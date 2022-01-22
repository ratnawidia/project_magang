<?php
class DbConfig
{    
    private $_host       = 'localhost';
    private $_username   = 'root';
    private $_password   = '';
    protected $_database = 'project';
    
    public $conn;
    
    public function __construct()
    {
        if (!isset($this->conn)) {
            
            $this->conn = new mysqli($this->_host, $this->_username, $this->_password, $this->_database);
            
            if (!$this->conn) {
                echo 'Tidak bisa terhubung ke database ' . $_database;
                exit;
            }            
        }    
        
        return $this->conn;
    }
}
?>