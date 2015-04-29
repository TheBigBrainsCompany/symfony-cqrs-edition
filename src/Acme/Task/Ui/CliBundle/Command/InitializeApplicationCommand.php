<?php

namespace Acme\Task\Ui\CliBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class InitializeApplicationCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('acme:task:initialize')
            ->setDescription('Initialize application by running the different commands required to have a working installation with loaded fixtures')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $installLockFile = $this->getContainer()->getParameter('kernel.root_dir') . '/../var/install.lock';
        if (file_exists($installLockFile)) {
            $installationDate = date(\DateTime::ISO8601, (int)trim(file_get_contents($installLockFile)));

            $output->writeln(
                sprintf(
                    '<error>Your application has already been initialized on %s. If you want re-initialize it, make sure to remove "%s" manually.</error>',
                    $installationDate,
                    realpath($installLockFile)
                )
            );

            $output->writeln(
                sprintf(
                    '<error>You may also need to run "doctrine:database:drop" command manually.</error>',
                    $installationDate,
                    realpath($installLockFile)
                )
            );

            return -1;
        }

        $commands = array();
        $commands[] = array('doctrine:database:create'               , array('--verbose'  => true, '--connection' => 'write'));
        $commands[] = array('doctrine:schema:create'                 , array('--em' => 'write'));

        if ($this->getContainer()->getParameter('db_read_name') != $this->getContainer()->getParameter('db_write_name')) {
            $commands[] = array('doctrine:database:create'           , array('--verbose'  => true, '--connection' => 'read'));
        }

        $commands[] = array('acme:task:create-task-view-model-schema', array());
        $commands[] = array('doctrine:fixtures:load'                 , array());

        foreach ($commands as $command) {
            list($commandName, $commandOptions) = $command;

            $command = $this->getApplication()->find($commandName);
            $commandInput = new ArrayInput(
                array_merge(
                    array(
                        'command'             => $commandName,
                        '--env'               => $input->getOption('env'),
                    ),
                    $commandOptions
                )
            );
            $command->run($commandInput, $output);
        }

        $output->writeln('');
        $output->writeln(
            sprintf(
                '<info>Your application has been initialized, you can know browse it from your browser.</info>'
            )
        );

        file_put_contents($installLockFile, time());
    }
}
