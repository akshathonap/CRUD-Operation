<?php
include 'db.php';

$id = $_GET['id'] ?? null;

if (!$id) {
    echo "Invalid user ID.";
    exit;
}

$sql = "DELETE FROM student WHERE id = $id";
if (mysqli_query($conn, $sql)) {
    header("Location: create.php");
    exit;
} else {
    echo "Error deleting user: " . mysqli_error($conn);
}
?>