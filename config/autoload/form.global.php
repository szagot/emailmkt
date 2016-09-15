<?php
/**
 * Zend-form
 */

use Zend\View;
use EmailMKT\Infrastructure;

$forms = [
    'dependencies' => [
        'aliases'    => [

        ],
        'invokables' => [

        ],
        'factories'  => [
            View\HelperPluginManager::class => Infrastructure\View\HelperPluginManagerFactory::class,
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