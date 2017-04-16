<?php

namespace EmailMKT\Application\Form\Factory;

use Doctrine\ORM\EntityManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use EmailMKT\Application\Form\CampaignForm;
use EmailMKT\Application\InputFilter\CampaignInputFilter;
use EmailMKT\Domain\Entity\Campaign;
use Interop\Container\ContainerInterface;

class CampaignFormFactory
{
    public function __invoke(ContainerInterface $container): CampaignForm
    {
        $entityManager = $container->get(EntityManager::class);

        $form = new CampaignForm();

        // Hidratador: pega um array com os dados do form e seta as propriedades da entidade
        $form->setHydrator(new DoctrineObject($entityManager));
        $form->setObject(new Campaign());

        // Validando Campaign
        $form->setInputFilter(new CampaignInputFilter());

        // Setando o ObjectManager para controle de tags do Contato
        $form->setObjectManager($entityManager);

        // Inicia o form (faz-se necessário devido ao ObjectManager)
        $form->init();

        return $form;
    }
}
