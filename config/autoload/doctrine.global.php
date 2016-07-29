<?php
// Configurações de Banco de dados para execução local

return [
    'doctrine' => [
        'connection' => [
            'orm_default' => [
                'driverClass' => 'Doctrine\DBAL\Driver\PDOMySql\Driver',
                'params'      => [
                    'host'          => 'localhost',
                    'port'          => '3306',
                    'user'          => '',
                    'password'      => '',
                    'dbname'        => 'homestead',
                    'driverOptions' => [
                        \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES "UTF8"'
                    ]
                ]
            ]
        ],
        'driver'     => [
            'EmailMKT_driver' => [
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => [ __DIR__ . '/../../src/EmailMKT/Entity' ]
            ],
            'orm_default' => [
                'drivers' => [
                    'EmailMKT\Entity' => 'EmailMKT_driver'
                ]
            ]
        ]
    ],
];
