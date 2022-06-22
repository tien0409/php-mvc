<?php

namespace Core;

use mysqli;

class Database {
    public function __construct() {
        $this->host = "localhost";
        $this->user = "root";
        $this->passs = "leanhtien";
        $this->db = "QLMS";
        $this->instance = null;
    }

    public function connect() {
        $this->instance = new mysqli($this->host, $this->user, $this->passs, $this->db);
        if($this->instance->connect_errno) {
            die("Erron in connection: " . $this->instance->connect_error);
        }
        return $this->instance;
    }

    public function close() {
        $this->instance->close();
    }

    public function __destruct() {
        $this->close();
    }
}