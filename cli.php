<?PHP

include('OneTimePadBinary.php');

$command = $argv[1];

if($command =='encrypt') {

  $filename_plain = $argv[2];
  
  $filename_pad = $filename_plain.'.pad';
  if(!empty($argv[3])) {
    $filename_pad = $argv[3];
  }
  
  $filename_cipher = $filename_plain.'.cipher';
  if(!empty($argv[4])) {
    $filename_cipher = $argv[4];
  }

  $plain = file_get_contents($filename_plain);

  $pad = OneTimePadBinary::generatePad($plain);

  $cipher = OneTimePadBinary::encrypt($plain, $pad);

  file_put_contents($filename_pad, $pad);
  
  file_put_contents($filename_cipher, $cipher);

}

if($command =='decrypt') {

  $filename_pad = $argv[2];
  
  $filename_cipher = $argv[3];

  $filename_plain = $argv[4];

  $pad = file_get_contents($filename_pad);

  $cipher = file_get_contents($filename_cipher);

  $plain = OneTimePadBinary::decrypt($cipher, $pad);

  file_put_contents($filename_plain, $plain);

}


