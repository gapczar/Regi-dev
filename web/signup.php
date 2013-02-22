<?php

include '../app/ConnectionManager.php';
include '../model/UserDQ.php';
include '../validator/UserValidator.php';

try {
    
    if ('POST' === $_SERVER['REQUEST_METHOD']) {
        
        echo "<pre>" . print_r($_POST, true) . "</pre>";
        echo "<br><br><pre>" . print_r($_FILES, true) . "</pre>";
        exit;
        
        $userValidator = new UserValidator($_POST['user']);
        $userData = $userValidator->filterData();

        if(false === $userData) {
            include "../view/signup.php";
        } else {
            
        }
        
        $userPhoto = $_FILES['user'];
        
        // TODO sanitize, validate, save
    }
    
    
    
    include "../view/signup.php";
    
}
catch (Exception $ex) {
    
    // log exception
    $log = date('M d, Y H:i:s') . '    ' . $ex->getMessage() . "\n";
    file_put_contents('../app/logs/ExceptionLog.txt', $log, FILE_APPEND);
    
    // render error page
    header("HTTP/1.1 500 Internal Server Error");
    include "../view/error500.php";
}
