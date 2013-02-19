<?php

/**
 * DateTime operations utility class.
 * 
 */
class DateTimeService
{
    /**
     * Compute age given a birth date.
     * 
     * @param int
     */
    public function computeAge(DateTime $birthdate)
    {
        $now = new DateTime();
        return $now->diff($birthdate)->y;
    }
}
