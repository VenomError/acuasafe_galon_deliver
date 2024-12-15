<?php


function set_auth($data)
{
    $_SESSION['auth'] = $data;
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


function logout()
{
    session_destroy();
}
