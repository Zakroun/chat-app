<?php
// session_start();
require('connexion.php');
if (isset($_POST['start'])) {
    $email2 = $_GET['email'];
    echo "<script>window.location.href='newpass.php?email=" . $email2 . "'</script>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>verification.ma</title>
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
            <h2>enter the verification code</h2>
            <form method="post">
                <div class="son">
                    <input type="text" id="input1" class="inputver">
                    <input type="text" id="input2" class="inputver">
                    <input type="text" id="input3" class="inputver">
                    <input type="text" id="input4" class="inputver">
                    <input type="text" id="input5" class="inputver">
                    <input type="text" id="input6" class="inputver">
                </div>
                <script>
                    var input1 = document.querySelector("#input1");
                    var input2 = document.querySelector("#input2");
                    var input3 = document.querySelector("#input3");
                    var input4 = document.querySelector("#input4");
                    var input5 = document.querySelector("#input5");
                    var input6 = document.querySelector("#input6");
                    window.onload = function() {
                        input1.focus();
                    }
                    input1.oninput = function() {
                        if (input1.value.length >= 1) {
                            input1.style.background = "#598ff390";
                            input2.focus();
                        }
                    }
                    input2.oninput = function() {
                        if (input2.value.length >= 1) {
                            input2.style.background = "#598ff390";
                            input3.focus();
                        }
                    }
                    input3.oninput = function() {
                        if (input3.value.length >= 1) {
                            input3.style.background = "#598ff390";
                            input4.focus();
                        }
                    }
                    input4.oninput = function() {
                        if (input4.value.length >= 1) {
                            input4.style.background = "#598ff390";
                            input5.focus();
                        }
                    }
                    input5.oninput = function() {
                        if (input5.value.length >= 1) {
                            input5.style.background = "#598ff390";
                            input6.focus();
                        }
                    }
                    input6.oninput = function() {
                        if (input6.value.length >= 1) {
                            input6.style.background = "#598ff390";
                        }
                    }
                </script>
                <input type="submit" value="Start Now" id="start" name="start">
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