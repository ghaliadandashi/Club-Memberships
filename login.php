<?php

session_start();

require 'dbconnect.php';

$email = $_POST['email'];
$pass = $_POST['password'];
$admine = "admin@enter";
$adminpass = "AdminEntry02";
$adminp = password_hash($adminpass, PASSWORD_DEFAULT);


$stmt = $conn->prepare('SELECT id FROM users WHERE email = ?');
$stmt->bind_param('s', $admine);
$stmt->execute();
$result = $stmt->get_result();

if (mysqli_num_rows($result) == 0) {
    $stmt = $conn->prepare('INSERT INTO users (full_name, email, password, role) VALUES (?, ?, ?, ?)');
    $admin = "admin";
    $stmt->bind_param('ssss', $admin, $admine, $adminp, $admin);
    $stmt->execute();
}

$stmt = $conn->prepare('SELECT id, password, email, role FROM users WHERE email = ?');
$stmt->bind_param('s', $email);
$stmt->execute();
$result = $stmt->get_result();
$row = mysqli_fetch_assoc($result);

$stmt=$conn->prepare('SELECT membershipID FROM membership_user where userID = ?');
$stmt->bind_param('i', $row['id']);
$stmt->execute();
$result1 = $stmt->get_result();
$row1 = mysqli_fetch_assoc($result1);


if (mysqli_num_rows($result) == 1) {
    $hash = $row['password'];
    if (password_verify($pass, $hash)) {
        $_SESSION['userID'] = $row['id'];
        $_SESSION['userRole'] = $row['role'];
        if(!isset($row1)){
            $_SESSION['userMem'] = "None";
        }else {
            $_SESSION['userMem'] = $row1['membershipID'];
        }
    } else {
        echo json_encode(["error" => "Wrong password!"]);
        exit();
    }
} else {
    echo json_encode(["error" => "User does not exist!"]);
    exit();
}

$stmt->close();
$conn->close();

echo json_encode(['success' => 'Login successful.']);
?>
