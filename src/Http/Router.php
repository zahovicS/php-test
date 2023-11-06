<?php

namespace Src\Http;

use Exception;
use Src\Http\Middleware\Middleware;

class Router
{
    protected $routes = [];

    public function add($method, $uri, $controller)
    {
        $this->routes[] = [
            'uri' => $uri,
            'controller' => $controller,
            'method' => $method,
            'middleware' => null
        ];

        return $this;
    }

    public function get($uri, $controller)
    {
        return $this->add('GET', $uri, $controller);
    }

    public function post($uri, $controller)
    {
        return $this->add('POST', $uri, $controller);
    }

    public function delete($uri, $controller)
    {
        return $this->add('DELETE', $uri, $controller);
    }

    public function patch($uri, $controller)
    {
        return $this->add('PATCH', $uri, $controller);
    }

    public function put($uri, $controller)
    {
        return $this->add('PUT', $uri, $controller);
    }

    public function only(array|string $key)
    {
        $this->routes[array_key_last($this->routes)]['middleware'] = $key;

        return $this;
    }

    public function route($uri, $method)
    {
        $action = null;
        $middlewares = null;
        foreach ($this->routes as $route) {
            if ($route['uri'] === $uri && $route['method'] === strtoupper($method)) {
                $action = $route["controller"];
                $middlewares = $route['middleware'];
                break;
            }
        }
        if (!$action) {
            return $this->abort();
            // throw new Exception("Action '{$route['uri']}' in Router is not defined.");
        }
        if(is_array($middlewares)){
            foreach ($middlewares as $middleware) {
                Middleware::resolve($middleware);
            }
        }
        if(is_string($middlewares)){
            Middleware::resolve($middlewares);
        }

        if (is_array($action)) {
            $controller = new $action[0];
            $action = [$controller,$action[1]];
        }
        $data = Request::capture();
        call_user_func_array($action,[(object) $data]);
    }

    public function previousUrl()
    {
        return $_SERVER['HTTP_REFERER'];
    }
    private function cleanURI(string $uri,string $url):string{
        $resolve = $uri;
        if ($uri != "/") {
            $resolve = str_replace($url,"",$uri);
        }
        return $resolve;
    }
    protected function abort($code = 404)
    {
        http_response_code($code);
        return view("Errors.{$code}");
    }
}