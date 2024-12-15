<?php

namespace App;

use mysqli;
use mysqli_sql_exception;

class DB
{
    private mysqli $conn;


    protected $table;
    protected $primary = 'id';
    protected $column = [];

    public function __construct()
    {
        try {

            $this->conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME, DB_PORT);
            $this->conn->set_charset("utf8mb4");
            $this->conn->query("SET time_zone = '+08:00'");
        } catch (mysqli_sql_exception $e) {
            die("Database connection error: " . $e->getMessage());
        }
    }

    public function conn(): mysqli
    {
        return $this->conn;
    }

    public function query($sql)
    {
        return $this->conn->query($sql);
    }

    public function all()
    {
        $result = $this->conn->query("SELECT * FROM {$this->table}");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function find($id)
    {
        $sql = "SELECT * FROM {$this->table} WHERE id='$id'";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            return $result->fetch_object();
        } else {
            return false;
        }
    }

    public function __destruct()
    {
        $this->conn->close();
    }
}
