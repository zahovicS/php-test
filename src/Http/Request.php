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
        );
        if (string_starts_with(self::getHeaders("CONTENT_TYPE"), "application/x-www-form-urlencoded")) {
            parse_str(urldecode(file_get_contents("php://input")), $input);
            $request = array_merge($request, $input);
        }
        if (string_starts_with(self::getHeaders("CONTENT_TYPE"), "application/json")) {
            $request = array_merge($request,(array) json_decode(file_get_contents("php://input"),true));
        }
        return $request;
    }
    public function hasFile(string $key = ""){
        if (isset($_FILES[$key])) return $_FILES[$key];
        return false;
    }
    protected static function getHeaders(string $key = ""): string
    {
        if (isset($_SERVER[$key])) return $_SERVER[$key];
        return "";
    }
    protected static function getCookie(string $key = ""): string
    {
        if (isset($_COOKIE[$key])) return $_COOKIE[$key];
        return "";
    }
}
