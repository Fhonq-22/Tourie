<?php
    class Database {
        private $host = "localhost";
        private $user = "root";
        private $pass = "";
        private $dbname = "Tourie";
        public $conn;

        public function __construct() {
            $this->conn = new mysqli($this->host, $this->user, $this->pass, $this->dbname);
            if ($this->conn->connect_error) {
                die("Kết nối thất bại: " . $this->conn->connect_error);
            }
            $this->conn->set_charset("utf8");
        }

        public function close() {
            $this->conn->close();
        }
    }
?>