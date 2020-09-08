<?php
if ($init = parse_ini_file('A6.ini')) 
{
	$mysqli = new mysqli(
      $init['host'],
      $init['username'],
      $init['password'],
      $init['database']);
	$con = mysqli_connect($init['host'],$init['username'],$init['password'],$init['database']);
	if (mysqli_connect_errno()) 
	{
		printf("Can't open MySQL connection. Error code: %s\n", mysqli_connect_errno());
		exit;
	}
}
else 
{
   echo "Database configuration file error. Sorry.";
}
?>
