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
<?php
  $conn = new mysqli("localhost","root","","sweettooth") or die ("<script>alert('Connection failed!!')</script>");

 if(isset($_POST['update'])){
     $edit_id = $_POST['edit_id'];
     $edit_image =$_FILES['edit_image']['name'];
     $edit_food = $_POST['edit_food'];
     $edit_info = $_POST['edit_info'];
     $edit_price = $_POST['edit_price'] ;

     $sql = "SELECT * FROM images WHERE id='$edit_id'";
     $sql_run = mysqli_query($conn,$sql);
     foreach($sql_run as $food_row){
        if($edit_image == NULL){
            //update with existing
            $image_data = $food_row['image'];
        }else{
            //update new image and delete the old image
            if($target = "uploads/".$food_row['image']){
                unlink($target);
                $image_data = $edit_image;
            }
        }
     }

     $query = "UPDATE images SET image = '$image_data', food = '$edit_food', info = '$edit_info', price = ' $edit_price' WHERE id='$edit_id'";
     $query_run = mysqli_query($conn,$query);

     if($query_run){
        if($edit_image == NULL){
            //update with existing
            $_SESSION['message'] = "Record has been updated with existing image.";
            $_SESSION['msg_type'] = "warning";
        
            header("location: inventory.php");
        }else{
            //update new image and delete the old image
            $target = "uploads/".basename($_FILES['edit_image']['name']);
            move_uploaded_file($_FILES['edit_image']['tmp_name'], $target);
            $_SESSION['message'] = "Record has been updated.";
            $_SESSION['msg_type'] = "warning";

            header("location: inventory.php");
        }

    

     }else{
        $_SESSION['message'] = "Error!!! Record not updated.";
        $_SESSION['msg_type'] = "warning";
    
        header("location: inventory.php");
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
    
     <div class="sidebar">
            <div class="sidebar-brand">
                <h2><span class="las la-ice-cream">Sweettooth</span></h2>
            </div>

            <div class="sidebar-menu">
                <ul>
                    <li>
                        <a href="" class="active"><span class="las la-igloo"></span><span>Dashboard</span></a>
                    </li>
                    <li>
                        <a href="customers.php"><span class="las la-users"></span><span>Customers</span></a>
                    </li>
                    <li>
                        <a href=""><span class="las la-shopping-bag"></span><span>Orders</span></a>
                    </li>
                    <li>
                        <a href="inventory.php"><span class="las la-birthday-cake"></span><span>Inventory</span></a>
                    </li>
                    <li>
                        <a href=""><span class="las la-user-circle"></span><span>Accounts</span></a>
                    </li>
                    <li>
                        <a href=""><span class="las la-chart-bar"></span><span>Statistics</span></a>
                    </li>
                    <li>
                        <a href="logout.php"><span class="las la-sign-out-alt"></span><span>Logout</span></a>
                    </li>
                </ul>
            </div>
        </div>
<div class = "container-fluid">
    <div class = "card shadow mb-4">
        <div class = "card-header py-3">
            <h6 class = "m-0 font-weight-bold text-primary">Edit</h6>
        </div>
    </div>
    <div class="card-body">

    <?php

    $conn = new mysqli("localhost","root","","sweettooth") or die ("<script>alert('Connection failed!!')</script>");

    if(isset($_POST['edit_data_btn'])){
        $id = $_POST['edit_id'];
        $query = "SELECT * FROM images WHERE id=$id";
        $query_run = mysqli_query($conn,$query);

        foreach($query_run as $row){
            ?>
             <form action="" method="POST" enctype="multipart/form-data">
        <input type = "hidden" name="edit_id" value="<?php echo $row['id']?>">

    <div>
      <input type="file" name="edit_image" value="<?php echo $row['image']?>">
    </div>
    <div>
      <label for="">Name</label>
      <input type="text" name="edit_food" value="<?php echo $row['food']?>">
    </div>
    <div>
      <textarea name="edit_info" id="" cols="40" rows="4" value="<?php echo $row['info']?>"></textarea>
    </div>
    <div>
      <label for="">Price</label>
      <input type="number" name="edit_price" value="<?php echo $row['price']?>">
    </div>
    <div>
             <a href="inventory.php" class="btn btn-danger">Cancel</a>
            <button type="submit" class="btn btn-primary" name="update">Update</button>
    </div>
        </form>
            <?php
        }
    }
    ?>
       
    </div>
</div>
</body>
</html>
<?php
$conn = new mysqli("localhost","root","","sweettooth") or die ("<script>alert('Connection failed!!')</script>");

if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $conn->query("DELETE FROM images WHERE id=$id") or die("<script>alert('Error!!Cannot delete.')</script>");

    $_SESSION['message'] = "Record has been deleted.";
    $_SESSION['msg_type'] = "danger";

    header("location: inventory.php");
}
?>