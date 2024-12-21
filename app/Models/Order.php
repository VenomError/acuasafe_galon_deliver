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
        return $this->query($sql);
    }

    public function joinCostumer()
    {
        return $this->query("SELECT  
            {$this->table}.*,
             costumer.name  AS costumer_name,
             costumer.id  AS costumer_id
            FROM {$this->table}
            LEFT JOIN costumer ON {$this->table}.costumer_id=costumer.id
            ORDER BY distance
         ");
    }

    public function joinCostumerWhereStatus($status)
    {
        return $this->query("SELECT  
            {$this->table}.*,
             costumer.name  AS costumer_name,
             costumer.id  AS costumer_id
            FROM {$this->table}
            LEFT JOIN costumer ON {$this->table}.costumer_id=costumer.id
            WHERE status='$status'
            ORDER BY distance
         ");
    }

    public function findAndJoinCostumer($id)
    {
        return $this->query("SELECT  
        {$this->table}.*,
         costumer.id  AS costumer_id,
         costumer.name  AS costumer_name,
         costumer.email  AS costumer_email,
         costumer.phone  AS costumer_phone
        FROM {$this->table}
       LEFT JOIN costumer ON {$this->table}.costumer_id=costumer.id
        WHERE {$this->table}.id='$id'
     ")->fetch_object();
    }

    public function delete($id)
    {

        return $this->query("DELETE FROM {$this->table} WHERE id='$id'");
    }

    public function assignDriver($order_id, $driver_id)
    {
        $sql = "UPDATE {$this->table} SET driver_id='$driver_id' WHERE id='$order_id'";
        return   $this->query($sql);
    }

    public function updateStatus($order_id, $status)
    {
        $sql = "UPDATE {$this->table} SET `status`='$status' WHERE id='$order_id'";
        return   $this->query($sql);
    }

    public function confirmOrder($id)
    {
        return $this->query("UPDATE {$this->table} SET is_confirm=1 WHERE id='$id'");
    }

    public function getCount($status = null)
    {
        if (is_null($status)) {
            return $this->query("SELECT * FROM {$this->table}")->num_rows;
        } else {
            return $this->query("SELECT * FROM {$this->table} WHERE `status`='$status'")->num_rows;
        }
    }

    public function getByDriver($driver_id)
    {
        return $this->query("SELECT  
        {$this->table}.*,
         costumer.id  AS costumer_id,
         costumer.name  AS costumer_name,
         costumer.email  AS costumer_email,
         costumer.phone  AS costumer_phone
        FROM {$this->table}
       LEFT JOIN costumer ON {$this->table}.costumer_id=costumer.id
        WHERE {$this->table}.driver_id='$driver_id'
     ");
    }

    public function getCountByDriver($driver_id, $status = null)
    {
        if (is_null($status)) {
            return $this->query("SELECT * FROM {$this->table} WHERE driver_id='$driver_id'")->num_rows;
        } else {
            return $this->query("SELECT * FROM {$this->table} WHERE `status`='$status' AND driver_id='$driver_id'")->num_rows;
        }
    }

    public function getByCostumer($costumer_id)
    {
        return $this->query("SELECT * FROM {$this->table} WHERE costumer_id='$costumer_id'");
    }
}
