<?php
namespace User\Model\Entity;
use User\Model\Entity\Entity;

class UserEntity extends Entity
{

    protected  $username;

    protected  $password;
    
    protected  $empcode;
    
    

    public function setUserName ($username)
    {
        $this->username = $username;
        return $this;
    }

    public function getUserName ()
    {
        return $this->username;
    }

    public function setPassword ($password)
    {
        $this->password = $password;
        return $this;
    }

    public function getPassword ()
    {
        return $this->password;
    }
    public function setEmpcode ($empcode)
    {
        $this->empcode = $empcode;
        return $this;
    }
    
    public function getEmpCode ()
    {
        return $this->empcode;
    }
}

?>