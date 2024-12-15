<?php

use App\DB;

class Auth extends DB
{

    protected $table = 'user';
    protected $primary = 'id';

    public static function user() {}
}
