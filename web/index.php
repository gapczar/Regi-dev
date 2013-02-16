<?php

include '../app/ConnectionManager.php';
include '../model/UserDQ.php';
include '../service/DateTimeService.php';

try {
    $connManager = new ConnectionManager();
    $userDQ = new UserDQ(@$connManager->getConnection());
    $users = $userDQ->retrieveAll();
    $dts = new DateTimeService();
    include "../view/homepage.php";
}
catch (Exception $ex) {
    
    // log exception
    $log = date('M d, Y H:i:s') . '    ' . $ex->getMessage() . "\n";
    file_put_contents('../app/logs/ExceptionLog.txt', $log, FILE_APPEND);
    
    // render error page
    header("HTTP/1.1 500 Internal Server Error");
    include "../view/error500.php";
}
