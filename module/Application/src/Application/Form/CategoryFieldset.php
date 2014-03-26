<?php
namespace Application\Form;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;
use Zend\Stdlib\Hydrator\ClassMethods as ClassMethodsHydrator;
use Application\Entity\Category;
/**
 *
 * @author experion
 *        
 */
class CategoryFieldset extends Fieldset implements InputFilterProviderInterface
{
    public function __construct()
    {
        parent::__construct('category');
        $this->setHydrator(new ClassMethodsHydrator(false))
        ->setObject(new Category());
    
        $this->setLabel('Category');
    
        $this->add(array(
                'name' => 'name',
                'options' => array(
                        'label' => 'Name of the category'
                ),
                'attributes' => array(
                        'required' => 'required'
                )
        ));
    }

    /**
     * (non-PHPdoc)
     *
     * @see \Zend\InputFilter\InputFilterProviderInterface::getInputFilterSpecification()
     *
     */
    public function getInputFilterSpecification ()
    {
        
        return array(
                'name' => array(
                        'required' => true,
                )
        );
    }
}

?>