
<?php

//This page will create a connection to localhost 

error_reporting( E_ALL & ~E_DEPRECATED & ~E_NOTICE );
$connection = mysqli_connect("localhost","root","password","Comp424");
if(!$connection)
{
	die('oops connection problem ! --> '.mysqli_error());
}


?>
