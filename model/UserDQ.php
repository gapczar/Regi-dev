<?php

/**
 * User table data query class.
 * 
 */
class UserDQ
{
    /**
     * User table name
     * 
     * @var string
     */
    private $tblName = "`user`";
    
    /**
     * User table columns
     * 
     * @var string
     */
    private $columns = "`user`.`id`, `user`.`display_name`, `user`.`real_name`, `user`.`location`, `user`.`email`, `user`.`date_of_birth`, `user`.`bio`, `user`.`photo`";
    
    /**
     * PDO connection obejct
     * 
     * @var PDO
     */
    private $pdo;
    
    /**
     * @param PDO $pdo
     */
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }
    
    /**
     * Retrieve all users.
     * 
     * @return array
     */
    public function retrieveAll()
    {
        $stmt = $this->pdo->query("SELECT $this->columns FROM $this->tblName");
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        return $stmt->fetchAll();
    }
    
    /**
     * Retrieve all users having a display name similar with the
     * specified display name.
     * 
     * @param string $displayName
     * 
     * @return array
     */
    public function retrieveAllByDisplayName($displayName)
    {
        $stmt = $this->pdo->prepare("SELECT $this->columns FROM $this->tblName " .
                                    "WHERE $this->tblName.`display_name` LIKE :display_name");
        $stmt->bindValue(':display_name', "%$displayName%");
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        return $stmt->fetchAll();
    }
}
