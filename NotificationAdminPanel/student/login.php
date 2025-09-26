<?php
session_start();
include("../config/db.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['name']); // from form input
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE name = ?"); // column is 'name'
    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['id'] = $user['id'];
        $_SESSION['name'] = $user['name'];   // session stores 'name'
        $_SESSION['role'] = $user['role'];

        if ($user['role'] === 'admin') {
            header("Location: admin/dashboard.php");
        } else {
            header("Location: student/notifications.php");
        }
        exit;
    } else {
        $error = "Invalid username or password";
    }
}


?>
<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-4">
      <div class="card shadow">
        <div class="card-header bg-dark text-white">Login</div>
        <div class="card-body">
          <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
          <?php endif; ?>
         <form method="post" action="/student/student_dashboard.php">

            <div class="mb-3">
              <label>Username</label>
              <input type="text" name="name" class="form-control" required>
            </div>
            <div class="mb-3">
              <label>Password</label>
              <input type="password" name="password" class="form-control" required>
            </div>
            <button class="btn btn-dark w-100">Login</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>
