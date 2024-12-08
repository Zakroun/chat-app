<?php
// session_start();
// if($_SESSION['us']!='done'){
//     header('location:login.php');
// }
require('connexion.php');
if (isset($_POST['start'])) {
    $code1 = $_POST['code1'];
    $code2 = $_POST['code2'];
    $code3 = $_POST['code3'];
    $code4 = $_POST['code4'];
    $code5 = $_POST['code5'];
    $code6 = $_POST['code6'];
    $codecomplete = $code1 . $code2 . $code3 . $code4 . $code5 . $code6;
    $verification_code = isset($_GET['verification_code']) ? $_GET['verification_code'] : '';
    if($verification_code && $codecomplete == $verification_code){
        header("location:login.php");
    }else{
        echo "<script>alert('code verification is incorrect');</script>";
    }
}
// }
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

        .childNNN2 {
            background-color: white;
            margin-top: 0px;
            margin-left: 450px;
            width: 58%;
            height: 300px;
            border: 1.5px solid rgb(218, 218, 218);
            border-radius: 8px;
            box-shadow: 0px 0px 5px 5px rgba(163, 195, 255, 0.427);
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
        <form method="post">
            <div class="childNNN2">
                <br><br>
                <h2>enter the verification code</h2>
                <div class="son">
                    <input type="text" id="input1" name="code1" class="inputver">
                    <input type="text" id="input2" name="code2" class="inputver">
                    <input type="text" id="input3" name="code3" class="inputver">
                    <input type="text" id="input4" name="code4" class="inputver">
                    <input type="text" id="input5" name="code5" class="inputver">
                    <input type="text" id="input6" name="code6" class="inputver">
                </div>
                <script>
                    var input1 = document.querySelector("#input1");
                    var input2 = document.querySelector("#input2");
                    var input3 = document.querySelector("#input3");
                    var input4 = document.querySelector("#input4");
                    var input5 = document.querySelector("#input5");
                    var input6 = document.querySelector("#input6");
                    var input7 = document.querySelector("#start");
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
                            input7.focus();
                        }
                    }
                </script>
                <input type="submit" value="Start Now" id="start" name="start">
            </div>
        </form>
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