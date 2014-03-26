<?php
namespace Application\Form;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;
use Application\Entity\Product;
use Application\Form\BrandFieldset;
use Application\Form\CategoryFieldset;
use Zend\Stdlib\Hydrator\ClassMethods as ClassMethodsHydrator;
/**
 *
 * @author experion
 *        
 */
class ProductFieldset extends Fieldset implements InputFilterProviderInterface
{
    
    public function __construct()
    {
        parent::__construct('product');
        $this->setHydrator(new ClassMethodsHydrator(false))
        ->setObject(new Product());
    
        $this->add(array(
                'name' => 'name',
                'options' => array(
                        'label' => 'Name of the product'
                ),
                'attributes' => array(
                        'required' => 'required'
                )
        ));
    
        $this->add(array(
                'name' => 'price',
                'options' => array(
                        'label' => 'Price of the product'
                ),
                'attributes' => array(
                        'required' => 'required'
                )
        ));
    
        $this->add(array(
                'type' => 'Application\Form\BrandFieldset',
                'name' => 'brand',
                'options' => array(
                        'label' => 'Brand of the product'
                )
        ));
    
        $this->add(array(
                'type' => 'Zend\Form\Element\Collection',
                'name' => 'categories',
                'options' => array(
                        'label' => 'Please choose categories for this product',
                        'count' => 2,
                        'should_create_template' => true,
                        'allow_add' => true,
                        'target_element' => array(
                                'type' => 'Application\Form\CategoryFieldset'
                        )
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
                ),
                'price' => array(
                        'required' => true,
                        'validators' => array(
                                array(
                                        'name' => 'Float'
                                )
                        )
                )
        );
    }
}

?>