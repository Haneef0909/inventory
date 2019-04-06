<?php
 
require '../vendor/autoload.php';
 
use inventory\Connection as Connection;
use inventory\StoreProc as StoreProc;
 
try {
    // connect to the PostgreSQL database
    $pdo = Connection::get()->connect();
    // 
    $storeProc = new StoreProc($pdo);
 
    $result = $storeProc->add(20, 30);
    echo $result;

    $accounts = $storeProc->getAccounts();
    
} catch (\PDOException $e) {
    echo $e->getMessage();
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>PostgreSQL PHP: calling stored procedure demo</title>
        <link rel="stylesheet" href="https://cdn.rawgit.com/twbs/bootstrap/v4-dev/dist/css/bootstrap.css">
    </head>
    <body>
        <div class="container">
            <h1>Account List</h1>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Plan</th>
                        <th>Effective Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($accounts as $account) : ?>
                        <tr>
                            <td><?php echo htmlspecialchars($account['id']) ?></td>
                            <td><?php echo htmlspecialchars($account['first_name']); ?></td>
                            <td><?php echo htmlspecialchars($account['last_name']); ?></td>
                            <td><?php echo htmlspecialchars($account['plan']); ?></td>
                            <td><?php echo htmlspecialchars($account['effective_date']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </body>
</html>