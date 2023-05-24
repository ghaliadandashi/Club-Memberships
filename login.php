<?php

session_start();

require 'dbconnect.php';

$email = $_POST['email'];
$pass = $_POST['password'];

$stmt = $conn->prepare('SELECT id, password, email , role FROM users WHERE email = ?');
$stmt->bind_param('s',$email);
$stmt->execute();
$result = $stmt->get_result();


if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);
    $hash = $row['password'];
    if(password_verify($pass,$hash)){
        $_SESSION['userID'] = $row['id'];
        $_SESSION['userRole'] = $row['role'];
    } else {
        echo json_encode(["error"=>"Wrong password!"]);
        exit();
    }
}else{
    echo json_encode(["error"=>"User does not exist!"]);
    exit();
}
$stmt->close();
echo json_encode(['success' => 'Login successful.']);
$conn->close();
?>