<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Orders</title>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins&display=swap">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Great+Vibes" type="text/css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia">
        <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="admin.css">
        <link rel="stylesheer" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="https://code.jquery.com/jquery-1.12.3.min.js">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
        
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
      
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>

    <?php 
    require_once("adminprocess.php"); 
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

    <input type="checkbox" id="nav-toggle">
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

    <div class="container">
    <?php
    $conn = new mysqli("localhost","root","","sweettooth") or die ("<script>alert('Connection failed!!')</script>");
    $result =$conn->query("SELECT * FROM cart")  or die ("<script>alert('Data selection failed!!')</script>");
    $sql =$conn->query("SELECT * FROM items")  or die ("<script>alert('Data selection failed!!')</script>");

    function pre_r($array){
    echo "<pre>";
    print_r($array);
    echo "</pre>";
    }
    ?>

<h3>ORDERS</h3>
    <div class="row justify-content-center">
        <table class="table table-fluid" id="myTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>customer</th>
                    <th>Total</th>
                    <th>Created</th>
                    <th>Status</th>
                </tr>
            </thead>
            <?php
            while( $rows = $result->fetch_assoc()):
            ?>
            <tr>
                <td><?php echo $rows['id'];?></td>
                <td><?php echo $rows['customer_id'];?></td>
                <td><?php echo $rows['grand_total'];?></td>
                <td><?php echo $rows['created'];?></td>
                <td><?php echo $rows['status'];?></td>
            </tr>
            <?php endwhile;?>
        </table>
    </div>
    <h3>ORDER ITEMS</h3>
    <div class="row justify-content-center">
        <table class="table table-fluid" id="myTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Order_id</th>
                    <th>Product_id</th>
                    <th>Quantity</th>
                </tr>
            </thead>
            <?php
            while( $row = $sql->fetch_assoc()):
            ?>
            <tr>
                <td><?php echo $row['id'];?></td>
                <td><?php echo $row['order_id'];?></td>
                <td><?php echo $row['product_id'];?></td>
                <td><?php echo $row['quantity'];?></td>
            </tr>
            <?php endwhile;?>
        </table>
    </div>
    <script>
        $(document).ready( function () {
    $('#myTable').DataTable();
} );
    </script>

   
        </div>
</body>
</html>
                