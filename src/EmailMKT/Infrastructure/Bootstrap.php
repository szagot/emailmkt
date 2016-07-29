<?php

namespace EmailMKT\Infrastructure;


use EmailMKT\Service\BootstrapInterface;

class Bootstrap implements BootstrapInterface
{

    public function create()
    {
        require __DIR__ . '/config/doctrine.php';
    }
}