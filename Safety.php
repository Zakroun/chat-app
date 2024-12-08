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
    <title>safety.ma</title>
    <link rel="webesite icon" href="chatlogo.png">
    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>
    <style>
        .parFAQ {
            position: absolute;
            margin-top: 60px;
        }

        .footer2 {
            width: 98%;
            margin-top: 1330px;
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
        <h1 style="text-align:center">SAFETY</h1>
        <hr>
        General Safety Measures and Parental Controls <br><br>

        <p>Last updated: May 31, 2024</p><br><br>

        Chathub™ is a website for users who are at least eighteen (18) years of age, For the safety of our users, please do not use this site if you are under this age for any reason whatsoever.<br><br>

        To ensure the safety and security of our users, we have implemented the following safety measures. Please take a moment to review them.<br><br>

        Phishing<br><br>

        Be cautious of phishing scams. Do not click on links or share your personal information with anyone. If you believe your account has been compromised, please contact us immediately at info@Chathub.us.<br><br>

        Passwords<br><br>

        Choose a strong password that is difficult to guess. Avoid using easily guessable passwords such as "1234". Use a combination of letters, numbers, and symbols to create a secure password.<br><br>

        Private Messaging<br><br>

        Be wary of private messages from strangers asking for personal information or money. If you believe your profile has been compromised, please contact us immediately at info@Chathub.us.<br><br>

        Meeting and Dating People<br><br>

        Do not meet anyone in person who you have met online from Chathub. Always alert your parents before making decisions about meeting people from the internet, and be sure to meet in a public setting. Do not let yourself be lured by promises of modeling contracts, money, or gifts.<br><br>

        Use a nickname online that does not include your real name and is not suggestive.<br><br>

        Parents and Guardians<br><br>

        It is the responsibility of parents and guardians to ensure that children under the age of eighteen (18) do not have access to Chathub. Please use parental control software to block adult websites and keep your children safe. It is important to talk to your children about the dangers <br><br>of giving out personal information online and to monitor their online activity. Place computers in a common area rather than a bedroom to ensure that your children are not engaging in inappropriate behaviour online.<br><br>

        For Windows users, parental controls are available in the Control Panel under "User Accounts and Safety". For Mac users, parental controls are available in the System Preferences under "Accounts".<br><br>

        Keeping Kids Safe Online<br><br>

        We aim for our chat rooms to be a safe space for open dialogue. However, as our services are intended for those over eighteen (18), we cannot verify user ages due to the anonymous nature of our platform.<br><br>

        As a parent, you play the most critical role in keeping children safe online. We encourage parents to have ongoing conversations with kids about internet safety, including topics like:<br><br>

        - Never share personal information with strangers<br><br>

        - Using caution before clicking unknown links or downloads<br><br>

        - Being wary of online contacts attempting to build a relationship and meet in person<br><br>

        - Monitoring time spent on chat platforms and devices<br><br>

        Though we cannot actively restrict underage access, there are steps you can take at home:<br><br>

        - Place computers/devices in common rooms rather than bedrooms<br><br>

        - Set screen time limits using parental controls<br><br>

        - Periodically check in on what sites or platforms your children are accessing<br><br>

        Please be sure to research best practices for parental supervision online. We are always open to additional suggestions from parents that can help promote minor safety across our user community.<br><br>

        Thank you for taking the time to review our safety measures. If you have any questions or concerns, please feel free to contact us at info@Chathub.us.<br><br>
    </div>
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