<?php
session_start();

require('connexion.php');
if (isset($_POST["start"])) {
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $sql = "SELECT * FROM `user` WHERE `email` = '$email'";
    $stm = $con->query($sql);
    $t = $stm->fetch();
    if ($t && password_verify($pass, $t['password'])) {
        $_SESSION['us'] = 'done';
        echo "<script>window.location.href='index.php?email=".$email."'</script>";
        exit();
    } else {
        echo "<script> alert('This person does not exist')</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login.ma</title>
    <link rel="webesite icon" href="chatlogo.png">
    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>
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
    <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
        <div class="parent">
            <div class="child1">
                <img src="imageleft.png" alt="..........." class="img1">
            </div>
            <div class="child2">
                <h2>Chat With Registration</h2>
                <input type="text" name="email" id="emaill" class="input" placeholder="Your email"><br><br>
                <input type="password" name="password" id="password" class="input" placeholder="Your password"><br><br>
                <input type="submit" value="Start chat Now" name="start" id="start">
                <input type="button" value="Register" id="Register" onclick="window.location.href='Register.php'"><br><br>
                <a href="password.php" id="forgot">forgot your password</a>
            </div>
        </div>
    </form>
    <p class="p">
        <span class="pSpan">Chat Hub</span> is a free chat room website where you can have live chat with single women and men,
        you can discuss <br> with random strangers from USA, Canada, United Kingdom, Australia and people from all over
        the world, at the<br> same time in multiple chatrooms and discussion groups, any time you can start a private
        conversation to meet<br> girls and boys living nearby in your area.
    </p>

    <!--footer -->
    <footer class="footer1">
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