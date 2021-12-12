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
        <title>Contact us</title>
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
       
        <div class="contact">
        <div class="container1">
            <h1>Connect with us</h1>
            <p>We would love to respond to your queries and help you in your orders.<br> Feel free to get in touch with us.</p>
            <div class="contact-box">
                <div class="contact-left">
                    <h3>Send your request</h3><br><br>
                  
                    <form action="" method="POST">
                        
                        <div class="input-new">
                        <div class="input-row1">
                            <div class="input-group1">
                                <label for="name">Full name</label>
                                <input type="text" id="name" name="fname"placeholder="John Doe">
                                <label for="phone">Phone number</label>
                                <input type="text" id="phone" name="phone-no" placeholder="+254 799 532 377">
                            </div>
                        </div>
                        <div class="input-row1">
                            <div class="input-group1">
                                <label for="emailadd">Email Address</label>
                                <input type="email" id="emailadd" name="email_address"placeholder="johndoe@gmail.com">
                                <label for="subject">Subject</label>
                                <input type="text" id="subject" name="subject_" placeholder="Messed up order">
                            </div>
                        </div>
                    </div>

                    <label for="message">Message</label>
                    <textarea name="messages" id="message" rows="5" placeholder="Type your message here"></textarea>

                    <input type="submit" name="sub" id="send" value="SEND">

                    </form>
                </div>
                <div class="contact-right">
                    <h3>Reach us</h3><br><br>

                    <table>
                        <tr>
                            <td>Email</td>
                            <td>sweettooth@gmail.com</td>
                        </tr>
                        <tr>
                            <td>Phone</td>
                            <td>+254 707 070 707</td>
                        </tr>
                        <tr>
                            <td>Address</td>
                            <td>#123, 5th floor, 3rd cross <br>
                            Heaven road,Angel street, best 434334</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </body>
</html>

<?php

?>