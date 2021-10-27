<?PHP

include('OneTimePadString.php');

for($i=1;$i<=100;$i++){

  $plaintext = 'Hello World! This is a nice text for testing the encryption and decryption with the one-time pad :-)';
  $pad = OneTimePadString::generatePad($plaintext);
  $cipher = OneTimePadString::encrypt($plaintext, $pad);
  $decrypted_plaintext = OneTimePadString::decrypt($cipher, $pad);
  
  echo 'test: '.$i."\r\n";
  echo 'plaintext: '.$plaintext."\r\n";
  echo 'pad: '.$pad."\r\n";
  echo 'cipher: '.$cipher."\r\n";
  echo 'decrypted_plaintext: '.$decrypted_plaintext."\r\n";
  
  if($plaintext==$decrypted_plaintext){
    echo 'ok'."\r\n";
  }else{
    echo 'fail: '.$decrypted_plaintext."\r\n";
    break;
  }
  
}
?>

