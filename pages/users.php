<?php
session_start();
include '../config/connection.php';

try {
    $stmt = $pdo->query("SELECT * FROM usertable");
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['approve'])) {
        $login = $_POST['login'];
        $approveStmt = $pdo->prepare("UPDATE usertable SET is_approved = 1 WHERE login = :login");
        $approveStmt->bindParam(':login', $login);
        $approveStmt->execute();
    } elseif (isset($_POST['deny'])) {
        $login = $_POST['login'];
        $denyStmt = $pdo->prepare("DELETE FROM usertable WHERE login = :login");
        $denyStmt->bindParam(':login', $login);
        $denyStmt->execute();
    } elseif (isset($_POST['promote'])) {
        $login = $_POST['login'];
        $promoteStmt = $pdo->prepare("UPDATE usertable SET is_admin = 1 WHERE login = :login");
        $promoteStmt->bindParam(':login', $login);
        $promoteStmt->execute();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User List</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">

<header>
    <nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse bg-white">
        <div class="position-sticky">
            <div class="list-group list-group-flush mx-3 mt-4">
                <a href="#" class="list-group-item list-group-item-action py-2 ripple" data-category="Graphics cards">
                    <span>Graphics cards</span>
                </a>
                <a href="#" class="list-group-item list-group-item-action py-2 ripple" data-category="Arduino">
                    <span>Arduino</span>
                </a>
                <a href="#" class="list-group-item list-group-item-action py-2 ripple" data-category="Raspberry pi">
                    <span>Raspberry pi</span>
                </a>
                <a href="users.php" class="list-group-item list-group-item-action py-2 ripple" data-category="Users">
                    <span>Users</span>
                </a>
            </div>
        </div>
    </nav>
</header>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container">
      <a class="h2 text-center mt-5 mb-4 mr-3" href="#">ElectroNaser</a>
   
      <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Log out</a>
          </li>
        </ul>
      </div>
  </div>
</nav>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>User List</h2>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Admin</th>
                            <th>Approved</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $user) : ?>
                            <tr>
                                <td><?php echo $user['login']; ?></td>
                                <td><?php echo $user['email']; ?></td>
                                <td><?php echo $user['is_admin'] ? 'Yes' : 'No'; ?></td>
                                <td><?php echo $user['is_approved'] ? 'Yes' : 'No'; ?></td>
                                <td>
                                    <form method="post">
                                        <input type="hidden" name="login" value="<?php echo $user['login']; ?>">

                                        <?php if (!$user['is_approved']) : ?>
                                            <button type="submit" class="btn btn-success" name="approve">Approve</button>
                                            <button type="submit" class="btn btn-danger" name="deny">Deny</button>
                                        <?php endif; ?>

                                        <?php if (!$user['is_admin']) : ?>
                                            <button type="submit" class="btn btn-info" name="promote">Promote to Admin</button>
                                        <?php endif; ?>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>

</html>