<?php

namespace Acme\Task\Domain\Model;

use Acme\Task\Domain\Event\CreatedTaskEvent;
use LiteCQRS\DomainEventProvider;
use Rhumsaa\Uuid\Uuid;

class Task extends DomainEventProvider
{
    private $id;
    private $content;

    public function invent($id, $content)
    {
        $this->id = $id;
        $this->content = $content;

        $this->raise(new CreatedTaskEvent(array(
            'id' => $this->id,
            'content' => $this->content,
        )));
    }
}
