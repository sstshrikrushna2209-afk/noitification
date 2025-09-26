<?php
session_start();
include("../config/db.php ");


if (!isset($_SESSION['id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}


$user_id = $_SESSION['id'];

// Count unread notifications
$sql = "SELECT COUNT(*) AS unread_count 
        FROM notification_recipients 
        WHERE user_id = ? AND is_read = 0";
$stmt = $pdo->prepare($sql);
$stmt->execute([$user_id]);
$result = $stmt->fetch(PDO::FETCH_ASSOC);
$unread_count = $result['unread_count'] ?? 0;
?>
<!DOCTYPE html>
<html>

<head>
  <title>Student Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

  <?php //include("./navbar_student.php"); 
  ?>

  <div class="container mt-4">
    <div class="row">
      <div class="col-md-12">
        <h3