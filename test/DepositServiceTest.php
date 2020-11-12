<?php

use PHPUnit\Framework\TestCase;
use Operation\DepositService;

require_once __DIR__.'./../src/deposit/DepositService.php';

final class DepositServiceTest extends TestCase {
    
    function testDepositWithStubMethod() {

        $stub = $this->getMockBuilder(DepositService::class)
            ->setConstructorArgs(['acctNum'=>'1234567890'])    
            ->onlyMethods(['accountAuthenticationProvider','saveTransaction'])
            ->getMock();

        $stub->method('accountAuthenticationProvider')
            ->willReturn([
                "accNo" => '1234567890',
                "accBalance" => 2000,
                "accName" => 'Demo',
            ]);

        $stub->method('saveTransaction')
            ->willReturn(true);

        $result = $stub->deposit('234');
        $this->assertEquals(2234, $result['accBalance']);
    }

    function testDepositWithRealData() {
        $deposit =  new DepositService('1234567890');
        $result = $deposit->deposit('234');
        $this->assertEquals(false, $result['isError']);
    }
}
