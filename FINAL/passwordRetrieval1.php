<?php

//In this page user types their username and if it already exists , their prechosen security Question will appear
//and if they answer it correctly they will be able to reset their password in the main table
    include ('comp424.php');

    session_start();
    if(isset($_SESSION['users'])!="")
    {
        header("Location: home.php");
    }
    include_once 'comp424.php';

    if(isset($_POST['btn-retrieveQ']))
    {
        //SQL INJECTION
        $uname = mysqli_real_escape_string($connection,strip_tags($_POST['username']));
        $res= mysqli_query($connection,"SELECT * FROM users WHERE username='$uname'");
        $row=mysqli_fetch_array($res);
        $count = mysqli_num_rows($res); 

        // if uname/pass correct it returns must be 1 row
        if($count == 1  )
        {
                $_SESSION['users'] = $row['userid'];
                header("Location: passwordRetrieval2.php");
        }
        else
        {
            ?>
            <script>alert('Your username does not exist!');</script>
            <?php
        }

    }
   
?>




<!DOCTYPE html >
<html >
    <head>
        <meta content="text/html; charset=utf-8" />
        <title>Comp424 Password Retrieval</title>
        <link rel="stylesheet" href="style.css" type="text/css" />
   
    </head>
    <body>
        <center>
            <div id="login-form">
                <form  method="post">
                    <table align="center" width="50%" border="0">
                        <tr>
                            <td>
                                <input type="text" name="username" placeholder="Your Username" required />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                    <button name="btn-retrieveQ" type="submit">Retrieve Question</button>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </center>
    </body>
</html>