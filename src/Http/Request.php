<?php

namespace Src\Http;

class Request
{
    protected array $request = [];

    public function __construct($request = [])
    {
        $this->request = $request;
        $this->setPropClass();
    }

    public static function capture(): Request
    {
        $data = self::createGlobals();
        return new static($data);
    }
    
    protected static function createGlobals():array
    {
        $request["GET"] = $_GET;
        $request["POST"] = $_POST;
        $request["FILES"] = $_FILES;
        $request["COOKIES"] = $_COOKIE;
        $request["SERVER"] = $_SERVER;
        $request["DATA-FORM"] = [];
        $request["DATA-JSON"] = [];
        if (string_starts_with(self::getHeaders("CONTENT_TYPE"), "application/x-www-form-urlencoded")) {
            parse_str(urldecode(file_get_contents("php://input")), $input);
            $request["DATA-FORM"] = $input;
        }
        if (string_starts_with(self::getHeaders("CONTENT_TYPE"), "application/json")) {
            $request["DATA-JSON"] = (array) json_decode(file_get_contents("php://input"),true);
        }
        return $request;
    }

    public function all() :array
    {
        return array_merge($this->request["GET"],$this->request["POST"],$this->request["DATA-FORM"],$this->request["DATA-JSON"]);
    }

    public function hasFile(string $key = ""){
        if (isset($this->request["FILES"][$key])) return $this->request["FILES"][$key];
        return false;
    }

    protected static function getHeaders(string $key = ""): string
    {
        if (isset(self::$request["SERVER"][$key])) return self::$request["SERVER"][$key];
        return "";
    }

    protected static function getCookie(string $key = ""): string
    {
        if (isset(self::$request["COOKIES"][$key])) return self::$request["COOKIES"][$key];
        return "";
    }
    private function setPropClass(){
        $data = array_merge($this->request["GET"],$this->request["POST"],$this->request["DATA-FORM"],$this->request["DATA-JSON"]);
        foreach ($data as $key => $var) {
            $this->$key = $var;
        }
    }
}
