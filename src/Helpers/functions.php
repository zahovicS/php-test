<?php
if (!function_exists('string_starts_with')) {
    function string_starts_with(string $haystack, string $needle): bool
    {
        return 0 === strncmp($haystack, $needle, \strlen($needle));
    }
}

if (!function_exists('dd')) {
    function dd(...$vars)
    {
        if (is_array($vars)) {
            foreach ($vars as $var) {
                dump($var);
            }
        }else{
            dump($vars);
        }
        die;
    }
}

if (!function_exists('dump')) {
    echo "<style>";
    echo "pre {
            white-space: pre-wrap;       /* css-3 */
            white-space: -moz-pre-wrap;  /* Mozilla, since 1999 */
            white-space: -pre-wrap;      /* Opera 4-6 */
            white-space: -o-pre-wrap;    /* Opera 7 */
            word-wrap: break-word;       /* Internet Explorer 5.5+ */
            margin:0px;
            padding:10px;
            background-color:#111111;
            color:white;
            font-size:15px;
            word-wrap: break-word!important;
        }
        /* Reset de estilos básicos del navegador */
        body, html {
            background-color: black;
            margin: 5px;
            padding: 0;
            font-family: monospace;
        }

        /* Estilo para la consola */
        .console {
            margin: 0 auto;
            padding: 20px;
            background-color: #000;
            color: #00ff00;
            border: 2px solid #00ff00;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 255, 0, 0.5);
        }

        /* Estilo para la salida (texto) de la consola */
        #output {
            height: 200px;
            overflow-y: scroll;
            background-color: #000;
            border: 1px solid #00ff00;
            padding: 10px;
        }

        /* Estilo para la entrada (input) de la consola */
        #input {
            width: 100%;
            padding: 5px;
            background-color: #000;
            color: #00ff00;
            border: none;
            outline: none;
        }";
    echo "</style>";
    function dump($var)
    {
        echo "<pre class='console'>";
        var_dump($var);
        echo "</pre>";
    }
}
