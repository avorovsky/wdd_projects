<?php

namespace Components;

class Validator
{
  //our errors array
  private $errors=[];
  /*validate required fields in $_POST
  *@param $field_name must be typed in. They are mandatory info.
  */
  public function required($field_name)
  {
    if(empty($_POST[$field_name])){
      $this->errors[$field_name][]=$field_name . ' is a required field.';
    }
  }

  /*validate required fields in $_POST
  *@param email must have @ and .com or .xx
  */
  public function validateEmail($field_name)
  {
    if(!filter_input(INPUT_POST, $field_name, FILTER_VALIDATE_EMAIL)){
      $this->errors[$field_name][]="Please enter a valide email address.";
    }
  }

  /*validate required fields in $_POST
  *@param string lenghth must have minimum and maximum restriction.
  */
  public function checkLength($field_name, $min_length, $max_length)
  {
    if(strlen($_POST[$field_name]) < $min_length){
      $this->errors[$field_name][]="$field_name must be at least $min_length characters long.";
    }elseif(strlen($_POST[$field_name]) > $max_length){
      $this->errors[$field_name][]="$field_name should be $max_length characters long at most.";
    }
  }

  /*validate required fields in $_POST
  *@param password should use uppercase, lowercase letter and numbers.
  */
  public function checkPassword($field_name)
  {
    $pattern='/(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9]).{6,}/';
    $string=$_POST[$field_name];
    if(preg_match($pattern,$string,$matches)===0){
      $this->errors[$field_name][]="Uppercase,lowercase,numbers are needed for security reasons.";
    }
  }

  /*validate required fields in $_POST
  *@param password typed in first time and second time must be same.
  */
  public function passwordMatch($field_name, $compare_field)
  {
    if($_POST[$field_name] != $_POST[$compare_field]){
      $this->errors[$field_name][]="Your " . $field_name . " can not match correctly.";
    }
  }

  /*validate required fields in $_POST
  *@param string can only use letters and spaces, such as name,conuntry,province...
  */
  public function checkString1($field_name)
  {
    $pattern='/^[a-zA-Z\s]+$/';
    $string=$_POST[$field_name];
    if(preg_match($pattern,$string,$matches)===0){
      $this->errors[$field_name][]="Sorry, only letters and spaces are allowed.";
    }
  }

  /*validate required fields in $_POST
  *@param string can use letters,space,dot and numbers.
  *such as street and city.
  */
  public function checkString2($field_name)
  {
    $pattern='/^[a-zA-Z\s\.\d]+$/';
    $string=$_POST[$field_name];
    if(preg_match($pattern,$string,$matches)===0){
      $this->errors[$field_name][]="Sorry, you used wrong characters.";
    }
  }

  /*create a function for checking telephone number.
  *telephone number should use Canadian standard format.
  *only allow: xxx.xxx.xxxx or xxx-xxx-xxxx or (xxx)xxx-xxxx or xxx xxx xxxx
  */
  public function checkTelephone($field_name)
  {
    $pattern='/^\(?[0-9]{3}\)?[\s|\.|\-][0-9]{3}[\.|\-][0-9]{4}$/';
    $string=$_POST[$field_name];
    if(preg_match($pattern,$string,$matches)===0){
      $this->errors[$field_name][]="Sorry, please use the correct format.";
    }
  }

  /*create a function for checking postal code.
  *postal code should use Canadian standard format.
  */
  public function checkPostal($field_name)
  {
    $pattern='/[A-Z][0-9][A-Z]\ ?[0-9][A-Z][0-9]/i';
    $string=$_POST[$field_name];
    if(preg_match($pattern,$string,$matches)===0){
      $this->errors[$field_name][]="Sorry, postal code should be correct format.";
    }
  }

  /*create a function for checking the field that only can be numbers.
  *this is for card number and secure code.
  */
  public function checkNumber($field_name)
  {
    $pattern='/^[1-9]\d*(\.\d+)?$/';
    $string=$_POST[$field_name];
    if(preg_match($pattern,$string,$matches)===0){
      $this->errors[$field_name][]="Sorry, here should be only numbers.";
    }
  }

  /*create a function for checking the field that only can be numbers.
  *this is for card number and secure code.
  */
  public function checkCVV($field_name)
  {
    $pattern='/[0-9].{2}/';
    $string=$_POST[$field_name];
    if(preg_match($pattern,$string,$matches)===0){
      $this->errors[$field_name][]="Sorry, here should be only numbers.";
    }
  }

  /*validate required fields in $_POST
  *@param string can use letters,space and dot
  *such as street and city.
  */
  public function checkCardName($field_name)
  {
    $pattern='/^[a-zA-Z\s\.]+$/';
    $string=$_POST[$field_name];
    if(preg_match($pattern,$string,$matches)===0){
      $this->errors[$field_name][]="Sorry, you enter a wrong character";
    }
  }

  function esc($string)
  {
    return htmlspecialchars($string, NULL, 'UTF-8', false);
  }
  //create the function that can escape the output in quotes
  function esc_attr($string)
  {
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8', false);
  }

  /**
  *@return array $this->errors
  */
  public function errors()
  {
    return $this->errors;
  }


}
