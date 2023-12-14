<?php
session_start();
include 'connection.php';

// Retrieve users from the database
try {
    $stmt = $pdo->query("SELECT * FROM usertable");
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

// Handle user approval, denial, and promotion
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['approve'])) {
        $login = $_POST['login'];
        // Update the user in the database to mark them as approved
        $approveStmt = $pdo->prepare("UPDATE usertable SET is_approved = 1 WHERE login = :login");
        $approveStmt->bindParam(':login', $login);
        $approveStmt->execute();
    } elseif (isset($_POST['deny'])) {
        $login = $_POST['login'];
        // Delete the user from the database
        $denyStmt = $pdo->prepare("DELETE FROM usertable WHERE login = :login");
        $denyStmt->bindParam(':login', $login);
        $denyStmt->execute();
    } elseif (isset($_POST['promote'])) {
        $login = $_POST['login'];
        // Update the user in the database to mark them as an admin
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
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <!-- Custom styles -->
    <style>
        body {
            background: linear-gradient(to right, #87CEEB, #C9A0DC);
        }
        .container {
            margin-top: 50px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row">
        <!-- User Table -->
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
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?php echo $user['login']; ?></td>
                            <td><?php echo $user['email']; ?></td>
                            <td><?php echo $user['is_admin'] ? 'Yes' : 'No'; ?></td>
                            <td><?php echo $user['is_approved'] ? 'Yes' : 'No'; ?></td>
                            <td>
                                <form method="post">
                                    <input type="hidden" name="login" value="<?php echo $user['login']; ?>">

                                    <?php if (!$user['is_approved']): ?>
                                        <button type="submit" class="btn btn-success" name="approve">Approve</button>
                                        <button type="submit" class="btn btn-danger" name="deny">Deny</button>
                                    <?php endif; ?>

                                    <?php if (!$user['is_admin']): ?>
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

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>
</html>
