<?php
session_start();
if($_SESSION['us']!='done'){
    header('location:login.php');
}

require('connexion.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>contact.ma</title>
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
            <h2>enter your message</h2>
            <input type="text" name="email" id="emaill" class="input" placeholder="Your email"><br><br>
            <textarea name="message" id="message" class="input" placeholder="Enter Your Message"></textarea>
            <input type="button" value="Sent Message" id="start" onclick="window.location.href='newpass.php'">
        </div>
    </div>

    <p class="p">
        <span class="pSpan">Chat Hub</span> is a free chat room website where you can have live chat with single women and men,
        you can discuss <br> with random strangers from USA, Canada, United Kingdom, Australia and people from all over
        the world, at the<br> same time in multiple homepage and discussion groups, any time you can start a private
        conversation to meet<br> girls and boys living nearby in your area.
    </p>

    <!--footer -->
    <footer class="footer2">
        <div class="divfooter">
            <img src="chatlogo(2).png" alt="......." class="img2">
            <div class="a1">
                <a href="index.php" id="a2">CHAT ROOMS</a><br><br>
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