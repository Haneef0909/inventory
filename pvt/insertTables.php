<?php
require '../vendor/autoload.php';
 
use inventory\Connection as Connection;
use inventory\PostgreSQLPHPInsert as PostgreSQLPHPInsert;
 
try {
    // connect to the PostgreSQL database
    $pdo = Connection::get()->connect();
    // 
    $insertDemo = new PostgreSQLPHPInsert($pdo);
 
    // insert a stock into the stocks table
    $id = $insertDemo->insertStock('MSFT', 'Microsoft Corporation');
    echo 'The stock has been inserted with the id ' . $id . '<br>';
 
    // insert a list of stocks into the stocks table
    $list = $insertDemo->insertStockList([
        ['symbol' => 'GOOG', 'company' => 'Google Inc.'],
        ['symbol' => 'YHOO', 'company' => 'Yahoo! Inc.'],
        ['symbol' => 'FB', 'company' => 'Facebook, Inc.'],
    ]);
 
    foreach ($list as $id) {
        echo 'The stock has been inserted with the id ' . $id . '<br>';
    }
} catch (\PDOException $e) {
    echo $e->getMessage();
}