<?php
/**
 * Zend-form
 */

use Zend\View;
use EmailMKT\Infrastructure;
use EmailMKT\Application\Form\{
    CustomerForm, LoginForm
};
use EmailMKT\Application\Form\Factory\{
    CustomerFormFactory, LoginFormFactory
};

$forms = [
    'dependencies' => [
        'aliases'    => [

        ],
        'invokables' => [

        ],
        'factories'  => [
            View\HelperPluginManager::class => Infrastructure\View\HelperPluginManagerFactory::class,
            LoginForm::class                => LoginFormFactory::class,
            CustomerForm::class             => CustomerFormFactory::class,
        ],
    ],
    'view_helpers' => [
        'aliases'    => [

        ],
        'invokables' => [

        ],
        'factories'  => [
            // Helper para pegar o usuário logado
            'identity' => View\Helper\Service\IdentityFactory::class
        ],
    ],
];

$configProviderForm = (new \Zend\Form\ConfigProvider())->__invoke();

return \Zend\Stdlib\ArrayUtils::merge($configProviderForm, $forms);