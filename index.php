<?php
session_start();
error_reporting(0);
require 'dbconnect.php';

if (isset($_GET['delete'])) {
    $deleteID = $_GET['delete'];
    $stmt = $conn->prepare('DELETE FROM membership_user where membershipID =?');
    $stmt->bind_param('i',$deleteID);
    $stmt->execute();

    $stmt = $conn->prepare('DELETE FROM memberships where id = ?');
    $stmt->bind_param('i',$deleteID);
    $stmt->execute();
    header("Location: ".$_SERVER['PHP_SELF']);
    exit();
}
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
                <li><a class="logout-btn"href="logout.php">Logout</a></li>
            <?php }?>
            <?php
            if ($_SESSION['userRole'] === 'admin') {
                ?>
                <li><a href="admin.php">Admin</a></li>
                <li><a class="logout-btn" href="logout.php">Logout</a></li>
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
                <button class="additembtn"><a href="add_memberships.php">Add Plan</a></button>
                <?php
            }
            ?>
        </div>
        <div class="container2">
            <?php

            if(isset($_SESSION['userID'])) {
                $stmt= $conn->prepare('SELECT * FROM membership_user where userID = ?');
                $stmt->bind_param('i',$_SESSION['userID']);
                $stmt->execute();
                $result1= $stmt->get_result();
                $row1 = mysqli_fetch_all($result1);

                if(empty($row1)) {
                    if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['memID'])) {
                        if (isset($_SESSION['userRole']) && $_SESSION['userRole'] === 'user') {
                            $memID = $_POST['memID'];
                            $userID = $_SESSION['userID'];

                            $stmt = $conn->prepare('INSERT INTO membership_user(membershipID,userID) VALUES (?, ?)');
                            $stmt->bind_param('ii', $memID, $userID);
                            $stmt->execute();

                            header("Location: " . $_SERVER['REQUEST_URI']);
                            exit();
                        } else {
                            header('Location: login.html');
                            exit();
                        }
                    }
                }
            } else if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['memID'])) {
                header('Location: login.html');
                exit();
            }


            $stmt = $conn->prepare('SELECT * FROM memberships');
            $stmt->execute();
            $result = $stmt->get_result();

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <div class="item">
                        <?php if ($_SESSION['userRole'] === 'admin') { ?>
                            <div class="icon">
                                <a href="?delete=<?php echo $row['id']; ?>">
                                    <i class="fa-solid fa-circle-minus fa-beat" style="color: #ff2600;"></i>
                                </a>
                            </div>
                        <?php } ?>
                        <h5 class="planname"><?php echo $row['name']; ?></h5>
                        <p class="plandesc"><?php echo $row['description']; ?></p>
                        <?php if(!isset($_SESSION['userRole']) || $_SESSION['userRole'] === 'user'){?>
                            <form method="post">
                                <button type="submit" class="applybtn">Apply</button>
                                <input type="hidden" name="memID" value="<?php echo $row['id']; ?>">
                            </form>
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