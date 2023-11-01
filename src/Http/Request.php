<?php

namespace Src\Http;

use stdClass;

class Request
{
    protected ?stdClass $request = null;
    protected array $server = [];
    protected array $cookies = [];
    protected array $files = [];

    public function __construct($request = [])
    {
        $this->request = (object) array_merge($request["GET"],$request["POST"],$request["DATA-FORM"],$request["DATA-JSON"]);
        $this->server = $request["SERVER"];
        $this->cookies = $request["COOKIES"];
        $this->files = $request["FILES"];
        // $this->setPropClass();
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

        if(isset($request["GET"]["url"])) unset($request["GET"]["url"]);

        if (string_starts_with(isset($request["SERVER"]["CONTENT_TYPE"]) ? $request["SERVER"]["CONTENT_TYPE"] : "", "application/x-www-form-urlencoded")) {
            parse_str(urldecode(file_get_contents("php://input")), $input);
            $request["DATA-FORM"] = $input;
        }
        if (string_starts_with(isset($request["SERVER"]["CONTENT_TYPE"]) ? $request["SERVER"]["CONTENT_TYPE"] : "", "application/json")) {
            $request["DATA-JSON"] = (array) json_decode(file_get_contents("php://input"),true);
        }
        return $request;
    }

    public function all() :array
    {
        return (array) $this->request;
    }

    public function hasFile(string $key = ""){
        return isset($this->files[$key]);
    }
    public function file(string $key = ""){
        return $this->files[$key] ?? null;
    }
    protected static function getHeaders(string $key = ""): string
    {
        if (isset(self::$server[$key])) return self::$server[$key];
        return "";
    }

    protected static function getCookie(string $key = ""): string
    {
        if (isset(self::$cookies[$key])) return self::$cookies[$key];
        return "";
    }
    private function setPropClass(){
        $data = array_merge($this->request["GET"],$this->request["POST"],$this->request["DATA-FORM"],$this->request["DATA-JSON"]);
        foreach ($data as $key => $var) {
            $this->$key = $var;
        }
    }
}
