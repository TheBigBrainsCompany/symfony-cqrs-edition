<?php

namespace Acme\Task\Ui\CliBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Doctrine\DBAL\Schema\SchemaException;

class CreateTaskViewModelSchemaCommand extends ContainerAwareCommand
{
    /**
     * @see Command
     */
    protected function configure()
    {
        $this
            ->setName('acme:task:create-task-view-model-schema')
            ->setDescription('Mounts tasks view model table in the database')
            ->setHelp(<<<EOF
The <info>%command.name%</info> command mounts tasks view model table in the database.

<info>php %command.full_name%</info>

EOF
            )
        ;
    }

    /**
     * @see Command
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        try {
            $this->getTaskViewModelRepository()->createTable();
        } catch (SchemaException $e) {
            $output->writeln("Aborting: " . $e->getMessage());

            return;
        }

        $output->writeln('Task view model table has been initialized successfully.');
    }

    /**
     * @return \Acme\Task\Infrastructure\Persistence\Doctrine\TaskViewModelDoctrineDbalRepository
     */
    public function getTaskViewModelRepository()
    {
        return $this->getContainer()->get('acme.task.query.repository.task_view_model_repository');
    }
}
