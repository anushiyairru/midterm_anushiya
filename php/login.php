<?php

if (isset($_POST['submit'])) {
    include 'dbconnect.php';
    $email = $_POST['email'];
    $pass = sha1($_POST['password']);
    $sqllogin = "SELECT * FROM tbl_usersreg WHERE user_email = '$email' AND user_password = '$pass'";
    $stmt = $conn->prepare($sqllogin);
    $stmt->execute();
    $number_of_rows = $stmt->fetchColumn();
    if ($number_of_rows > 0) {
        session_start();
        $_SESSION["sessionid"] = session_id();
        $_SESSION["email"] = $email;


        echo "<script>alert('Login Success');</script>";
        echo "<script>window.location.replace('index.php')</script>";
    } else {
        echo "<script>alert('Login Failed');</script>";
        echo "<script>window.location.replace('login.php')</script>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <script src="../scripts/menu.js" defer></script>
    <script src="../scripts/img.js" defer></script>
    <script src="../scripts/reg.js" defer></script>
    <script src="../scripts/login.js" defer></script>
    <link rel="stylesheet" href="../css/headr.css">


    <title>LOG IN</title>


</head>
<script>
    let cookie_consent = getCookie("user_cookie_consent");
    if (cookie_consent != "") {
        document.getElementById("cookieNotice").style.display = "none";
    } else {
        document.getElementById("cookieNotice").style.display = "block";
    }
</script>

<body onload="loadCookies()">
    <!--desktop mode navigation-->
    <div class="w3-bar w3-teal w3-hover-light-green w3-hover-text-pink" style="position: fixed">
        <a href="index.php" class="w3-bar-item w3-button w3-hide-small w3-left">Home</a>
        <a href="Ttutor.php" class="w3-bar-item w3-button w3-hide-small w3-left">Tutors</a>
        <a href="#" class="w3-bar-item w3-button w3-hide-small w3-left">Free classes</a>
        <a href="reguser.php" class="w3-bar-item w3-button w3-hide-small w3-left">Register</a>
        <a href="#" class="w3-bar-item w3-button w3-hide-small w3-left">Book n' Pay</a>
        <a href="login.php" class="w3-bar-item w3-button w3-hide-small w3-left">Log in</a>
        <a href="javascript:void(0)" class="w3-bar-item w3-button w3-left w3-hide-large w3-hide-medium" onclick="myFunction()">&#9776;</a>
    </div>
    <!--phone mode navigation-->
    <div id="idnavbar" class="w3-bar-block w3-teal w3-hover-light-green w3-hover-text-pink w3-hide w3-hide-large w3-hide-medium" style="position: fixed">
        <a href="index.php" class="w3-bar-item w3-button w3-center">Home</a>
        <a href="Ttutor.php" class="w3-bar-item w3-button w3-center">Tutors</a>
        <a href="#" class="w3-bar-item w3-button w3-center">Free classes</a>
        <a href="reguser.php" class="w3-bar-item w3-button w3-center">Register</a>
        <a href="#" class="w3-bar-item w3-button w3-center">Book n' Pay</a>
        <a href="login.php" class="w3-bar-item w3-button w3-center">Log in</a>
    </div>
    <header class="w3-header w3-container w3-black w3-padding-32 w3-center">
        <h1 class="w3-xxxxxlarge font-effect-shadow-multiple">My Tutor</h1>
        <h2 class="w3-text-teal" style="text-shadow:1px 1px 0 rgb(136, 199, 215)">invest in knowledge</h2>
    </header>
    <br>

    <br>
    <H1 class="w3-center">Log In</H1>

    <div style="display:flex; justify-content: center">
        <div class="w3-container w3-card w3-padding w3-margin" style="width:600px;margin:auto;text-align:left;">
            <form name="loginForm" action="login.php" method="post" onsubmit="return validateemail();">
                <p>
                    <label><b>Email</b></label>
                    <input class="w3-input w3-round w3-border" type="email" name="email" id="email" placeholder="enter email" required class="inputbox">
                </p>
                <p>
                    <label><b>Password</b></label>
                    <input class="w3-input w3-round w3-border" type="password" name="password" id="password" placeholder="enter password" required class="inputbox">
                </p>
                <p>
                    <input class="w3-check" type="checkbox" id="idremember" onclick="rememberMe()">
                    <label><b>Remember Me</b></label>
                </p>
                <p>
                    <input class="w3-button w3-round w3-border w3-pink" type="submit" name="submit" id="idsubmit">
                </p>

            </form>
        </div>


    </div>


    <div id="cookieNotice" class="w3-right w3-block" style="display: none;">
        <div class="w3-red">
            <h4>Cookie Consent</h4>
            <p>This website uses cookies or similar technologies, to enhance your
                browsing experience and provide personalized recommendations.
                By continuing to use our website, you agree to our
                <a style="color:#115cfa;" href="/privacy-policy">Privacy Policy</a>
            </p>
            <div class="w3-button">
                <button onclick="acceptCookieConsent();">Accept</button>
            </div>
        </div>
    </div>






    <footer class="w3-container w3-black w3-hover-teal w3-center w3-margin-top">
        <p>Stay conected with me!</p>
        <a href="https://www.facebook.com/anu.hikari" class="fa fa-facebook-official w3-hover-pink"></a>
        <a href="https://youtube.com/channel/UCXREH-_X8f_3lJ6yz4e2y6A" class="fa fa-youtube-play w3-hover-pink"></a>
        <a href="https://pin.it/3YY5aq0" class="fa fa-pinterest-p w3-hover-pink"></a>
        <p>

        </p>
    </footer>
</body>
<script>
    let cookie_consent = getCookie("user_cookie_consent");
    if (cookie_consent != "") {
        document.getElementById("cookieNotice").style.display = "none";
    } else {
        document.getElementById("cookieNotice").style.display = "block";
    }


    function deleteCookie(cname) {
        const d = new Date();
        d.setTime(d.getTime() + (24 * 60 * 60 * 1000));
        let expires = "expires=" + d.toUTCString();
        document.cookie = cname + "=;" + expires + ";path=/";
    }

    function acceptCookieConsent() {
        deleteCookie('user_cookie_consent');
        setCookies('user_cookie_consent', 1, 30);
        document.getElementById("cookieNotice").style.display = "none";
    }
</script>




</html>