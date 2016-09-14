<?php

return [
    'session' => [
        // Nome da sessão
        'name'     => 'PHPSESSID',
        // Tempo de expiração em segundos
        'lifetime' => 7200,

        'path'     => null,
        'domain'   => null,
        'secure'   => false,
        'httponly' => true,
    ],
];