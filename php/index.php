<?php
session_start();
if (!isset($_SESSION['sessionid'])) {
    echo "<script>alert('Session not available.Please Login');</script>";
    echo "<script> window.location.replace('login.php')</script>";
} else {
    $email = $_SESSION['email'];
}
include_once("dbconnect.php");

$sqlcourses = "SELECT * FROM tbl_subjects";

$results_per_page = 10;
if (isset($_GET['pageno'])) {
    $pageno = (int)$_GET['pageno'];
    $page_first_result = ($pageno - 1) * $results_per_page;
} else {
    $pageno = 1;
    $page_first_result = 0;
}

$showcase = $conn->prepare($sqlcourses);
$showcase->execute();
$number_of_result = $showcase->rowCount();
$number_of_page = ceil($number_of_result / $results_per_page);
$sqlcourses = $sqlcourses . " LIMIT $page_first_result , $results_per_page";
$showcase = $conn->prepare($sqlcourses);
$showcase->execute();
$result = $showcase->setFetchMode(PDO::FETCH_ASSOC);
$rows = $showcase->fetchAll();
$conn = null;

function truncate($string, $length, $dots = "...")
{
    return (strlen($string) > $length) ? substr($string, 0, $length - strlen($dots)) . $dots : $string;
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
    <link rel="stylesheet" href="../css/subject.css">


    <title>HOME</title>


</head>

<body>
    <!--desktop mode navigation-->
    <div class="w3-bar w3-teal w3-hover-light-green w3-hover-text-pink" style="position: fixed">
        <a href="index.php" class="w3-bar-item w3-button w3-hide-small w3-left">Home</a>
        <a href="#" class="w3-bar-item w3-button w3-hide-small w3-left">Courses</a>
        <a href="Ttutor.php" class="w3-bar-item w3-button w3-hide-small w3-left">Tutor</a>
        <a href="reguser.php" class="w3-bar-item w3-button w3-hide-small w3-left">Register</a>
        <a href="#" class="w3-bar-item w3-button w3-hide-small w3-left">Subscription</a>
        <a href="#" class="w3-bar-item w3-button w3-hide-small w3-left">Profile</a>
        <a href="login.php" class="w3-bar-item w3-button w3-hide-small w3-left">Log out</a>
        <a href="javascript:void(0)" class="w3-bar-item w3-button w3-left w3-hide-large w3-hide-medium" onclick="myFunction()">&#9776;</a>
    </div>
    <!--phone mode navigation-->
    <div id="idnavbar" class="w3-bar-block w3-teal w3-hover-light-green w3-hover-text-pink w3-hide w3-hide-large w3-hide-medium" style="position: fixed">
        <a href="index.php" class="w3-bar-item w3-button w3-center">Home</a>
        <a href="#" class="w3-bar-item w3-button w3-center">Courses</a>
        <a href="Ttutor.php" class="w3-bar-item w3-button w3-center">Tutor</a>
        <a href="reguser.php" class="w3-bar-item w3-button w3-center">Register</a>
        <a href="#" class="w3-bar-item w3-button w3-center">Subscription</a>
        <a href="#" class="w3-bar-item w3-button w3-center">Profile</a>
        <a href="login.php" class="w3-bar-item w3-button w3-center">Log out</a>
    </div>
    <header class="w3-header w3-container w3-black w3-padding-32 w3-center">
        <h1 class="w3-xxxxxlarge font-effect-shadow-multiple">My Tutor</h1>
        <h2 class="w3-text-teal" style="text-shadow:1px 1px 0 rgb(136, 199, 215)">invest in knowledge</h2>
    </header>
    <!--home page contents-->


    <br>

    <div class="w3-grid-template">
        <?php
        $i = 0;
        foreach ($rows as $courses) {
            $i++;

            $prid = $courses['subject_id'];
            $prname = truncate($courses['subject_name'], 15);
            $prprice = number_format((float)$courses['subject_price'], 2, '.', '');
            $prsessions = $courses['subject_sessions'];
            $prrate = $courses['subject_rating'];
            echo "<div class ='w3-center w3-padding'>";
            echo "<div class ='w3-card-4 w3-dark-grey' >";
            echo "<header class='w3-container w3-blue'>";
            echo "<h5>$prname</h5>";
            echo "</header>";
            echo "<img class='w3-image' src=../assets/courses/$prid.png" .
                " onerror=this.onerror=null;this.src='../res/userpic/icon2.png'"
                . " style='width:100%;height:250px'>";
            echo "<div class='w3-container w3-left-align'><hr>";
            echo "<p><i style='font-size:16px'></i> <p> Price: RM$prprice</p>
        <i style='font-size:16px'>
        </i><p> Rating: $prrate </p>
        <i style='font-size:16px'></i> <p>Sessions of class: $prsessions sessions<br></p><hr>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
        }
        ?>

    </div>
    <br>

    <?php
    $num = 1;
    if ($pageno == 1) {
        $num = 1;
    } else if ($pageno == 2) {
        $num = ($num) + 10;
    } else {
        $num = $pageno * 10 - 9;
    }
    echo "<div class='w3-container w3-row'>";
    echo "<center>";
    for ($page = 1; $page <= $number_of_page; $page++) {
        echo '<a href = "index.php?pageno=' . $page . '" style= "text-decoration: none">&nbsp&nbsp' . $page . ' </a>';
    }
    echo " ( " . $pageno . " )";
    echo "</center>";
    echo "</div>";
    ?>




    <!--home page contents-->


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