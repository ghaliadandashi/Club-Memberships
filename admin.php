<?php
session_start();
if(count($_SESSION)==0 || $_SESSION['userRole']==='user'){
    header("Location: login.html");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Styling/admin.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Climate+Crisis&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Righteous&display=swap" rel="stylesheet">
    <title>Admin</title>
</head>
<body>
<header>
    <nav>
        <ul>
            <li><a href="index.php">Membership Plans</a></li>
            <li><a href="admin.php" class="selected-page"> Admin</a></li>
            <li class="userpro"><a href="logout.php">Logout</a></li>
        </ul>
    </nav>
</header>
<main>
    <div class="container">
        <div class="container1">
            <table>
                <caption>Applied Users</caption>
                <tr><th>Name</th><th>Email</th><th>DOB</th><th>Membership</th><th>MStatus</th></tr>
                <?php
                require "dbconnect.php";

                if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['status']) && isset($_POST['userID'])) {
                    $status = $_POST['status'];
                    $userID = $_POST['userID'];

                    if ($status == 'approved') {
                        $stmt = $conn->prepare('UPDATE membership_user SET status=? WHERE userID=?');
                        $stmt->bind_param('si', $status, $userID);
                        $stmt->execute();
                    } else if ($status == 'rejected') {
                        $stmt = $conn->prepare('DELETE FROM membership_user WHERE userID=?');
                        $stmt->bind_param('i', $userID);
                        $stmt->execute();
                    }

                    header("Location: " . $_SERVER['REQUEST_URI']);
                    exit();
                }

                    $stmt =$conn->prepare('SELECT * FROM membership_user');
                    $stmt->execute();
                    $result = $stmt->get_result();
                    while($row = mysqli_fetch_assoc($result)) {
                        $userID = $row['userID'];
                        $stmt = $conn->prepare('SELECT full_name,email,dob FROM users where id = ?');
                        $stmt->bind_param('i', $userID);
                        $stmt->execute();
                        $resultu = $stmt->get_result();
                        $rowu = mysqli_fetch_assoc($resultu);

                        $membershipID = $row['membershipID'];
                        $stmt = $conn->prepare('SELECT name FROM memberships where id=?');
                        $stmt->bind_param('i',$membershipID);
                        $stmt->execute();
                        $resultm = $stmt->get_result();
                        $rowm = mysqli_fetch_assoc($resultm);
                        ?>
                        <tr>
                            <td><?php echo ucwords($rowu['full_name'])?></td>
                            <td><?php echo $rowu['email'] ;?></td>
                            <td><?php echo $rowu['dob'];?></td>
                            <td><?php echo $rowm['name'];?></td>
                            <td><?php echo ucfirst($row['status']);?></td>
                            <td>
                                <form method="POST">
                                    <button type="submit" name="status" value="approved" class="ap-re-btn approve">Approve</button>
                                    <input type="hidden" name="userID" value="<?php echo $userID; ?>">
                                </form>
                            </td>
                            <td>
                                <form method="POST">
                                    <button type="submit" name="status" value="rejected" class="ap-re-btn reject">Reject</button>
                                    <input type="hidden" name="userID" value="<?php echo $userID; ?>">
                                </form>
                            </td>
                        </tr>
                    <?php
                    }
                ?>
            </table>
        </div>
    <div class="container2">
        <table>
            <caption>Users</caption>
            <tr><th>Name</th><th>Email</th><th>Dob</th></tr>
            <?php
                $role = 'user';
                $stmt=$conn->prepare('SELECT full_name,email,dob FROM users where role = ?');
                $stmt->bind_param('s',$role);
                $stmt->execute();
                $result1 = $stmt->get_result();
                while($row1 = mysqli_fetch_assoc($result1)){
            ?>
            <tr><td><?php echo $row1['full_name'];?></td><td><?php echo $row1['email'];?></td><td><?php echo $row1['dob'];?></td></tr>
            <?php
                }
            ?>
        </table>
    </div>
    </div>
</main>
</body>
</html>
