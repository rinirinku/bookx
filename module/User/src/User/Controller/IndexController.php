<?php
/**
 * Experion Technologies (http://experionglobal.com//)
 *
 * @link      https://github.com/rinirinku/bookx for the canonical source repository
 * @copyright Copyright (c) 2014-2015 Experion Technologies (http://experionglobal.com//)
 * @license  
 */
namespace User\Controller;
use User\Model\Entity\UserEntity;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use User\Model\Data\UserInfo;
use User\Form\LoginForm;
use User\Form\UserForm;
class IndexController extends AbstractActionController
{
    protected $authservice;
    protected $storage;
    protected $userform;
    protected $userentity;
    public function getAuthService()
    {
        if (! $this->authservice) {
            $this->authservice = $this->getServiceLocator()
            ->get('AuthService');
        }
         
        return $this->authservice;
    }
     
    public function getSessionStorage()
    {
        if (! $this->storage) {
            $this->storage = $this->getServiceLocator()
            ->get('User\Adapter\AuthStorage');
        }
         
        return $this->storage;
    }
    public function getUserModel()
    {
        if (! $this->userModel) {
            $this->usertable = $this->getServiceLocator()
            ->get('User\Model\UserModel');
        }
         
        return $this->usertable;
    }
    
    public function getUserForm()
    {
        if(!$this->userform)
        {
            $this->userform = new UserForm();
            
        }
        return $this->userform;
    }
    public function getUserEntity()
    {
        if(!$this->userentity)
        {
            $this->userentity = new UserEntity();
    
        }
        return $this->userentity;
    }
    public function indexAction ()
    {
      // var_dump($this->getAuthService()->hasIdentity());die;
        //if already login, redirect to success page
        if ($this->getAuthService()->hasIdentity()){
            return $this->redirect()->toRoute('profile');
        }
          return array(
                'form' => $this->getUserForm(),
                'messages'  => $this->flashmessenger()->getMessages()
        );
    }
    public function authenticateAction ()
    {//echo "here";die;
        $userform = $this->getUserForm();
        $userentity= $this->getUserEntity();
        $userform->bind($userentity);
        $redirect='login';
     //  var_dump($_POST);die;
        if ($this->request->isPost()) {
            $userform->setData($this->request->getPost());
            if ($userform->isValid()) {
                //var_dump($userentity);
                //check authentication...
                $userPost =$this->request->getPost('user');
                $this->getAuthService()->getAdapter()
                ->setIdentity($userPost['username'])
                ->setCredential($userPost['password'])
                ->setUserModel($userentity);
                ;
                 
                 
                $result = $this->getAuthService()->authenticate();
                foreach($result->getMessages() as $message)
                {
                    //save message temporary into flashmessenger
                    $this->flashmessenger()->addMessage($message);
                }
    
                if ($result->isValid()) {
                    $redirect = 'profile';
                    //check if it has rememberMe :
                    if ($userPost['rememberme'] == 1 ) {
                     //   echo "here";die;
                        $this->getSessionStorage()
                        ->setRememberMe(1);
                        //set storage again
                        $this->getAuthService()->setStorage($this->getSessionStorage());
                    }
                    $this->getAuthService()->getStorage()->write($userPost['username']);
                }
                 
            }
        }
        return $this->redirect()->toRoute($redirect);
        
         
       
    }
    public function profileAction ()
    {
        return new ViewModel();
    }
    
    public function logoutAction()
    {
        $this->getSessionStorage()->forgetMe();
        $this->getAuthService()->clearIdentity();
         
        $this->flashmessenger()->addMessage("You've been logged out");
        return $this->redirect()->toRoute('login');
    }
    
    
}
