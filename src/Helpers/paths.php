<?php

function storage_path(){
    
}

function app_path(string $path = ""){
    return root_path("/app/{$path}");
}

function view_path(string $path = ""){
    return app_path("Views/{$path}");
}

function root_path(string $folder = ""){
    return APP_ROOT . $folder;
}

function config_path(string $file){
    return root_path("/config/{$file}.php");
}

function config(string $config){
    $arr_config = explode(".",$config);
    $arr_count = count($arr_config);
    if (!file_exists(config_path($arr_config[0]))) {
        throw new Exception("The file or configuration does not exist for {$arr_config[0]}");
    }
    if ($arr_count === 4) {
        throw new Exception("Only 3 parameter was expected to be searched in the configuration {$config}");
    }
    $config = require config_path($arr_config[0]);
    if($arr_count == 1) return $config;
    if($arr_count == 2) return $config[$arr_config[1]];
    if($arr_count == 3) return $config[$arr_config[1]][$arr_config[2]];
    return null;
}