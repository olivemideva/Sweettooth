<?php

session_start();

    $update = false;
    $id = 0;

    $username = '';
    $password = '';

//user details

$conn = new mysqli("localhost","root","","sweettooth");

if(!$conn){
    die ("<script>alert('Connection failed!!')</script>");
}

if (isset($_POST['save'])){
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $conn->query("INSERT INTO admin (Username, Password) VALUES ('$username','$password')")or  die ("<script>alert('Connection failed!!')</script>");

    
    $_SESSION['message'] = "Record has been saved.";
    $_SESSION['msg_type'] = "success";

    header("location: accounts.php");
}
if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $conn->query("DELETE FROM admin WHERE id=$id") or die("<script>alert('Error!!Cannot delete.')</script>");

    $_SESSION['message'] = "Record has been deleted.";
    $_SESSION['msg_type'] = "danger";

    header("location: accounts.php");
}
if(isset($_GET['edit'])){
    $id = $_GET['edit'];
    $update = true;
    $sql = ("SELECT * FROM admin WHERE id=$id") or die ("<script>alert('Error!!Cannot find data.')</script>");
    $result = mysqli_query($conn,$sql);
    if($result ->num_rows >= 1){
        $rows = $result->fetch_array();
        $username = $rows['Username'];
        $password = md5($rows['Password']);
    }
}
if(isset($_POST['update'])){
    $id = $_POST['id'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $conn->query("UPDATE admin SET Username = '$username', Password = '$password' WHERE id =$id") or die ("<script>alert('Error!!Update failed.')</script>");

    $_SESSION['message'] = "Record has been updated.";
    $_SESSION['msg_type'] = "warning";

    header("location: accounts.php");
}
?>