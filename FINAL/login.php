
<?php
//This is where user can sign in if they have the correct username and password entered 
//as well as Captcha for extra layer of security against BruteForce attack

    include ('comp424.php');


    session_start();
    if(isset($_SESSION['users'])!="")
    {
        header("Location: home.php");
    }
    include_once 'comp424.php';

    if(isset($_POST['btn-login']))
    {
        //SQL INJECTION
        $uname = mysqli_real_escape_string($connection,$_POST['username']);
        $upass = mysqli_real_escape_string($connection,$_POST['pass']);
        

        $salt = '';
        $key="ab01$%";

        $res= mysqli_query($connection,"SELECT * FROM users WHERE username='$uname'");

        $row=mysqli_fetch_array($res);
        $salt = $row['salt'];
        $hashPass = hash ('sha512', $salt . $key . $upass);

        $count = mysqli_num_rows($res); 

        // if uname/pass correct it returns must be 1 row
        if($count == 1 && $hashPass == $row['password'] )
        {
            if(isset($_POST["captcha"])&&$_POST["captcha"]!=""&&$_SESSION["code"]==$_POST["captcha"])
            {
                //Captcha code entered correctly 
                $_SESSION['users'] = $row['userid'];
                               
                header("Location: home.php");
            }
            else
            {
               ?>
                    <script>alert('You have entered wrong captcha');</script>

               <?php
            }


        }
        else
        {
            ?>
            <script>alert('You have entered wrong username or password!');</script>

            <?php
        }

    }
?>




<!DOCTYPE html >
<html >
    <head>
        <meta content="text/html; charset=utf-8" />
        <title>Lab4 - Login</title>
        <link rel="stylesheet" href="style.css" type="text/css" />
   
    </head>
    <body>
        <center>
            <div id="login-form">
                <form  method="post">
                    <table align="center" width="30%" border="0">
                        <tr>
                            <td>
                                <input type="text" name="username" placeholder="Your Username" required />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="password" name="pass" id="password" placeholder="Your Password" required />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input name="captcha" type="text" placeholder="Enter Captcha Below">    
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <img src="captcha.php" />  
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <button type="submit" name="btn-login">Sign In</button>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <a href="register.php">Dont have an account? Register here</a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <a href="passwordRetrieval1.php">Forgot your password?</a>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </center>
    </body>
</html>