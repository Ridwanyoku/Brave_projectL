<?php
class Database {
    private $host = 'localhost';
    private $dbname = 'elearning';
    private $username = 'root';
    private $password = '';
    public $conn;

    public function connect() {
        $this->conn = null;
        $this->conn = mysqli_connect($this->host, $this->dbname, $this->username, $this->password);

    }
}
