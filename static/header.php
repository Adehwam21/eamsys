<?php
session_start();
// Check if user is logged in
if (!isset($_SESSION['objLogin'])) {
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Management</title>
    <link rel="stylesheet" href="styles.css"> <!-- Add your CSS files here -->
</head>

<body>
    <div class="container">
        <!-- Navigation and other header elements can go here -->
        <header>
            <h1>Employee Management System</h1>
            <nav>
                <ul>
                    <li><a href="<?php echo WEB_URL; ?>static/dashboard.php">Dashboard</a></li>
                    <li><a href="<?php echo WEB_URL; ?>employee/employeelist.php">Employee List</a></li>
                    <li><a href="<?php echo WEB_URL; ?>employee/addemployee.php">Add Employee</a></li>
                    <li><a href="<?php echo WEB_URL; ?>static/logout.php">Logout</a></li>
                </ul>
            </nav>
        </header>