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
        ]
    ]
];
