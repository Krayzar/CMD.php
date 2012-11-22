CMD.php
=======

**by Krayzar**

The hilariously unsafe (and lazy) way to remotely run shell commands on your Windows based, php enabled, (hopefully) non-production web server!

What it is
----------

A single file script that takes a user submitted command and passes it on to the Windows command shell directly.  From there, the shell redirects output (both STDOUT and STDERR) that contains the results of the command to a file in the same path as the script and the script reads the file into an array.  The script then displays the results of the command line by line from the array in a user-readable format.

The script assumes two things:

1. It has the ability to write to the folder it is located in.
2. It is running under a user account that has - at the very least - permisson to execute the Windows shell executable (cmd.exe).  Note that if you are following Windows security best practices this should NEVER be the case.

Why it is
---------

1. My development server (which is 3 meters to my right and runs Windows) is too far away and I didn't feel like using MMC or RDP that day.
2. I wanted to try creating a single file, self-contained script with a form as I did not quite understand the concept of a script submitting to itself and all the examples I found were boring.
3. Its a good - albeit blunt - demonstration of why input validation/sanatization is important.
4. I enjoy creating utterly rediculous and inefficient workarounds for problems that will never ever exist.

Notes
-----

This script has been tested on:

UniServer 7 - Orion and 8 - Coral (http://www.uniformserver.com/)

I've released this solely as a learning experience and with the hope that folks also learning php (or wanting to be especially and uniquely lazy) may find it useful.  
 
**WARNING:** This script does not validate or sanatize user input and passes a raw user defined variable directly to the Windows command shell (cmd.exe). This could potenially give anyone accessing your web server (whether it is actually on Windows or not) full access to your files or the web server itself.  This script should NOT be used on php web servers that are exposed directly to the internet and should only be used for local testing purposes.  USE AT YOUR OWN RISK, I AM NOT RESPONSIBLE FOR DAMAGE DONE BY YOU OR OTHERS TO ANY HARDWARE OR SOFTWARE YOU CHOOSE TO RUN THIS SCRIPT ON.

The below is included mostly for my protection. Anyone could have come up with this script so feel free to use it as you see fit. You don't actually have to credit me.

**License**

The MIT License (MIT)
Copyright © 2012 J.A. Pace (Krayzar)

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the “Software”), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED “AS IS”, WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.