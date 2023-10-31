<?php

namespace Src\View;

use Exception;

class View{
    public static function view(string $template, array $data = [])
    {
        if (!empty($data)) {
            extract($data);
        }

        $template = str_replace(".","/",$template);
        $path_template = view_path($template . ".php");
        if(!file_exists($path_template)){
            throw new Exception("No View exists");
        }
        require_once $path_template;
    }
}