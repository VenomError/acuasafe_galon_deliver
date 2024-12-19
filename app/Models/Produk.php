<?php


namespace App\Models;

use App\DB;

class Produk extends DB
{

    protected $table = 'product';

    public $name;
    public $size;
    public $description;
    public $price;
    public $image;

    public function all()
    {
        return $this->query("SELECT * FROM product")->fetch_all(MYSQLI_ASSOC);
    }

    public function create()
    {

        return $this->query("INSERT INTO product
        (
        name,
        size,
        description,
        price,
        image
        )
        VALUES
        (
        '{$this->name}',
        '{$this->size}',
        '{$this->description}',
        '{$this->price}',
        '{$this->image}'
        )
        ");
    }
}
