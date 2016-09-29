<?php
// Configurações de Banco de dados para execução local

use EmailMKT\Domain\Entity\User;

return [
    'doctrine' => [
        'connection'     => [
            'orm_default' => [
                'driverClass' => \Doctrine\DBAL\Driver\PDOMySql\Driver::class,
                'params'      => [
                    'host'          => 'localhost',
                    'port'          => '3306',
                    'user'          => '',
                    'password'      => '',
                    'dbname'        => 'homestead',
                    'driverOptions' => [
                        \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES "UTF8"'
                    ],
                ],
            ],
        ],
        'driver'         => [
            'EmailMKT_driver' => [
                'class' => \Doctrine\ORM\Mapping\Driver\YamlDriver::class,
                'cache' => 'array',
                'paths' => [__DIR__ . '/../../src/EmailMKT/Infrastructure/Persistence/Doctrine/ORM']
            ],
            'orm_default'     => [
                'drivers' => [
                    'EmailMKT\Domain\Entity' => 'EmailMKT_driver'
                ],
            ],
        ],
        // Autenticação do sistema
        'authentication' => [
            'orm_default' => [
                'object_manager'      => Doctrine\ORM\EntityManager::class,
                // Entidade de usuário
                'identity_class'      => EmailMKT\Domain\Entity\User::class,
                // Campo de identificação
                'identity_property'   => 'email',
                // Campo de Senha
                'credential_property' => 'password',
                // Como autenticar a senha?
                'credential_callable' => function (User $user, $passwordGiven) {
                    // Verifica a senha passada comparando com a senha da entidade
                    return password_verify($passwordGiven, $user->getPassword());
                },
            ],
        ],
    ],
];
