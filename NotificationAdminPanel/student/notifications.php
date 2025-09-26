<?php
include("../config/db.php");
$user_id = 2; // student id (normally from session)
$notifs = $pdo->prepare("
    SELECT n.id, n.title, n.message, nr.id as recipient_id, nr.is_read
    FROM notifications n
    JOIN notification_recipients nr ON n.id = nr.notification_id
    WHERE nr.user_id=? ORDER BY n.created_at DESC");
$notifs->execute([$user_id]);
?>
<!DOCTYPE html>
<html>
<head>
  <title>My Notifications</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body class="container py-4">

<h2>My Notifications</h2>
<?php
session_start();
require_once '../config/db.php';   // make sure this creates $pdo as a PDO instance

$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$user_id = $_SESSION['user_id'] ?? 2;

$sql = "SELECT n.id, n.title, n.message, n.created_at,
               r.is_read, r.read_at
        FROM notifications n
        INNER JOIN notification_recipients r
            ON n.id = r.notification_id
        WHERE r.user_id = :user_id
        ORDER BY n.created_at DESC";

$stmt = $pdo->prepare($sql);
$stmt->execute(['user_id' => $user_id]);
$notifications = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html>
<head>
  <title>My Notifications</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<?php include("./navbar_student.php"); ?>

<div class="container mt-4">
  <!-- <h3>My Notifications</h3> -->
  <hr>

  <?php if (count($notifications) === 0): ?>
    <div class="alert alert-info">No notifications yet.</div>
  <?php else: ?>
    <div class="list-group">
      <?php foreach ($notifications as $row): ?>
        <div class="list-group-item d-flex justify-content-between align-items-center">
          <div>
            <h5 class="mb-1">
              <?php echo htmlspecialchars($row['title']); ?>
              <?php if ($row['is_read'] == 0): ?>
                <span class="badge bg-danger">New</span>
              <?php endif; ?>
            </h5>
            <p class="mb-1"><?php echo nl2br(htmlspecialchars($row['message'])); ?></p>
            <small>Sent on: <?php echo $row['created_at']; ?></small>
          </div>
          <div>
            <?php if ($row['is_read'] == 0): ?>
              <button class="btn btn-sm btn-success mark-read" data-id="<?php echo $row['id']; ?>">
                Mark as Read
              </button>
            <?php else: ?>
              <span class="badge bg-secondary">Read</span>
            <?php endif; ?>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
</div>

<script>
document.querySelectorAll(".mark-read").forEach(btn => {
  btn.addEventListener("click", function() {
    let id = this.getAttribute("data-id");

    fetch("mark_read.php", {
      method: "POST",
      headers: { "Content-Type": "application/x-www-form-urlencoded" },
      body: "id=" + id
    })
    .then(res => res.text())
    .then(data => {
      if (data === "ok") {
        this.parentElement.innerHTML = '<span class="badge bg-secondary">Read</span>';
      }
    });
  });
});
</script>

</body>
</html>

<?php foreach ($notifs as $n): ?>
  <div class="card p-3 mb-2 <?= $n['is_read'] ? '': 'border-danger' ?>">
    <h5><?= $n['title'] ?></h5>
    <p><?= $n['message'] ?></p>
    <?php if(!$n['is_read']): ?>
      <button class="btn btn-sm btn-success mark-read" data-id="<?= $n['recipient_id'] ?>">Mark as Read</button>
    <?php else: ?>
      <span class="badge bg-success">Read</span>
    <?php endif; ?>
  </div>
<?php endforeach; ?>

<script>
$(".mark-read").click(function(){
  let id = $(this).data("id");
  $.post("mark_read.php", {id:id}, function(){
    location.reload();
  });
});
</script>
</body>
</html>
