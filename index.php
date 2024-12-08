<?php
session_start();

if ($_SESSION['us'] != 'done') {
    header('location:login.php');
}
require('connexion.php');
//get username:
$email = isset($_GET['email']) ? $_GET['email'] : '';
if ($email) {
    // Prepare the SQL statement to prevent SQL injection
    $sql = "SELECT `id` FROM `user` WHERE `email` = :email";
    $stm = $con->prepare($sql);
    $stm->bindParam(':email', $email);
    $stm->execute();

    // Fetch the username
    $t = $stm->fetch();
    if ($t) {
        $_SESSION['id'] = $t['id'];
    } else {
        $_SESSION['id'] = 'User not found';
    }
}
$id = isset($_GET['id']) ? $_GET['id'] : (isset($_SESSION['id']) ? $_SESSION['id'] : 'User not found');
$sql = "SELECT `username` FROM `user` WHERE `id` = '$id'";
$stm = $con->query($sql);
$tabluser = $stm->fetch();
$username = $tabluser[0];

// Store the username in the session if it's provided in the URL
if (isset($_GET['usrname'])) {
    $_SESSION['username'] = $_GET['usrname'];
}
$sql2 = "SELECT `id` FROM `user` WHERE `email` = '$email'";
$stm = $con->query($sql2);
$tab = $stm->fetch();
$iduser2 = isset($tab[0]) ? $tab[0] : '';

//send message to database:
if (isset($_POST['send'])) {
    $message = $_POST['message'];
    $receiver_username = isset($_POST['nomfriend']) ? $_POST['nomfriend'] : ''; // Changed to match form input name
    if ($message !== '' && $receiver_username !== '') {
        $datee = (new DateTime())->format('Y-m-d H:i:s');
        try {
            // Assuming $username is defined somewhere in your session or earlier in the script
            if (isset($username)) {
                // Get the id of the sender based on the current username
                $sql_sender = "SELECT `id` FROM `user` WHERE `username` = :username";
                $stmt_sender = $con->prepare($sql_sender);
                $stmt_sender->execute(['username' => $username]);
                $sender = $stmt_sender->fetch();
                $sender_id = $sender ? $sender['id'] : null;

                // Get the id of the recipient based on the friend's username
                $sql_receiver = "SELECT `idfriend` FROM `friends` WHERE `username_friend` = :friend_username";
                $stmt_receiver = $con->prepare($sql_receiver);
                $stmt_receiver->execute(['friend_username' => $receiver_username]);
                $receiver = $stmt_receiver->fetch();
                $receiver_id = $receiver ? $receiver['idfriend'] : null;

                if ($sender_id && $receiver_id) {
                    $sql_insert1 = "INSERT INTO `messages` (`idsender`, `idreceiver`, `message`, `datee`)
                                VALUES (:sender_id, :receiver_id, :messagee, :datee)";

                    $stmt_insert1 = $con->prepare($sql_insert1);
                    $stmt_insert1->execute([
                        'sender_id' => $sender_id,
                        'receiver_id' => $receiver_id,
                        'messagee' => $message,
                        'datee' => $datee
                    ]);
                    header("Location: " . $_SERVER['REQUEST_URI']);
                    exit();
                } else {
                    echo "Error: Sender or receiver ID not found.";
                }
            } else {
                echo "Error: Sender username is not defined.";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
        echo "Error: Message or recipient username is empty.";
    }
}

$selected_recipient = isset($_POST['recipient_username']) ? $_POST['recipient_username'] : '';
$messages = [];
$answers = [];
$recipient_phone = '';
$recipient_image = '';

if ($selected_recipient) {
    // Fetch the sender ID based on the current username
    $sql_sender = "SELECT `id` FROM `user` WHERE `username` = :username";
    $stmt_sender = $con->prepare($sql_sender);
    $stmt_sender->execute(['username' => $username]);
    $sender = $stmt_sender->fetch();
    $sender_id = $sender ? $sender['id'] : null;

    // Fetch the recipient ID (idfriend) based on the selected recipient username from the friends table
    $sql_receiver = "SELECT `idfriend` FROM `friends` WHERE `username_friend` = :selected_recipient";
    $stmt_receiver = $con->prepare($sql_receiver);
    $stmt_receiver->execute(['selected_recipient' => $selected_recipient]);
    $receiver = $stmt_receiver->fetch();
    $receiver_id = $receiver ? $receiver['idfriend'] : null;

    if ($sender_id && $receiver_id) {
        // Fetch messages between the sender and the recipient
        $sql_messages = "SELECT 
                    m.id, 
                    m.message, 
                    m.idsender, 
                    m.datee, 
                    u.username AS sender_username, 
                    u.srcimg AS sender_srcimage 
                FROM `messages` m
                JOIN `user` u ON m.idsender = u.id
                WHERE 
                    (m.idsender = :sender_id AND m.idreceiver = :receiver_id) 
                    OR 
                    (m.idsender = :receiver_id AND m.idreceiver = :sender_id) 
                ORDER BY m.datee ASC";
        $stmt_messages = $con->prepare($sql_messages);
        $stmt_messages->execute([
            'sender_id' => $sender_id,
            'receiver_id' => $receiver_id
        ]);
        $messages = $stmt_messages->fetchAll();


        // Fetch the recipient's phone number
        $sql_phone = "SELECT `phone_number` FROM `friends` WHERE `username_friend` = :selected_recipient";
        $stmt_phone = $con->prepare($sql_phone);
        $stmt_phone->execute(['selected_recipient' => $selected_recipient]);
        $recipient = $stmt_phone->fetch();
        $recipient_phone = $recipient ? $recipient['phone_number'] : 'Phone not found';

        // Fetch the recipient's image
        $sql_image = "SELECT `srcimg` FROM `user` WHERE `username` = :selected_recipient";
        $stmt_image = $con->prepare($sql_image);
        $stmt_image->execute(['selected_recipient' => $selected_recipient]);
        $recipient_data = $stmt_image->fetch();
        $recipient_image = $recipient_data ? $recipient_data['srcimg'] : 'Image not found';
    }
}

if (isset($_POST['usercompte'])) {
    echo '<script>
    window.location.href = "usercompte.php?username= ' . $username . '"
</script>';
}
$sql = "SELECT `id` FROM `user` WHERE `email` = '$email'";
$stm = $con->query($sql);
$tab = $stm->fetch();
$iduser = isset($tab[0]) ? $tab[0] : '';
//send $username to add friendpage:
if (isset($_POST["ajouter"])) {
    echo '<script>
    window.location.href = "addfriends.php?iduser= ' . $iduser . '"
</script>';
}
if (isset($_POST["contact"])) {
    echo '<script>
    window.location.href = "listcontact.php?iduser= ' . $iduser . '"
</script>';
}
//select srcimage from database :
$sqll = "SELECT `srcimg` FROM `user` WHERE `id` = '$iduser'";
$stmm = $con->query($sqll);
$tabl = $stmm->fetch();
$imagesrc = isset($tabl[0]) ? $tabl[0] : '';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>chathub.ma</title>
    <link rel="webesite icon" href="chatlogo.png">
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        .footer2 {
            width: 98%;
            margin-top: 620px;
            position: absolute;
        }

        .span22 {
            font-family: sans-serif;
            font-size: 20px;
            margin-top: -12px;
            margin-left: -40px;
            cursor: pointer;
        }

        .username {
            color: white;
            margin-top: 25px;
            font-size: 18.5px;
            margin-left: -250px;
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

        .barcantact {
            width: 35%;
            height: 620px;
            margin-left: -8px;
            background-color: rgb(89, 143, 243);
        }

        .parentchat {
            border-top: 1.5px solid white;
            position: absolute;
            margin-top: 42px;
            display: flex;
            width: 99.3%;
        }

        .divmessage {
            margin-left: 3px;
            width: 95%;
            background-image: url('whatsapp.jpg');
            /* background-color: #F3F3F3; */
        }

        .search {
            background-color: transparent;
            margin-left: 6px;
            width: 97%;
        }

        #search {
            border-radius: 5px;
            margin-top: 4px;
            border: transparent;
            width: 99%;
            height: 30px;
            outline: none;
            border: 1px solid black;
            background-color: white;
        }

        #searchimg {
            cursor: pointer;
            position: absolute;
            width: 20px;
            margin-left: 340px;
            margin-top: -26.5px;
        }

        .cantact {
            overflow-y: scroll;
            margin-top: 8px;
            background-color: rgb(89, 143, 243);
            height: 536px;
        }

        .friendcantact {
            margin-top: 5px;
            border: 1px #3A4750 solid;
            cursor: pointer;
            margin-left: 2.8px;
            border-radius: 10px;
            width: 98%;
            background-color: #3A4750;
        }

        #imgfriend {
            border-radius: 50%;
            width: 35px;
            height: 35px;
            vertical-align: middle;
            margin-left: -100px;
            margin-top: 5px;
        }

        .userfriend {
            color: white;
            margin-top: 10px;
            position: relative;
            margin-left: 10px;
            font-size: 19px;
            font-family: sans-serif;
        }

        .telefriend {
            color: white;
            font-size: 14px;
            font-family: sans-serif;
            margin-left: -90px;
        }

        .parentofParaAjou {
            background-color: rgb(89, 143, 243);
            display: flex;
            margin-right: 0px;
            height: 40px;
        }

        .listcontact {
            margin-top: -1.9%;
            margin-left: 4px;
            width: 48%;
            height: 42px;
            background-color: #3A4750;
            border: 1px solid #3A4750;
            border-radius: 4px;
            cursor: pointer;
            padding: 9px;
        }

        .ajouter {
            margin-top: -1.9%;
            margin-left: 4px;
            width: 48%;
            height: 42px;
            background-color: #3A4750;
            backdrop-filter: blur(4px);
            border: 1px solid #3A4750;
            border-radius: 4px;
            cursor: pointer;
            padding: 9px;
        }

        #spanpara {
            font-size: 18px;
            font-family: sans-serif;
            color: white;
        }

        #imgparam {
            margin-top: -5px;
            vertical-align: middle;
            width: 18px;
            margin-left: -10px;
        }

        #imgparam2 {
            margin-top: -5px;
            vertical-align: middle;
            width: 18px;
            margin-left: 0px;
        }

        #message {
            margin-left: 8px;
            border: .5px solid gray;
            outline: none;
            border-radius: 5px;
            width: 90%;
            height: 30px;
        }

        #file {
            display: none;
        }

        #send {
            cursor: pointer;
            color: white;
            background-color: rgb(89, 143, 243);
            border: 1px solid rgb(89, 143, 243);
            border-radius: 5px;
            width: 75px;
            height: 34px;
        }

        .chatPrin {
            overflow-y: scroll;
            background-color: transparent;
            width: 100%;
            height: 523px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .message {
            width: fit-content;
            max-width: 350px;
            background-color: rgb(89, 143, 243);
            border-radius: 10px;
            margin-left: auto;
            margin-right: 10px;
            padding: 7px;
            color: white;
            margin-top: 5px;
            word-wrap: break-word;
        }

        .textmessage {
            background-color: transparent;
            margin-left: 0px;
            /* margin-left: 30px; */
        }

        .datetime {
            margin-top: 3px;
            margin-bottom: 0px;
            height: 10px;
            font-size: 13px;
            color: black;
            text-align: end;
        }

        .userinform {
            display: block;
            width: 100%;
            height: 50px;
            background-color: #3A4750;
            display: flex;
            justify-content: space-between;
        }

        #imgfriend2 {
            border-radius: 50%;
            width: 35px;
            height: 35px;
            margin-top: 8px;
            margin-right: 35px;
            margin-left: 10px;
        }

        #imgfriend22 {
            border-radius: 50%;
            width: 25px;
            height: 25px;
            margin-top: 2px;
            margin-left: 2px;
            margin-right: 8px;
            margin-bottom: 4px;
            vertical-align: middle;
        }

        .nomfriend {
            color: white;
            font-family: sans-serif;
            font-size: 27px;
            width: 280px;
            margin-top: 0px;
            margin-left: 160px;
            background-color: transparent;
            border: transparent;
            outline: none;
        }

        .telfriend2 {
            color: white;
            font-family: sans-serif;
            font-size: 25px;
            margin-top: 10px;
            margin-right: 7px;
        }

        #usercompte {
            border: none;
            background-color: transparent;
        }

        ::-webkit-scrollbar {
            width: 10px;
        }

        ::-webkit-scrollbar-track {
            box-shadow:  0 0 0px white;
            border-radius: 10px;
            height: 10px;
        }

        ::-webkit-scrollbar-thumb {
            background:  #3A4750;
            border-radius: 4px;
        }
    </style>

    <script>
        $(document).ready(function() {
            $("#search").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $(".friend").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>
</head>

<body>
    <!--header -->
    <header>
        <div class="span1">
            <p>Free chat rooms</p>
        </div>
        <div class="span22">
            <h3><img src="chat.png" alt="..." id="imgheader">Chat Hub</h3>
        </div>
        <form method="post">
            <button type="submit" id="usercompte" name="usercompte">
                <div class="span2">
                    <p class="username">
                        <?php echo htmlspecialchars($username); ?>
                    </p>
                    <div class="imguser"><img src="img/<?php echo $imagesrc; ?>" alt="." id="user"></div>
                </div>
            </button>
        </form>
    </header>
    <div class="parentchat">
        <div class="barcantact">
            <div class="search">
                <input type="text" name="search" id="search" placeholder="Search or start a new chat..." oninput="search()">
                <img src="search.png" alt="" id="searchimg">
            </div>
            <div class="cantact">
                <?php
                $sql = "SELECT `username_friend`, `phone_number` FROM `friends` WHERE `iduser`='$iduser2' ";
                $stm = $con->query($sql);
                $table = $stm->fetchAll();
                foreach ($table as $row) {
                    $usernamefriend = $row['username_friend'];
                    $sql1 = "SELECT `srcimg` FROM `user` WHERE `username`='$usernamefriend'";
                    $stm2 = $con->query($sql1);
                    $table2 = $stm2->fetch();
                    $srcimg = $table2[0];
                    echo '<div class="friend">
                        <form method="post" style="display: flex; align-items: center; width: 100%;">
                            <button type="submit" name="select_recipient" class="friendcantact" value="' . htmlspecialchars($row['username_friend']) . '">
                                <input type="hidden" name="recipient_username" value="' . htmlspecialchars($row['username_friend']) . '">
                                <img src="img/' . htmlspecialchars($srcimg) . '" alt=",," id="imgfriend">
                                <span class="userfriend">' . htmlspecialchars($row['username_friend']) . '</span><br>
                                <span class="telefriend">' . htmlspecialchars($row['phone_number']) . '</span>
                            </button>
                        </form>
                    </div>';
                }
                ?>
            </div>
            <form method="post">
                <div class="parentofParaAjou">
                    <button type="submit" name="contact" class="listcontact">
                        <img src="contact.png" id="imgparam"></img>
                        <span id="spanpara">list of cantacts</span>
                    </button>
                    <button type="submit" name="ajouter" class="ajouter">
                        <img src="add.png" id="imgparam2"></img>
                        <span id="spanpara">add friends</span>
                    </button>
                </div>
            </form>
        </div>
        <div class="divmessage">
            <form method="post">
                <div class="userinform">
                    <img src="img/<?php echo htmlspecialchars($recipient_image); ?>" alt="..." id="imgfriend2">
                    <input type="text" name="nomfriend" class="nomfriend" id="nomfriend" readonly value="<?php echo htmlspecialchars($selected_recipient); ?>">
                    <span class="telfriend2" id="telfriend2"><?php echo htmlspecialchars($recipient_phone); ?></span>
                </div>
                <div class="chatPrin">
                    <?php
                    if (!empty($messages)) {
                        foreach ($messages as $message) {
                            $messageClass = ($message['idsender'] == $sender_id) ? 'message' : 'message received';
                            $messageid = $message['id'];
                            $senderUsername = htmlspecialchars($message['sender_username']);
                            $senderSrcImage = htmlspecialchars($message['sender_srcimage']);
                            $messageDate = date('H:i', strtotime($message['datee']));
                            echo "<div class='$messageClass' data-id='" . htmlspecialchars($messageid) . "'>";
                            echo "<img src='img/" . $senderSrcImage . "' alt='...' id='imgfriend22'>";
                            //"<strong style='color:black;'>$senderUsername </strong><br>"; Display the sender's username and image
                            echo "<span class='textmessage'>" . htmlspecialchars($message['message']) . "</span><br>";
                            echo "<h6 class='datetime'>" . $messageDate . "</h6>"; // Display the date of the message
                            echo "</div>";
                        }
                    }
                    ?>
                </div>
                <div class="inputmessage">
                    <input type="text" name="message" id="message" value="" placeholder="Type your message ...">
                    <!-- <input type="file" name="file" id="file" accept="image/*,video/*"> -->
                    <input type="submit" name="send" id="send" value="send">
                </div>
            </form>
        </div>
</body>

</html>