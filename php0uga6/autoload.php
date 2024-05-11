<?php
spl_autoload_register(function ($classname){
    if (!file_exists("./index/".$classname.'.php')){
        header("HTTP/1.0 404 Not Found");
        header("Status: 404 Not Found");
        die();
    }
    include_once "./index/".$classname.'.php';
});