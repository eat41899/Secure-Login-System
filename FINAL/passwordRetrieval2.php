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
    
    $userRes=mysqli_query($connection,"SELECT * FROM users WHERE userid=".$_SESSION['users']);       $userRow=mysqli_fetch_array($userRes);
    $uname =$userRow['username'];

    if(isset($_POST['btn-retrieveP']))
    {
        $upass = mysqli_real_escape_string($connection,strip_tags($_POST['pass']));
        $question = $userRow['securityQuestion'];
        $answer = $userRow['securityAnswer'];
        $userAnswer = mysqli_real_escape_string($connection,strip_tags($_POST['answer']));
        
        $salt = '';
        $key="ab01$%";
        $salt = $userRow['salt'];
        $hashPass = hash ('sha512', $salt . $key . $upass);

        $count = mysqli_num_rows($userRes); 

        // if uname/pass correct it returns must be 1 row
        if($count == 1 && $answer == $userAnswer )
        {
            if(isset($_POST["captcha"])&&$_POST["captcha"]!=""&&$_SESSION["code"]==$_POST["captcha"])
            {
                //Captcha code entered correctly 
                $newRes =mysqli_query($connection,"UPDATE users SET password='$hashPass' WHERE username='$uname'");
                
                $_SESSION['user'] = $uname;
                header("Location: login.php");
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
            <script>alert('You have entered wrong answer!');</script>

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
                document.getElementById("btn-retrieveP").disabled = false;
                return "Password is strong, you can register!";}
            if (score > 60){
                document.getElementById("btn-retrieveP").disabled = false;
                return "Password is good, you can register!";}
            if (score >= 30){
                document.getElementById("btn-retrieveP").disabled = true;
                return "Password is weak, improve to register!";}
                
            document.getElementById("btn-retrieveP").disabled = true;
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
                <form  method="post">
                    <table align="center" width="50%" border="0">
                        <tr>
                            <td>
                                <p type="text" id="username" >Username : <?php echo $userRow['username']; ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p id="question"> Question : <?php echo $userRow['securityAnswer']; ?> </p> 
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" name="answer" placeholder="Your Answer"  />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="password" size="15" name="pass" id="password" placeholder="Your New Password" required />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p  id="strength_human">Password Strength</p> 
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
                                <button type="submit" id="btn-retrieveP" name="btn-retrieveP">Retrieve Password</button>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <a href="login.php">Remembered your Password?</a>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </center>
    </body>
</html>