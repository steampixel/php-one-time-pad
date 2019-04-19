<?php

class OneTimePadString{
  
  // Define the supported characters
  static $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ .:,;?!_-#*/+=()}<>&%$^"\''."\r\n";
  
  static function getCharacterMap() {
	return self::$characters;
  }
  
  static function setCharacterMap($characters) {
	self::$characters = $characters;
  }
  
  // Textarea newlines on Windows will produce two characters and will destroy the charater map.
  // So we have to convert this
  static function convertEOL($string, $to = "\n")
  {   
    return preg_replace("/\r\n|\r|\n/", $to, $string);
  }
  
  // Return the modulo of a given number
  // PHPs % operator cannot deal with negative numbers. They will stay negative
  static function modulo($num, $mod) {
    return ($mod + ($num % $mod)) % $mod;
  }
  
  static public function generatePad($plaintext){
	$plaintext = self::convertEOL($plaintext);
    $plaintext_length = mb_strlen($plaintext);// Get the length of the plaintext
	echo 'Generating pad length of '.$plaintext_length.'<br>';
    $pad = '';
    for ($i = 0; $i < $plaintext_length; $i++) {
      // Note: Use random_int instead of rand since its better for generating cryptographic save random numbers
      $pad.= self::$characters[random_int(0, mb_strlen(self::$characters)-1)];
    }
    return $pad;
  }
  
  static public function encrypt($plaintext,$pad){
    
	$plaintext = self::convertEOL($plaintext);
	$pad = self::convertEOL($pad);
	
    $plaintext_length = mb_strlen($plaintext);// Get the length of the plaintext
    $pad_length = mb_strlen($pad);// Get the length of the pad
    
    if($pad_length!=$plaintext_length){
      echo 'Your pad length must equal the plaintext length!'."\r\n";
      return false;
    }
    
    $cipher = ''; // Initiate the cipher as empty string
    
    // This class operates on character level 
    // So it might happen that not every character can be translated
    // Only characters defined in $characters are supported
    $unsupported_plaintext_characters = [];
    
    // Iterate over the pad
    for ($i = 0; $i < $pad_length; $i++) {
      
      // Convert plaintext and pad characters into numbers based on their position in the $characters array
      $key_char_number = mb_strpos(self::$characters,$pad[$i]);
      
      $plaintext_char_number = mb_strpos(self::$characters,$plaintext[$i]);

      if($plaintext_char_number!==false){
        
        // Add the numbers with the length of the possible chars as modulo
        $result_number = self::modulo(($plaintext_char_number + $key_char_number), mb_strlen(self::$characters));
      
        // Convert the number back to a char
        $result_char = self::$characters[$result_number];
        
        //echo 'Encrypt: '.$plaintext[$i].'('.$plaintext_char_number.') + '.$pad[$i].'('.$key_char_number.') = '.$result_char.'('.$result_number.') mod '.strlen(self::$characters)."\r\n";
      
      }else{
        
        // Unupported characters will not be translated
        $result_char = $plaintext[$i];
        array_push($unsupported_plaintext_characters,$plaintext[$i]);
        
      }

      // Add the char to the cipher text
      $cipher.= $result_char;
    }
    
    // If one ore more characters are not supported print a warning
    $unsupported_plaintext_characters = array_unique($unsupported_plaintext_characters);
    
    if(count($unsupported_plaintext_characters)){
      echo 'Warning! Cannot replace the characters "'.implode('", "',$unsupported_plaintext_characters).'" in plaintext! They are currently not in the list of supported chars and will not be encoded. But you can simply add them to the list'."\r\n";
    }
    
    return $cipher;
    
  }
  
  static public function decrypt($cipher, $pad){
    
	$cipher = self::convertEOL($cipher);
	$pad = self::convertEOL($pad);
	
    $cipher_length = mb_strlen($cipher); // Get the length of the cipher
    $pad_length = mb_strlen($pad); // Get the length of the pad
    
    if($pad_length!=$cipher_length){
		echo 'cipher_length: '.$cipher_length.'<br>';
		echo 'pad_length: '.$pad_length.'<br>';
      echo 'Your pad length must be equal to the cipher length!';
      return false;
    }
    
    $plaintext = ''; //Initiate the plaintext as empty string
    
    // Iterate over the pad
    for ($i = 0; $i < $pad_length; $i++) {
      
      // Convert cipher and pad characters into numbers based on their position in $characters array
      $key_char_number = mb_strpos(self::$characters,$pad[$i]);
      
      $cipher_char_number = mb_strpos(self::$characters,$cipher[$i]);
      
      if($cipher_char_number!==false){
      
        // Substract the numbers with the length of the possible chars as modulo
        $result_number = self::modulo(($cipher_char_number - $key_char_number), mb_strlen(self::$characters));
        
        // Convert the number back to a char
        $result_char = self::$characters[$result_number];
        
        //echo 'Decrypt: '.$cipher[$i].'('.$cipher_char_number.') - '.$pad[$i].'('.$key_char_number.') = '.$result_char.'('.$result_number.') mod '.strlen(self::$characters)."\r\n";
        
      }else{
        
        // Unsupported character
        $result_char = $cipher[$i];
      }
      
      //Add the char to the plaintext
      $plaintext.= $result_char;
      
    }
    
    return $plaintext;
    
  }
  
}
