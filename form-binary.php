<!DOCTYPE html>
<html lang="en-us">
  <head>
    <link rel="stylesheet" type="text/css" href="assets/style.css" />
  </head>
  <body>

    <div class="container">

    	<?PHP

    		include('src/OneTimePadBinary.php');

        // If we must encrypt the input...
    		if(isset($_REQUEST['encrypt'])) {

          // Generate a new pad if the pad is empty...
    			if(empty($_REQUEST['pad'])) {
    				$pad = OneTimePadBinary::generatePad($_REQUEST['text']);
    				$_REQUEST['pad'] = bin2hex($pad);
    			}else{
    				$pad = hex2bin($_REQUEST['pad']);
    			}

          // Encrypt the text and convet the result to hex because we cannot display binary in the browser
    			$_REQUEST['text'] = bin2hex(OneTimePadBinary::encrypt($_REQUEST['text'], $pad));

    		}

        // If we have to decrypt a string...
    		if(isset($_REQUEST['decrypt'])) {

          // convert the hex to bin and decrypt the binary value
    			$_REQUEST['text'] = OneTimePadBinary::decrypt(hex2bin($_REQUEST['text']), hex2bin($_REQUEST['pad']));

    		}

    	?>

      <h1>Binary level OneTimePad</h1>

      <p>
        This is a simple hex string based implementation of the binary OneTimePad. It will convert the binary format to HEX to make it human read and printable.
        Just copy your plaintext into the text field and press encrypt. If the pad is empty you will get a new random pad.
        To decrypt some data paste the ciphertext into the text field and copy your pad into the pad field. Than press the decrypt button.<br><br>
        <strong>Warning:</strong> Never use a generated pad twice! Only use this service on a trusted machine because the encryption is processed on the server and not on the client.
        Never host this tool on a public infrastructure as data could be logged or stolen. Again! This tool is made for internal use only!
        Never loose your pad or your ciphertext, since this encryption method is completely unbreakable forever!
      </p>

    	<form method="post">
    		<label>Text or ciphertext:</label>
    		<textarea style="height:200px;width:100%;" name="text"><?=$_REQUEST['text'] ?></textarea>
    		<label>Pad (key):</label>
    		<textarea style="height:200px;width:100%;" name="pad"><?=$_REQUEST['pad'] ?></textarea>
    		<button name="encrypt" <?=(isset($_REQUEST['encrypt']) ? 'disabled' : '') ?>>Encrypt</button>
    		<button name="decrypt" <?=(isset($_REQUEST['decrypt']) ? 'disabled' : '') ?>>Decrypt</button>
    	</form>

    </div>

  </body>
</html>
