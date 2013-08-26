<?php

namespace Acme\Task\Infrastructure\InfrastructureBundle\DataFixtures\ORM;

use Acme\Task\Command\CreateTaskCommand;
use Rhumsaa\Uuid\Uuid;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class TaskData extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     *
     * @return ContainerInterface
     */
    public function getContainer()
    {
        return $this->container;
    }

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create();

        for($i = 0 ; $i < 10 ; $i++) {
            $createTaskCommand = new CreateTaskCommand(array(
                'id' => (string) Uuid::uuid4(),
                'content' => $faker->sentence(8),
            ));

            $this->getCommandBus()->handle($createTaskCommand);
        }
    }

    /**
     * @return \LiteCQRS\Bus\CommandBus;
     */
    public function getCommandBus()
    {
        return $this->getContainer()->get('command_bus');
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 1;
    }
}
