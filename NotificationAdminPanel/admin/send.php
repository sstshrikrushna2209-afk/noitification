<?php
include("../config/db.php");

if($_SERVER['REQUEST_METHOD']=='POST'){

    $title   = $_POST['title'];
    $message = $_POST['message'];
    $batch_ids = $_POST['batch_ids']; // array of selected batches
    $send_email = isset($_POST['send_email']);

    if(empty($title)|| empty($message) || empty($batch_ids)){
        die("Please fill all required fields.");
    }

    $pdo->beginTransaction();

    // Insert notification
    $stmt = $pdo->prepare("INSERT INTO notifications (title, message, created_by) VALUES (?, ?, ?)");
    $stmt->execute([$title, $message, 1]); // admin id = 1
    $notif_id = $pdo->lastInsertId();

    // Attach files (if uploaded)
    if (isset($_FILES['files']) && count($_FILES['files']['name']) > 0) {
        foreach ($_FILES['files']['tmp_name'] as $key => $tmp_name) {
            if (!empty($_FILES['files']['name'][$key])) {
                $fileName = time() . "_" . basename($_FILES['files']['name'][$key]);
                $targetPath = "../uploads/" . $fileName;
                move_uploaded_file($tmp_name, $targetPath);

                $stmt = $pdo->prepare("INSERT INTO notification_files (notification_id, file_path) VALUES (?, ?)");
                $stmt->execute([$notif_id, $targetPath]);
            }
        }
    }

    // Assign notification to students in selected batches
    foreach ($batch_ids as $batch_id) {
        // Get all users in this batch
        $stmt = $pdo->prepare("SELECT id FROM users WHERE batch_id = ?");
        $stmt->execute([$batch_id]);
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($users as $users) {
            $stmt = $pdo->prepare("INSERT INTO notification_recipients (notification_id, user_id, is_read) VALUES (?, ?, 0)");
            $stmt->execute([$notif_id, $users['id']]);
        }
    }

    $pdo->commit();

    echo "Notification sent successfully!";
} else {
    echo "Invalid request.";
}
