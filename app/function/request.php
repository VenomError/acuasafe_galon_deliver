<?php

if (!function_exists("request")) {

    function request($method = 'GET')
    {
        $data = [];
        if (strtoupper($method) === 'POST') {
            $data = $_POST;
        } else {
            parse_str($_SERVER['QUERY_STRING'] ?? '', $data);
        }

        return new class($data) {
            private $data;

            public function __construct($data)
            {
                $this->data = (object) $data;
            }

            public function __get($name)
            {
                return $this->data->$name ?? null;
            }

            public function all()
            {
                return $this->data;
            }
        };
    }
}


function redirect($url, $statusCode = 303)
{
    header('Location: ' . $url, true, $statusCode);
    die();
}

function redirect_back()
{
    if (isset($_SERVER['HTTP_REFERER'])) {
        header('Location: ' . $_SERVER['HTTP_REFERER'], true, 303);
        exit;
    } else {
        redirect('/');
    }
}

function post()
{


    return request('POST');
}


function toFloat($decimal)
{
    return floatval(str_replace(',', '', $decimal));
}
