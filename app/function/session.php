<?php

function session($key)
{
    if (isset($_SESSION[$key]) && !empty($_SESSION[$key])) {
        return $_SESSION[$key];
    } else {
        return null;
    }
}
function set_session($key, $message)
{
    $_SESSION[$key] = "{$message}";
}


function has_session($key): bool
{

    if (!empty(session($key))) {
        return true;
    } else {
        return false;
    }
}


function unset_session($key)
{
    unset($_SESSION[$key]);
}
