<?php
namespace ApplicationTest\Controller;
use Zend\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;

class UserControllerTest extends AbstractHttpControllerTestCase
{

    protected $traceError = true;

    public function setUp ()
    {
        $this->setApplicationConfig(
                include '../../config/application.config.php')

        ;
        parent::setUp();
    }

    public function testIndexActionCanBeAccessed ()
    {
        $this->dispatch('/');
        $this->assertResponseStatusCode(200);
    }
}