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
     * Add a new account
     * @param string $firstName
     * @param string $lastName
     * @param int $planId
     * @param date $effectiveDate
     */
    public function addAccount($firstName, $lastName, $planId, $effectiveDate) {
        try {
            // start the transaction
            $this->pdo->beginTransaction();
 
            // insert an account and get the ID back
            $accountId = $this->insertAccount($firstName, $lastName);
 
            // add plan for the account
            $this->insertPlan($accountId, $planId, $effectiveDate);
 
            // commit the changes
            $this->pdo->commit();
        } catch (\PDOException $e) {
            // rollback the changes
            $this->pdo->rollBack();
            throw $e;  
        }
    }

    /**
     * 
     * @param string $firstName
     * @param string $lastName
     * @return int
     */
    private function insertAccount($firstName, $lastName) {
        $stmt = $this->pdo->prepare(
                'INSERT INTO accounts(first_name,last_name) '
                . 'VALUES(:first_name,:last_name)');
 
        $stmt->execute([
            ':first_name' => $firstName,
            ':last_name' => $lastName
        ]);
 
        return $this->pdo->lastInsertId('accounts_id_seq');
    }

    /**
     * insert a new plan for an account
     * @param int $accountId
     * @param int $planId
     * @param int $effectiveDate
     * @return bool
     */
    private function insertPlan($accountId, $planId, $effectiveDate) {
        $stmt = $this->pdo->prepare(
                'INSERT INTO account_plans(account_id,plan_id,effective_date) '
                . 'VALUES(:account_id,:plan_id,:effective_date)');
 
        return $stmt->execute([
                    ':account_id' => $accountId,
                    ':plan_id' => $planId,
                    ':effective_date' => $effectiveDate,
        ]);
    }
}