<?php
session_start();
error_reporting(0);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clubs</title>
    <link href="Styling/style.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Climate+Crisis&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Righteous&display=swap" rel="stylesheet">
</head>
<body>
<header>
    <nav>
        <ul>
            <li><a href="index.php" class="selected-page">Membership Plans</a></li>
            <?php if($_SESSION['userRole']==='user'){?>
            <li><a href="profile.php">Profile</a></li>
            <?php }?>
            <?php
            if ($_SESSION['userRole'] === 'admin') {
                ?>
                <li><a href="admin.php">Admin</a></li>
                <?php
            }
            ?>
        </ul>
        <?php
        if (!isset($_SESSION['userID'])) {
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
        <div class="container1">
            <?php
            if ($_SESSION['userRole'] === 'admin') {
                ?>
                <button class="additembtn">Add Plan</button>
                <?php
            }
            ?>
        </div>
        <div class="container2">
            <?php
            require "dbconnect.php";

            $stmt = $conn->prepare('SELECT * FROM memberships');
            $stmt->execute();
            $result = $stmt->get_result();

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <div class="item">
                        <?php if ($_SESSION['userRole'] === 'admin') { ?>
                            <div class="icon">
                                <i class="fa-solid fa-circle-minus fa-beat" style="color: #ff2600;"></i>
                            </div>
                        <?php } ?>
                        <h5 class="planname"><?php echo $row['name']; ?></h5>
                        <p class="plandesc"><?php echo $row['description']; ?></p>
                        <?php if(($_SESSION['userRole']==='user') || (count($_SESSION)===0)){?>
                        <button class="applybtn" onclick="">Apply</button>
                        <?php } ?>
                    </div>
                    <?php
                }
            } else {
                echo "No memberships found!";
            }
            ?>
        </div>
    </section>
</main>
<footer>
</footer>
<script src="https://kit.fontawesome.com/f04a6cfd3a.js" crossorigin="anonymous"></script>
</body>
</html>