<?php 
namespace User\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilter;
use Zend\Stdlib\Hydrator\ClassMethods as ClassMethodsHydrator;

class UserForm extends Form
{
    public function __construct()
    {
        parent::__construct('user_form');

        $this->setAttribute('method', 'post')
             ->setHydrator(new ClassMethodsHydrator(false))
             ->setInputFilter(new InputFilter());

        $this->add(array(
            'type' => 'User\Form\UserFieldset',
            'options' => array(
                'use_as_base_fieldset' => true
            )
        ));
        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type' => 'submit',
                'value' => 'Login',
                 'class'=>'btn btn-default'
            )
        ));
    }
}