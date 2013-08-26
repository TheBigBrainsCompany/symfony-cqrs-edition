<?php

namespace Acme\Task\Infrastructure\Persistence\Doctrine;

use Acme\Task\Query\Repository\TaskViewModelRepositoryInterface;
use Acme\Task\Query\ViewModel\TaskViewModel;
use Acme\Task\Query\ViewModel\TaskViewModelCollection;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Schema\SchemaException;
use Doctrine\DBAL\Schema\Schema;

class TaskViewModelDoctrineDbalRepository implements TaskViewModelRepositoryInterface
{
    protected $connection;
    protected $tableName;

    /**
     * Constructor
     *
     * @param Connection $connection
     * @param string     $tableName
     */
    public function __construct(Connection $connection, $tableName = 'tasks_views')
    {
        $this->connection = $connection;
        $this->tableName = $tableName;
    }

    /**
     * {@inheritDoc}
     */
    public function save(TaskViewModel $taskViewModel)
    {
        $data = $taskViewModel->toArray();

        $this->connection->insert($this->tableName, $data);
    }

    /**
     * {@inheritDoc}
     */
    public function getByTaskId($id)
    {
        return $this->em->getRepository($this->class)->find($id);
    }

    /**
     * {@inheritDoc}
     */
    public function getList($offset, $limit)
    {
        $rows = $this->connection->fetchAll(sprintf(
            'SELECT * FROM %s LIMIT %d, %d', $this->tableName, $offset, $limit));

        if (!$rows) {
            return null;
        }

        $collection = new TaskViewModelCollection(array(), $offset, $limit, count($rows));
        foreach($rows as $row) {
            $collection->add(new TaskViewModel(array(
                'id' => $row['id'],
                'content' => $row['content'],
            )));
        }

        return $collection;
    }


    /**
     * Creates task view model table in the database
     */
    public function createTable()
    {
        $schema = new Schema();
        $table = $schema->createTable($this->tableName);
        $table->addColumn('id', 'string', array('length' => 64, 'nullable' => false, 'unique' => true));
        $table->addColumn('content', 'string', array('length' => 255, 'nullable' => false));
        $table->setPrimaryKey(array('id'));

        foreach ($schema->toSql($this->connection->getDatabasePlatform()) as $sql) {
            $this->connection->exec($sql);
        }
    }
}
