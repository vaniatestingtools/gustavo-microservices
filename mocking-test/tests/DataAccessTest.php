<?php

require './vendor/autoload.php';
use PHPUnit\Framework\TestCase;
use SAC_WebAPI\DataAccess\DataAccess;

class DataAccessTest extends TestCase{
    
    public function tearDown() : void{
        Mockery::close();
    }

    public function testAbrirTicket(){
        $dataAccess = new DataAccess();
        $mock = Mockery::mock(\mysqli::class);
        $dataAccess->connect($mock);
        $dataAccess->connect($mock);
    }

    // public function testAbrirTicket(){
    //     $dataAccess = new DataAccess();

    // }
}
?>