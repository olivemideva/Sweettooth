<?php
session_start();

$conn = new mysqli("localhost","root","","sweettooth");

if(isset($_POST['add_to_cart'])){

  if(isset($_SESSION['cart'])){

    $session_array_id = array_column($_SESSION['cart'], "id");

    if(!in_array($_GET['id'], $session_array_id)){

      $session_array = array(
        'id' => $_GET['id'],
        "food" => $_POST['food'],
        "price" => $_POST['price'],
        "quantity" => $_POST['quantity']
      );
  
      $_SESSION['cart'][] = $session_array;

    }

  }else{

    $session_array = array(
      'id' => $_GET['id'],
      "food" => $_POST['food'],
      "price" => $_POST['price'],
      "quantity" => $_POST['quantity']
    );

    $_SESSION['cart'][] =$session_array;

  }

}

if(!isset($_SESSION['email'])){
  header("Location: loginsweettooth.php");
}

?>
<!doctype html>
<html lang="en">
  <head>
    <title>Cart</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="https://kit.fontawesome.com/1c3de9b1bb.js" crossorigin="anonymous"></script>
       
       <meta name="veiwport" content="width=device-width, initial-scale=1.0">
       <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins&display=swap">
       <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
       <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Great+Vibes" type="text/css">
       <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia">
       <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
       <link rel="stylesheet" href="sweettooth.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <style>
    span{
      font-size: 50px;
      color: #fff;
    }
    body{
      background-color: #fab1a0;
    }
  </style>
  <body>
      
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <nav class="navbar">
    <?php 
            echo "Welcome " .$_SESSION['user'];
            ?>
            <br><br><br>
            <div class="inner-width">
                <a href="#" class="logo">Sweettooth</a>
                <div class="navbar-menu">
                <a href="homepage.php">Home</a>
                <a href="services.php">Services</a>
                <a href="contact.php">Contact</a>
                <a href="about.php">About</a>
                <a href="feedback.php">Feedback</a>
                <a href="cart.php">Menu<span class="las la-shopping-cart"></span></a> 
                <a href="logout.php">Logout</a> 
            </div>
            
        </div>
     
        </nav> 

    <div class="container-fluid">
      <div class="col-md-12">
        <div class="row">
          <div class="col-md-6">
            <h3 class="text-center">Items</h3>
            <div class="col-md-12">
              <div class="row">

              <?php 
              
              $query = "SELECT * FROM images";
              $result = mysqli_query($conn,$query);

              while($row = mysqli_fetch_array($result)){?>
              <div class="col-md-4">
                <form method="POST" action="cart.php?id=<?=$row['id'] ?>">
                <img src="uploads/<?=$row['image']; ?>" style="height: 150px;">
                <h2 class="text-center"><?=$row['food']; ?></h2>
                <p><?=$row['info']; ?></p>
                <h2 class="text-center">$<?= number_format($row['price'],2); ?></h2>

                <input type="hidden" name="food" value="<?=$row['food']; ?>">
                <input type="hidden" name="price" value="<?=$row['price']; ?>">
                <input type="number" name="quantity" value="1" class="form-control">
                <input type="submit" name="add_to_cart" class="btn btn-primary btn-block my-2" value="Add to Cart">
              </form>
              </div>
             <?php }
              ?>

              </div>
            </div>
          </div>
          <div class="col-md-6">
            <h3 class="text-center">Cart</h3>

            <?php

            $total = 0;
            
            $output = "";

            $output = "
            <table class='table table-bordered table-striped'>
                <tr>
                   <th>ID</th>
                   <th>Item name</th>
                   <th>Price</th>
                   <th>Quantity</th>
                   <th>Total Price</th>
                   <th>Action</th>
                 </tr>
            ";

            if(!empty($_SESSION['cart'])){

              foreach($_SESSION['cart'] as $key => $value){

                $output .= "
                <tr>
                <td>".$value['id']."</td>
                <td>".$value['food']."</td>
                <td>".$value['price']."</td>
                <td>".$value['quantity']."</td>
                <td>$".number_format($value['price'] * $value['quantity'],2)."</td>
                <td>
                <a href='cart.php?action=remove&id=".$value['id']."'>
                <button class='btn btn-danger btn-block'>Remove</button>
                </a>
                </td>
              </tr>
                ";

                $total = $total + $value['quantity'] * $value['price'];

              }

              $output .= "
                   <tr>
                     <td colspan='3'></td>
                     <td><b>Total Price</b></td>
                     <td>".number_format($total,2)."</td>
                     <td>
                     <a href='cart.php?action=clearall'>
                     <button class='btn btn-warning btn-block'>Clear Cart</button>
                     </td>
                   </tr>
                   <tr>
                   <td>
                   <a href='cart.php?action=checkout'>
                   <button class='btn btn-warning btn-block'>Checkout</button>
                   </td>
                   </tr>
              ";
            }

            echo $output;

            ?>

          </div>
        </div>
      </div>
    </div>

    <?php

    
    if(isset($_GET['action'])){
      if($_GET['action'] == "clearall"){
        unset($_SESSION['cart']);
      }

      if($_GET['action'] == "remove"){
        foreach($_SESSION['cart'] as $key => $value){
          if($value['id'] == $_GET['id']){
            unset($_SESSION['cart'][$key]);
          }
        }
      }

        if($_GET['action'] == "checkout"){
                    
          $custID = $_SESSION['userid'];
          $food_id = $value['id'];
          $amount = $value['quantity'];

                          // Insert order info in the database 
                        $insertOrder = $conn->query("INSERT INTO cart (customer_id, grand_total, created, status) VALUES ('$custID', '$total', NOW(), 'Pending')"); 

                        if($insertOrder){
                         
                          $orderID = $conn->insert_id;
                          $sql = "";
                          foreach($_SESSION['cart'] as $key => $value){
                                $sql .="INSERT INTO items (order_id, product_id, quantity) VALUES ('$orderID','$food_id', '$amount')";
                          }
                              
                          $insertOrderItems = $conn->multi_query($sql); 

                          if($insertOrderItems){ 
                              // Remove all items from cart 
                              unset($_SESSION['cart']); 
                              
                          }
                        }
                        
                        
          }
      
      
    }
        
    ?>

  </body>
</html>