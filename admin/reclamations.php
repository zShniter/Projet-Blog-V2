<?php 
session_start();

#if (isset($_SESSION['admin_id']) && isset($_SESSION['username'])) {
?>
<!DOCTYPE html>
<html>
<head>
  <title>Dashboard - Reclamations</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  <link rel="stylesheet" href="../css/side-bar.css">
  <link rel="stylesheet" href="../css/style.css">
  <style>
    .status-pending { color: #dc3545; font-weight: bold; }
    .status-resolved { color: #28a745; font-weight: bold; }
  </style>
</head>
<body>
  <?php 
    $key = "hhdsfs1263z";
    include "inc/side-nav.php"; 
    include_once("../db_conn.php");
    
    // Get all reclamations
    $sql = "SELECT * FROM reclamations ORDER BY created_at DESC";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $reclamations = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Handle status update
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_status'])) {
        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
        $status = filter_input(INPUT_POST, 'status', FILTER_SANITIZE_STRING);
        
        $stmt = $conn->prepare("UPDATE reclamations SET status = ? WHERE id = ?");
        $stmt->execute([$status, $id]);
        
        $_SESSION['success'] = 'Status updated successfully!';
        header("Location: reclamations.php");
        exit();
    }
  ?>
               
  <div class="main-table">
    <h3 class="mb-3">All Reclamations</h3>
    <?php if (isset($_GET['error'])) { ?> 
      <div class="alert alert-warning">
        <?=htmlspecialchars($_GET['error'])?>
      </div>
    <?php } ?>

    <?php if (isset($_GET['success'])) { ?> 
      <div class="alert alert-success">
        <?=htmlspecialchars($_GET['success'])?>
      </div>
    <?php } ?>

    <?php if (!empty($reclamations)) { ?>
    <div class="table-responsive">
      <table class="table t1 table-bordered">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Subject</th>
            <th scope="col">Message</th>
            <th scope="col">Status</th>
            <th scope="col">Date</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($reclamations as $reclamation) { ?>
          <tr>
            <th scope="row"><?=$reclamation['id']?></th>
            <td><?=htmlspecialchars($reclamation['name'])?></td>
            <td><?=htmlspecialchars($reclamation['email'])?></td>
            <td><?=htmlspecialchars($reclamation['subject'])?></td>
            <td><?=nl2br(htmlspecialchars($reclamation['message']))?></td>
            <td class="status-<?=$reclamation['status']?>">
              <?=ucfirst($reclamation['status'])?>
            </td>
            <td><?=date('M j, Y g:i a', strtotime($reclamation['created_at']))?></td>
            <td>
              <form method="post" class="d-inline">
                <input type="hidden" name="id" value="<?=$reclamation['id']?>">
                <select name="status" class="form-select form-select-sm" onchange="this.form.submit()">
                  <option value="pending" <?=$reclamation['status'] === 'pending' ? 'selected' : ''?>>Pending</option>
                  <option value="resolved" <?=$reclamation['status'] === 'resolved' ? 'selected' : ''?>>Resolved</option>
                </select>
                <input type="hidden" name="update_status" value="1">
              </form>
            </td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
    <?php } else { ?>
      <div class="alert alert-warning">
        No reclamations found!
      </div>
    <?php } ?>
  </div>
  </section>
  </div>

  <script>
    var navList = document.getElementById('navList').children;
    // Update this index based on where you want the reclamations link to be highlighted
    navList.item(4).classList.add("active");
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>

<?php #} else {
  #header("Location: ../admin-login.php");
  #exit;
#} ?>