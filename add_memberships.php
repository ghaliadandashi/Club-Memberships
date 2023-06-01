<?php
session_start();
require "dbconnect.php";
error_reporting(0);
if(count($_SESSION)==0 || $_SESSION['userRole']==='user'){
    header("Location: login.html");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="Styling/add_memberships.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Climate+Crisis&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Righteous&display=swap" rel="stylesheet">
    <title>Add</title>
</head>
<body>
<header>
    <nav>
        <ul>
            <li><a href="index.php">Membership Plans</a></li>
            <li><a href="admin.php">Admin</a> </li>
            <li class="userpro"><a href="logout.php">Logout</a></li>
        </ul>
    </nav>
</header>
<main>
    <form method="post" class="add-form" >
        <h1>Add Membership</h1>
        <label for="mem-name">
            Membership Name
            <input type="text" name="mem-name" id="mem-name" required>
        </label>
        <label for="desc">
            Membership Description
            <textarea name="mem-desc" id="mem-desc" required></textarea>
        </label>
        <button type="submit">Add Plan</button>
        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $mem_name=$_POST['mem-name'];
    $mem_desc = $_POST['mem-desc'];
    $stmt = $conn->prepare('SELECT * FROM memberships where name= ?');
    $stmt->bind_param('s',$mem_name);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = mysqli_fetch_assoc($result);
    $error_message = "";
    if(!empty($row)){
        $error_message = "Membership Already Exists!";
    }else if(strlen($mem_desc)>455){
        $error_message = "Description is too long!";
    }else{
        $stmt = $conn->prepare('INSERT INTO memberships(name,description)VALUES(?,?)');
        $stmt->bind_param('ss',$mem_name,$mem_desc);
        $stmt->execute();
        header('Location: index.php');
    }
}

if(!empty($error_message)){?>
    <div class="error-container">
        <div class="error"><?php echo $error_message; ?></div>
    </div>
<?php
}
?>

    </form>
</main>
</body>
</html>
