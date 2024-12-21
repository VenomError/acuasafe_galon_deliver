<?php

namespace App\Models;

use App\DB;

class Admin extends DB
{

    protected $table = "admin";

    public $name;
    public $email;
    public $password;

    public function create()
    {
        $password = password_hash($this->password, PASSWORD_DEFAULT);
        $this->conn()->query("INSERT INTO admin (name,email,password) VALUES 
        ('{$this->name}' , '{$this->email}' , '{$password}')");
    }

    public function getByEmail(string $email)
    {

        $sql = "SELECT * FROM admin WHERE email='$email'";
        $costumer = $this->query($sql);
        if ($costumer->num_rows > 0) {
            return $costumer->fetch_object();
        } else {
            return null;
        }
    }

    public function delete($id)
    {
        return $this->query("DELETE FROM admin WHERE id='$id'");
    }
}
