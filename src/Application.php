<?php

namespace Src;

class Application
{

    protected string $basePath;
    protected string $appPath;

    public function __construct($basePath = null) {
        if ($basePath) $this->setBasePath($basePath);

    }

    public function setBasePath($basePath){
        $this->basePath = rtrim($basePath,'\/');
        $this->setHelpers();
        // $this->bindPathsInContainer();
        return $this;
    }
    protected function setHelpers(){
        $helpers = APP_ROOT . "/src/Helpers/*.php";
        foreach (glob($helpers) as $file) {
            include $file;
        }
    }
    // protected function bindPathsInContainer(){

    // }

    // public function path($path = ''){
    //     $appPath = $this->appPath ?: $this->basePath.DIRECTORY_SEPARATOR.'app';
    //     return $appPath.($path ? DIRECTORY_SEPARATOR.$path : $path);
    // }

}