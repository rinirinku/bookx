<?php
namespace User\Adapter;
use Zend\Authentication\Adapter\AdapterInterface;
use Zend\Authentication\Result;
use User\Model\UserModel as UserModel;

class AuthAdapter implements AdapterInterface
{
    private $username; 
    
    private $password;
    
    private $userentity;
    
    private $usermodel;
    
   // private $permissions;
    
    public function __construct($usermodel)
    {
        $this->usermodel=$usermodel;
    }
    
    
    /*
     * (non-PHPdoc) @see
     * \Zend\Authentication\Adapter\AdapterInterface::authenticate()
     */
    public function authenticate ()
    {
        
         $result= $this->usermodel->isValidUser($this->userentity);
         if ($result) {
             return $this->getResult(Result::SUCCESS, $result, 'SUCCESS');
         } else {
             return $this->getResult(Result::FAILURE_CREDENTIAL_INVALID, null, 'FAILURE_CREDENTIAL_INVALID');
         }
        
    }
    private function getResult($type, $identity, $message)
    {
        return new Result($type, $identity, array(
                $message
        ));
    }
    public function setIdentity($username)
    {
        $this->username = $username;
        return $this;
    }
    
    public  function setCredential($password)
    {
        //echo $password;die;
        $this->password = $password;
    
        return $this;
    }
    
    public function setUserModel($userentity)
    {
        $this->userentity =$userentity;
        return $this;
    }
    
}
