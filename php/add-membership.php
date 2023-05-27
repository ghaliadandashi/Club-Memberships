<?php

session_start();

require 'dbconnect.php';

$user_id = $_POST['user_id'];
$name = $_POST['name'];
$description = $_POST['description'];;
$status = $_POST['status'];
$uemail = $_POST['email'];


$stmt = $conn->prepare('SELECT role from users where email = ?');
$stmt->bind_param('s', $uemail);
$stmt->execute();
$stmt->store_result();

// if($role == "admin"){
    $sql = "INSERT INTO memberships (user_id, name, description, status)
        VALUES (?,?,?,?), ";
         $stmt = $conn->prepare($query);
         $stmt->bind_param("isss", $user_id,$name, $description, $status);
         
         if ($conn->query($sql) === TRUE) {
             $last_insert_id = $conn->insert_id;
             echo "Membership added successfully. Last inserted ID: " . $last_insert_id;
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
            
// }
$conn->close();
?>
