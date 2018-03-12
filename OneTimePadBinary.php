<?php

class OneTimePadBinary{

  static public function generatePad($plaintext){
    $length = strlen($plaintext); //strlen should return the length in bytes with php
    return random_bytes( $length );
  }

  static public function encrypt($plaintext,$pad){
    $cipher = $plaintext ^ $pad;
    return $cipher;
  }
  
  static public function decrypt($cipher, $pad){
    $plaintext = $cipher ^ $pad;
    return $plaintext;
  }
  
}
