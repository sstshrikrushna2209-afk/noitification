<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Student Panel</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="student_dashboard.php">Student Panel</a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#studentNavbar"
      aria-controls="studentNavbar" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="studentNavbar">
      <ul class="navbar-nav me-auto">
        <li class="nav-item"><a class="nav-link" href="student_dashboard.php">Dashboard</a></li>
        <li class="nav-item"><a class="nav-link" href="notifications.php">My Notifications</a></li>
      </ul>

      <ul class="navbar-nav ms-auto">
        <!-- 🔔 Notification Bell -->
        <li class="nav-item dropdown">
          <a class="nav-link position-relative" href="#" id="notifDropdown" role="button"
             data-bs-toggle="dropdown" aria-expanded="false">
            🔔
            <?php
// session_start();

if (!isset($_SESSION['user_id'])) {
    // Temporary for demo/testing
    $_SESSION['user_id'] = 2;  
}
$user_id = $_SESSION['user_id'];


            include("../config/db.php");
            $stmt = $pdo->prepare("SELECT COUNT(*) FROM notification_recipients WHERE user_id = ? AND is_read = 0");
            $stmt->execute([$user_id]);
            $unread_count = $stmt->fetchColumn();

            if ($unread_count > 0) {
              echo "<span class='position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger'>$unread_count</span>";
            }
            ?>
          </a>

          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="notifDropdown">
            <?php
            // Show latest 5 notifications
            $stmt = $pdo->prepare("
              SELECT n.title, nr.is_read 
              FROM notifications n
              JOIN notification_recipients nr ON n.id = nr.notification_id
              WHERE nr.user_id = ?
              ORDER BY n.created_at DESC LIMIT 5
            ");
            $stmt->execute([$user_id]);
            $rows = $stmt->fetchAll();

            if ($rows) {
              foreach ($rows as $row) {
                $class = $row['is_read'] ? "" : "fw-bold";
                echo "<li><a class='dropdown-item $class' href='notifications.php'>{$row['title']}</a></li>";
              }
            } else {
              echo "<li><span class='dropdown-item text-muted'>No notifications</span></li>";
            }
            ?>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item text-center" href="notifications.php">View All</a></li>
          </ul>
        </li>

        <!-- User Dropdown -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="studentUserDropdown" role="button" data-bs-toggle="dropdown">
            Student
          </a>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="studentUserDropdown">
            <li><a class="dropdown-item" href="profile.php">Profile</a></li>
            <li><a class="dropdown-item" href="login.php">Logout</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
