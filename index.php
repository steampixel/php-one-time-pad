<!DOCTYPE html>
<html lang="en-us">
  <head>
	
  </head>
  <body>
	
	<?PHP
		
		include('OneTimePadString.php');
		
		if(isset($_REQUEST['encrypt'])) {
			
			if(empty($_REQUEST['pad'])) {
				$_REQUEST['pad'] = OneTimePadString::generatePad($_REQUEST['text']);
			}
			
			$_REQUEST['text'] = OneTimePadString::encrypt($_REQUEST['text'], $_REQUEST['pad']);
			
		}
		
		if(isset($_REQUEST['decrypt'])) {

			$_REQUEST['text'] = OneTimePadString::decrypt($_REQUEST['text'], $_REQUEST['pad']);
			
		}
		
	?>
	
	This is a simple string based implementation of the one time pad. Just copy your plaintext into the text field and press encrypt. The pad will then generated randomly. To decrypt some data paste the ciphertext into the text field and copy your pad into the pad field. Than press the decrypt button.
	
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
