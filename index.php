<?php
session_start();
error_reporting(0)
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clubs</title>
    <link href="/Styling/style.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Climate+Crisis&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Righteous&display=swap" rel="stylesheet">
</head>
<body>
<header>
<nav>
    <ul>
        <li><a href="index.php">Membership Plans</a></li>
        <li><a href="profile.html">Profile</a></li>
    </ul>
    <?php
    if(!isset($_SESSION['userID'])) {

        ?>
        <div class="userpro">
            <a href="login.html">Login</a>
            <a href="register.html">Register</a>
        </div>

        <?php
    }
    ?>
</nav>

</header>
<main>
    <section class="container">
        <div class="item">
            <?php
            if(($_SESSION['userRole'] === 'admin')) {
                ?>
                <div class="icon">
                    <i class="fa-solid fa-circle-minus fa-beat" style="color: #ff2600;"></i>
                </div>

                <?php
            }
            ?>
            <h5>Bronze</h5>
            <p>This membership consists of the following features:</p>
        </div>
        <div class="item">
            <?php
            if(($_SESSION['userRole'] === 'admin')) {
                ?>
                <div class="icon">
                    <i class="fa-solid fa-circle-minus fa-beat" style="color: #ff2600;"></i>
                </div>

                <?php
            }
            ?>
            <h5>Silver</h5>
            <p>This membership consists of the following features:</p>
        </div>
        <div class="item">
            <?php
            if(($_SESSION['userRole'] === 'admin')) {
                ?>
                <div class="icon">
                    <i class="fa-solid fa-circle-minus fa-beat" style="color: #ff2600;"></i>
                </div>

                <?php
            }
            ?>
            <h5>Gold</h5>
            <p>This membership consists of the following features:</p>
        </div>
    </section>
</main>
<footer>
