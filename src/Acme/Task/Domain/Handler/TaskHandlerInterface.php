<?php

namespace Acme\Task\Domain\Handler;

use Acme\Task\Command\CreateTaskCommand;

interface TaskHandlerInterface
{
    function createTask(CreateTaskCommand $command);
}
