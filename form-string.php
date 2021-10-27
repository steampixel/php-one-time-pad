<!DOCTYPE html>
<html lang="en-us">
  <head>
    <link rel="stylesheet" type="text/css" href="assets/style.css" />
  </head>
  <body>

    <div class="container">

    	<?PHP

    		include('src/OneTimePadString.php');

        // Get or set the current character map
        if(isset($_REQUEST['characters'])) {
          OneTimePadString::setCharacterMap($_REQUEST['characters']);
        } else {
          $_REQUEST['characters'] = OneTimePadString::getCharacterMap();
        }

        // Lets encrypt a text
    		if(isset($_REQUEST['encrypt'])) {

          // Generate a new pad if empty
    			if(empty($_REQUEST['pad'])) {
    				$_REQUEST['pad'] = OneTimePadString::generatePad($_REQUEST['text']);
    			}

          // Encrypt the text
    			$_REQUEST['text'] = OneTimePadString::encrypt($_REQUEST['text'], $_REQUEST['pad']);

    		}

        // Lets decrypt a ciphertext
    		if(isset($_REQUEST['decrypt'])) {

    			$_REQUEST['text'] = OneTimePadString::decrypt($_REQUEST['text'], $_REQUEST['pad']);

    		}

    	?>

      <h1>String based OneTimePad</h1>

      <p>
      	This is a implementation of the string based one time pad. With this tool you can encrypt and decrypt strings on character level.
        Just copy your plaintext into the text field and press the encrypt button.
        You can insert your own pad, if you want. Leave the pad field empty to auto generate a random one (recommended).
        To decrypt some data paste the ciphertext into the text field and copy your pad into the pad field. Than press the decrypt button.
        Because the encryption is on character level the character map inside the character field is also very important for restoring the information from a ciphertext.
        So please make sure all characters inside your text are also available inside the character map. Also keep its correct order!<br><br>
        <strong>Warning:</strong> Never use a generated pad twice! Only use this service on a trusted machine because the encryption is processed on the server and not on the client.
        Never host this tool on a public infrastructure as data could be logged or stolen. Again! This tool is made for internal use only!
        Never loose your pad or your ciphertext, since this encryption method is completely unbreakable forever! Also keep your used character map!
      </p>

      <?php

      $errors = OneTimePadString::getErrors();

      if(count($errors)) {
        echo 'Errors and Warnings:';
        echo '<ul>';
        foreach($errors as $error) {
          echo '<li>'.$error.'</li>';
        }
        echo '</ul>';
      }

      ?>

    	<form method="post">
        <label>Supported characters:</label>
    		<textarea style="height:50px;width:100%;" name="characters"><?=$_REQUEST['characters'] ?></textarea>
    		<label>Text or ciphertext:</label>
    		<textarea style="height:200px;width:100%;" name="text"><?=$_REQUEST['text'] ?></textarea>
    		<label>Pad (key):</label>
    		<textarea style="height:200px;width:100%;" name="pad"><?=$_REQUEST['pad'] ?></textarea>
    		<button name="encrypt">Encrypt</button>
    		<button name="decrypt">Decrypt</button>
    	</form>

    </div>

  </body>
</html>
