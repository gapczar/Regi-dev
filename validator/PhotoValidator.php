<?php

/**
 * Photo validator.
 * 
 */
class PhotoValidator
{

    public function __construct($conditions, $messageConditions)
    {

    }

    public function validatePhoto($fileInfo = array())
    {

        if(!in_array($fileInfo['type'], $validMimeTypes)) {
            
        }
    }

}
