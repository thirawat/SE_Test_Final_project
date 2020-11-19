<?php

use PHPUnit\Framework\TestCase;
use Operation\DepositService;

require_once __DIR__.'./../src/deposit/DepositService.php';

final class DepositServiceTest extends TestCase {
    
    /**
    * @dataProvider depositDataProvider
    */
    function testDepositWith2StubMethod($acc_no,$deposit,$is_error,$error_message) {
        $mock = $this->getMockBuilder(DepositService::class)
            ->setConstructorArgs(['acctNum'=>$acc_no])    
            ->onlyMethods(['accountAuthenticationProvider','saveTransaction'])
            ->getMock();
        $stub1 = $mock->method('accountAuthenticationProvider');
        $stub2 = $mock->method('saveTransaction');
        if($acc_no == '1234567890')
        {
            $stub1->willReturn([
                "accNo" => '123456789',
                "accBalance" => 2000,
                "accName" => 'Demo',
            ]);
        }
        else
        {
            $stub1->will($this->throwException(new AccountInformationException("Account number : {$acc_no} not found.")));
        }
        $stub2->willReturn(true);
        $result = $mock->deposit($deposit);
        $this->assertEquals($is_error, $result['isError']);
        $this->assertEquals($error_message, isset($result['message'])?$result['message']:'');
    }

     /**
    * @dataProvider depositDataProvider
    */
    function testDepositWith1StubMethod($acc_no,$deposit,$is_error,$error_message) {
        $mock = $this->getMockBuilder(DepositService::class)
            ->setConstructorArgs(['acctNum'=>$acc_no])    
            ->onlyMethods(['saveTransaction'])
            ->getMock();
        $stub = $mock->method('saveTransaction');
        $stub->willReturn(true);
        $result = $mock->deposit($deposit);
        $this->assertEquals($is_error, $result['isError']);
        $this->assertEquals($error_message, isset($result['message'])?$result['message']:'');
    }

    /**
    * @dataProvider depositDataProvider
    */
    function testDepositWithRealData($acc_no,$deposit,$is_error,$error_message) {
        $depositObj =  new DepositService($acc_no);
        $result = $depositObj->deposit($deposit);
        $this->assertEquals($is_error, $result['isError']);
        $this->assertEquals($error_message, isset($result['message'])?$result['message']:'');
    }
    
    function depositDataProvider()
    {
        return [
            ['acc_no'=>'1234567890','deposit'=>'100','is_error'=>false,'error_message'=>''],
            ['acc_no'=>'q!@We#$Rt%','deposit'=>'100','is_error'=>true,'error_message'=>'Account no. must be numeric!'],
            ['acc_no'=>'1234','deposit'=>'100','is_error'=>true,'error_message'=>'Account no. must have 10 digit!'],
            ['acc_no'=>'1234567890','deposit'=>'0','is_error'=>true,'error_message'=>'Amount must be numeric!'],
            ['acc_no'=>'1234567890','deposit'=>'-100','is_error'=>true,'error_message'=>'Amount must be numeric!'],
            ['acc_no'=>'1234567890','deposit'=>'q!@We#$rT%','is_error'=>true,'error_message'=>'Amount must be numeric!'],
            ['acc_no'=>'0987654321','deposit'=>'100','is_error'=>true,'error_message'=>'Account number : 0987654321 not found.'],
        ];
    }
}
