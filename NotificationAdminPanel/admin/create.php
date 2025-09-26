<?php include("../config/db.php"); ?>
<!DOCTYPE html>
<html>
<head>
  <title>Create Notification</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</head>
<body class="container py-4">
<div class="container">
  <div class="row">
    <div class="col-4">
<?php 
include './sideBars/sidebar_admin.php'
?>
    </div>
    <div class="col-8">
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <!-- Brand -->
    <a class="navbar-brand" href="dashboard.php">Admin Panel</a>

    <!-- Toggle for mobile -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Links -->
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link" href="dashboard.php">Dashboard</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="create.php">Create Notification</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="users.php">Manage Users</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="batches.php">Manage Batches</a>
        </li>
      </ul>

      <!-- Right Side -->
      <ul class="navbar-nav ms-auto">
        <!-- Notifications Bell -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle position-relative" href="#" id="notifDropdown" role="button"
             data-bs-toggle="dropdown" aria-expanded="false">
            🔔 Notifications
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
              3
            </span>
          </a>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="notifDropdown">
            <li><a class="dropdown-item" href="#">New Exam Reminder</a></li>
            <li><a class="dropdown-item" href="#">Fee Payment Due</a></li>
            <li><a class="dropdown-item text-center" href="notifications.php">View All</a></li>
          </ul>
        </li>

        <!-- User -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
             data-bs-toggle="dropdown" aria-expanded="false">
            Admin
          </a>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
            <li><a class="dropdown-item" href="profile.php">Profile</a></li>
            <li><a class="dropdown-item" href="logout.php">Logout</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>


<h2>Create Notification</h2>
<form action="send.php" method="POST" enctype="multipart/form-data" class="card p-3 shadow-sm">
  <div class="mb-3">
    <label class="form-label">Title</label>
    <input type="text" name="title" class="form-control" required>
  </div>

  <div class="mb-3">
    <label class="form-label">Message</label>
    <textarea name="message" class="form-control" rows="4" required></textarea>
  </div>

  <div class="mb-3">
    <label class="form-label">Attachments</label>
    <input type="file" name="files[]" multiple class="form-control">
  </div>

  <!-- Send To Batches -->
 <div class="mb-3">
  <label class="form-label">Send To Batches</label>
  <select name="batch_ids[]" class="form-select" multiple required>
    <?php
    $batches = $pdo->query("SELECT * FROM batches")->fetchAll();
    foreach ($batches as $b) {
        echo "<option value='{$b['id']}'>{$b['name']}</option>";
    }
    ?>
  </select>
  <small class="form-text text-muted">Hold Ctrl (Windows) or Command (Mac) to select multiple batches</small>
</div>


  <div class="mb-3 form-check">
    <input type="checkbox" class="form-check-input" name="send_email" value="1">
    <label class="form-check-label">Send through Email also</label>
  </div>

  <button type="submit" class="btn btn-primary">Send</button>
</form>



    </div>
  </div>
</div>






</body>
</html>
