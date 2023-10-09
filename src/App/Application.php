<?php

namespace Src\App;

class Application
{

    protected string $basePath;
    protected string $appPath;
    protected static $container;

    public function __construct($basePath = null) {
        if ($basePath) $this->setBasePath($basePath);

    }

    public function handle(array $request){
        
    }

    public function setBasePath($basePath){
        $this->basePath = rtrim($basePath,'\/');
        $this->setHelpers();
        return $this;
    }

    protected function setHelpers(){
        $helpers = $this->basePath . "/src/Helpers/*.php";
        foreach (glob($helpers) as $file) {
            include $file;
        }
    }

    public static function setContainer($container)
    {
        static::$container = $container;
    }

    public static function container()
    {
        return static::$container;
    }

    public static function bind($key, $resolver)
    {
        static::container()->bind($key, $resolver);
    }

    public static function resolve($key)
    {
        return static::container()->resolve($key);
    }

}