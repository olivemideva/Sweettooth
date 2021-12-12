<?php

session_start();

error_reporting(0);

$conn = new mysqli("localhost","root","","sweettooth");

if(!$conn){
    die ("<script>alert('Connection failed!!')</script>");
}

if(isset($_POST['register'])){
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $cpassword = md5($_POST['cpassword']);

    if($password == $cpassword){
        $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
        $result = mysqli_query($conn,$sql);
        if($result ->num_rows > 0){
            echo "<script>alert('Oooops! Username already exists.')</script>";
        }else{
            $sql = "INSERT INTO users(username,email,password) VALUES ('$username','$email','$password')";
            $result = mysqli_query($conn, $sql);
            if($result){
                echo "<script>alert('Congratutations! You are now registered.')</script>";
                $username = "";
                $email = "";
                $_POST['password'] = "";
                $_POST['cpassword'] = "";
            }else{
                echo "<script>alert('Oooops! Something went wrong.')</script>";
            }
        }
  
    }else{
       echo "<script>alert('Password does not match.')</script>"; 
    }
}

if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conn,$sql);
    if($result ->num_rows > 0){
        $row = mysqli_fetch_assoc($result);
        $_SESSION['email'] = $row['email'];
        $_SESSION['userid'] = $row['id'];
        $_SESSION['user'] = $_POST['username'];
        header("Location: services.php");
    }else{
        echo "<script>alert('Oooops! username or password is wrong.')</script>";
        
    }
}

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://kit.fontawesome.com/1c3de9b1bb.js" crossorigin="anonymous"></script>
        <title>Login and Registration page</title>
        <meta name="veiwport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Great+Vibes" type="text/css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia">
        <link rel="stylesheet" type="text/css" href="sweettooth.css">
    
    </head>
    <body>
       
        <div class="one">

            <div class="form-box">
                <div class="button-box">
                    <div id="btn"></div>
                    <button type="button" class="toggle-btn" onclick="login()">Login</button>
                    <button type="button" class="toggle-btn" onclick="register()">Register</button>
                </div>
                <div class="social-icons1">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                </div>
                <form id="login" class="input-group" method="POST">
                    <input type="text" class="input-field" placeholder="Username" name="username" required>
                    <input type="password" class="input-field" placeholder="Password" name="password" required>
                    <span>Remember password</span><input type="checkbox" class="checkbox">
                    <button type="submit" class="submit-btn" name="login"> Login </button><br>
                </form>
                <form id="register" class="input-group" method="POST">
                    <input type="text" class="input-field" placeholder="Username" name="username" required>
                    <input type="email" class="input-field" placeholder="Email Address" name="email" required>
                    <input type="password" class="input-field" placeholder="Password" name="password" required>
                    <input type="password" class="input-field" placeholder="Confirm Password" name="cpassword" required>
                    <span>I agree to the terms & conditions</span><input type="checkbox" class="checkbox">
                    <button type="submit" class="submit-btn" name="register"> Register</button>
                </form>
            </div>
            <button><a class="submit-btn" href="adminlogin.php">Admin</a></button>
        </div>
       
        <script>
            var x = document.getElementById("login");
            var y = document.getElementById("register");
            var z = document.getElementById("btn");

            function register(){
                x.style.left="-400px";
                y.style.left="50px";
                z.style.left="110px";

            }
            function login(){
                x.style.left="50px";
                y.style.left="450px";
                z.style.left="0px";

            }
        </script>
    </body>
</html>