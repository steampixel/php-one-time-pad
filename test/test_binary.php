<?PHP

include('OneTimePadBinary.php');

$filename = 'testfiles/test.txt';

for($i=1;$i<=100;$i++){

  $plaintext = file_get_contents($filename);

  $pad = OneTimePadBinary::generatePad($plaintext);
  $cipher = OneTimePadBinary::encrypt($plaintext,$pad);
  $plaintext_dectypted = OneTimePadBinary::decrypt($cipher,$pad);

  //file_put_contents($filename.'.cipher',$cipher);
  //file_put_contents($filename.'.decrypted',$plaintext_dectypted);

  echo 'test: '.$i."\r\n";
  echo $plaintext."\r\n";
  echo $pad."\r\n";
  echo $cipher."\r\n";
  echo $plaintext_dectypted."\r\n";

  if($plaintext == $plaintext_dectypted){
    echo 'done';
  }else{
    echo 'fail';
    break;
  }

}