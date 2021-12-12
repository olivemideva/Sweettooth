<?php
session_start();

require_once 'dbConfig.php'; 

if(!isset($_SESSION['email'])){
    header("Location: loginsweettooth.php");
}
?>

<!doctype html>
<html lang="en">
  <head>
  <title>Services page</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://kit.fontawesome.com/1c3de9b1bb.js" crossorigin="anonymous"></script>
       
        <meta name="veiwport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins&display=swap">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Great+Vibes" type="text/css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia">
        <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
        <link rel="stylesheet" href="sweettooth.css">
        <link rel="stylesheet" href="tester.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <style>
    span{
        font-size: 50px;
        color: #fff;
    }
    .search-input{
        height: 10px;
        width: 250px;
        border: none;
        font-size: 16px;
        outline: none;
        background: transparent;
        margin: 15px 0 0 10px;
    }
    i{
        font-size: 20px;
        margin: 0 10px 0 0;
    }
    .label{
        font-weight: bold;
    }
    .quantity{
        width: 100px;
    }
    #price{
        color: #ff7675;
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
                <a href="viewCart.php" title="View Cart"><span class="las la-shopping-cart"></span></a> 
                <a href="logout.php">Logout</a> 
            </div>
            
         
        </div>
        <div class="search-box">
        <form>
                <input type="text" placeholder="Search..." name="search" class="search-input">
                <button type="submit" class="search-btn"><i class="fas fa-search"></i></button>
            </form>
            </div>
        </nav> 

      
        <div class="services">
        <div class="new-container">
            <div class="new-box">
            <h2>01</h2>
                <h3>Vegan Items</h3>
                <p>No more being left out confectionery is for everyone. Explore the vegan section of our website and make orders for your vegan items a taste that cannopt be imitated
                    We have trust worthy confectionery that does not have any animal product in them and is prepared by an actual vegan.
               </p>
            </div>
        </div>
        <div class="new-container">
            <div class="new-box">
            <h2>02</h2>
                <h3>Non-vegan Items</h3>
                <p>People with a sweet tooth and eat everything, here is any form of confectionery you can find.Be sure to make orders and explore the page because we have alot of options.
              </p>
            </div>
        </div>
        <div class="new-container">
            <div class="new-box">
            <h2>03</h2>
                <h3>Lactose free Items</h3>
                <p>No more being left out confectionery is for everyone. Explore the lactose intolerant section of our website and make orders for your lactose intolerant items a taste that cannopt be imitated
                    We have trust worthy confectionery that does not have any milk in them.
                </p>
            </div>
        </div>
        <div class="new-container">
            <div class="new-box">
            <h2>04</h2>
                <h3>Sweet deals</h3>
                <p>We have great offers for different season click here to see the offers and make orders. We have good discounts that will make your jaw drop.
                </p>
            </div>
        </div>
    </div>

          <!-- Product list -->
          <div class="row col-lg-12">
              <?php 
              // Get products from database 
              $result = $db->query("SELECT * FROM images"); 
              if($result->num_rows > 0){  
                  while($row = $result->fetch_assoc()){ 
              ?>
              <div class="card col-lg-4">
                  <div class="card-body">
                  <img src='uploads/<?php echo $row['image']; ?>'>
                      <h5 class="card-title"><?php echo $row['food']; ?></h5>
                      <h6 class="card-subtitle mb-2 text-muted">Price: <?php echo '$'.$row['price'].' .00'; ?></h6>
                      <p class="card-text"><?php echo $row['info']; ?></p>
                      <div class="form-group">
                      <label>Quantity:</label>
                      <select id="quantity <?php echo $row["id"]; ?>" class="form-control">
                          <option>1</option>
                          <option>2</option>
                          <option>3</option>
                          <option>4</option>
                      </select>

                      <input type="hidden" id="name <?php echo $row["id"]; ?>" value="<?php echo $row['food']; ?>">
                      <input type="hidden" id="price <?php echo $row["id"]; ?>" value="<?php echo $row['price']; ?>">

                      <button class="btn btn-primary" data-id="<?php echo $row["id"]; ?>">Add to Cart</button>
                      </div>
                      
                  </div>
              </div>
              <?php } }else{ ?>
              <p>Product(s) not found.....</p>
              <?php } ?>
          </div>
          <script>
              $(document).ready(function(){
                  $('button').click(function(){
                      id = $(this).data('id');
                      name = $('#name' + id).val()
                      price = $('#price' + id).val()
                      quantity = $('#quantity' + id).val()
                      $.ajax({
                          url: 'cart.php',
                          method: 'POST',
                          dataType:'json',
                          data:{
                              cart_id: id,
                              cart_name: name,
                              cart_price: price,
                              cart_quantity: quantity,
                              action:'add',
                              success:function(data){
                                  alert(data)
                              }
                          }
                      })
                      console.log("name: "+name)
                      console.log("price: "+price)
                      console.log("quantity: "+quantity)
                  })
              })
          </script>
  </body>
</html>
