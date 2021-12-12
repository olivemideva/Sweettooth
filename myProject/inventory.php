<?php

$msg = "";
if (isset($_POST['upload'])){
    //path to store uploaded images
    $target = "uploads/".basename($_FILES['image']['name']);

    $conn = new mysqli("localhost","root","","sweettooth") or die ("<script>alert('Connection failed!!')</script>");

    $image = $_FILES['image']['name'];
    $food = $_POST['food'];
    $info = $_POST['info'];
    $price = $_POST['price'];

    $sql = "INSERT INTO images (image, food, info, price) VALUES ('$image', '$food', ' $info', '$price')";
    mysqli_query($conn, $sql);

    //moves uploaded image into the folder uploads
    if (move_uploaded_file($_FILES['image']['tmp_name'], $target)){
        $msg = "Image uploaded succesfully";
    }else{
        $msg = "There was a problem in uploading the image";
    }
}

?>
<!doctype html>
<html lang="en">
  <head>
    <title>Inventory</title>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins&display=swap">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Great+Vibes" type="text/css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia">
        <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
        <link rel="stylesheet" href="admin.css">
        <link rel="stylesheet" href="tester.css">
    
  </head>
  <body>
      
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <?php 
    require_once("inventory_process.php"); 
    ?>

    <?php
    if(isset($_SESSION['message'])):
    ?>

    <div class = "alert alert-<?=$_SESSION['msg_type']?>">

    <?php
    echo $_SESSION['message'];
    unset($_SESSION['message']);
    ?>
     </div>
     <?php endif ?>

     <div class="sidebar">
            <div class="sidebar-brand">
                <h2><span class="las la-ice-cream">Sweettooth</span></h2>
            </div>

            <div class="sidebar-menu">
                <ul>
                    <li>
                        <a href="admin.php" class="active"><span class="las la-igloo"></span><span>Dashboard</span></a>
                    </li>
                    <li>
                        <a href="customers.php"><span class="las la-users"></span><span>Customers</span></a>
                    </li>
                    <li>
                        <a href="orders.php"><span class="las la-shopping-bag"></span><span>Orders</span></a>
                    </li>
                    <li>
                        <a href="inventory.php"><span class="las la-birthday-cake"></span><span>Inventory</span></a>
                    </li>
                    <li>
                        <a href="accounts.php"><span class="las la-user-circle"></span><span>Accounts</span></a>
                    </li>
                    <li>
                        <a href="logout.php"><span class="las la-sign-out-alt"></span><span>Logout</span></a>
                    </li>
                </ul>
            </div>
        </div>

    <div id="content">

    <?php
          $conn = new mysqli("localhost","root","","sweettooth") or die ("<script>alert('Connection failed!!')</script>");
          $sql = "SELECT * FROM images";
          $result = mysqli_query($conn, $sql);
          while($row = mysqli_fetch_array($result)){
              echo "<div id= 'img_div'>";
              echo "<img src='uploads/".$row['image']."'>";
              echo "<p>".$row['food']."</p>";
              echo "<p>".$row['info']."</p>";
              echo "<p id= 'price'>$".$row['price'].".00</p>";
              echo "<p>";?>
              <form action="inventory_process.php" method="POST">
                  <input type = "hidden" name="edit_id" value="<?php echo $row['id']?>">
                  <button type="submit" name = "edit_data_btn" class="btn btn-info">Edit</button>
              </form>
              <a href="inventory_process.php?delete=<?php echo $row['id']?>"
                    class = "btn btn-danger">Delete</a>
                    
                    <?php 
              echo "</p>";
              echo "</div>";
          
           } ?>


      <form method="POST" action="inventory.php" enctype="multipart/form-data">
      <input type="hidden" name="e_id" value="<?php echo $id?>">
    <div>
      <input type="file" name="image" >
    </div>
    <div>
      <label for="">Name</label>
      <input type="text" name="food" placeholder="food name">
    </div>
    <div>
      <textarea name="info" id="" cols="40" rows="4" placeholder="say something about the image..." ></textarea>
    </div>
    <div>
      <label for="">Price</label>
      <input type="number" name="price" placeholder="00.00">
    </div>
    <div>
            <button type="submit" class="btn btn-primary" name="upload">Upload</button>
    </div>
    </form>
    </div>
            </div>

  </body>
</html>