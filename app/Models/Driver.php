<?php

namespace App\Models;

use App\DB;

class Driver extends DB
{

    protected $table = "driver";

    public $name;
    public $email;
    public $phone;
    public $password = 'password';


    public function delete($id)
    {
        return $this->query("DELETE FROM driver WHERE id='$id'");
    }

    public function create()
    {
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        return $this->query("INSERT INTO driver
        (name,email,phone,password)
        VALUE
        (
        '{$this->name}',
        '{$this->email}',
        '{$this->phone}',
        '{$this->password}'
        )
        ");
    }


    public function getByEmail(string $email)
    {

        $sql = "SELECT * FROM driver WHERE email='$email'";
        $driver = $this->query($sql);
        if ($driver->num_rows > 0) {
            return $driver->fetch_object();
        } else {
            return null;
        }
    }
}
