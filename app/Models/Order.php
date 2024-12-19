<?php

namespace App\Models;

use App\DB;

class Order extends DB
{
    public $table = "`order`"; // Escape the table name with backticks

    public $total_amount;
    public $payment_method;
    public $latitude;
    public $longitude;
    public $distance = 0;
    public $address;
    public $address_detail;
    public $resit;
    public $is_confirm = false;
    public $costumer_id;
    public $driver_id = null;

    public function create()
    {
        $is_confirm = (int) $this->is_confirm;
        $sql = "INSERT INTO {$this->table}
        (total_amount, payment_method, latitude, longitude, distance, address, address_detail, costumer_id, driver_id, is_confirm)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $this->conn()->prepare($sql);

        // Bind parameters (adjust the types accordingly: "s" for string, "i" for integer, "d" for double/float)
        $stmt->bind_param(
            "ssddssssii",
            $this->total_amount,
            $this->payment_method,
            $this->latitude,
            $this->longitude,
            $this->distance,
            $this->address,
            $this->address_detail,
            $this->costumer_id,
            $this->driver_id,
            $is_confirm
        );

        if ($stmt->execute()) {
            return $stmt->insert_id;
        } else {
            throw new \Exception("Error executing query: " . $stmt->error);
        }
    }

    public function uploadResit($order_id, $uploadName)
    {
        $sql = "UPDATE {$this->table} SET resit='$uploadName' WHERE id='$order_id'";
        $result = $this->query($sql);
    }

    public function joinCostumer()
    {
        return $this->query("
            SELECT  
            {$this->table}.*,
             costumer.name  AS costumer_name,
             costumer.id  AS costumer_id
            FROM {$this->table}
            JOIN costumer ON {$this->table}.costumer_id=costumer.id
            ORDER BY distance
         ")
            ->fetch_all(MYSQLI_ASSOC);
    }
}
