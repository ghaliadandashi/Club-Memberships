<?php
require_once 'dbconnect.php';

$un = $_POST['name'];
$uemail = $_POST['email'];
$upass = $_POST['password'];
$cupass = $_POST['confirmpass'];
$udob = $_POST['dob'];
$dobb = date('Y-m-d', strtotime($udob));
$role = "user";

$error_msgs = [];
$hashed = '';

$stmt = $conn->prepare('SELECT * from users where email = ?');
$stmt->bind_param('s', $uemail);
$stmt->execute();
$stmt->store_result();

if($stmt->num_rows > 0 ) {
    echo json_encode(["error" => "Email already exists!"]);
    exit();
}

if ($upass != $cupass) {
    echo json_encode(["error" => "Passwords do not match!"]);
    exit();
} else if (strlen($upass) < 8) {
    echo json_encode(["error" => "Password must be longer!"]);
    exit();
} else if (!preg_match("/[A-Z]/", $upass)) {
    echo json_encode(["error" => "Password must contain at least one uppercase letter!"]);
    exit();
} else if (!preg_match("/[a-z]/", $upass)) {
    echo json_encode(["error" => "Password must contain at least one lowercase letter!"]);
    exit();
} else if (!preg_match("/[0-9]/", $upass)) {
    echo json_encode(["error" => "Password must contain at least one number!"]);
    exit();
}

$hashed = password_hash($upass, PASSWORD_DEFAULT);

$current_date = new DateTime();
$date_of_birth = DateTime::createFromFormat('Y-m-d', $dobb);
$age = $current_date->diff($date_of_birth)->y;

if(!isset($age)){
    echo json_encode(["error"=> "Must enter date of birth"]);
    exit();
}
if ($age < 18) {
    echo json_encode(["error" =>  "You must be older than 18!"]);
    exit();
}

    $query = "INSERT INTO users (full_name, email, password, dob,role) VALUES (?, ?, ?, ?,?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssss", $un, $uemail, $hashed, $dobb,$role);

   $stmt->execute();
   $stmt->close();
echo json_encode(['success' => 'Registration successful.']);

$conn->close();
?>
