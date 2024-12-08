<?php
session_start();
require('connexion.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

if (isset($_POST['Next'])) {
    $keymt = mt_rand(99999, 999999);
    $mail = new PHPMailer(true);
    try {
        //Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'chathub0001@gmail.com';
        $mail->Password = "rfjfbfvfmsxgrcmb"; 
        $mail->SMTPSecure = "ssl";
        $mail->Port = 465;

        //Recipients
        $mail->setFrom("chathub0001@gmail.com", 'Chat Hub');
        $mail->addAddress($_POST['email']);

        // Content
        $mail->isHTML(true);
        $mail->Subject = "Chat Hub Verification Code";
        
        $style = "
            <div style='font-family: Arial, sans-serif; text-align: center; color: black;'>
                <h2 style='color: #4CAF50;'>Chat Hub Verification Code</h2>
                <p>Your verification code is:</p>
                <div style='font-size: 24px; font-weight: bold; color: #FF5722;'>$keymt</div>
                <p style='color: #888;'>This code will expire in 3 minutes.</p>
                <img src='https://example.com/verification_image.png' alt='Verification' style='width: 100px; height: 100px;'>
                <div style='margin-top: 20px;'>
                    <a href='https://www.instagram.com/chathub' style='text-decoration: none; margin: 0 10px;'>
                        instagram
                    </a>
                    <a href='https://www.facebook.com/chathub' style='text-decoration: none; margin: 0 10px;'>
                        facebook
                    </a>
                    <a href='https://www.twitter.com/chathub' style='text-decoration: none; margin: 0 10px;'>
                        twitter
                    </a>
                </div>
            </div>
        ";

        $mail->Body = $style;

        $mail->send();
        echo '<script>alert(Message has been sent)</script>';
    } catch (Exception $e) {
        echo "<script>alert(Message could not be sent. Mailer Error: {$mail->ErrorInfo})</script>";
    }

    $email = $_POST['email'];
    $sql = "SELECT * FROM `user` WHERE `email` = '$email'";
    $stm = $con->query($sql);
    $t = $stm->fetch();
    if ($t) {
        echo "<script>window.location.href='verification2.php?email=" . $email . "?verification_code=" . $keymt . "'</script>";
    } else {
        echo "<script>alert('This person with this email does not exist')</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ChatHub.ma</title>
    <link rel="webesite icon" href="chatlogo.png">
    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>
    <style>
        .footer2 {
            width: 98%;
            margin-top: 620px;
            position: absolute;
        }
    </style>
</head>

<body>
    <!--header -->
    <header>
        <a href="login.php">
            <div class="span1">
                <p>Free chat rooms</p>
            </div>
        </a>
        <a href="login.php">
            <div class="span2">
                <h3><img src="chat.png" alt="..." id="imgheader">Chat Hub</h3>
            </div>
        </a>
        <div class="span3">
            <a href="login.php">Login</a>
            <a href="">Chathub Free Registration</a>
        </div>
    </header>
    <div class="parent">
        <div class="childNN2">
            <br><br>
            <h2>enter your email</h2>
            <form method="post">
                <input type="text" name="email" id="emaill" class="input" placeholder="Your email"><br><br>
                <input type="submit" value="Next" name="Next" id="start">
            </form>
        </div>
    </div>

    <p class="p">
        <span class="pSpan">Chat Hub</span> is a free chat room website where you can have live chat with single women and men,
        you can discuss <br> with random strangers from USA, Canada, United Kingdom, Australia and people from all over
        the world, at the<br> same time in multiple chatrooms and discussion groups, any time you can start a private
        conversation to meet<br> girls and boys living nearby in your area.
    </p>

    <!--footer -->
    <footer class="footer2">
        <div class="divfooter">
            <img src="chatlogo(2).png" alt="......." class="img2">
            <div class="a1">
                <a href="CHATROOMS.php" id="a2">CHAT ROOMS</a><br><br>
                <a href="FAQ.php" id="a2">FAQ</a><br>
            </div>
            <div class="a2">
                <a href="Contact.php" id="a2">Contact</a><br><br>
                <a href="Safety.php" id="a2">Safety</a><br>
            </div>
            <div class="socialmedia">
                <a href="https://facebook.com/ChatHub" target="_blank">
                    <img src="facebook.png" alt="not found" loading="lazy" id="social">
                </a>
                <a href="https://instagram.com/ChatHub" target="_blank">
                    <img src="instagram.png" alt="not found" loading="lazy" id="social">
                </a>
                <a href="https://tiktok.com/ChatHub" target="_blank">
                    <img src="tiktok.png" alt="not found" loading="lazy" id="social">
                </a>
                <a href="https://twitter.com/ChatHub" target="_blank">
                    <img src="twitter.png" alt="not found" loading="lazy" id="social">
                </a>
            </div>
        </div>
        <p class="pfooter">Copyright &copy; 2024 ChatHub.com</p>
    </footer>
</body>

</html>