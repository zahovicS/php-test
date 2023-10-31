<?php

use Src\View\View;

function view(string $template,array $data = []){
    return View::view($template,$data);
}

function asset(string $path = ""){
    $config = config("app");
    $url = $config["url"];
    $asset_folder = $config["asset_folder"] ?? "asset/";
    return "{$url}{$asset_folder}{$path}";
}

function route(string $route = ""){
    $config = config("app");
    $url = $config["url"];
    return "{$url}{$route}";
}
function string_starts_with(string $haystack, string $needle): bool
{
    return 0 === strncmp($haystack, $needle, \strlen($needle));
}

function dd(...$vars)
{
    if (is_array($vars)) {
        foreach ($vars as $var) {
            dump($var);
        }
    } else {
        dump($vars);
    }
    die;
}

function dump($var)
{
    $folder = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH))[1] ?? "System";
    echo "<style>";
    echo "body, html {
            background-color: #2E2E2E;
            padding: 0;
            font-family: monospace;
        }
        .console {
            margin: 0 auto;
            background-color: #000;
            border: 5px solid #202020;
            border-radius: 10px;
        }
        .header-console{
            padding: 7px 10px;
            background-color:#202020;
        }
        .title-console{
            font-size: 16px;
            color:white;
        }
        #output {
            // height: 200px;
            background-color: #000;
            padding: 10px;
            color: #fff;
            margin: 0;
            font-size: 15px;
        }
        pre{
            white-space: pre-wrap;
            white-space: -moz-pre-wrap;
            white-space: -pre-wrap;
            white-space: -o-pre-wrap;
            word-wrap: break-word;
        }
        .header-output{
            color: white;
            font-size: 17px;
            padding-bottom:5px;
        }";
    echo "</style>";
    echo '<div class="console">
        <div class="header-console">
            <span class="title-console">
                <svg version="1.0" xmlns="http://www.w3.org/2000/svg"
                width="15px" height="15px" viewBox="0 0 90.000000 90.000000"
                preserveAspectRatio="xMidYMid meet">
               <g transform="translate(0.000000,100.000000) scale(0.100000,-0.100000)"
               fill="#fff" stroke="none">
               <path d="M151 851 c-29 -29 -33 -79 -29 -388 l3 -283 28 -27 27 -28 320 0 320
               0 27 28 28 27 0 319 0 319 -24 26 -24 26 -329 0 c-311 0 -329 -1 -347 -19z
               m639 -411 l0 -230 -290 0 -290 0 0 230 0 230 290 0 290 0 0 -230z"/>
               <path d="M310 525 c-11 -14 -7 -23 30 -60 l43 -44 -42 -46 c-44 -47 -47 -61
               -18 -79 14 -9 28 0 77 49 33 33 60 64 60 69 0 14 -112 126 -126 126 -6 0 -17
               -7 -24 -15z"/>
               <path d="M504 335 c-13 -33 15 -45 101 -45 86 0 114 12 101 45 -8 22 -194 22
               -202 0z"/>
               </g>
               </svg> Bienvenido a la consola de debug.</span>
        </div>
        <pre id="output"><span class="header-output">C:\Users\\' . $folder . '></span><br><hr>';
    var_dump($var);
    echo "</pre></div>";
}
