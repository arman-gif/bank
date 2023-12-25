<?php
@include 'assets/db.php';

if(isset($_POST['submit'])){

    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);

    $account_type = mysqli_real_escape_string($con, $_POST['account_type']);
    $nationality = mysqli_real_escape_string($con, $_POST['nationality']);
    $occupation = mysqli_real_escape_string($con, $_POST['occupation']);
    $authority = mysqli_real_escape_string($con, $_POST['authority']);
    $address = mysqli_real_escape_string($con, $_POST['address']);
    $birth = mysqli_real_escape_string($con, $_POST['birth']);
    $issued_state = mysqli_real_escape_string($con, $_POST['issued_state']);
    $issued_date = mysqli_real_escape_string($con, $_POST['issued_date']);
    $expiry_date = mysqli_real_escape_string($con, $_POST['expiry_date']);
    $nominee_name = mysqli_real_escape_string($con, $_POST['nominee_name']);
    $number = mysqli_real_escape_string($con, $_POST['number']);
    $nid_number = mysqli_real_escape_string($con, $_POST['nid_number']);
   
    $pass = md5($_POST['password']);
    $cpass = md5($_POST['cpassword']);
    $user_type = $_POST['user_type'];
    $select_gender = $_POST['select_gender'];

    $select = "SELECT * FROM user_form WHERE email = '$email' && password = '$pass' && number ='$number' && nominee_name = '$nominee_name' && account_type = '$account_type' &&  nationality = ' $nationality' && occupation = '$occupation' && authority = '$authority' && address = '$address' && birth = '$birth' &&  issued_state = '$issued_state' &&  issued_date = '$issued_date'  &&  expiry_date = '$expiry_date' && nid_number = '$nid_number'";
    $result = mysqli_query($con, $select);

    if(mysqli_num_rows($result) > 0){
        $error[] = 'user already exist!';
        
    }else{
        if($pass != $cpass){
            $error[] = 'password not match!';
        }else{
            $insert = "INSERT INTO user_form(name, email, password, number, nominee_name, account_type, nationality, occupation, authority, address, birth, issued_state, issued_date, expiry_date, nid_number, select_gender, user_type) VALUES('$name','$email','$pass','$number','$nominee_name','$account_type',' $nationality','$occupation','$authority','$address','$birth','$issued_state','$issued_date','$expiry_date','$nid_number','$select_gender','$user_type')";
            mysqli_query($con, $insert); 
            header('location:login.php');
        }
    }

};





?>














<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>register form</title>

    <?php if (isset($_GET['delete'])) 
  {
    if ($con->query("delete from useraccounts where id = '$_GET[id]'"))
    {
      header("location:mindex.php");
    }
  } ?>


    <style>
        /* ===== Google Font Import - Poppins ===== */
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600&display=swap');
*{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
}
.form-container{
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px;
    padding-bottom: 60px;
    background: #eee;
}
.form-container form{
   padding: 20px;
   border-radius: 5px;
   box-shadow: 0 5px 10px rgba(0,0,0,.1);
   background:#fff;
   text-align: center;
   width: 1500px;
}
.form-container form h3{
    font-size: 30px;
    text-transform: uppercase;
    margin-bottom: 10px;
    color:#333;
}
 .form-container form select{
    width: calc(100% / 2 - 50px);;
    padding: 10px 15px;
    font-size: 17px;
    margin: 8px 0px;
    background: #eee;
    border-radius: 5px;
}
.form-container form input{
    width: calc(100% / 2 - 50px);
    padding: 10px 15px;
    font-size: 17px;
    margin: 8px 0px;
    background: #eee;
    border-radius: 5px;
}

.form-container form select option{
    background: #fff;
}
.form-container form .form-btn{
    background: #fbd0d9;
    color: red;
    text-transform: capitalize;
    font-size: 20px;
    cursor: pointer;
}
.form-container form .form-btn:hover{
    background: red;
    color: #fff;
}
.form-container form p{
    margin-top: 10px;
    font-size: 20px;
    color: #333;
}
.form-container form .error-msg{
    margin: 10px 0;
    display: block;
    background: red;
    color: #fff;
    border-radius: 5px;
    font-size: 20px;
}


</style> 
</head>
<body>

<div class="form-container">
    <form action="" method="post">
        <h3>register now</h3>

        <?php

        if(isset($error)){
            foreach($error as $error){
                echo '<span class = "error-msg">'.$error.'</span>';
            };
        };

        ?>

        <input type="text" name="name" required placeholder="enter your name">
        <input type="email" name="email" required placeholder="enter your email">
        <input type="password" name="password" required placeholder="enter your password">
        <input type="password" name="cpassword" required placeholder="confirm your password">
        <input type="number" name="number"placeholder="Enter mobile number" required>
        <input type="text" name="birth"placeholder="Enter birth date" required>
        <input type="text" name="address"placeholder="Permanent or Temporary Address" required>
        <input type="text" name="account_type"placeholder="Enter account type" required>
        <input type="text" name="nationality"placeholder="Enter nationality" required>
        <input type="text" name="occupation"placeholder="Enter your occupation" required>
        <input type="text" name="authority"placeholder="Enter issued authority" required>
        <input type="text" name="issued_state"placeholder="Enter issued state" required>
        <input type="text" name="issued_date"placeholder="Enter your issued date" required>
        <input type="text" name="expiry_date"placeholder="Enter expiry date" required>
        <input type="text" name="nominee_name"placeholder="Enter nominee name" required>
        <input type="number" name="nid_number" placeholder="Enter NID Number" required>

        <select name="user_type">
            <option value="user">user</option>
            <option value="admin">admin</option>
        </select>
        <select name="select_gender" required>
                <option>Male</option>
                <option>Female</option>
                <option>Others</option>
        </select>

        <input type="submit" name="submit" value="register now" class="form-btn">
        <p> already have an account? <a href="login.php"> login now </a> </p>
      
        
    </form>    
</div>

</body>
</html>