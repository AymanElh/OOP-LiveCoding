# Bank Account Management System

## Overview
This PHP script implements a simple bank account management system. The system includes basic functionalities for handling bank accounts such as deposit, withdrawal, transaction tracking, and retrieving account information. It utilizes object-oriented principles including abstract classes, interfaces, and inheritance.

## Features
- **Deposit Functionality**: Deposits a specified amount into the account.
- **Withdraw Functionality**: Allows withdrawal with certain restrictions based on account type (savings or normal account).
- **Transaction Tracking**: Keeps a record of all transactions.
- **Account Statistics**: Retrieves the total number of accounts created.

## Classes and Interfaces

### `IBankAccount` Interface
Defines the `withdraw` method that must be implemented by all bank account classes.

```php
interface IBankAccount {
    function withdraw($amount);
}
```

### `BankAccount` Abstract Class
This abstract class represents the core functionality for any bank account. It handles common features such as deposits, transaction tracking, and static data for the number of accounts created.

#### Properties:
- `protected float $balance`: The current balance of the account.
- `protected string $accountOwner`: The name of the account owner.
- `private static int $numberAccount`: The total number of accounts created.
- `private array $transactions`: A list of transactions associated with the account.

#### Methods:
- `__construct($balance, $name)`: Initializes the account with a starting balance and owner name.
- `deposit($amount)`: Deposits a specified amount into the account and records the transaction.
- `insertTransaction($transaction)`: Adds a transaction to the transaction log.
- `getAllTransactions()`: Displays all the transactions associated with the account.
- `static getTotalAccounts()`: Returns the total number of accounts created.

### `SavingAccount` Class
Extends the `BankAccount` class and represents a savings account with a minimum balance requirement for withdrawals.

#### Properties:
- `public $minBalance = 100`: The minimum balance required for the account.
- `public $check`: A variable to store check status (currently unused).

#### Methods:
- `withdraw($amount)`: Withdraws a specified amount if it doesn’t cause the balance to go below the minimum balance. It also records the transaction.

### `NormalAccount` Class
Also extends the `BankAccount` class, but represents a normal account with an overdraft limit.

#### Properties:
- `public $maxCredit = 500`: The overdraft limit allowed for the account.

#### Methods:
- `withdraw($amount)`: Withdraws the specified amount if the balance does not exceed the overdraft limit. It also records the transaction.

## Example Usage

```php
// Create a new SavingAccount object
$account1 = new SavingAccount(500, "Ahmed");

// Deposit 1000 into the account
$account1->deposit(1000);

// Attempt to withdraw 1000
$account1->withdraw(1000);

// Attempt to withdraw 700
$account1->withdraw(700);

// Create another SavingAccount object
$account2 = new SavingAccount(20, "Yassine");

// Display the total number of accounts created
echo BankAccount::getTotalAccounts();

// Display all transactions for account1
$account1->getAllTransactions();
```

## File Structure
- `IBankAccount`: Interface that defines the `withdraw` method.
- `BankAccount`: Abstract class that handles common account operations.
- `SavingAccount`: Class for handling savings accounts with minimum balance restrictions.
- `NormalAccount`: Class for handling normal accounts with overdraft limits.

## Requirements
- PHP 7.4 or higher.
- A server or environment capable of executing PHP scripts.

## Notes
- The current implementation focuses on basic bank account operations and could be extended with additional features such as account transfers, interest calculation, and more complex user interactions.
- All transactions are logged and can be viewed with the `getAllTransactions()` method.

