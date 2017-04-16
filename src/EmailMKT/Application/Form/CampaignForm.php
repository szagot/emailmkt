<?php

namespace EmailMKT\Application\Form;

use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Form\Element\ObjectSelect;
use EmailMKT\Domain\Entity\Tag;
use Zend\Form\Form;
use Zend\Form\Element;

class CampaignForm extends Form
{
    private $objectManager;

    public function __construct($name = 'campaign', array $options = [])
    {
        parent::__construct($name, $options);
    }

    public function init()
    {
        // Adicionando Campos
        $this->add([
            'name' => 'id',
            'type' => Element\Hidden::class
        ]);

        $this->add([
            'name'       => 'name',
            'type'       => Element\Text::class,
            'options'    => [
                'label' => 'Nome'
            ],
            'attributes' => [
                'id' => 'name'
            ],
        ]);

        $this->add([
            'name'       => 'subject',
            'type'       => Element\Text::class,
            'options'    => [
                'label' => 'Assunto'
            ],
            'attributes' => [
                'id' => 'subject'
            ],
        ]);

        $this->add([
            'name'       => 'tags',
            'type'       => ObjectSelect::class,
            'options'    => [
                'object_manager' => $this->getObjectManager(),
                'target_class'   => Tag::class,
                'property'       => 'name',
                'label'       => 'Tags',
            ],
            'attributes' => [
                'multiple' => 'multiple'
            ],
        ]);

        $this->add([
            'name'       => 'template',
            'type'       => Element\Textarea::class,
            'options'    => [
                'label' => 'Template'
            ],
            'attributes' => [
                'id' => 'template'
            ],
        ]);

        $this->add([
            'name'       => 'submit',
            'type'       => Element\Button::class,
            'attributes' => [
                'type' => 'submit'
            ],
            'options'    => [
                'label_options' => [
                    'disable_html_escape' => true, #permite html no label
                ]
            ]
        ]);

    }

    /**
     * Set the object manager
     *
     * @param ObjectManager $objectManager
     */
    public function setObjectManager(ObjectManager $objectManager)
    {
        $this->objectManager = $objectManager;
    }

    /**
     * Get the object manager
     *
     * @return ObjectManager
     */
    public function getObjectManager(): ObjectManager
    {
        return $this->objectManager;
    }
}