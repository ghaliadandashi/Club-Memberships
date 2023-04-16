<?php
require_once 'dbconnect.php';

$un = $_POST['name'];
$uemail = $_POST['email'];
$upass = $_POST['password'];
$cupass = $_POST['confirmpass'];
$udob = $_POST['dob'];

$hashed ='';
$error_msgs =[];
if($upass != $cupass){
    $error_msgs[] = "Passwords do not match!";
}else if(strlen($upass) < 8){
    $error_msgs[] = "Password must be longer!";
}else if(!preg_match("/[A-Z]/", $upass)){
    $error_msgs[]= "Password must contain at least one uppercase letter!";
}else if(!preg_match("/[a-z]/",$upass)){
    $error_msgs[]= "Password must contain at least one lowercase letter!";
}else if(!preg_match("/[0-9]/",$upass)){
    $error_msgs[] = "Password must contin at least one number!";
}else{
    $hashed = password_hash($upass,PASSWORD_DEFAULT);
}




$query = "INSERT INTO members (name, email, password, dob) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($query);
$stmt->bind_param("ssss", $un, $uemail, $hashed, $udob);

if ($stmt->execute()) {
    header("Location: login.html");
    exit();
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
