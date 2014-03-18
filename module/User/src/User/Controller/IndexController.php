<?php
/**
 * Experion Technologies (http://experionglobal.com//)
 *
 * @link      https://github.com/rinirinku/bookx for the canonical source repository
 * @copyright Copyright (c) 2014-2015 Experion Technologies (http://experionglobal.com//)
 * @license  
 */
namespace User\Controller;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{

    public function indexAction ()
    {
        return new ViewModel();
    }

    public function profileAction ()
    {
        return new ViewModel();
    }
}
