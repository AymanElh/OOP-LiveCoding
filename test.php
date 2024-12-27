<?php 

class BankAccount {
    protected $balance;
    protected $accoutOwner;
    private static  $numberAccount = 0;
    private $transactions = [];

    
    function __construct($balance, $name) {
        $this->balance = $balance;
        $this->accoutOwner = $name;
        self::$numberAccount++;
        $this->insertTransaction("Account initilze with: $balance");
    }

    function deposit($amount) {
        if($amount <= 0) {
            echo "Amount must me grater that 0";
            return;
        }
        $this->balance += $amount;
        $this->insertTransaction("Deposit: $amount");
        echo "New balance = $this->balance";
    }

    private function calculate() {
        return $this->balance * 0.02;
    }
    
    function print() {
        echo $this->calculate();
        return $this;
    }

    protected function insertTransaction($transaction) {
        $this->transactions[] = $transaction;
    }

    public function getAllTransactions() {
        foreach($this->transactions as $transaction) {
            echo "$transaction <br>";
        }
        var_dump($this);
        return $this;
    }

    static function getTotalAccounts() {
        return self::$numberAccount;
        echo "hello";
    }

}

$account1 = new BankAccount(500, "Ahmed");
$account1->deposit(1000);
echo BankAccount::getTotalAccounts();
$account1->getAllTransactions()->print();

// echo $account1->calculate();