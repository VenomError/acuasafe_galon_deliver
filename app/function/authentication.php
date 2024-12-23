<?php


function set_auth($data, $name = 'auth')
{
    $_SESSION[$name] = $data;
}

function auth()
{
    if (!is_null(session('auth'))) {
        return session('auth');
    } else {
        return null;
    }
}
function auth_check()
{
    if (!is_null(auth())) {
        return true;
    } else {
        return false;
    }
}


function guest()
{
    if (is_null(auth())) {
        return true;
    } else {
        return false;
    }
}


function auth_only()
{

    if (auth_check()) {
        return true;
    } else {
        return redirect('/auth/login');
    }
}

function guest_only()
{

    if (auth_check()) {
        return redirect('/');
    } else {
        return true;
    }
}

function guest_admin_only()
{
    if (admin_check()) {
        return redirect('/dashboard');
    } else {
        return true;
    }
}

function guest_driver_only()
{
    if (driver_check()) {
        return redirect('/driver');
    } else {
        return true;
    }
}


// admin auth
function admin()
{
    if (!is_null(session('admin'))) {
        return session('admin');
    } else {
        return null;
    }
}
function driver()
{
    if (!is_null(session('driver'))) {
        return session('driver');
    } else {
        return null;
    }
}
function admin_check(): mixed
{
    if (!is_null(admin())) {
        return true;
    } else {
        return false;
    }
}
function driver_check(): mixed
{
    if (!is_null(driver())) {
        return true;
    } else {
        return false;
    }
}

function admin_only()
{

    if (admin_check()) {
        return true;
    } else {
        return redirect('/dashboard/login');
    }
}
function driver_only()
{

    if (driver_check()) {
        return true;
    } else {
        return redirect('/driver/login');
    }
}

function logout()
{
    session_destroy();
}
