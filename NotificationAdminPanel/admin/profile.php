<?php
session_start();

// check if logged in
// if (!isset($_SESSION['id'])) {
//     header("Location: ../login.php");
//     exit;
// }

?>
<!DOCTYPE html>
<html>
<head>
  <title>Profile</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<?php
// Include different navbar depending on role
if ($_SESSION['role'] === 'admin') {
    include("../admin/navbar_admin.php");
} else {
    include("../student/navbar_student.php");
}
?>

<div class="container mt-4">
  <h3>My Profile</h3>

  <?php if ($_SESSION['role'] === 'admin'): ?>
    <!-- Admin profile -->
    <table class="table table-bordered">
      <tr><th>ID</th><td><?php echo htmlspecialchars($_SESSION['id']); ?></td></tr>
      <tr><th>Name</th><td><?php echo htmlspecialchars($_SESSION['name']); ?></td></tr>
      <tr><th>Role</th><td><?php echo htmlspecialchars($_SESSION['role']); ?></td></tr>
      <tr><th>Dashboard</th><td><a href="../admin/dashboard.php" class="btn btn-dark btn-sm">Go to Admin Dashboard</a></td></tr>
    </table>

  <?php else: ?>
    <!-- Student profile -->
    <table class="table table-bordered">
      <tr><th>ID</th><td><?php echo htmlspecialchars($_SESSION['id']); ?></td></tr>
      <tr><th>Name</th><td><?php echo htmlspecialchars($_SESSION['name']); ?></td></tr>
      <tr><th>Role</th><td><?php echo htmlspecialchars($_SESSION['role']); ?></td></tr>
      <tr><th>Notifications</th><td><a href="../student/notifications.php" class="btn btn-primary btn-sm">View Notifications</a></td></tr>
    </table>
  <?php endif; ?>

</div>
</body>
</html>
