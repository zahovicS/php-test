<?php

namespace Src\App;

class Application
{

    protected string $basePath;
    protected array $configGlobal;
    protected string $appPath;
    protected static $container;

    public function __construct($basePath = null)
    {
        if ($basePath) $this->setBasePath($basePath);
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

    public function handle(array $request)
    {
    }

    public function setBasePath($basePath)
    {
        $this->basePath = rtrim($basePath, '\/');
        return $this;
    }


    private function setHelpers()
    {
        $helpers = $this->basePath . "/src/Helpers/*.php";
        foreach (glob($helpers) as $file) {
            include $file;
        }
    }

    private function setTimeZone(string $timezone)
    {
        date_default_timezone_set($timezone);
    }

    private function setConfig()
    {
        $this->configGlobal = config("app");
    }

    public function init()
    {
        //set timezone etc
        $this->setHelpers();
        $this->setConfig();
        $this->setTimeZone($this->configGlobal["timezone"]);
        $this->setErrors();
    }

    private function setErrors()
    {
        if ($this->configGlobal["debug"]) {
            ini_set('display_errors', 1);
            ini_set('display_startup_errors', 1);
            error_reporting(E_ALL);
        }
    }
}
