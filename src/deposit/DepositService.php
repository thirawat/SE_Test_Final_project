<?php namespace Operation;

use AccountInformationException;
use ServiceAuthentication;
use DBConnection;

require_once __DIR__."./../serviceauthentication/serviceauthentication.php";
require_once __DIR__."./../serviceauthentication/AccountInformationException.php";
require_once __DIR__."./../serviceauthentication/DBConnection.php";

class DepositService
{
    private $acctNum;
    public function __construct($acctNum)
    {
        $this->acctNum = $acctNum;
    }

    public function deposit(string $amount):array
    {
        $response = array("isError" => true);
        if(!preg_match('/^[0-9]*$/',$this->acctNum)){
            $response["message"] = "Account no. must be numeric!";
        }
        elseif(strlen($this->acctNum) != 10){
            $response["message"] = "Account no. must have 10 digit!";
        }
        elseif(!preg_match('/^[0-9]*$/',$amount)){
            $response["message"] = "Amount must be numeric!";
        }
        else{
            try
            {
                $account =  $this->accountAuthenticationProvider($this->acctNum);
                $accNo = $account['accNo'];
                $updatedBalance = $account['accBalance'] + (int)$amount;
                if($this->saveTransaction($accNo, $updatedBalance))
                {
                    $response = array(
                        "isError" => false,
                        "accNo" => $accNo,
                        "accBalance" => $updatedBalance,
                        "accName" => $account['accName'],
                    );
                    
                }
                else
                {
                    $response["message"] = "Invalid.";
                }
            }
            catch(AccountInformationException $e)
            {
                $result["message"] = $e->getMessage();
            }            
        }

        return $response;
    }   

    public function accountAuthenticationProvider(string $acctNum) : array
    {
        return  ServiceAuthentication::accountAuthenticationProvider($acctNum);
    }

    public function saveTransaction(string $accNo, int $updatedBalance) : bool
    { 
        return  DBConnection::saveTransaction($accNo, $updatedBalance);
    }
}