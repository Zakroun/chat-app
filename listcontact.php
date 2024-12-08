<?php
require('connexion.php');
$iduser = trim($_GET['iduser']);
$sql = "SELECT `username`,`srcimg` FROM `user` WHERE `id` = '$iduser'";
$stm = $con->query($sql);
$tabluser = $stm->fetch();
$username = $tabluser[0];
$srcimg = $tabluser[1];

$sql2 = "SELECT `username_friend`,`phone_number` FROM `friends` WHERE `iduser` = '$iduser'";
$stm2 = $con->query($sql2);
$tabl = $stm2->fetchAll();

if (isset($_POST['delete'])) {
    echo '<script>
    window.location.href = "supfriend.php?iduser= ' . $iduser . '"
</script>';
}
if (isset($_POST['usercompte'])) {
    echo '<script>
    window.location.href = "usercompte.php?username= ' . $username . '"
</script>';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>listcontact.ma</title>
    <link rel="webesite icon" href="chatlogo.png">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
    <script src="script.js"></script>
    <style>
        .footer2 {
            width: 98%;
            margin-top: 630px;
            position: absolute;
        }

        .username {
            color: white;
            margin-top: 25px;
            font-size: 18.5px;
            margin-left: -228px;
        }

        .imguser {
            margin-top: -43px;
            margin-left: -50px;
            width: 28px;
            height: 27px;
            border-radius: 50%;
            border: .5px solid black;
            background-color: gainsboro;
            z-index: 1;
        }

        #user {
            object-fit: cover;
            border-radius: 50%;
            width: 27.8px;
            height: 26.8px;
        }

        .childNN2 {
            background-color: white;
            margin-left: 15px;
            width: 99%;
            height: 480px;
            border: 1.5px solid rgb(218, 218, 218);
            border-radius: 8px;
            box-shadow: 0px 0px 5px 5px rgba(163, 195, 255, 0.427);
        }

        .cantactinform {
            width: 98%;
            height: 40px;
            margin-left: 1%;
            margin-top: 1%;
            border-radius: 10px;
            background-color: rgb(124, 170, 255);
        }

        #friendimage {
            margin-left: 30px;
            margin-top: 7px;
            vertical-align: middle;
            object-fit: cover;
            border-radius: 50%;
            width: 27.8px;
            height: 26.8px;
        }

        .userfriend {
            width: 130px;
            margin-left: 250px;
            font-family: sans-serif;
            font-size: 25px;
            color: white;
        }

        .telefriend {
            margin-left: 250px;
            font-family: sans-serif;
            font-size: 20px;
            color: white;
        }

        #delete {
            margin-left: 360px;
            border-radius: 8px;
            background-color: red;
            border: 1px solid red;
            width: 80px;
            height: 30px;
            color: white;
            cursor: pointer;
        }
        #usercompte {
            border: none;
            background-color: transparent;
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
        <form method="post">
            <button type="submit" id="usercompte" name="usercompte">
                <div class="span2">
                    <p class="username">
                        <?php echo htmlspecialchars($username); ?>
                    </p>
                    <div class="imguser"><img src="img/<?php echo $srcimg; ?>" alt="" id="user"></div>
                </div>
            </button>
        </form>
    </header>
    <div class="parent">
        <div class="childNN2">
            <?php
            foreach ($tabl as $row) {
                $usernamefriend = $row[0];
                $sql1 = "SELECT `srcimg` FROM `user` WHERE `username`='$usernamefriend'";
                $stm2 = $con->query($sql1);
                $table2 = $stm2->fetch();
                $srcimg = $table2[0];
                echo '<div class="cantactinform">
                <form method="post">
                    <img src="img/' . htmlspecialchars($srcimg) . '" alt="" id="friendimage">
                    <span class="userfriend">' . htmlspecialchars($row[0]) . '</span>
                    <span class="telefriend">' . htmlspecialchars($row[1]) . '</span>
                    <input type="hidden" name="usernamefriend" value="' . htmlspecialchars($row['username_friend']) . '">
                    <input type="hidden" name="iduser" value="' . htmlspecialchars($iduser) . '">
                    <input type="submit" id="delete" value="delete" name="delete">
                </form>
            </div>';
            }
            ?>
        </div>
    </div>
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