<?php
require('connexion.php');
if (isset($_POST['add'])) {
    $username_friend = $_POST['username'];
    $tel = $_POST['tel'];
    $datee = (new DateTime())->format('Y-m-d H:i:s');
    $iduser = trim($_GET['iduser']);

    // Check if the friend's username exists in the user table
    $stmt_exist = $con->prepare("SELECT COUNT(*) FROM `user` WHERE `username` = ?");
    $stmt_exist->execute([$username_friend]);
    $user_exists = $stmt_exist->fetchColumn();

    if ($user_exists) {
        // Get the friend's ID
        $stmt = $con->prepare("SELECT id FROM `user` WHERE `username` = ?");
        $stmt->execute([$username_friend]);
        $tabll = $stmt->fetch();
        $idfriend = $tabll['id'];

        // If the user exists, proceed to add them as a friend
        $sql = "INSERT INTO `friends`(`idfriend`, `username_friend`, `phone_number`, `add_at`, `iduser`) VALUES (?, ?, ?, ?, ?)";
        $stmt = $con->prepare($sql);
        $stmt->execute([$idfriend, $username_friend, $tel, $datee, $iduser]);

        // Redirect to the homepage with the username parameter
        $sql2 = "SELECT `username` FROM `user` WHERE `id` = ?";
        $stmt2 = $con->prepare($sql2);
        $stmt2->execute([$iduser]);
        $username_row = $stmt2->fetch();
        $username = $username_row ? $username_row['username'] : '';
        header("Location: index.php?username=$username");
        exit();
    } else {
        // If the user doesn't exist, display an alert
        echo "<script>alert('User does not exist');</script>";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>addfrinds.ma</title>
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
    <!--header-->
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
            <h2>Add your new friend</h2>
            <form action="" method="post">
                <input type="text" name="username" id="username" class="input" placeholder="username of friend"><br><br>
                <input type="tel" name="tel" id="tel" class="input" placeholder="phone number of friend"><br><br>
                <input type="submit" name="add" value="Add" id="start">
            </form>
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