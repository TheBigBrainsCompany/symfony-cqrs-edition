<?php

namespace Acme\Task\Domain\Event;

use LiteCQRS\Bus\EventMessageHeader;
use LiteCQRS\DomainEvent as DomainEventInterface;

abstract class DomainEvent implements DomainEventInterface
{
    private $messageHeader;

    public function __construct(array $args = array())
    {
        foreach ($args as $property => $value) {
            $this->$property = $value;
        }
        $this->messageHeader = new EventMessageHeader();
    }

    public function getAggregateId()
    {
        return $this->messageHeader->aggregateId;
    }

    public function getMessageHeader()
    {
        return $this->messageHeader;
    }
}
