<?php
/**
 * Zend-form
 */

use Zend\View;
use EmailMKT\Infrastructure;
use EmailMKT\Application\Form\{
    CustomerForm, LoginForm, UserForm, TagForm, CampaignForm
};
use EmailMKT\Application\Form\Factory\{
    CustomerFormFactory, LoginFormFactory, UserFormFactory, TagFormFactory, CampaignFormFactory
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
            UserForm::class                 => UserFormFactory::class,
            TagForm::class                  => TagFormFactory::class,
            CampaignForm::class             => CampaignFormFactory::class,
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