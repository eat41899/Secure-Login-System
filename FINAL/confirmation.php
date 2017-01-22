<?php

//After user clicks on confirmation link, they will be redirected to this page where the confirmation code will be checked
//and if it matches the original confirmation code assigned to the user in temporary Table, all rows in temporary table will be deleted
//and user will be added to main table with a secure Salt password 

include('comp424.php');

//get unique code sent to user
$passkey = $_GET['passkey'];

//find passkey if exist in temp table
$query = "SELECT * FROM usersTemp WHERE code='$passkey'";
$result = mysqli_query($connection,$query);

if($result){
    //count rows that have passkey
    $countkeys = mysqli_num_rows($result);
    
    //if unique code found once - get data from temp table
    if($countkeys == 1){
        $rows = mysqli_fetch_array($result);
        
        //take out whitespace 
        $uname = trim($rows['username']);
        $email = trim($rows['email']);
        $upass = trim($rows['password']);
        $fname = trim($rows['firstName']);
        $lname = trim($rows['lastName']);
        $bDay = trim($rows['birthday']);
        
        //BRUTE FORCE PREVENTTION - SALT HASHING 
        define('SALT_LENGTH',12);
        $key="ab01$%";
        $salt = substr(hash('sha512',uniqid(rand(), true).microtime()), 0, SALT_LENGTH);
        $hashedPass = hash ('sha512', $salt . $key . $upass);
        
        //insert into final user table
        $query2 = "INSERT INTO users (username,password,firstName,lastName,birthday,email,securityQuestion,securityAnswer,salt) VALUES('$uname','$hashedPass','$fname','$lname','$bDay','$email','$securityQ','$securityA','$salt')";
        $infinaltable = mysqli_query($connection,$query2);
        
        if($infinaltable){ 
            //take user to login page
            ?>
            <script>alert("You have successfully Registered! You can now Login!")</script>
            <?php
            header("Location:login.php");
            
            //OR confirm to user 'account verified'
            //echo "Congratulations, you account has been verified.";
            
            //delete and clean data from temp table
            $sqldel = "DELETE FROM usersTemp WHERE 1";
            mysqli_query($connection,$sqldel);
        }else{
            echo "Sorry, could not verify your account.";
        }        
        
    }else{
        echo "Wrong confirmation code - Account not created.";
    }

}
?>