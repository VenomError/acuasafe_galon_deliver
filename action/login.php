<?php
session_start();

use App\Models\Costumer;

require_once __DIR__ . "/../vendor/autoload.php";

try {
    $email = post()->email;
    $password = post()->password;
    $costumer = new Costumer();
    $data = $costumer->getByEmail($email);

    if (!password_verify($password, $data->password)) {
        throw new Exception("login failed");
    }

    set_auth($data);
    $name = auth()->name ?? '';
    set_session('success', "Welcome {$name}");
    redirect('/');
} catch (\Throwable $th) {
    set_session('error', "Login Failed ");
    redirect('/auth/login');
}
