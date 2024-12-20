<?php

namespace App\Models;

use App\DB;


class Costumer extends DB
{

    protected $table = 'costumer';

    public $name;
    public $email;
    public $password;
    public $phone;

    public function create()
    {
        $password_hash = password_hash($this->password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO {$this->table} 
        (name,email,password,phone) 
        VALUES 
        ('$this->name' , '$this->email' , '$password_hash' , '$this->phone')
        ";

        try {
            $this->query($sql);
        } catch (\Throwable $th) {
            throw new \Exception($th);
        }
    }

    public function getByEmail(string $email)
    {
        try {
            $sql = "SELECT * FROM costumer WHERE email='$email'";
            $costumer = $this->query($sql);
            if ($costumer->num_rows > 0) {
                return $costumer->fetch_object();
            } else {
                throw new \Exception('failed to get costumer');
            }
        } catch (\Throwable $th) {
            throw new \Exception($th);
        }
    }

    public function delete($id)
    {
        return $this->query("DELETE FROM costumer WHERE id='$id'");
    }
}
