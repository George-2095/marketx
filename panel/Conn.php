<?php
// define('DB_HOST', 'localhost');
// define('DB_USER', 'root');
// define('DB_PASSWORD', '');
// define('DB_NAME', 'xmarket');

define('DB_HOST', 'sql213.epizy.com');
define('DB_USER', 'epiz_32601671');
define('DB_PASSWORD', 'sY8Ohg0Yir5');
define('DB_NAME', 'epiz_32601671_xmarket');
class Conn
{
    public $conn;
    public function __construct()
    {
        $this->conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        if ($this->conn->connect_error) {
            die($this->conn->connect_error);
        }
    }
}

$connclass = new Conn();
