<?php
require '../vendor/autoload.php';
 
use inventory\Connection as Connection;
use inventory\StockDB as StockDB;
 
try {
    // connect to the PostgreSQL database
    $pdo = Connection::get()->connect();
    // 
    $stockDB = new StockDB($pdo);
    // get all stocks data
    $stocks = $stockDB->all();
    // get all stocks data
    $stock = $stockDB->findByPK(1);
    
    var_dump($stock);
    
} catch (\PDOException $e) {
    echo $e->getMessage();
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>PostgreSQL PHP Querying Data Demo</title>
        <link rel="stylesheet" href="https://cdn.rawgit.com/twbs/bootstrap/v4-dev/dist/css/bootstrap.css">
    </head>
    <body>
        <div class="container">
            <h1>Customer Database</h1>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Email</th>
                        <th>Password</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($stocks as $stock) : ?>
                        <tr>
                            <td><?php echo htmlspecialchars($stock['user_id']) ?></td>
                            <td><?php echo htmlspecialchars($stock['email']); ?></td>
                            <td><?php echo htmlspecialchars($stock['password']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </body>
</html>