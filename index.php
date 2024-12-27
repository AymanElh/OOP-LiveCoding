<?php 

/**
 * Interface IBankAccount
 *
 * This interface defines the contract for a bank account.
 * Any class implementing this interface must provide an implementation
 * for the withdraw method.
 */

// interface IBankAccount {
//     function withdraw($amount);
// }


/**
 * Abstract class BankAccount
 * 
 * This class represents a bank account with basic functionalities such as deposit and transaction tracking.
 * It implements the IBankAccount interface.
 * 
 * Properties:
 * - protected float $balance: The current balance of the account.
 * - protected string $accoutOwner: The name of the account owner.
 * - private static int $numberAccount: The total number of accounts created.
 * - private array $transactions: A list of transactions made on the account.
 * 
 * Methods:
 * - __construct(float $balance, string $name): Initializes the account with a balance and owner name.
 * - deposit(float $amount): Deposits a specified amount into the account.
 * - protected insertTransaction(string $transaction): Records a transaction in the transactions list.
 * - public getAllTransactions(): Displays all transactions made on the account.
 * - static getTotalAccounts(): Returns the total number of accounts created.
 */
abstract class BankAccount implements IBankAccount  {
    protected float $balance;
    protected string $accoutOwner;
    private static int  $numberAccount = 0;
    private array $transactions = [];

    
    /**
     * Constructor for initializing an account.
     *
     * @param float $balance The initial balance of the account.
     * @param string $name The name of the account owner.
     */
    function __construct($balance, $name) {
        $this->balance = $balance;
        $this->accoutOwner = $name;
        self::$numberAccount++;
        $this->insertTransaction("Account initilze with: $balance");
    }

    abstract function withdraw($amount);

    /**
     * Deposits a specified amount into the account.
     *
     * @param float $amount The amount to be deposited. Must be greater than 0.
     *
     * @return void
     */
    public function deposit($amount) {
        if($amount <= 0) {
            echo "Amount must me grater that 0";
            return;
        }
        $this->balance += $amount;
        $this->insertTransaction("Deposit: $amount");
        echo "New balance = $this->balance";
    }

    /**
     * Inserts a transaction into the transactions array.
     *
     * @param mixed $transaction The transaction to be inserted.
     * @return void
     */
    protected function insertTransaction($transaction) {
        $this->transactions[] = $transaction;
    }

    /**
     * Retrieves and displays all transactions.
     *
     * This method iterates through the transactions array and prints each transaction
     * followed by a line break.
     *
     * @return void
     */
    public function getAllTransactions() {
        foreach($this->transactions as $transaction) {
            echo "$transaction <br>";
        }
    }

    /**
     * Get the total number of accounts.
     *
     * This static function returns the total number of accounts
     * by accessing the static property $numberAccount.
     *
     * @return int The total number of accounts.
     */
    public static function getTotalAccounts() {
        return self::$numberAccount;
    }

}

class SavingAccount extends BankAccount {

    /**
     * @var int $minBalance The minimum balance required.
     * @var mixed $check A variable to store the check status.
     */
    private float $minBalance = 100;

    // function __construct($balance, $name) {
        // parent::__construct($balance, $name);
    //     $this->check = $check;
    // }

    /**
     * Withdraws a specified amount from the account balance.
     *
     * @param float $amount The amount to withdraw. Must be greater than 0.
     *
     * If the amount is less than 0, an error message is displayed and the function returns.
     * If the withdrawal would cause the balance to drop below the minimum balance, an error message is displayed and the function returns.
     * Otherwise, the amount is subtracted from the balance, a transaction is recorded, and the new balance is displayed.
     */
    public function withdraw($amount) {
        if($amount < 0 ) {
            echo "Amount must be greater than 0";
            return;
        }

        if($this->balance - $amount < $this->minBalance) {
            echo "Withdraw rejected";
            return;
        }

        $this->balance -= $amount;
        $this->insertTransaction("Withdraw: $amount");
        echo "new balance: $this->balance";

    }
}

class NormalAccount extends BankAccount {
    private float $maxCredit = 500;

    /**
     * Withdraws a specified amount from the balance.
     *
     * @param float $amount The amount to withdraw. Must be greater than 0.
     *
     * @return void
     */
    public function withdraw($amount) {
        if($amount < 0) {
            echo "Amount must me greater than 0";
            return;
        }
        if($this->balance - $amount > -$this->maxCredit) {
            echo "Withdraw rejected";
            return;
        }

        $this->balance -= $amount;
    }
}

// create a new object of SavingAccount
$account1 = new SavingAccount(500, "Ahmed");
// deposit 1000
$account1->deposit(1000);
// withdraw 1000
$account1->withdraw(1000);
// withdraw 700
$account1->withdraw(700);

$account2 = new SavingAccount(20, "yassine");
echo BankAccount::getTotalAccounts();
$account1->getAllTransactions();