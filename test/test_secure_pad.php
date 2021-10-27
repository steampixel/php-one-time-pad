<?PHP

include('OneTimePadString.php');

// This example shows why you cannot secure your pad with an extra password that is not generated from a random source
// The idea was simple: OTP is great but you have to store your pad somewhere. That leads to the question if there is any
// possibility to secure your pad with an extra password layer.
// Below I will go through the steps how to do that:
$plaintext = 'aaaaaaaaaa';

// 1. Create a password that you can remember
$password = '01234';

// 2. Expand the password to the same length as your plaintext
$password = $password.$password;

// 3. Create a pad using the generator with the required length
$pad = OneTimePadString::generatePad($password);

// 4. Create a "secure" pad by encrypting your password string with the generated pad
$secure_pad = OneTimePadString::encrypt($password, $pad);

// 5. Than create your cipher by using the last generated "secure" pad
$cipher = OneTimePadString::encrypt($plaintext, $secure_pad);

// Cool! Now if anybody discovers your pad and your cipher he will still need the password to get the original plaintext back.
// But wait! What would happen if we just try out the decrypt method without the password?
$pad_cipher_difference = OneTimePadString::decrypt($cipher, $pad);

// Ops! The result looks like the password. Only the characters are shifted to the right.
// Ok. In real we would not encrypt such a simple plaintext and would not use such a weak password. 
// But it doesnt matters: The pattern of our password is hidden inside the secure pad and will get sharper if we know the cipher.
// So. This is realy not more secure. To make this realy secure your password have to be random too. 
echo 'plaintext: '.$plaintext."\r\n";
echo 'password: '.$password."\r\n";
echo 'pad: '.$pad."\r\n";
echo 'secure_pad: '.$secure_pad."\r\n";
echo 'cipher: '.$cipher."\r\n";
echo 'pad_cipher_difference: '.$pad_cipher_difference."\r\n";











