<?php

namespace ApplicationTest\Controller;

use Zend\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;

class ApplicationControllerTest extends AbstractHttpControllerTestCase
{
	protected $traceError = true;
   
     public function setUp()
    {
        $this->setApplicationConfig(
            include 'TestConfig.php'
        );
        parent::setUp();
    }
    public function testIndexActionCanBeAccessed()
	{
	  
	    $this->dispatch('/');
		$this->assertResponseStatusCode(200);
	   

	}

	
}