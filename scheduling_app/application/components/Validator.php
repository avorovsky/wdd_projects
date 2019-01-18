<?php

/*
 * Project: PHP Capstone Project
 * Instructor: Steve George
 * Student: Oleksandr Vorovskyi
 * Date: September 11, 2018
 */

/*
 * forms validation
 */

namespace Components;

class Validator
{

    /*
     * returns error's display message
     *
     * @param string - text of error
     * @param array - array of errors collected
     * @return string - html-output
     */
    public static function displayError($string, $errors) {
        
        $result = (empty($errors[$string]) ? '' : '<span class="errors">'.$errors[$string].'</span>');
        
        return $result;   
        
    }
    
    /*
     * removes unnecessary spaces, quotes, special chars, tags
     * multi-spaces replaced with single ones
     *
     * @param string - field's input
     * @return string - cleaned string
     */
    public static function cleanUp($string) {
        
        $string = trim($string); // leading and ending spaces
        $string = strip_tags($string); // tags
        $string = htmlspecialchars($string); // HTML entities
        $string = urldecode($string); // URL-related
        $string = stripslashes($string); // slashes
        $result = preg_replace('!\s+!', ' ', $string); // multi to mono space
        
        return $result;   
        
    }

    /*
     * strips the phone number (digits only left)
     *
     * @param string - field's input
     * @return string - cleaned string
     */
    public static function stripPhone($string) {
        
        $result = preg_replace('/[^0-9]/', '', $string);
        
        return $result;   
        
    }
    
    /*
     * format the phone as follows 999 (999) 999-9999
     *
     * @param string - field's input
     * @return string - formatted string
     */
    public static function formatPhone($string) {
        
        $len = strlen($string);
        
        $last_part = ($len >= 4 ? substr($string, $len-4, 4) : $string);
        $prefix = ($len >=7 ? substr($string, $len-7, 3).'-' : ($len > 4? substr($string, 0, $len-4).'-' : ''));
        $net_code = ($len >=10 ? '('.substr($string, $len-10, 3).') ' : ($len >7 ? '('.substr($string, 0, $len-7).') ' : ''));
        $country_code = ($len > 10 ? substr($string, 0, $len-10).' ' : '');

        return $country_code.$net_code.$prefix.$last_part;   
        
    }

    /*
     * format ZIP as follows A1B 2C3
     *
     * @param string - field's input
     * @return string - formatted string
     */
    public static function formatZip($string) {

        $string = strtoupper($string);
        $string = str_replace(' ', '', $string);
        $string = substr($string, 0, 3).' '.substr($string, 3, 3);

        return $string;

    }

    /*
     * checks the lenght of string
     *
     * @param string - string to check
     * @param int - min length (optional)
     * @param int - max length (optional)
     * @return string - text of error
     * @return bbolean - no errors
     */
    public static function lenghtControl($string, $min=0, $max=255) {
        
        $strLenght = mb_strlen($string);
        if ($strLenght < $min || $strLenght > $max) {
            if ($min == $max) {
                return "lenght should be {$min} characters exactly";
            }
            return "lenght should be {$min} to {$max} characters";
        }
        
        return false;
        
    }
    
    /*
     * checks for letters, digits, dashes and underscores only, 6-24 chars
     *
     * @param string - field's input
     * @return string - text of error
     * @return boolean - no errors
     */
    public static function usernameCheck($string) {
        
        if (!preg_match('/^[A-Za-z][A-Za-z0-9\_\-]{6,24}$/', $string)) {
            return 'should contains letters, digits, dashes and underscores only; start with letter; and be 6 to 24 characters long';
        }
        
        // check for unique username
        if (\Models\People::getPeopleItemByUsername($string)) {
            return ' is not unique';
        }
        
        return false;
        
    }
    
    /*
     * check for letters, dots, dashes and spaces only, 2+ chars
     *
     * @param string - field's input
     * @return string - text of error
     * @return boolean - no errors
     */
    public static function nameCheck($string) {
        
        if (!preg_match('/^[A-Za-z][A-Za-z\.\-]{2,}$/', $string)) {
            return 'should contains letters, dots and dashes only; start with letter; and be at least 2 characters long';
        }
        
        return false;
        
    }
    
    /*
     * check for letters, digits, dashes and spaces only, 5+ chars
     *
     * @param string - field's input
     * @return string - text of error
     * @return boolean - no errors
     */
    public static function addressCheck($string) {
        
        if (!preg_match('/^[A-Za-z0-9\s\-]{5,}$/', $string)) {
            return 'should contains letters, digits, dashes and spaces only; and be at least 5 characters long';
        }
        
        return false;
        
    }

    /*
     * check for letters, dashes and spaces only, 5+ chars
     *
     * @param string - field's input
     * @return string - text of error
     * @return boolean - no errors
     */
    public static function cityCheck($string) {

        if (!preg_match('/^[A-Za-z\s\-]{2,}$/', $string)) {
            return 'should contains letters, dashes and spaces only; and be at least 2 characters long';
        }

        return false;

    }

    /*
     * check for Canadian ZIP format
     *
     * @param string - field's input
     * @return string - text of error
     * @return boolean - no errors
     */
    public static function zipCheck($string) {

        if (!preg_match('/^[A-z]\d[A-z][\s]?\d[A-z]\d$/', $string)) {
            return 'should have Canadian format: A1B 2C3 or A1B2C3';
        }

        return false;

    }

    /*
     * check for email validity
     *
     * @param string - field's input
     * @return string - text of error
     * @return boolean - no errors
     */
    public static function emailCheck($string) {
        
        // internal php-validation
        if (!filter_var($string, FILTER_VALIDATE_EMAIL)) {
            return "email is mot valid";
        }

        // regexp check
        // (the longest TLD at the moment - 24 chars, 
        // source: http://data.iana.org/TLD/tlds-alpha-by-domain.txt)
        if (!preg_match("/^(?:[a-z0-9]+(?:[-_.]?[a-z0-9]+)?@[a-z0-9_.-]+(?:\.?[a-z0-9]+)?\.[a-z]{2,24})$/i", $string)) {
            return "email is mot valid";
        }

        // check for unique username
        if (\Models\People::getPeopleItemByEmail($string)) {
            return ' is not unique (you may have an account with us)';
        }

        return false;
        
    }

    /*
     * check for password complexity/validity
     *
     * @param string - field's input
     * @return string - text of error
     * @return boolean - no errors
     */
    public static function passwordCheck($string) {
        
        if (!preg_match("/^.*(?=.{8,})(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).*$/", $string)) {
            return 'should  be at least 8 characters long, must contain at least one lower case letter, one upper case letter, and one digit';
        }
        
        return false;
        
    }

}
