<?php

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{
    protected $varDir;

    public function __construct($environment, $debug)
    {
        parent::__construct($environment, $debug);
        $this->varDir = $this->getVarDir();
    }

    public function registerBundles()
    {
        $bundles = array(
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Symfony\Bundle\MinimalBundle\MinimalBundle(),
            new Acme\HelloBundle\AcmeHelloBundle()
        );

        if (in_array($this->getEnvironment(), array('dev', 'test'))) {
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
        }

        return $bundles;
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(__DIR__.'/config/config.yml');

        if (in_array($this->getEnvironment(), array('dev', 'test'))) {
            $loader->load(function (ContainerBuilder $container) {
                $container->loadFromExtension('web_profiler', array(
                    'toolbar' => true,
                ));
            });
        }
    }

    /**
     * {@inheritdoc}
     *
     * @api
     */
    public function getVarDir()
    {
        return $this->rootDir.'/../var';
    }

    /**
     * {@inheritdoc}
     *
     * @api
     */
    public function getCacheDir()
    {
        return $this->varDir.'/cache/'.$this->environment;
    }

    /**
     * {@inheritdoc}
     *
     * @api
     */
    public function getLogDir()
    {
        return $this->varDir.'/logs';
    }
}
