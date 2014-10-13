<?php
class Validator{
	public static function validatePostParam($postParams, $isNumber = false){
		if(isset($_POST[$postParams])){
			return $_POST[$postParams];
		}

		if(!$isNumber){
			return '';
		}
		else{
			return 0;
		}
	}
	
	public static function getError($errors){
		$errorString = '';
		foreach($errors as $error)
		{
			$errorString .= $error[0].'</br>';
		}
		return $errorString;
	}
	
	public static function getFirstError($errors){
		$errorString = '';
		foreach($errors as $error)
		{
			$errorString = $error[0];
		}
		return $errorString;
	}
	
	public static function validateUsername($value){
		if ( preg_match('/\s/',$value)) {
			return FALSE;
		}
		
		if(!$value){
			return FALSE;
		}
		
		if(strlen($value) < 5){
			return FALSE;
		}
		return TRUE;
	}
	
	public static function validatePhoneNumber($value){
		if(!$value || strlen($value)==0){
			return FALSE;
		}
		
		if (!preg_match('/^([0-9_()]*)$/', $value)) {
			return FALSE;
		}
		
		if(strlen($value) < 5 || strlen($value) > 15){
			return FALSE;
		}
		return TRUE;
	}
        
       public static function validatePassword($value){
		
		
		if(!$value){
			return FALSE;
		}
		
		if(strlen($value) < 5){
			return FALSE;
		}
		return TRUE;
	}
    
	
	public static function validateEmail($email)
	{
		if( !preg_match("/^[_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*(.[a-z]{2,3})$/i", $email) ) {
		    return FALSE;
		}
		else{
			return TRUE;
		}
	}
	
	public static function convertPhoneTo84($phone)
	{
		$firstLetter = substr($phone, 0, 1);
		if(strcmp($firstLetter, '0') == 0){
			$phone = substr( $phone, 1 );
			$phone = '84'.$phone;
		}
		
		return $phone;
	}
}