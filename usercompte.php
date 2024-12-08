<?php
require('connexion.php');
$bio = "";
$srcimg = "images/default.png";
$username = trim($_GET['username']);

$updateSuccessful = false; // Flag to track update success

if (isset($_POST['update'])) {
    $biousr = $_POST['bio'];

    // Check if file was uploaded successfully
    if ($_FILES["image"]["error"] === 4) {
        // No image uploaded
    } else {
        $fileName = $_FILES["image"]["name"];
        $fileSize = $_FILES["image"]["size"];
        $tmpName = $_FILES["image"]["tmp_name"];

        $validImageExtensions = ['jpg', 'jpeg', 'png'];
        $imageExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        if (empty($imageExtension)) {
            // Could not extract file extension
        } elseif (!in_array($imageExtension, $validImageExtensions)) {
            // Invalid Image Extension
        } else if ($fileSize > 1000000) {
            // Image Size Is Too Large
        } else {
            // Generate a unique name for the image
            $newImageName = uniqid() . '.' . $imageExtension;

            // Move the uploaded file to a permanent location
            if (move_uploaded_file($tmpName, "img/$newImageName")) {
                // Update the database with the new bio and image name
                $sql = "UPDATE `user` SET `bio` = '$biousr', `srcimg` = '$newImageName' WHERE `username` = '$username'";
                $con->exec($sql);

                // Set update successful flag to true
                $updateSuccessful = true;
            }
        }
    }
}

// Check if update was successful and display appropriate message
if ($updateSuccessful) {
    echo "<script>alert('Update has been successful');</script>";
}



$sql = "SELECT `bio`,`srcimg` FROM `user` WHERE `username` = '$username'";
$STM = $con->query($sql);
$tab = $STM->fetch();
$bio = $tab[0];
$srcimg = $tab[1];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>usercompte.ma</title>
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
            margin-top: 650px;
            position: absolute;
        }

        .username {
            color: white;
            margin-top: 25px;
            font-size: 18.5px;
            margin-left: -195px;
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
            height: 595px;
            border: 1.5px solid rgb(218, 218, 218);
            border-radius: 8px;
            box-shadow: 0px 0px 5px 5px rgba(163, 195, 255, 0.427);
        }

        .userinfo {
            margin-top: 10px;
            margin-left: 30px;
        }

        #key {
            font-size: 20px;
            font-family: sans-serif;
            font-weight: bolder;
        }

        #value {
            font-size: 18px;
            font-family: sans-serif;
        }

        #keybio {
            margin-left: 30px;
            font-size: 20px;
            font-family: sans-serif;
            font-weight: bolder;
        }

        #bio {
            border: transparent;
            font-family: sans-serif;
            font-size: 18px;
            width: 400px;
            height: 30px;
            outline: none;
            border-radius: 10px;
        }
        #bio:focus {
            border: 0.3px solid black;
        }
        .wrapper {
            background-color: #fff;
            border-radius: 7px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .image img {
            width: 200px;
            height: 200px;
            object-fit: cover;
            border-radius: 50%;
            cursor: pointer;
        }

        #file-path {
            display: none;
        }

        .wrapper h2 {
            margin-bottom: 20px;
        }

        .image {
            position: relative;
        }

        .image label {
            position: absolute;
            top: 10px;
            right: 13px;
            color: #fff;
            background-color: #1b74e4;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            font-size: 20px;
            cursor: pointer;
            opacity: 0;
            pointer-events: none;
            transition: 0.2s;
        }

        .image:hover label {
            opacity: 1;
            pointer-events: all;
        }

        .update {
            background-color: #1b74e4;
            border: #1b74e4 1px solid;
            border-radius: 8px;
            width: 80px;
            height: 35px;
            color: white;
            margin-left: 120px;
            cursor: pointer;
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
        <div class="span2">
            <p class="username">
                <?php echo htmlspecialchars($username); ?>
            </p>
            <div class="imguser"><img src="img/<?php echo $srcimg; ?>" alt="" id="user"></div>
        </div>
    </header>
    <div class="parent">
        <div class="childNN2">
            <form method="post"  enctype="multipart/form-data">
                <div class="wrapper">
                    <h2>Profile Photo</h2>
                    <div class="image">
                        <img src="img/<?php echo $srcimg; ?>">
                        <label for="file-path">
                            <span class="material-symbols-rounded">photo_camera</span>
                        </label>
                        <input type="file" name="image" accept="image/jpeg, image/png, image/jpg" id="file-path" class="user-file">
                    </div>
                </div>
                <script>
                    const profilePic = document.querySelector(".image img");
                    const userFile = document.querySelector(".user-file");

                    userFile.onchange = function() {
                        profilePic.src = URL.createObjectURL(userFile.files[0]);
                    }
                </script>
                <div class="userinfo">
                    <?php
                    $sql = "SELECT `username`, `email`, `country`, `sexe`, `create_at` FROM `user` WHERE `username` = '$username'";
                    $stm = $con->query($sql);
                    $tab = $stm->fetchAll(PDO::FETCH_ASSOC);;
                    foreach ($tab as $row) {
                        foreach ($row as $key => $value) {
                            echo "<span id='key'>" . htmlspecialchars($key) . ":</span>      <span id='value'>" . htmlspecialchars($value) . "</span><br><br>";
                        }
                    }
                    ?></div>
                <span id='keybio'>Bio:</span>
                <input type="text" name="bio" id="bio" value="<?php echo isset($bio) ? $bio : ''; ?>"><br><br>
                <input type="submit" value="update" name="update" class="update">
            </form>
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