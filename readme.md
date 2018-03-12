# PHP One-Time-Pad

Hey! This is a PHP library. It generates One-Time-Pads and can be used to decrypt and encrypt text stings or binary data.
It basically consists of two classes:

* OneTimePadBinary.php
* OneTimePadString.php

The generator and encryption methods of the OneTimePadBinary class will work on binary level 
whereas the OneTimePadString class will work on character level.

# When should you use which?
The OneTimePadBinary class can be used for all production environments because its very simple and stable. 
Take a look at the file. It has very little code. You can use it to generate binary random pads or encrypt and decrypt all kind of files.

The OneTimePadString class on the other hand is great for making experiments because the generated cipher and the pads are human readable.
It is also very secure but you have no support for binary formats and you have to care for the character mapping defined in the class.
