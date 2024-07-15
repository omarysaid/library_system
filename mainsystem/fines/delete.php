<?php
session_start();
include '../connection/connection.php';
$fine_id = $_REQUEST['fine_id'];
$query = "DELETE FROM fine WHERE fine_id=$fine_id";
$result = mysqli_query($connect, $query) or die(mysqli_error($connect));

// Check if deletion was successful
if ($result) {
    // Redirect to view.php with success message
    header("Location: ./view.php?success=1");
} else {
    // Redirect to view.php with failure message
    header("Location: ./view.php?success=0");
}
exit();