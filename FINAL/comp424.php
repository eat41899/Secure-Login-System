
<?php

//This page will create a connection to localhost url with username:root and passowrd:password and Database name being Comp424

error_reporting( E_ALL & ~E_DEPRECATED & ~E_NOTICE );
$connection = mysqli_connect("localhost","root","password","Comp424");
if(!$connection)
{
	die('oops connection problem ! --> '.mysqli_error());
}


?>