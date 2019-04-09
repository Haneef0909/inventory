<?php
 
require '../vendor/autoload.php';
 
use inventory\Connection as Connection;
use inventory\BlobDB as BlobDB;
 
try {
    // connect to the PostgreSQL database
    $pdo = Connection::get()->connect();
    // 
    $blobDB = new BlobDB($pdo);
    
    // $fileId = $blobDB->insert(2, 'logo', 'image/png', '../assets/images/google.png');
 
    // echo 'A file has been inserted with id ' . $fileId;

    // get document id from the query string
    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
    
    $file = $blobDB->read($id);

} catch (\PDOException $e) {
    echo $e->getMessage();
}