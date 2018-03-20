# PHP One-Time-Pad
Hey! This is a PHP library. It generates One-Time-Pads and can be used to decrypt and encrypt text stings or binary data.
It basically consists of two classes:

* OneTimePadBinary.php
* OneTimePadString.php

The generator and encryption methods of the OneTimePadBinary class will work on binary level 
whereas the OneTimePadString class will work on character level.

## When should you use which?
The OneTimePadBinary class can be used for all production environments because its very simple and stable. 
Take a look at the file. It has very little code. You can use it to generate binary random pads or encrypt and decrypt all kind of files.

The OneTimePadString class on the other hand is great for making experiments because the generated cipher and the pads are human readable.
It is also very secure but you have no support for binary formats and you have to care for the character mapping defined in the class.

## MIT License

Copyright (c) 2018 SteamPixel

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.