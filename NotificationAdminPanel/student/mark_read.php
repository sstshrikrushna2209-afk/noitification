<?php
session_start();
include("../config/db.php");

if (!isset($_SESSION['user_id'])) {
    die("Not logged in");
}

if (!isset($_POST['id'])) {
    die("Notification ID missing");
}

$notif_id = (int)$_POST['id'];
$user_id  = $_SESSION['user_id'];

$sql = "UPDATE notification_recipients 
        SET is_read = 1, read_at = NOW() 
        WHERE notification_id = ? AND user_id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$notif_id, $user_id]);

echo "ok";
