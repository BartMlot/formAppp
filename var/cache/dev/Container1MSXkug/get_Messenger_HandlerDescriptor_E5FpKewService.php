<?php

namespace Container1MSXkug;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class get_Messenger_HandlerDescriptor_E5FpKewService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private '.messenger.handler_descriptor.e5FpKew' shared service.
     *
     * @return \Symfony\Component\Messenger\Handler\HandlerDescriptor
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).''.\DIRECTORY_SEPARATOR.'vendor'.\DIRECTORY_SEPARATOR.'symfony'.\DIRECTORY_SEPARATOR.'messenger'.\DIRECTORY_SEPARATOR.'Handler'.\DIRECTORY_SEPARATOR.'HandlerDescriptor.php';

        $a = ($container->privates['App\\MessageHandler\\FormMessageHandler'] ?? $container->load('getFormMessageHandlerService'));

        if (isset($container->privates['.messenger.handler_descriptor.e5FpKew'])) {
            return $container->privates['.messenger.handler_descriptor.e5FpKew'];
        }

        return $container->privates['.messenger.handler_descriptor.e5FpKew'] = new \Symfony\Component\Messenger\Handler\HandlerDescriptor($a->__invoke(...), ['priority' => 10, 'from_transport' => 'async']);
    }
}
