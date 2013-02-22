<?php

/**
 * Photo validator.
 * 
 */
class PhotoValidator
{
    private $validMimeTypes;
    private $conditions;
    private $messages;
    private $errorMessage;

    public function __construct($conditions = array(), $messages = array())
    {
        $this->conditions = $conditions;
        $this->messages = $messages;
        $this->errorMessage = 'Please validate your photo!';

        $this->validMimeTypes = array('image/jpeg', 'image/png', 'image/gif', 'image/bmp');
    }

    public function getErrorMessage()
    {
        return $this->errorMessage;
    }

    public function validatePhoto($photoInfo = array())
    {
        if(!in_array($photoInfo['type']['photo'], $this->validMimeTypes)) {
            return false;
        }

        //TODO: validate other info
        if(isset($this->conditions['max_size'])) {
            //TODO: validate other info if not valid;

        }

        return true;
    }

}
