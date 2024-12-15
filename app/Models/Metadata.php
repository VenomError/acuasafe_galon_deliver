<?php

namespace App\Models;

use App\DB;

class Metadata extends DB
{

    protected $table = "metadata";

    public function set($key, $value)
    {

        $sql = "SELECT * FROM {$this->table} WHERE `key`='$key'";

        if ($this->query($sql)->num_rows > 0) {
            $this->query("UPDATE {$this->table} SET value='$value' WHERE `key`='$key'");
        } else {
            $this->query("INSERT INTO {$this->table} (`key`,value) VALUES ('$key' , '$value')");
        }
    }

    public function get($key)
    {
        $result = $this->query("SELECT * FROM {$this->table} WHERE `key`='$key'")->fetch_object();
        return $result->value ?? null;
    }
    public function delete($key)
    {
        return $this->query("DELETE FROM {$this->table} WHERE `key`='$key'");
    }
}
