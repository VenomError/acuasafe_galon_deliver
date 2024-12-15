<?php
session_start();

use App\Models\Costumer;

require_once __DIR__ . "/../vendor/autoload.php";

$costumer = new Costumer();

try {
    $costumer->name = post()->name;
    $costumer->email = post()->email;
    $costumer->phone = post()->phone;
    $costumer->password = post()->password;

    $costumer->create();

    set_session('success', 'register success');

    redirect('/auth/login');
} catch (\Exception $th) {
    $error = $th->getMessage();

    set_session('error', "Error :  {$error}");
    redirect('/auth/register');
}
