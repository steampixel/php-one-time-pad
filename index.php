<!DOCTYPE html>
<html lang="en-us">
  <head>
	
  </head>
  <body>
	
	<?PHP
		
		include('OneTimePadBinary.php');
		
		if(isset($_REQUEST['encrypt'])) {
			
			if(empty($_REQUEST['pad'])) {
				$pad = OneTimePadBinary::generatePad($_REQUEST['text']);
				$_REQUEST['pad'] = bin2hex($pad);
			}else{
				$pad = hex2bin($_REQUEST['pad']);
			}
			
			$_REQUEST['text'] = bin2hex(OneTimePadBinary::encrypt($_REQUEST['text'], $pad));
			
		}
		
		if(isset($_REQUEST['decrypt'])) {

			$_REQUEST['text'] = OneTimePadBinary::decrypt(hex2bin($_REQUEST['text']), hex2bin($_REQUEST['pad']));
			
		}
		
	?>
	
	This is a simple hex string based implementation of the binary one time pad. Just copy your plaintext into the text field and press encrypt. The pad will then generated randomly. To decrypt some data paste the ciphertext into the text field and copy your pad into the pad field. Than press the decrypt button.
	
	<form method="post">
		Text:
		<textarea style="height:200px;width:100%;" name="text"><?=$_REQUEST['text'] ?></textarea>
		Pad:
		<textarea style="height:200px;width:100%;" name="pad"><?=$_REQUEST['pad'] ?></textarea>
		<button name="encrypt" <?=(isset($_REQUEST['encrypt']) ? 'disabled' : '') ?>>Encrypt</button>
		<button name="decrypt" <?=(isset($_REQUEST['decrypt']) ? 'disabled' : '') ?>>Decrypt</button>
	</form>
	
  </body>
</html>
