<?php

namespace Acme\Task\Domain\Handler;

use Acme\Task\Command\CreateTaskCommand;
use Acme\Task\Domain\Model\Task;
use Acme\Task\Domain\Repository\TaskRepositoryInterface;
use LiteCQRS\Bus\IdentityMap\IdentityMapInterface;

class TaskHandler implements TaskHandlerInterface
{
    protected $identityMap;
    protected $taskRepository;

    public function __construct(IdentityMapInterface $identityMap, TaskRepositoryInterface $taskRepository)
    {
        $this->identityMap = $identityMap;
        $this->taskRepository = $taskRepository;
    }

    public function createTask(CreateTaskCommand $command)
    {
        // TODO: Factory ?
        $task = new Task();
        $this->identityMap->add($task);

        $task->invent($command->id, $command->content);

        $this->taskRepository->add($task);
    }
}
