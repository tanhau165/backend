<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Define
{
    public static function GenerationCode()
    {
        $c = round(microtime(true) * 1000);
        $code = $c . self::rand_string(20);
        return $code;
    }

    private static function rand_string($length)
    {
        $str = "";
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $size = strlen($chars);
        for ($i = 0; $i < $length; $i++) {
            $str .= $chars[rand(0, $size - 1)];
        }
        $str = substr(str_shuffle($chars), 0, $length);
        return $str;
    }

}
