<?php
include('../config.php');
include('../header.php');
include('../utility/common.php');
include(ROOT_PATH . 'language/en/lang_employee_list.php');

if (!isset($_SESSION['objLogin'])) {
    header("Location: " . WEB_URL . "logout.php");
    die();
}

$delinfo = 'none';
$addinfo = 'none';
$msg = "";

// Handle delete operation
if (isset($_GET['id']) && $_GET['id'] != '' && $_GET['id'] > 0) {
    $sqlx = "DELETE FROM tbl_add_employee WHERE eid = " . $_GET['id'];
    mysqli_query($connect, $sqlx);
    $delinfo = 'block';
}

// Handle success and update messages
if (isset($_GET['m']) && $_GET['m'] == 'add') {
    $addinfo = 'block';
    $msg = $_data['added_employee_successfully'];
}

if (isset($_GET['m']) && $_GET['m'] == 'up') {
    $addinfo = 'block';
    $msg = $_data['update_employee_successfully'];
}

// Ensure we check if the table exists before proceeding
$checkTableQuery = "SHOW TABLES LIKE 'tbl_add_member_type'";
$tableResult = mysqli_query($connect, $checkTableQuery);

if (mysqli_num_rows($tableResult) == 0) {
    die("Error: The table 'tbl_add_member_type' does not exist in the database.");
}

// Now, safely run the query to retrieve employee data
$sql = "SELECT e.*, mt.member_type FROM tbl_add_employee e
        LEFT JOIN tbl_add_member_type mt ON mt.member_id = e.e_designation
        WHERE e.branch_id = " . (int)$_SESSION['objLogin']['branch_id'];

$result = mysqli_query($connect, $sql);
if (!$result) {
    die("Error executing query: " . mysqli_error($connect));
}
?>

<!-- Display employee list -->
<table>
    <thead>
        <tr>
            <th>Image</th>
            <th>Name</th>
            <th>Email</th>
            <th>Contact</th>
            <th>Designation</th>
            <th>Join Date</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Fetch and display employees
        while ($row = mysqli_fetch_array($result)) {
            $image = WEB_URL . 'img/no_image.jpg'; // Default image if none exists
            if (file_exists(ROOT_PATH . '/img/upload/' . $row['image']) && $row['image'] != '') {
                $image = WEB_URL . 'img/upload/' . $row['image'];
            }
        ?>
            <tr>
                <td><img src="<?php echo $image; ?>" alt="Employee Image" width="50"></td>
                <td><?php echo $row['e_name']; ?></td>
                <td><?php echo $row['e_email']; ?></td>
                <td><?php echo $row['e_contact']; ?></td>
                <td><?php echo isset($row['member_type']) ? $row['member_type'] : 'Not Available'; ?></td>
                <td><?php echo $row['e_date']; ?></td>
                <td>
                    <a href="edit_employee.php?id=<?php echo $row['eid']; ?>">Edit</a>
                    <a href="employeelist.php?id=<?php echo $row['eid']; ?>" onclick="return confirm('Are you sure?');">Delete</a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<?php include('../footer.php'); ?>