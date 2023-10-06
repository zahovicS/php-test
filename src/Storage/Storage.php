<?php

namespace Src\Http;

class Storage
{
    public static string $STORAGE_DEFAULT = "storage";
    public static string $STORAGE_PATH = "";
    public static string $STORAGE_SELECTOR = "";
    public static function disk(string $disk){
        return new static;
    }
    public static function get(string $path){

    }
    public static function put(string $path){
        
    }
    public static function download(string $path){
        
    }
}