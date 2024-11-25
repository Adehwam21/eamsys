<?php
include('../config.php'); // Include your database configuration file

// Admin user data
$branch_id = 1;
$username = 'admin';
$password = '1234';
$hashed_password = password_hash($password, PASSWORD_BCRYPT); // Hash the password using bcrypt
$role = 'admin';
$member_type = 'Admin';
$status = 'active';

// SQL query to insert the admin into the tbl_add_member_type table
$sql = "INSERT INTO tbl_add_member_type (branch_id, username, password, role, member_type, status) 
        VALUES ('$branch_id', '$username', '$hashed_password', '$role', '$member_type', '$status')";

// Execute the SQL query
if (mysqli_query($connect, $sql)) {
    echo "Admin added successfully!";
} else {
    echo "Error: " . mysqli_error($connect); // Print any error if the query fails
}

mysqli_close($connect);
