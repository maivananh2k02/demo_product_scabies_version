<?php


class Validate
{

    public static function checkPassword($password)
    {
        $pattern = "/[A-Za-z0-9]{8,}/";
        if (!preg_match($pattern,$password)){
            session_start();
            echo "Password is not available";
        }
    }
}