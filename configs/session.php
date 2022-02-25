<?php

session_start();

if (isset($_COOKIE["KSSESSIONID"])) {
    $sessionId = $_COOKIE["KSSESSIONID"];
} else {


    function generateRandomString($length = 500)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    $sessionId = sha1(generateRandomString());

    setcookie("KSSESSIONID", $sessionId , time() + (86400 * 30), "/");
}
