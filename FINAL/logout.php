
<?php
//
//The Code in this page is ran in the background if the 1 min timelimit of user in home.php page is up and they need to be logged out automatically
//and this code does the job of logging out their session

include ('comp424.php');

session_start();

if(!isset($_SESSION['users']))
{
	header("Location: login.php");
}
else if(isset($_SESSION['users'])!="")
{
	header("Location: home.php");
}

if(isset($_GET['logout']))
{
	session_destroy();
	unset($_SESSION['users']);
	header("Location: login.php");
}
?>