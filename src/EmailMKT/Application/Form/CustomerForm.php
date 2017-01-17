<?php
namespace EmailMKT\Application\Form;

use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Form\Element\ObjectSelect;
use DoctrineModule\Persistence\ObjectManagerAwareInterface;
use DoctrineORMModule\Service\ObjectSelectFactory;
use EmailMKT\Domain\Entity\Tag;
use Zend\Form\Form;
use Zend\Form\Element;

class CustomerForm extends Form implements ObjectManagerAwareInterface
{
    private $objectManager;

    public function __construct($name = 'customer', array $options = [])
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
            'name'       => 'email',
            // NOTA:
            // Element\Email::class não usada por estar sendo validado em CustomerInputFilter
            // Pq senão ele mostra os erros em ingles referente eo email
            // No lugar, usa-se o atributo email*
            'type'       => Element\Text::class, # vide nota acima
            'options'    => [
                'label' => 'E-mail'
            ],
            'attributes' => [
                'id'   => 'email',
                // *Este atributo
                'type' => 'email' # vide nota acima
            ],
        ]);

        $this->add([
            'name'    => 'tags',
            'type'    => ObjectSelect::class,
            'attributes' => [
                'multiple' => 'multiple'
            ],
            'options' => [
                'object_manager' => $this->getObjectManager(),
                'target_class'   => Tag::class,
                'property'       => 'name'
            ]
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