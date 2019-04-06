<?php


namespace inventory;
/**
 * Query Data from table
 */
class BlobDB {

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
     * Insert a file into the company_files table
     * @param int $stockId
     * @param string $fileName
     * @param string $mimeType
     * @param string $pathToFile
     * @return int
     * @throws \Exception
     */
    public function insert($stockId, $fileName, $mimeType, $pathToFile) {
        if (!file_exists($pathToFile)) {
            throw new \Exception("File %s not found.");
        }
 
        $sql = "INSERT INTO company_files(stock_id,mime_type,file_name,file_data) "
                . "VALUES(:stock_id,:mime_type,:file_name,:file_data)";
 
        try {
            $this->pdo->beginTransaction();
            
            // create large object
            $fileData = $this->pdo->pgsqlLOBCreate();
            $stream = $this->pdo->pgsqlLOBOpen($fileData, 'w');
            
            // read data from the file and copy the the stream
            $fh = fopen($pathToFile, 'rb');
            stream_copy_to_stream($fh, $stream);
            //
            $fh = null;
            $stream = null;
 
            $stmt = $this->pdo->prepare($sql);
 
            $stmt->execute([
                ':stock_id' => $stockId,
                ':mime_type' => $mimeType,
                ':file_name' => $fileName,
                ':file_data' => $fileData,
            ]);
 
            // commit the transaction
            $this->pdo->commit();
        } catch (\Exception $e) {
            $this->pdo->rollBack();
            throw $e;
        }
 
        return $this->pdo->lastInsertId('company_files_id_seq');
    }

}