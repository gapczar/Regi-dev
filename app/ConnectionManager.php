<?php

/**
 * Handles acquisition and caching of database connection.
 * 
 */
class ConnectionManager
{
    /**
     * Database driver name
     * 
     * @var string
     */
    private $driver = 'mysql';
    
    /**
     * Database host
     * 
     * @var string
     */
    private $host = '127.0.0.1';
    
    /**
     * Name of database
     * 
     * @var string
     */
    private $dbname = 'regi';
    
    /**
     * Username of the account to be used for establishing connection
     * 
     * @var string
     */
    private $username = 'root';
    
    /**
     * Password of the account to be used for establishing connection
     * 
     * @var string
     */
    private $password = '';
    
    /**
     * A PDO connection object
     * 
     * @var PDO
     */
    private $pdo = null;
    
    /**
     * Retrieves a PDO connection.
     * 
     * @return PDO
     */
    public function getConnection()
    {
        if (null == $this->pdo) {
            $this->pdo = new PDO($this->getDsn(), $this->username,
                                  $this->password, array ());
            
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE,
                                     PDO::ERRMODE_EXCEPTION);
        }
        
        return $this->pdo;
    }
    
    /**
     * Retrieve the data source name.
     * 
     * @return string
     */
    public function getDsn()
    {
        return "$this->driver:host=$this->host;dbname=$this->dbname";
    }
}