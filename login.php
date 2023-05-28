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

$stmt = $conn->prepare('SELECT id, password, email , role FROM users WHERE email = ?');
$stmt->bind_param('s', $email);
$stmt->execute();
$result = $stmt->get_result();

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $hash = $row['password'];
        if (password_verify($pass, $hash)) {
            $_SESSION['userID'] = $row['id'];
            $_SESSION['userRole'] = $row['role'];
        } else {
            echo json_encode(["error" => "Wrong password!"]);
            exit();
        }
    } else {
        echo json_encode(["error" => "User does not exist!"]);
        exit();
    }


    $stmt->close();
    echo json_encode(['success' => 'Login successful.']);
    $conn->close();

?>
