<?php

session_start();

error_reporting(0);

$conn = new mysqli("localhost","root","","sweettooth");

if(!$conn){
    die ("<script>alert('Connection failed!!')</script>");
}

if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM admin WHERE Username = '$username' AND Password = '$password'";
    $result = mysqli_query($conn,$sql);
    if($result ->num_rows > 0){
        $row = mysqli_fetch_assoc($result);
        $_SESSION['admin'] = $_POST['username'];
        header("Location: admin.php");
    }else{
        echo "<script>alert('Oooops! username or password is wrong.')</script>";
        
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin login</title>
    <link rel="stylesheet" href="adminlogin.css">
</head>
<body>
    <div class="container">
    <div class="box">
        <img src="loginicon.png">

               <form id="login" class="input-group" method="POST">
                    <input type="text" class="input-field" placeholder="Username" name="username" required>
                    <input type="password" class="input-field" placeholder="Password" name="password" required>
                    <span>Remember password</span><input type="checkbox" class="checkbox">
                    <button type="submit" class="submit-btn" name="login"> Login </button><br>
                </form>
    </div>
    </div>
</body>
</html>