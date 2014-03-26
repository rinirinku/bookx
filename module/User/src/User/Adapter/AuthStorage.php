<?php
namespace User\Adapter;

use Zend\Authentication\Storage\Session;

class AuthStorage extends Session
{

    public function setRememberMe ($rememberMe = 0, $time = 1209600)
    {
        if ($rememberMe == 1) {
            $this->session->getManager()->rememberMe($time);
        }
    }

    public function forgetMe ()
    {
        $this->session->getManager()->forgetMe();
    }
}

?>