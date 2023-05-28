<?php

require "dbconnect.php";

$stmt = $conn->prepare('SELECT * FROM memberships');
$stmt->execute();
$result = $stmt->get_result();
$data = array();

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = ['name'=>$row['name'],'desc'=>$row['description']];
    }
    echo json_encode($data);
} else {
    echo "No memberships found!";
}
?>
