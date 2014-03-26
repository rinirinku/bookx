<?php
namespace User\Form;
use User\Model\Entity\UserEntity;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Stdlib\Hydrator\ClassMethods as ClassMethodsHydrator;

class UserFieldset extends Fieldset implements InputFilterProviderInterface
{
    public function __construct()
    {
        parent::__construct('user');
        $this->setHydrator(new ClassMethodsHydrator(false))
        ->setObject(new UserEntity());
    
        $this->add(array(
                'name' => 'username',
                'options' => array(
                       // 'label' => 'User Name'
                ),
                
                'attributes' => array(
                        'required' => 'required',
                         'class' => 'form-control',
                       'placeholder'=>'Enter User Name'
                )
        ));
    
        $this->add(array(
                'name' => 'password',
                'options' => array(
                       // 'label' => 'Password'
                ),
                'attributes' => array(
                        'required' => 'required',
                        'class' => 'form-control',
                        'placeholder'=>'Enter Password',
                        'type'    => 'password'
                )
        ));
        $this->add($this->setCheckBox());
    
    
    }
    
    public function setCheckBox()
    {
        return array(
             'type' => 'Zend\Form\Element\Checkbox',
             'name' => 'rememberme',
              'class'=> 'form-control',
             'options' => array(
                    'label' => 'Remember    ',
                     'use_hidden_element' => true,
                     'checked_value' => 'rememberme',
                     
             )
             
         );
    }
    
    /**
     * Should return an array specification compatible with
     * {@link Zend\InputFilter\Factory::createInputFilter()}.
     *
     * @return array
     \*/
    public function getInputFilterSpecification()
    {
        return array(
                'username' => array(
                        'required' => true,
                ),
                'password' => array(
                        'required' => true,
    
                )
        );
    }
}

?>