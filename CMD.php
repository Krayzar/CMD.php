<?php
header("Expires: Sat, 02 Apr 1994 00:00:00 GMT");
header("Last-Modified: ".gmdate("D, d M Y H:i:s")." GMT");
header("Cache-Control: post-check=0, pre-check=0",false);
header("Pragma: no-cache");
session_cache_limiter("public, no-store");
session_start();
/* WARNING - DO NOT USE THIS SCRIPT ON "PRODUCTION" WINDOWS WEB SERVERS */

$User = "Test";
$Password = "Test";

$Command = $_POST["Command"];
$head = "<head>\n<title>CMD</title>\n</head>";
$newcom_button = "<input type=\"button\" value=\"New Command\" onclick=\"window.history.back()\" /><br /><br />";



if (!isset($_SERVER['PHP_AUTH_USER']) or ($_SESSION['AUTH'] != 1) or ($_SESSION['LAST_ACTIVITY'] && (time() - $_SESSION['LAST_ACTIVITY'] > (1 * 60)))) {
	$_SESSION['AUTH'] = 1;
	$_SESSION['LAST_ACTIVITY'] = time();
    header('WWW-Authenticate: Basic realm="Please Login"');
    header('HTTP/1.0 401 Unauthorized');
    echo "You must login to use this page\n\n<input type=\"button\" value=\"Login\" onclick=\"location.reload(forceGet)\" />";
    die;
	
} else {

	if ($_SERVER['PHP_AUTH_USER'] == $User && $_SERVER['PHP_AUTH_PW'] == $Password) {
	$_SESSION['LAST_ACTIVITY'] = time();
	} else {
		echo "Incorrect Password\n<input type=\"button\" value=\"Login\" onclick=\"location.reload(forceGet)\" />";
		$_SESSION = array();
		session_destroy();
		die;
	}
}

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
		
		die("$head\nCommand not allowed<br /><br />$newcom_button");
		
	}

	print ( // Display the results of the command line by line - display new command button (just a browser back, a cheat to get the previous command to populate without work).
 		 	"$head
			<body>
			<b>$Command results</b>&nbsp&nbsp&nbsp<br />$newcom_button"
  		);
  
$lines = file("outputlog.txt");
  	foreach ($lines as $line_num => $line) {
    print ("$line <br />\n</body>");
	}
	
unlink("outputlog.txt");
/*if ($i = 25){
		$_SESSION = array();
		session_destroy();
}*/
}
?>