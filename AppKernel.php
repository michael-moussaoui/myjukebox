<?php

use Symfony\Component\HttpKernel\Kernel;
use Vich\UploaderBundle\VichUploaderBundle;


class AppKernel extends Kernel
{
    public function registerBundles()
    {
        return array(
            // ...
            new VichUploaderBundle(),
        );
    }
}