<?php
/**
 * Zend-form
 */

use Zend\View;
use EmailMKT\Infrastructure;
use EmailMKT\Application\Form;

$forms = [
    'dependencies' => [
        'aliases'    => [

        ],
        'invokables' => [

        ],
        'factories'  => [
            View\HelperPluginManager::class => Infrastructure\View\HelperPluginManagerFactory::class,
            Form\LoginForm::class           => Form\Factory\LoginFormFactory::class,
            Form\CustomerForm::class        => Form\Factory\CustomerFormFactory::class,
        ],
    ],
    'view_helpers' => [
        'aliases'    => [

        ],
        'invokables' => [

        ],
        'factories'  => [

        ],
    ],
];

$configProviderForm = (new \Zend\Form\ConfigProvider())->__invoke();

return \Zend\Stdlib\ArrayUtils::merge($configProviderForm, $forms);