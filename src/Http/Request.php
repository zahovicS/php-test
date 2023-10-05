<?php

namespace Src\Http;

class Request
{
    public static function capture()
    {
        return self::createGlobals();
    }
    protected static function createGlobals()
    {
        $request = array_merge(
            $_GET,
            $_POST,
            $_FILES,
        );
        if (string_starts_with(self::getHeaders("CONTENT_TYPE"), "application/x-www-form-urlencoded")) {
            $request = (array) json_decode(file_get_contents("php://input"),true) ?? [];
        }
        return $request;
    }
    protected static function getHeaders($key = ""): string
    {
        if (isset($_SERVER[$key])) return $_SERVER[$key];
        return "";
    }
    protected static function getCookie($key = ""): string
    {
        if (isset($_COOKIE[$key])) return $_COOKIE[$key];
        return "";
    }
}
