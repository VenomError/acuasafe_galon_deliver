<?php
session_start();

use App\Models\Admin;

require_once __DIR__ . "/../vendor/autoload.php";

try {
    $email = post()->email;
    $password = post()->password;
    $admin = new Admin();
    $data = $admin->getByEmail($email);

    if (!password_verify($password, $data->password)) {
        throw new Exception("login failed");
    }

    set_auth($data, 'admin');
    $name = admin()->name ?? '';
    set_session('success', "Welcome {$name}");
    redirect('/dashboard');
} catch (\Throwable $th) {
    set_session('error', "Login Failed ");
    redirect('/dashboard/login');
}
