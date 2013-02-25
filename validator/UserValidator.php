<?php

/**
 * User validator.
 * 
 */
class UserValidator
{
    private $userData = null;
    private $photo = null;
    private $sanitizedData = array ();
    private $errors = array ();
    private $isBound = false;
    
    /**
     * Bind user data
     * 
     * @param type $userData
     * @param type $photo
     * @return \UserValidator Returns self
     * @throws Exception
     */
    public function bindData($userData, $photo = null)
    {
        $expectedFields = array (
            'display_name',
            'real_name',
            'location',
            'email',
            'date_of_birth',
            'bio'
        );
        
        $missingFields = array_diff_key($expectedFields, array_keys($userData));
        if (0 !== count($missingFields)) {
            throw new Exception('Specified user data has missing fields: ' . implode(',', $missingFields));
        }
        
        // trim trailing white spaces from user data
        $this->userData = array_map('trim', $userData);
        $this->photo = $photo;
        $this->isBound = true;
        
        return $this;
    }
    
    /**
     * Validate bound data.
     * 
     * @return boolean
     */
    public function isValid()
    {
        if ($this->isBound) {
            $this->sanitize();
            $this->validate();
            return 0 === count($this->errors);
        }
        
        throw new Exception('Cannot validate. Ensure data has been successfully bound.');
    }
    
    private function sanitize()
    {
        $this->sanitizedData['display_name'] = filter_var($this->userData['display_name'], FILTER_SANITIZE_STRING);
        $this->sanitizedData['real_name'] = filter_var($this->userData['real_name'], FILTER_SANITIZE_STRING);
        $this->sanitizedData['location'] = filter_var($this->userData['location'], FILTER_SANITIZE_STRING);
        $this->sanitizedData['email'] = filter_var($this->userData['email'], FILTER_SANITIZE_EMAIL);
        $this->sanitizedData['date_of_birth'] = filter_var($this->userData['date_of_birth'], FILTER_SANITIZE_STRING);
        $this->sanitizedData['bio'] = filter_var($this->userData['bio'], FILTER_SANITIZE_STRING);
    }
    
    private function validate()
    {
        // validate display name
        if (0 === strlen($this->sanitizedData['display_name'])) {
            $this->errors['display_name'] = 'Display name is required';
        }
        
        // validate email (1)
        if (0 === strlen($this->sanitizedData['email'])) {
            $this->errors['email'] = 'Email is required';
        }
        
        // validate email (2)
        if (0 !== strlen($this->sanitizedData['email']) &&
            !filter_var($this->sanitizedData['email'], FILTER_VALIDATE_EMAIL)) {
            $this->errors['email'] = 'Email format is invalid';
        }
        
        // validate date of birth (if provided)
        if (0 !== strlen($this->sanitizedData['date_of_birth'])) {
            $parts = explode('-', $this->sanitizedData['date_of_birth']);
            
            if (3 !== count($parts)) {
                $this->errors['date_of_birth'] = 'Invalid date format';
            }
            
            if (3 === count($parts) && !checkdate($parts[1], $parts[2], $parts[0])) {
                $this->errors['date_of_birth'] = 'Invalid date';
            }
        }
        
        // validate photo (if one was uploaded)
        if (4 != $this->photo['error']['photo']) {
            $img = $this->photo['tmp_name']['photo'];
            if (!getimagesize($img)) {
                $this->errors['photo'] = 'Invalid image file';
            }
        }
    }
    
    /**
     * Get validation errors
     * 
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }
    
    /**
     * Get unsanitized user data
     * 
     * @return array
     */
    public function getUserData()
    {
        return $this->userData;
    }
    
    /**
     * Get sanitized data.
     * 
     * @return array
     */
    public function getSanitizedData()
    {
        return $this->sanitizedData;
    }
    
    /**
     * Get photo
     * 
     * @return mixed
     */
    public function getPhoto()
    {
        return $this->photo;
    }
}
