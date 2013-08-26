<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),

            // CQRS
            new LiteCQRS\Plugin\SymfonyBundle\LiteCQRSBundle(),
            new Ano\CqrsBundle\AnoCqrsBundle(),

            // UI
            new Liip\ThemeBundle\LiipThemeBundle(),
        );

        if (in_array($this->getEnvironment(), array('dev', 'test'))) {
            // --> Acme Task bundles (to be removed)

            // Infrastructure
            $bundles[] = new Acme\Task\Infrastructure\InfrastructureBundle\AcmeTaskInfrastructureInfrastructureBundle();

            // Ui
            $bundles[] = new Acme\Task\Ui\SharedBundle\AcmeTaskUiSharedBundle();
            $bundles[] = new Acme\Task\Ui\WebBundle\AcmeTaskUiWebBundle();
            $bundles[] = new Acme\Task\Ui\CliBundle\AcmeTaskUiCliBundle();
//            $bundles[] = new Acme\Task\Ui\ApiBundle\AcmeTaskUiApiBundle();

            // <-- End Acme Task bundles

            $bundles[] = new Doctrine\Bundle\FixturesBundle\DoctrineFixturesBundle();
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
            $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
        }

        return $bundles;
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(__DIR__.'/config/config_'.$this->getEnvironment().'.yml');
    }

    public function getCacheDir()
    {
        return realpath($this->rootDir.'/../var/cache').'/'.$this->environment;
    }

    public function getLogDir()
    {
        return realpath($this->rootDir.'/../var/logs');
    }
}
