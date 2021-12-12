<?php

session_start();

if(!isset($_SESSION['email'])){
    header("Location: loginsweettooth.php");
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://kit.fontawesome.com/1c3de9b1bb.js" crossorigin="anonymous"></script>
        <title>Feedback</title>
        <meta name="veiwport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins&display=swap">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Great+Vibes" type="text/css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia">
        <link rel="stylesheet" href="sweettooth.css">
        
    
    </head>
    <body>
        
    <nav class="navbar">
            <div class="inner-width">
                <a href="#" class="logo">Sweettooth</a>
                <div class="navbar-menu">
                <a href="homepage.php">Home</a>
                <a href="services.php">Services</a>
                <a href="contact.php">Contact</a>
                <a href="about.php">About</a>
                <a href="feedback.php">Feedback</a>
                <a href="logout.php">Logout</a> 
            </div>
            <?php 
            echo "Welcome " .$_SESSION['user'];
            ?>
        </div>
   
        </nav> 

        <section id="testimonials">
            <div class="testimonial-heading">
                <p>Comments</p>
                <h1>Client Says</h1>
            </div>
            <div class="testimonial-box-container">
                <div class="testimonial-box">
                    <div class="box-top">
                        <div class="profile">
                            <div class="profile-img">
                                <img src ="images/c-1.jpg"/>
                            </div>
                            <div class="name-user"></div>
                        </div>
                        <div class="reviews"></div>
                    </div>
                </div>

            </div>
        </section>
    </body>
</html>

<?php

?>