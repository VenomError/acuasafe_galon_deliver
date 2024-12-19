<?php


namespace App\Models;

use App\DB;

class Produk extends DB
{
    protected $table = "product";

    public function all()
    {
        return $this->query("SELECT * FROM product")->fetch_all(MYSQLI_ASSOC);
    }
}
