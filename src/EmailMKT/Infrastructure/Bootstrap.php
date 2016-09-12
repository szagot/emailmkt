<?php

namespace EmailMKT\Infrastructure;


use EmailMKT\Domain\Service\BootstrapInterface;

class Bootstrap implements BootstrapInterface
{

    public function create()
    {
        require __DIR__ . '/config/doctrine.php';
    }
}