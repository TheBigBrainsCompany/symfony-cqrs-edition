<?php
/**
 * @author Boris Guéry <guery.b@gmail.com>
 */

namespace Acme\Task\Ui\WebBundle\EventListener;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\HttpKernel;
use Symfony\Component\Templating\EngineInterface;

class ApplicationInitializationListener
{
    private $installLockFilePath;
    private $templateEngine;

    public function __construct($installLockFilePath, EngineInterface $templateEngine)
    {
        $this->installLockFilePath = $installLockFilePath;
        $this->templateEngine      = $templateEngine;
    }

    public function onKernelRequest(GetResponseEvent $event)
    {
        if (HttpKernel::MASTER_REQUEST != $event->getRequestType()) {
            // don't do anything if it's not the master request
            return;
        }

        if (file_exists($this->installLockFilePath)) {

            return;

        }

        $event->setResponse(
            Response::create(
                $this->templateEngine->render('AcmeTaskUiWebBundle::_application_initialization_alert.html.twig')
            )
        );
    }
} 
