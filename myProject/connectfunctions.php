<?php
function connect(){
    $dbserver = "localhost";
    $dbuser = "root";
    $dbpassword = " ";
    $dbname = "sweettooth";
    $link = mysqli_connect($dbserver,$dbuser,$dbpassword,$dbname) or die("<script>alert('Connection failed!!')</script>");
    return $link;
}
function getData($sql){
    $link = connect();
    $result = mysqli_query($link,$sql);

    while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
        $rows[] = $row;
    }
    return $rows;
}
function setData($sql){
    $link = connect();
    if(mysqli_query($link,$sql)){
        return true;
    }else{
        return false;
    }
}
?>