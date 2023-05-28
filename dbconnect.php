<?php

    $conn = @mysqli_connect('localhost', 'phpuser', 'phppwd', 'phpclub');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

?>
