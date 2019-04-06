<?php
 
require '../vendor/autoload.php';
 
use inventory\Connection as Connection;
use inventory\AccountDB as AccountDB;
 
try {
    // connect to the PostgreSQL database
    $pdo = Connection::get()->connect();
 
    $accountDB = new AccountDB($pdo);
 
    // add accounts
    $accountDB->addAccount('John', 'Doe', 1, date('Y-m-d'));
    $accountDB->addAccount('Linda', 'Williams', 2, date('Y-m-d'));
    $accountDB->addAccount('Maria', 'Miller', 3, date('Y-m-d'));
 
 
    echo 'The new accounts have been added.' . '<br>';
    // 
    $accountDB->addAccount('Susan', 'Wilson', 99, date('Y-m-d'));
} catch (\PDOException $e) {
    echo $e->getMessage();
}