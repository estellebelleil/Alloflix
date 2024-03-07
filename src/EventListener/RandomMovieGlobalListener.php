<?php

namespace App\EventListener;

use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Symfony\Component\HttpKernel\KernelEvents;

final class RandomMovieGlobalListener
{
    /**
     * Fonction qui s'éxecute lorsque l'evenement kernel.controller s'execute
     *
     * @param ControllerEvent $event
     * @return void
     */
    #[AsEventListener(event: KernelEvents::CONTROLLER)]
    public function onKernelController(ControllerEvent $event): void
    {
        // dump("L'évenement kernel.controller est declenché !");
    }
}
