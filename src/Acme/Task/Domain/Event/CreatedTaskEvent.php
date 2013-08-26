<?php

namespace Acme\Task\Domain\Event;

use Ano\CqrsBundle\Domain\Event\DomainEvent;

class CreatedTaskEvent extends DomainEvent
{
    public $id;
    public $content;

    public function getEventName()
    {
        return 'CreatedTask';
    }
}
