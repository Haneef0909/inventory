<?php
 
require '../vendor/autoload.php';
 
use inventory\Connection as Connection;
use inventory\BlobDB as BlobDB;
 
try {
    // connect to the PostgreSQL database
    $pdo = Connection::get()->connect();
    // 
    $blobDB = new BlobDB($pdo);
    $fileId = $blobDB->insert(2, 'logo', 'image/png', 'assets/images/google.png');
 
    echo 'A file has been inserted with id ' . $fileId;
} catch (\PDOException $e) {
    echo $e->getMessage();
}