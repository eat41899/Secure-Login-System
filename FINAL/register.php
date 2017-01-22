
<?php

//This is where user can registere, After enter all the information, given that the email address matches the confirmation email address and Captcha code is entered correctly
//an email will be sent to the user with a confirmation link while their information is stored on a Temporary table

include ('comp424.php');
session_start();
if(isset($_SESSION['users'])!="")
{
	header("Location: home.php");
}
include_once 'comp424.php';

if(isset($_POST['btn-signup']))
{
   // $_SESSION['user'] = $_POST['uname'];
   // $_SESSION['password'] = $_POST['pass'];
    
    //SQL INJECTION and XSS
	$uname = mysqli_real_escape_string($connection,strip_tags($_POST['uname']));
	$upass = mysqli_real_escape_string($connection,strip_tags($_POST['pass']));
    $fname = mysqli_real_escape_string($connection,strip_tags($_POST['fname']));
    $lname = mysqli_real_escape_string($connection,strip_tags($_POST['lname']));             
    $email = mysqli_real_escape_string($connection,strip_tags($_POST['email']));             
    $emailC = mysqli_real_escape_string($connection,strip_tags($_POST['emailC']));      
    $bDay = mysqli_real_escape_string($connection,strip_tags($_POST['bDay']));
    $securityQ = mysqli_real_escape_string($connection,strip_tags($_POST['securityQ']));
    $securityA = mysqli_real_escape_string($connection,strip_tags($_POST['securityA']));
    //SQL INJECTION and XSS
    
    //generate conf code for email verif.
    $conf_code = sha1(uniqid(rand()));

	
	$result = mysqli_query($connection,"SELECT * FROM users WHERE username='$uname'");
	//get number of rows found in database with the given username
    $count =mysqli_num_rows($result);
    
    //check if email and confirmation email match
	if ($uemail==$uemailC){
        
        //if username is unique
        if($count==0){
            if (ctype_alnum($uname))
            {
                if(isset($_POST["captcha"])&&$_POST["captcha"]!=""&&$_SESSION["code"]==$_POST["captcha"])
                {
                    if(mysqli_query($connection,"INSERT INTO usersTemp (code,username,password,firstName,lastName,birthday,email,securityQuestion,securityAnswer) VALUES('$conf_code','$uname','$uPass','$fname','$lname','$bDay','$email','$securityQ','$securityA')"))
                    {
                        $message = "Click on link to activate account:
                                http://localhost/Comp424/confirmation.php?passkey=$conf_code";
                    
                        $sentmail = mail("$email","Registration Confirmation","$message");
                        
                        if($sentmail)
                        {
                             ?>
                            <script>alert('An Email with Confirmation link has been sent to you');</script>
                            <?php   
                        }
                        else{
                             ?>
                            <script>alert('Confirmation Email could not be sent!');</script>
                            <?php
                        }
                        
                    }
                    else{
                        ?>
                        <script>alert('There was an error during your registeration!');</script>
                        <?php
                    }
                
                
                }   
                else
                {
                    ?>
                    <script>alert('You have entered wrong captcha!');</script>
                    <?php
                }
            }
            else{
                ?>
                <script>alert('Username can only contain letters and numbers!');</script>
                <?php
            }
        }
        else{
                ?>
                <script>alert('Your username is already taken, please try another one!');</script>
                <?php
        }
        
    }
    else{
        ?><script>alert("Your Email Address Does Not Match Your Confirm Email Address!")</script><?php
    }
	
}
?>
<!DOCTYPE html >
<html >
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Comp424 Registeration</title>
    <link rel="stylesheet" href="style.css" type="text/css" />
       <script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
       <script>
            function scorePassword(pass) {
                
            var score = 0;
            if (!pass)
                return score;

            // award every unique letter until 5 repetitions
            var letters = new Object();
            for (var i=0; i<pass.length; i++) {
                letters[pass[i]] = (letters[pass[i]] || 0) + 1;
                score += 5.0 / letters[pass[i]];
            }

            // bonus points for mixing it up
            var variations = {
                digits: /\d/.test(pass),
                lower: /[a-z]/.test(pass),
                upper: /[A-Z]/.test(pass),
                nonWords: /\W/.test(pass),
            }

            variationCount = 0;
            for (var check in variations) {
                variationCount += (variations[check] == true) ? 1 : 0;
            }
            score += (variationCount - 1) * 10;

            return parseInt(score);
            }

            function checkPassStrength(pass) {
                
            var score = scorePassword(pass);
            if (score > 80){
                document.getElementById("btn-signup").disabled = false;
                return "Password is strong, you can register!";}
            if (score > 60){
                document.getElementById("btn-signup").disabled = false;
                return "Password is good, you can register!";}
            if (score >= 30){
                document.getElementById("btn-signup").disabled = true;
                return "Password is weak, improve to register!";}
                
            document.getElementById("btn-signup").disabled = true;
            return "Password is very weak, improve to register!";
            }

            $(document).ready(function() {
                
                $("#password").bind('input', function() {
                    var pass = $(this).val();
                    $("#strength_human").text(checkPassStrength(pass));
                });
            });

        </script>
    </head>
    <body>
        <center>
            <div id="login-form">
                <form method="post">
                    <table align="center" width="50%" border="0">
                        <tr>
                            <td>
                                <input type="text" size="25" name="fname" placeholder="First Name" required>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" size="25" name="lname" placeholder="Last Name" required>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="date" name="bDay" placeholder="Birthday" required>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="email" size="50" name="email" placeholder="Email Address" required>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="email" size="50" name="emailConfirm" placeholder="Confirm Email Address" required>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" size="25" name="uname" placeholder="User Name" required>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="password" size="15" name="pass" id="password" placeholder="Your Password" required />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p  id="strength_human">Password Strength</p> 
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" size="70" name="securityQ" placeholder="Please Type Your Security Question" required>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" size="20" name="securityA" placeholder="Type The Answer To Your Security Question" required>
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
                                   
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <button type="submit" id="btn-signup" name="btn-signup">Register</button> 
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <a href="login.php">Sign In Here</a> 
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </center>
    </body>
</html>