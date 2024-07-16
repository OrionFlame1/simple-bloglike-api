<?php
    Class Db {
        private $servername;

        private $username;

        private $password;

        private $dbname;

        function __construct($ini)
        {
            $this->servername = $ini['servername'];
            $this->username = $ini['username'];
            $this->password = $ini['password'];
            $this->dbname = $ini['dbname'];
        }

        function connect() {
            $conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
    
            if ($conn -> connect_errno) {
                echo "Failed to connect to MySQL: " . $conn -> connect_error;
                exit();
            }
    
            return $conn;
        }
    }
?>