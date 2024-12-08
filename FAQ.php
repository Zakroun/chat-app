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
    <title>FaQ.ma</title>
    <link rel="webesite icon" href="chatlogo.png">
    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>
    <style>
        .parFAQ{
            position: absolute;
            margin-top: 70px;
        }
        .footer2 {
            width: 98%;
            margin-top: 750px;
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
    <div class="parFAQ">
        <h1 >FAQ</h1>
        <hr>
        <h1>How Can I use Chathub?</h1>
        <p>
            Visit the Chathub homepage, once you fill-in the form you click on “Start Chat” button. There is also an option of becoming a VIP member. Click this link to subscribe as a VIP member https://www.Chathub.us/user/signup_form
        </p>

        <h1>Sending a message to an online user, how is it done?</h1>
        <p>After you login to Chathub chat, on your left you will see the list of all online users. Select the one you want to chat with by clicking his/her name, where the chat box will open for you to write a message in it, the finish by clicking on the “send” button to send it.
        </p>

        <h1>How safe is Chathub?</h1>
        <p>It is important for you to visit the safety tips page before doing anything after joining in Chathub. However, Chathub Development Team and Administration have gone to lengths of ensuring safety by having the capability to block some countries and IPs with a bad repute.
        </p>

        <h1>If I have a problem, how can I contact your back office support?</h1>
        <p>You can certainly go to our contact page and contact us at any time when you have an issue. We are here to help you resolve your problem and to hear you. Here is the direct link to our contact page https://www.Chathub.us/user/contactus
        </p>

        <h1>What kind of individuals are here in Chathub?</h1>
        <p>You will find and encounter both men and women from the whole world who are aiming to create relations and meet new people or a special someone.
        </p>
    </div>
    <!--footer -->
    <footer class="footer2">
        <div class="divfooter2">
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