<?php

/**
 * User validator.
 * 
 */
class UserValidator
{
    private $userData;
    private $status;
    private $errors;

    public function __construct($userData = array())
    {
        $this->userData = $userData;
        $this->errors = array();
    }
    
    protected function sanitize()
    {
        $this->status = true;

        foreach($this->userData as $key => $value) {
            if('email' == $key) {
                $value = filter_var($value, FILTER_SANITIZE_EMAIL);
            }

            if('photo' != $key) {
                $value = filter_var($value, FILTER_SANITIZE_STRING);
            }

            if(false === $value) {
                $this->errors[$key] = 'Sanitizing '.$key.' has an error';
                $this->status = false;
            } else {
                $this->userData[$key] = $value;
            }
        }
    }
    
    protected function validate()
    {
        $this->status = true;
        // validate email
        if(isset($this->userData['email'])) {
            $value = filter_var($this->userData['email'], FILTER_VALIDATE_EMAIL);

            if(false === $value) {
                $this->status = false;
                $this->errors['email'] = 'Make sure input email is in right format';
            }
        }
    }

    public function getErrors()
    {
        return $this->errors;
    }



    public function filterUserData()
    {
        if(empty($this->userData)) {
            $this->errors['global_error'] = 'Incorrect data.';

            return false;
        }

        $this->sanitize();

        if($this->status) {
            $this->validate();

            if($this->status) {
                return $this->userData;
            }
        }

        return false;
    }
}
