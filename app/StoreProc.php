<?php


namespace inventory;
/**
 * Query Data from table
 */
class StoreProc {

    /**
     * PDA Object
     */
    private $pdo;
    
    /**
     * init the object with a \PDA object
     * @param type $pda
     */
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    /**
     * Call a simple stored procedure
     * @param int $a
     * @param int $b
     * @return int
     */
    public function add($a, $b) {
        $stmt = $this->pdo->prepare('SELECT * FROM add(:a,:b)');
        $stmt->setFetchMode(\PDO::FETCH_ASSOC);
        $stmt->execute([
            ':a' => $a,
            ':b' => $b
        ]);
        return $stmt->fetchColumn(0);
    }

    /**
     * Call a stored procedure that returns a result set
     * @return array
     */
    function getAccounts() {
        $stmt = $this->pdo->query('SELECT * FROM get_accounts()');
        $accounts = [];
        while ($row = $stmt->fetch()) {
            $accounts[] = [
                'id' => $row['id'],
                'first_name' => $row['first_name'],
                'last_name' => $row['last_name'],
                'plan' => $row['plan'],
                'effective_date' => $row['effective_date']
            ];
        }
        return $accounts;
    }

}