<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
namespace User;
use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Zend\Authentication\AuthenticationService;
use User\Adapter\AuthAdapter;
use User\Adapter\AuthStorage;
use User\Model\UserModel;
class Module
{

    public function onBootstrap (MvcEvent $e)
    {
        $eventManager = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
        
    }

    public function getConfig ()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig ()
    {
        return array(
                'Zend\Loader\StandardAutoloader' => array(
                        'namespaces' => array(
                                __NAMESPACE__ => __DIR__ . '/src/' .
                                         __NAMESPACE__
                        )
                )
        );
    }
    public function getServiceConfig()
    {
        return array(
                'factories'=>array(
                        'User\Adapter\AuthStorage' => function($sm){
                            return new \User\Adapter\AuthStorage('bookx');
                        },
                        'User\Model\UserModel' =>  function($sm) {
                            $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                            return new UserModel($dbAdapter);
                        },
                        'User\Adapter\AuthAdapter'=> function($sm){
                            return new \User\Adapter\AuthAdapter($sm->get('User\Model\UserModel'));
                        },
                        'AuthService' => function($sm) {
                            $authAdapter = $sm->get('User\Adapter\AuthAdapter');
                            $authService = new AuthenticationService();
                            $authService->setAdapter($authAdapter);
                            $authService->setStorage($sm->get('User\Adapter\AuthStorage'));
                            return $authService;
                        },
                        
                ),
        );
         
    }
}
