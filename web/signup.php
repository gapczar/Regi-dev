<?php

require_once '../app/ConnectionManager.php';
require_once '../model/UserDQ.php';
require_once '../validator/UserValidator.php';
require_once '../validator/PhotoValidator.php';

try {
    
    if ('POST' === $_SERVER['REQUEST_METHOD']) {
        $userValidator = new UserValidator($_POST['user']);
        $userData = $userValidator->filterUserData();
        $errors = array();

        if(false === $userData) {
            $errors = $userData->getErrors();
        } else {
            if(strlen($_FILES['user']['name']['photo']) > 0) {
                //save photo
                $photoValidator = new PhotoValidator();
                $photoStatus = $photoValidator->validatePhoto($_FILES['user']);
               
                if($photoStatus) {
                    //move file
                    $targetPath = '/images';
                    $path = realpath(dirname(__FILE__))."/$targetPath";

                    if (!file_exists($path)) {  
                        mkdir($path, 0777, true);
                    }
                       
                    if (move_uploaded_file($_FILES['user']['tmp_name']['photo'], $path.'/'.$_FILES['user']['name']['photo'])){
                        $userData['photo'] = $_FILES['user']['name']['photo'];
                    }  else {
                        $errors['photo'] = $photoValidator->getErrorMessage(); 
                    }

                } else {
                    $errors['photo'] = $photoValidator->getErrorMessage(); 
                }
            } 

            if(empty($errors)) {
                //save to database
                $connManager = new ConnectionManager();
                $userDQ = new UserDQ(@$connManager->getConnection());
                $userDQ->save($userData);

                header("Location: index.php"); 
                exit;
            }
        }
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
