<?php
namespace User\Form;
use Zend\Form\Form;
use Zend\Form\Element;

/**
 *
 * @author experion
 *        
 */
class LoginForm extends Form
{
    protected $username;
    
    protected $password;
    
    public function __construct($name='login')
    {
        parent::__construct('login');
        $this->add($this->setUserName());
        $this->add($this->setPassword());
    }
    
    public function setUserName()
    {
        $this->username = new Element('username');
        $this->username->setAttributes(array(
                'type'  => 'text'
        ));
        return $this->username;
    }
    
    public function setPassword()
    {
        $this->password = new Element();
        $this->password->setAttributes(array(
                'type'  => 'password'
        ));
        return $this->password;
    }
}

?>