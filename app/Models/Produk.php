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
    public function update($id)
    {
        // Ensure image is properly handled if not empty
        $imageSql = !empty($this->image) ? ", image='{$this->image}'" : '';

        // Update SQL query with the missing comma after the price field
        $sql = "UPDATE {$this->table}
                SET
                name='{$this->name}',
                size='{$this->size}',
                description='{$this->description}',
                price='{$this->price}'
                {$imageSql}
                WHERE id='$id'";

        // Execute the query
        return $this->query($sql);
    }

    public function delete($id)
    {
        return $this->query("DELETE FROM {$this->table} WHERE id='$id'");
    }
}
