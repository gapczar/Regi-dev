<?php

require_once '../app/ConnectionManager.php';
require_once '../model/UserDM.php';
require_once '../validator/UserValidator.php';

try {
    
    // initialize userData
    $user = array (
        'display_name' => '',
        'real_name' => '',
        'location' => '',
        'email' => '',
        'date_of_birth' => '',
        'bio' => '',
    );
    
    if ('POST' === $_SERVER['REQUEST_METHOD']) {
        
        $validator = new UserValidator();
        $validator->bindData($_POST['user'], $_FILES['user']);
        
        if ($validator->isValid()) {
            
            // save photo using a unique filename
            $photo = $validator->getPhoto();
            $base = pathinfo($_FILES['user']['name']['photo'], PATHINFO_FILENAME);
            $time = time();
            $ext = pathinfo($_FILES['user']['name']['photo'], PATHINFO_EXTENSION);
            $filename = $base . "_$time." . $ext;
            
            $isUploadSuccess = @move_uploaded_file($photo['tmp_name']['photo'], 'images/' . $filename);
            if (!$isUploadSuccess) {
                throw new Exception('Failed moving image!');
            }
            
            $userData = $validator->getSanitizedData();
            $userData['photo'] = $filename;
            
            $connManager = new ConnectionManager();
            $userDM = new UserDM(@$connManager->getConnection());
            $userDM->insert($userData);
            $userDM->insert($userData);
            
            header("Location: index.php");
            exit;
        }
        
        $user = $validator->getUserData();
        $errors = $validator->getErrors();
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
