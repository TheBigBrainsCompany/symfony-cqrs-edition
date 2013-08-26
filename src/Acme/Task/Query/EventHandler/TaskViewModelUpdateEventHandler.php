<?php

namespace Acme\Task\Query\EventHandler;

use Acme\Task\Query\ViewModel\TaskViewModel;
use Acme\Task\Query\Repository\TaskViewModelRepositoryInterface;
use Acme\Task\Domain\Event\CreatedTaskEvent;

class TaskViewModelUpdateEventHandler
{
    private $taskViewModelRepository;

    /**
     * Constructor
     *
     * @param TaskViewModelRepositoryInterface $taskViewModelRepository
     */
    public function __construct(TaskViewModelRepositoryInterface $taskViewModelRepository)
    {
        $this->taskViewModelRepository = $taskViewModelRepository;
    }

    /**
     * CreatedTask event handling
     *
     * @param CreatedTaskEvent $event
     */
    public function onCreatedTask(CreatedTaskEvent $event)
    {
        $taskViewModel = new TaskViewModel(array(
            'id' => (string) $event->id,
            'content' => $event->content,
        ));

        $this->taskViewModelRepository->save($taskViewModel);
    }
}
