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
        <title>About us</title>
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

        <div class="about">
            <div class="contain">
                <center>
                    <h1>About Us...</h1>
                    <div class="image"></div>
                    <p>We have a great deal of fun eating and moving the candy we ate as children. Now and again we are asked how we can move multi year old candy. It makes us grin and our reaction is that our candy is straight from the producer. We don’t make the candy, we found the makers who are still in the business and after that move their candy on the web. We bundle and ship our candy each day so it gets into your hands (and mouths) rapidly.

                        The mission of the ‘Sweettooth’ is to give youth candy recollections, for example, a way that it celebrates God and His arrangement for our lives. Our objective for each candy arrange is that it results in a “charmed client” who will tell their companions.</p>
                <button class="btna"> Read More</button>
                    </center>
            </div>
        </div>
    </body>
</html>

<?php

?>