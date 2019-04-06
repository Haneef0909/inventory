<?php


namespace inventory;
/**
 * Query Data from table
 */
class StockDB {

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
     * Return all rows in the stocks table
     * @return array
     */
    public function all() {
        $stmt = $this->pdo->query('SELECT user_id, email, password '
                . 'FROM customer '
                . 'ORDER BY password');
        $stocks = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $stocks[] = [
                'user_id' => $row['user_id'],
                'email' => $row['email'],
                'password' => $row['password']
            ];
        }
        return $stocks;
    }

    /**
     * Find stock by id
     * @param int $id
     * @return a stock object
     */
    public function findByPK($id) {
        // prepare SELECT statement
        $stmt = $this->pdo->prepare('SELECT user_id, email, password
                                       FROM customer
                                      WHERE user_id = :id');
        // bind value to the :id parameter
        $stmt->bindValue(':id', $id);
        
        // execute the statement
        $stmt->execute();
 
        // return the result set as an object
        return $stmt->fetchObject();
    }
}
?>