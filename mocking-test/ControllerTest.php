<?php

require __DIR__ . '/vendor/autoload.php';
use PHPUnit\Framework\TestCase;
use SAC_WebAPI\Model\Ticket;
use SAC_WebAPI\Controllers\Controller;

include_once './Controllers/Controller.php';
include_once './Models/Ticket.php';

class ControllerTest extends TestCase{
	
	public function tearDown() : void{
		Mockery::close();
	}

	public function testAbrirTicket(){
		$mock = Mockery::mock('DataAccess');
		$mock->shouldReceive('abrirTicket')->andReturn(1);
		$controller = new Controller($mock);
		$result = $controller->abrirTicket("gustavo", "gustavo@gmail.com", "9999", "alou", "nada");
		$this->assertEquals(1, $result);
	}

	public function testGetTodosTickets(){
		$mock = Mockery::mock('DataAccess');
		$mock->shouldRecieve('getTodosTickets')->andReturn(1);
		$controller = new Controller($mock);
		$result = $controller->getTodosTickets();
		$this->assertEquals(1, $result);
	}

}
?>
