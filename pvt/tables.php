<?php
 
require '../vendor/autoload.php';
 
use inventory\Connection as Connection;
use inventory\PostgreSQLCreateTable as PostgreSQLCreateTable;
 
try {
    
    // connect to the PostgreSQL database
    $pdo = Connection::get()->connect();
    
    // 
    $tableCreator = new PostgreSQLCreateTable($pdo);
    
    // create tables and query the table from the
    // database
    $tables = $tableCreator->getTables();
    
    foreach ($tables as $table){
        echo $table . '<br>';
    }
    
} catch (\PDOException $e) {
    echo $e->getMessage();
}