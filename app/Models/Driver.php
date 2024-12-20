<?php

namespace App\Models;

use App\DB;

class Driver extends DB
{

    protected $table = "driver";

    public function delete($id)
    {
        return $this->query("DELETE FROM driver WHERE id='$id'");
    }
}
