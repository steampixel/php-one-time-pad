<?php

class OneTimePadString{
  
  // Define the supported characters
  static $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ .:,;?!_-*/+=()[]{}<>&%$§^"\'';
  
  // Return the modulo of a given number
  // PHPs % operator cannot deal with negative numbers. They will stay negative
  static function modulo($num, $mod) {
    return ($mod + ($num % $mod)) % $mod;
  }
  
  static public function generatePad($plaintext){
    $plaintext_length = strlen($plaintext);// Get the length of the plaintext
    $pad = '';
    for ($i = 0; $i < $plaintext_length; $i++) {
      // Note: Use random_int instead of rand since its better for generating cryptographic save random numbers
      $pad.= self::$characters[random_int(0, strlen(self::$characters)-1)];
    }
    return $pad;
  }
  
  static public function encrypt($plaintext,$pad){
    
    $plaintext_length = strlen($plaintext);// Get the length of the plaintext
    $key_length = strlen($pad);// Get the length of the pad
    
    if($key_length!=$plaintext_length){
      echo 'Your pad length must equal the plaintext length!'."\r\n";
      return false;
    }
    
    $cipher = ''; // Initiate the cipher as empty string
    
    // This class operates on character level 
    // So it might happen that not every character can be translated
    // Only characters defined in $characters are supported
    $unsupported_plaintext_characters = [];
    
    // Iterate over the pad
    for ($i = 0; $i < $key_length; $i++) {
      
      // Convert plaintext and pad characters into numbers based on their position in the $characters array
      $key_char_number = strpos(self::$characters,$pad[$i]);
      
      $plaintext_char_number = strpos(self::$characters,$plaintext[$i]);

      if($plaintext_char_number!==false){
        
        // Add the numbers with the length of the possible chars as modulo
        $result_number = self::modulo(($plaintext_char_number + $key_char_number), strlen(self::$characters));
      
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
      echo 'Warning! Cannot replace the characters "'.implode('", "',$unsupported_plaintext_characters).' in plaintext"! They are currently not in the list of supported chars and will not be encoded. But you can simply add them to the list'."\r\n";
    }
    
    return $cipher;
    
  }
  
  static public function decrypt($cipher, $pad){
    
    $cipher_length = strlen($cipher); // Get the length of the cipher
    $key_length = strlen($pad); // Get the length of the pad
    
    if($key_length!=$cipher_length){
      echo 'Your pad length must be equal to the cipher length!';
      return false;
    }
    
    $plaintext = ''; //Initiate the plaintext as empty string
    
    // Iterate over the pad
    for ($i = 0; $i < $key_length; $i++) {
      
      // Convert cipher and pad characters into numbers based on their position in $characters array
      $key_char_number = strpos(self::$characters,$pad[$i]);
      
      $cipher_char_number = strpos(self::$characters,$cipher[$i]);
      
      if($cipher_char_number!==false){
      
        // Substract the numbers with the length of the possible chars as modulo
        $result_number = self::modulo(($cipher_char_number - $key_char_number), strlen(self::$characters));
        
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
