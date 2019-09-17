<?php

require './vendor/autoload.php';

// use PHPUnit\Framework\TestCase;
use SAC_WebAPI\Model\Ticket;
use SAC_WebAPI\Controllers\Controller;
use SAC_WebAPI\Exceptions\InvalidTicketException;
use \Mockery as m;

include_once './Exceptions/InvalidTicketException.php';
include_once './Controllers/Controller.php';
include_once './Models/Ticket.php';

class ControllerTest extends PHPUnit\Framework\TestCase{

	/**
	 * @expectedException SAC_WebAPI\Exceptions\InvalidTicketException
	 */
	public function testAbrirTicket(){
		$mock = m::mock('DataAccess');
		$mock->shouldReceive('abrirTicket')->andReturn(1);

		$controller = new Controller($mock);
		try{
			$result = $controller->abrirTicket(null, "gustavo@gmail.com", "9999", "alou", "nada");
			$this->assertEquals($result, 1);
		}catch(InvalidTicketException $e){
			$this->assertNotNull($e->getData());
			throw new InvalidTicketException();
		}


	}

	public function tearDown() : void{
		m::close();
		parent::tearDown();
	}

}
?>
