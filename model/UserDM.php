<?php



/**
 * User table data manipulation class.
 * 
 */
class UserDM
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
    private $columns = "`user`.`display_name`, `user`.`real_name`, `user`.`location`, `user`.`email`, `user`.`date_of_birth`, `user`.`bio`, `user`.`photo`";
    
    /**
     * PDO connection obejct
     * 
     * @var PDO
     */
    private $pdo;
    
    /**
     * PDO prepared insert statement
     * 
     * @var PDOStatement
     */
    private $insertStmt;
    
    /**
     * Parameter variables
     * 
     * @var array
     */
    private $columnValues = array (
        'display_name' => '',
        'real_name' => '',
        'location' => '',
        'email' => '',
        'date_of_birth' => '',
        'bio' => '',
        'photo' => ''
    );
    
    /**
     * @param PDO $pdo
     */
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
        
        // prepare insert statement
        $this->insertStmt = $this->pdo->prepare("INSERT INTO $this->tblName($this->columns) VALUES " .
                "(:display_name, :real_name, :location, :email, :date_of_birth, :bio, :photo)");
        
        /* bindParam() binds the variable -- similar with pass-by-reference in Java
         * or pointers in C. To bind a value use bindValue()
         */
        $this->insertStmt->bindParam(':display_name', $this->columnValues['display_name']);
        $this->insertStmt->bindParam(':real_name', $this->columnValues['real_name']);
        $this->insertStmt->bindParam(':location', $this->columnValues['location']);
        $this->insertStmt->bindParam(':email', $this->columnValues['email']);
        $this->insertStmt->bindParam(':date_of_birth', $this->columnValues['date_of_birth']);
        $this->insertStmt->bindParam(':bio', $this->columnValues['bio']);
        $this->insertStmt->bindParam(':photo', $this->columnValues['photo']);
    }
    
    /**
     * Insert a new user
     * 
     * @param type $userData
     * @return boolean
     */
    public function insert($userData)
    {
        $this->columnValues['display_name']     = !empty ($userData['display_name'])?
                                                  $userData['display_name']:
                                                  NULL;
        $this->columnValues['real_name']        = !empty ($userData['real_name'])?
                                                  $userData['real_name']:
                                                  '';
        $this->columnValues['location']         = !empty ($userData['location'])?
                                                  $userData['location']:
                                                  NULL;
        $this->columnValues['email']            = !empty ($userData['email'])?
                                                  $userData['email']:
                                                  NULL;
        $this->columnValues['date_of_birth']    = !empty ($userData['date_of_birth'])?
                                                  $userData['date_of_birth']:
                                                  NULL;
        $this->columnValues['bio']              = !empty ($userData['bio'])?
                                                  $userData['bio']:
                                                  NULL;
        $this->columnValues['photo']            = !empty ($userData['photo'])?
                                                  $userData['photo']:
                                                  NULL;
        return $this->insertStmt->execute();
    }
}
