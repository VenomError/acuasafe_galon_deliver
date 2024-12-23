<?php
session_start();

use App\Models\Driver;

require_once __DIR__ . "/../vendor/autoload.php";

try {
    $email = post()->email;
    $password = post()->password;
    $driver = new Driver();
    $data = $driver->getByEmail($email);

    if (!password_verify($password, $data->password)) {
        throw new Exception("login failed");
    }

    set_auth($data, 'driver');
    $name = admin()->name ?? '';
    set_session('success', "Welcome {$name}");
    redirect('/driver');
} catch (\Throwable $th) {
    set_session('error', "Login Failed ");
    redirect('/driver/login');
}
