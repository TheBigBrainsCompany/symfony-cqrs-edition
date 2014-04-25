<?php

namespace Acme\Task\Domain\Event;

class CreatedTaskEvent extends DomainEvent
{
    public $id;
    public $content;

    public function getEventName()
    {
        return 'CreatedTask';
    }
}
