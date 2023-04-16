<?php

require 'dbconnect.php';

$email = $_POST['email'];
$pass = $_POST['password'];

$stmt = $conn->prepare('SELECT password,email FROM members WHERE email = ?');
$stmt->bind_param('s',$email);
$stmt->execute();
$result = $stmt->get_result();


if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);
    $hash = $row['password'];
    if(password_verify($pass,$hash)){
        header("Location: Home.html");
    }else{
        echo "Wrong password!";
    }
}else{
    echo "User does not exist!";
}



?>