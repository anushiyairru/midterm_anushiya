<?php
if (isset($_POST["submit"])) {
    include_once("dbconnect.php");
    $name = $_POST["name"];
    $ic = $_POST["ic"];
    $age = $_POST["age"];
    $phnum = $_POST["phnum"];
    $address = $_POST["address"];
    $email = $_POST["email"];
    $pass = sha1($_POST["password"]);
    $studyfield = $_POST["studyfield"];
    $subscrption = $_POST["subscrption"];
    $sqlregister = "INSERT INTO `tbl_usersreg`(`user_name`, `user_ic`, `user_age`, `user_phnum`, `user_homeAdd`, `user_email`,`user_password`, `user_studyfield`, `user_subscription`) 
    VALUES ('$name','$ic','$age','$phnum','$address','$email','$pass','$studyfield ','$subscrption')";
    try {

        $conn->exec($sqlregister);
        if (file_exists($_FILES["fileToUpload"]["tmp_name"]) || is_uploaded_file($_FILES["fileToUpload"]["tmp_name"])) {
            $last_id = $conn->lastInsertId();
            uploadImage($last_id);
            echo "<script>alert('successfully registered!')</script>";
            echo "<script>window.location.replace('index.php')</script>";
        }
    } catch (PDOException $e) {
        echo "<script>alert('registration failed!')</script>";
        echo "<script>window.location.replace('reguser.php')</script>";
    }
}

function uploadImage($filename)
{
    $target_dir = "../res/userpic/";
    $target_file = $target_dir . $filename . ".png";
    move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
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

    <title>Registration</title>


</head>

<body background="../res/backgrounds/bg.jpg" style="background-repeat: no-repeat;
  background-attachment: fixed;  
  background-size: cover;             ">
    <!--desktop mode navigation-->
    <div class="w3-bar w3-teal w3-hover-light-green w3-hover-text-pink" style="position: fixed">
        <a href="index.php" class="w3-bar-item w3-button w3-hide-small w3-left">Home</a>
        <a href="#" class="w3-bar-item w3-button w3-hide-small w3-left">Tutors</a>
        <a href="#" class="w3-bar-item w3-button w3-hide-small w3-left">Free classes</a>
        <a href="reguser.php" class="w3-bar-item w3-button w3-hide-small w3-left">Register</a>
        <a href="#" class="w3-bar-item w3-button w3-hide-small w3-left">Book n' Pay</a>
        <a href="index.php" class="w3-bar-item w3-button w3-hide-small w3-left">Log in</a>
        <a href="javascript:void(0)" class="w3-bar-item w3-button w3-left w3-hide-large w3-hide-medium" onclick="myFunction()">&#9776;</a>
    </div>
    <!--phone mode navigation-->
    <div id="idnavbar" class="w3-bar-block w3-teal w3-hover-light-green w3-hover-text-pink w3-hide w3-hide-large w3-hide-medium" style="position: fixed">
        <a href="index.php" class="w3-bar-item w3-button w3-center">Home</a>
        <a href="#" class="w3-bar-item w3-button w3-center">Tutors</a>
        <a href="#" class="w3-bar-item w3-button w3-center">Free classes</a>
        <a href="reguser.php" class="w3-bar-item w3-button w3-center">Register</a>
        <a href="#" class="w3-bar-item w3-button w3-center">Book n' Pay</a>
        <a href="index.php" class="w3-bar-item w3-button w3-center">Log in</a>
    </div>
    <header class="w3-header w3-container w3-black w3-padding-32 w3-center">
        <h1 class="w3-xxxxxlarge font-effect-shadow-multiple">My Tutor</h1>
        <h2 class="w3-text-teal" style="text-shadow:1px 1px 0 rgb(136, 199, 215)">invest in knowledge</h2>

    </header>
    <br>



    <div style="display:flex; justify-content: center">
        <div class="w3-container w3-card w3-padding w3-margin form-container-reg" style="width:600px;margin:auto;text-align:left;">
            <div class="w3-card">
                <div class="w3-container w3-blue">
                    <H1 class="w3-center">User Registration</H1>
                </div>

                <form style="background-color:#CAA4B3" class="w3-container w3-padding " name="registerForm" action="reguser.php" method="post" enctype="multipart/form-data" onsubmit="return confirmDialog()">
                    <div class="w3-container w3-pink">
                        <h3>New User </h3>
                    </div>
                    <div class="w3-container w3-padding w3-border w3-center">
                        <img class="w3-image w3-mmargin" src="../res/icon2.png" style="height:100%;max-width:400px">

                        <input type="file" name="fileToUpload" onchange="previewFile()"><br>

                    </div>
                    <!--/*user_id	user_name	user_ic	user_age	user_phnum	user_homeAdd	user_email	user_password	user_regDate*/-->

                    <p>
                    <div>
                        <label>Name: </label>
                        <input class="w3-input w3-border w3-round" name="name" id="idname" type="text" placeholder="Your full name" required>
                    </div><br>
                    </p>

                    <p>
                    <div>
                        <label>IC Number: </label>
                        <input class="w3-input w3-border w3-round" name="ic" id="idic" type="text" placeholder="Your identity card number" max-length="12" required>
                    </div><br>
                    </p>

                    <p>
                    <div>
                        <label>Age: </label>
                        <input class="w3-input w3-border w3-round" name="age" id="idage" type="text" placeholder="Your age" max-length="2" required>
                    </div><br>
                    </p>
                    <p>
                    <div>
                        <label>Ph Number: </label>
                        <input class="w3-input w3-border w3-round" name="phnum" id="idphone" type="phone" placeholder="Your phone number" required>
                    </div><br>
                    </p>
                    <p>
                    <div>
                        <label>Address: </label>
                        <textarea class="w3-input w3-border w3-round" rows="5" width="80%" name="address" id="idadd" placeholder="Your address" required></textarea>
                    </div><br>
                    </p>
                    <p>
                    <div>
                        <label>Email: </label>
                        <input class="w3-input w3-border w3-round" name="email" id="idemail" type="email" placeholder="Your active email" required>
                    </div><br>
                    </p>
                    <p>
                    <div>
                        <label><b>Password</b></label>
                        <input class="w3-input w3-round w3-border" type="password" name="password" id="idpass" placeholder="your password" required>
                    </div><br>
                    </p>
                    <p>
                    <div>
                        <label>Study Major field: </label>
                        <select class="w3-input w3-border w3-round" name="studyfield" id="studyid">
                            <option value="Software Engineering">Software Engineering</option>
                            <option value="Artificial Intelligence">Artificial Intelligence</option>
                            <option value="Data Science Management">Data Science Management</option>
                            <option value="Networking">Networking</option>
                            <option value="IT Security">IT Security</option>
                        </select>
                    </div><br>
                    </p>

                    <p>
                    <div>
                        <label>Please select your subscribtion: </label>
                        <select class="w3-input w3-border w3-round" name="subscrption" id="idsub">
                            <option value="onemonth">1-month:RM60</option>
                            <option value="sixmonth">6-month:RM300</option>
                            <option value="oneyear">1-year:RM600</option>

                        </select>
                    </div><br>
                    </p>



                    <div class="row">
                        <input class="w3-input w3-border w3-block w3-blue w3-round" type="submit" name="submit" value="Submit">
                    </div>

                </form>
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

</html>