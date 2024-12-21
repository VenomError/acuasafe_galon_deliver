<?php

namespace App\Models;

use App\DB;

class OrderItem extends DB
{
    public $table = "`order_item`";

    public $amount;
    public $quantity;
    public $order_id;
    public $product_id;

    public function create()
    {

        $sql = "INSERT INTO {$this->table}
        (amount, quantity, order_id,product_id)
        VALUES (?,?,?,?)";

        $stmt = $this->conn()->prepare($sql);

        // Bind parameters (adjust the types accordingly: "s" for string, "i" for integer, "d" for double/float)
        $stmt->bind_param(
            "ssss",
            $this->amount,
            $this->quantity,
            $this->order_id,
            $this->product_id,
        );

        if ($stmt->execute()) {
            return $stmt->insert_id;
        } else {
            throw new \Exception("Error executing query: " . $stmt->error);
        }
    }

    public function getByOrder($order_id)
    {
        $sql = "SELECT 
        order_item.*, 
        product.name AS product_name ,
        product.price AS product_price 
        FROM {$this->table} 
        JOIN product ON order_item.product_id = product.id
        WHERE order_id = '$order_id'";
        $result = $this->query($sql);
        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return [];
        }
    }

    public function getByProduct($product_id)
    {

        $result = $this->query("SELECT * FROM {$this->table} WHERE product_id='$product_id'");
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function getSumQuantityByProduct($product_id)
    {
        // Melakukan query menggunakan SQL dengan SUM untuk menjumlahkan quantity
        $query = "SELECT SUM(quantity) as total_quantity FROM {$this->table} WHERE product_id='$product_id'";

        // Menjalankan query
        $result = $this->query($query);

        // Memeriksa apakah query berhasil dan mengambil jumlah total
        if ($result) {
            $row = $result->fetch_assoc();
            return $row['total_quantity'] ?? 0;  // Mengembalikan 0 jika tidak ada hasil
        }

        // Jika terjadi error pada query, kembalikan 0
        return 0;
    }

    public function getTotalQuantityByProduct($product_id)
    {

        $query = "SELECT SUM(quantity) as total_quantity FROM {$this->table} 
                  WHERE product_id = '{$product_id}'";

        $result = $this->query($query);

        if ($result) {
            $row = $result->fetch_assoc();
            return $row['total_quantity'] ?? 0; // Return the sum or 0 if no rows are returned
        }

        return 0;
    }
}
