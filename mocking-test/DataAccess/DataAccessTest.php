<?php

require './vendor/autoload.php';
use PHPUnit\Framework\TestCase;
use SAC_WebAPI\DataAccess\DataAccess;

class DataAccessTest extends TestCase{
    
    public function tearDown() : void{
        Mockery::close();
    }

    public function testConnection(){
        $dataAccess = new DataAccess();
        $mock = Mockery::mock(\mysqli::class);
        // $mock->set($connect_errno, true);
        // $mock->set($connet_error, "error");
        //$this->expectException(\Exception::class);
        $dataAccess->connect($mock);
        $this->assertNull($dataAccess->host);
    }

    // public function testAbrirTicket(){
    //     $dataAccess = new DataAccess();

    // }
}
?>