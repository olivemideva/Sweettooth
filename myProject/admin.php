<?php

session_start();

if(!isset($_SESSION['admin'])){
    header("Location: adminlogin.php");
}

$conn = new mysqli("localhost","root","","sweettooth") or die ("<script>alert('Connection failed!!')</script>");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Sweettooth admin</title>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins&display=swap">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Great+Vibes" type="text/css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia">
        <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="admin.css">
        <script src="https://www.gstatic.com/charts/loader.js"></script>
        <style>
            body{
                background: #fab1a0;
            }
        </style>
                    <script type="text/javascript">
        google.charts.load('current', {
            'packages' : ['corechart'],
            'mapsApikey' : ''
        });
        google.charts.setOnLoadCallback(drawRegionsMap);

        function drawRegionsMap(){
            var data = google.visualization.arrayToDataTable([
                ['date','sales'],
                <?php
                $chartQuery = "SELECT * FROM cart";
                $chartQueryRecords = mysqli_query($conn, $chartQuery);
                while($row = mysqli_fetch_assoc($chartQueryRecords)){
                    echo "['" .$row['created']."',".$row['grand_total']."],";
                }
                ?>
            ]);
            var options = {

            };
            var chart = new google.visualization.LineChart(document.getElementById('chart'));
            chart.draw(data,options);
            
        }
        </script>
    </head>

    <body>
        <input type="checkbox" id="nav-toggle">
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

        <div class="main-content">
            <header>
                <h2>
                <label for="">
                        <span class="las la-bars"></span>
                </label>
                Dashboard

                </h2>
                <div class="search-wrapper">
                    <span class="las la-search"></span>
                    <input type="search" placeholder="Search...">
                </div>

                <div class="user-wrap">
                    <img src="adminicon.png" width="40px" height="40px" alt="">
                    <div>
                        <h4>Welcome back..........</h4>
                        <small> <?php 
                              echo $_SESSION['admin'];
                              ?></small>
                    </div>
                </div>

            </header>
            <main>
                <div class="cards">
                    <div class="card-single">
                        <div>
                            <h1> 54 </h1>
                            <span> Customers </span>
                        </div>
                        <div>
                            <span class="las la-users"></span>
                        </div>
                    </div>
                    <div class="card-single">
                        <div>
                            <h1> 79 </h1>
                            <span> Deliveries </span>
                        </div>
                        <div>
                            <span class="las la-truck"></span>
                        </div>
                    </div>
                    <div class="card-single">
                        <div>
                            <h1> 124 </h1>
                            <span> Orders </span>
                        </div>
                        <div>
                            <span class="las la-shopping-bag"></span>
                        </div>
                    </div>
                    <div class="card-single">
                        <div>
                            <h1> $6k </h1>
                            <span> Income </span>
                        </div>
                        <div>
                            <span class="las la-wallet"></span>
                        </div>
                    </div>
                </div>
                <div id="chart" style = "width: 100%; height: 400px;"></div>
            </main>
        </div>
    </body>
</html>