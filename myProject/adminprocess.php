<?php

session_start();

    $update = false;
    $id = 0;

    $username = '';
    $email = '';
    $password = '';

//user details

$conn = new mysqli("localhost","root","","sweettooth");

if(!$conn){
    die ("<script>alert('Connection failed!!')</script>");
}

if (isset($_POST['save'])){
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $conn->query("INSERT INTO users (username, email, password) VALUES ('$username','$email','$password')")or  die ("<script>alert('Connection failed!!')</script>");

    
    $_SESSION['message'] = "Record has been saved.";
    $_SESSION['msg_type'] = "success";

    header("location: customers.php");
}
if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $conn->query("DELETE FROM users WHERE id=$id") or die("<script>alert('Error!!Cannot delete.')</script>");

    $_SESSION['message'] = "Record has been deleted.";
    $_SESSION['msg_type'] = "danger";

    header("location: customers.php");
}
if(isset($_GET['edit'])){
    $id = $_GET['edit'];
    $update = true;
    $sql = ("SELECT * FROM users WHERE id=$id") or die ("<script>alert('Error!!Cannot find data.')</script>");
    $result = mysqli_query($conn,$sql);
    if($result ->num_rows >= 1){
        $rows = $result->fetch_array();
        $username = $rows['username'];
        $email = $rows['email'];
        $password = md5($rows['password']);
    }
}
if(isset($_POST['update'])){
    $id = $_POST['id'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $conn->query("UPDATE users SET username = '$username', email = '$email', password = '$password' WHERE id =$id") or die ("<script>alert('Error!!Update failed.')</script>");

    $_SESSION['message'] = "Record has been updated.";
    $_SESSION['msg_type'] = "warning";

    header("location: customers.php");
}
?>