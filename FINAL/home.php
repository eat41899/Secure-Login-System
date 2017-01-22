
<?php

//This is the page that user will see after a successful login attempt, there is a hidden timer set to 1 min and after 
//1 min is over, user will automatically  log out 

    include ('comp424.php');

    session_start();
    include_once 'comp424.php';

    if(!isset($_SESSION['users']))
    {
        header("Location: login.php");
    }

    $res=mysqli_query($connection,"SELECT * FROM users WHERE userid=".$_SESSION['users']);
    $userRow=mysqli_fetch_array($res);


?>
<!DOCTYPE >
<html >
<head>
    <meta  content="text/html; charset=utf-8" />
    
<!--    logout after 1 min or 60 seconds-->
    <meta http-equiv="refresh" content="60;url=logout.php?logout" />
    <title>lab4 - Home</title>
    <link rel="stylesheet" href="style.css" type="text/css" />
</head>
<body>
    <center>
        <h1><a href="logout.php?logout">Sign Out</a> </h1>
        <h1 style=" font-size: 5em;">This was Lab4 and You have signed in as : 
            <span >
                <?php echo $userRow['username']; ?>
            </span>
        </h1>
    </center>


</body>
</html>