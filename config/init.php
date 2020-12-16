<?php
session_start();
ob_start();
require_once 'config.php';
spl_autoload_register(function($className){
    include 'lib/'.$className. '.php';
});
