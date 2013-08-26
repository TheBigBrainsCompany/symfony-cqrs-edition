<?php

namespace Acme\Task\Domain\Repository;

use Acme\Task\Domain\Model\Task;

interface TaskRepositoryInterface
{
    /**
     * Adds one Task to the repository
     *
     * @param Task $task
     * @return void
     */
    function add(Task $task);

    /**
     * Fetch one Task by its ID (Uuid)
     *
     * @param string $id
     * @return Task|null
     */
    function get($id);
}
