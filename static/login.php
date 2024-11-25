<?php
session_start();
include('config.php'); // Include database configuration

// Check if already logged in, redirect to index page
if (isset($_SESSION['objLogin'])) {
    header("Location: index.php");
    die();
}

$error_message = "";

// Check if form is submitted
if (isset($_POST['txtUsername']) && isset($_POST['txtPassword']) && isset($_POST['txtBranchID'])) {
    $username = mysqli_real_escape_string($connect, $_POST['txtUsername']);
    $password = $_POST['txtPassword'];
    $branch_id = mysqli_real_escape_string($connect, $_POST['txtBranchID']);

    // Query to check username, password, and branch_id
    $sql = "SELECT * FROM tbl_add_member_type WHERE username = '$username' AND branch_id = '$branch_id' AND status='active'";
    $result = mysqli_query($connect, $sql);

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_array($result);

        // Verify the password using password_verify
        if (password_verify($password, $user['PASSWORD'])) {
            // Password is correct, create session
            $_SESSION['objLogin'] = array(
                'username' => $user['username'],
                'branch_id' => $user['branch_id'],
                'role' => $user['member_type_name']
            );

            header("Location: index.php"); // Redirect to home page
            die();
        } else {
            $error_message = "Invalid password!";
        }
    } else {
        $error_message = "Invalid username or branch ID!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>

<body>

    <h2>Login</h2>

    <!-- Show error message if login fails -->
    <?php if (!empty($error_message)) {
        echo "<p style='color:red;'>$error_message</p>";
    } ?>

    <form method="post" action="">
        <label for="txtUsername">Username</label><br>
        <input type="text" name="txtUsername" id="txtUsername" required><br>

        <label for="txtPassword">Password</label><br>
        <input type="password" name="txtPassword" id="txtPassword" required><br>

        <label for="txtBranchID">Branch ID</label><br>
        <input type="text" name="txtBranchID" id="txtBranchID" required><br>

        <input type="submit" value="Login">
    </form>

</body>

</html>