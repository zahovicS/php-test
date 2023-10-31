<?php

namespace Src\Core\Http;

class Response
{
    public static function json(array $data, int $status = 200, array $headers = [])
    {
        $jsonData = json_encode($data, JSON_UNESCAPED_UNICODE);
        http_response_code($status);
        foreach ($headers as $header => $value) {
            header("$header: $value;");
        }
        header("Content-Type: application/json;");
        echo $jsonData;
    }
    public static function output(string $path,string $filename,array $headers = [])
    {
        $file = file_get_contents($path);
        $size = strlen($file);
        header("Content-length: $size");
        header('Content-Type: text/plain');
        header('Content-disposition: inline; filename="' . $filename . '"');
        header('Content-Transfer-Encoding: binary');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
        header('Expires: Sat, 26 Jul 1997 05:00:00 GMT');
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
        foreach ($headers as $header => $value) {
            header("$header: $value;");
        }
        echo $file;
    }
    public static function download(string $path,string $filename,array $headers = [])
    {
        $file = file_get_contents($path);
        $size = filesize($file);
        header("Content-length: $size");
        header('Content-disposition: attachment; filename="' . $filename . '"');
        header('Cache-Control: public, must-revalidate, max-age=0');
        header('Pragma: public');
        header('Expires: Sat, 26 Jul 1997 05:00:00 GMT');
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
        foreach ($headers as $header => $value) {
            header("$header: $value;");
        }
        readfile($file);
    }
    public static function builder($headers)
    {
    }
    private static function setHeaders(array $headers)
    {
    }

    // private static function setHeaders(array $headers):string{
    //     $string_headers = "";
    //     foreach ($headers as $header => $value) {
    //         $string_headers .= "$header: $value;";
    //     }
    //     return $string_headers;
    // }
}
