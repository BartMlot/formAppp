<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserFormType;
use App\Message\UserFormTypeMessage;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class FormController extends AbstractController
{
    #[Route('/form', name: 'user_form')]
    public function new(Request $request, MessageBusInterface $bus): Response
    {
        $form = $this->createForm(UserFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $userData = $form->getData();

                if (!$file = $userData['picture']) {
                    $user = (new User())
                        ->setFirstName($userData['firstName'])
                        ->setLastName($userData['lastName']);
                } else {
                    $destination = $this->getParameter('kernel.project_dir') . '/public/uploads';
                    $newFilename = uniqid() . '.' . $file->guessExtension();
                    $file->move($destination, $newFilename);

                    $user = (new User())
                        ->setFirstName($userData['firstName'])
                        ->setLastName($userData['lastName'])
                        ->setPicture($newFilename);
                }

                $bus->dispatch(new UserFormTypeMessage($user));

                $this->addFlash('success', 'Form submitted successfully!');
            } catch (FileException $e) {
                $this->addFlash('error', 'An error occurred while processing the file. Please try again.');
            } catch (\Exception $e) {
                $this->addFlash('error', 'An unexpected error occurred. Please try again.');
            }

            return $this->redirectToRoute('user_form');
        }

        return $this->render('form/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}