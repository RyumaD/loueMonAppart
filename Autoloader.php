<?php
function loadMyClass($class){
    if(class_exists($class)===false){
        $string = "model/".$class.'.php';
        if(file_exists($string)===true){
            require $string;
        }
        $string = "../model/".$class.'.php';
        if(file_exists($string)===true){
            require $string;
        }
    }
}
spl_autoload_register('loadMyClass');