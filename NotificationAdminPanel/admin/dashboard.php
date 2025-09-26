<?php include("../config/db.php"); ?>
<!DOCTYPE html>
<html>
<head>
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container py-4">

<?php 
 include 'adminNav.php';
?>
<h2>Notifications</h2>
<table class="table table-bordered">
  <tr><th>Title</th><th>Sent</th><th>Read</th><th>Unread</th></tr>
  <?php
  $notifs = $pdo->query("SELECT * FROM notifications ORDER BY created_at DESC")->fetchAll();
  foreach ($notifs as $n) {
      $counts = $pdo->prepare("SELECT 
                  COUNT(*) as total,
                  SUM(is_read=1) as read_count
               FROM notification_recipients WHERE notification_id=?");
      $counts->execute([$n['id']]);
      $c = $counts->fetch();
      echo "<tr>
              <td>{$n['title']}</td>
              <td>{$c['total']}</td>
              <td>{$c['read_count']}</td>
              <td>".($c['total']-$c['read_count'])."</td>
            </tr>";
  }
  ?>
</table>

</body>
</html>
