<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['objLogin'])) {
    header("Location: index.php");  // Redirect to the index page if not logged in
    exit;
}

// Database connection (change it according to your config file)
include('config.php');

// Query to count the number of employees
$sql = "SELECT COUNT(*) as total_employees FROM tbl_add_employee"; // Modify this query as per your database structure
$result = mysqli_query($connect, $sql);
$row = mysqli_fetch_assoc($result);
$total_employees = $row['total_employees'];

$user = $_SESSION['objLogin'];  // Get the logged-in user details
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="styles.css"> <!-- Add your CSS files here -->
</head>

<body>

    <!-- Include the header.php file -->
    <?php include('header.php'); ?>

    <div class="content">
        <h2>Welcome, <?php echo $user['username']; ?>!</h2>
        <h3>Total Employees: <?php echo $total_employees; ?></h3>
    </div>

    <!-- Include the footer.php file -->
    <?php include('footer.php'); ?>
</body>

</html>