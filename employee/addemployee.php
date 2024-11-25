<?php
include('../config.php');
include('../header.php');
include('../utility/common.php');

// Check if the language file exists before including
$language_file = ROOT_PATH . 'language/en/lang_add_employee.php';
if (file_exists($language_file)) {
    include($language_file);
} else {
    echo "Language file not found!";
}

// Fallback values if $_data is not set
if (!isset($_data)) {
    $_data = [
        'add_new_employee' => 'Add New Employee',
        'save_button_text' => 'Save',
        'added_employee_successfully' => 'Employee added successfully!'
    ];
}

if (!isset($_SESSION['objLogin'])) {
    header("Location: ../logout.php");
    die();
}

$success = "none";
$e_name = $e_email = $e_contact = $e_pre_address = $e_per_address = $e_nid = '';
$e_designation = $e_date = $ending_date = $e_status = 0;
$e_password = $branch_id = $title = $_data['add_new_employee'];
$button_text = $_data['save_button_text'];
$successful_msg = $_data['added_employee_successfully'];

if (isset($_POST['txtEmpName'])) {
    $e_password = $_POST['txtPassword'];
    $image_url = uploadImage($_FILES['uploaded_file']); // Pass the file to the function

    if (isset($_POST['chkEmpStatus'])) {
        $e_status = 1;
    }

    // Prepare the SQL query using a prepared statement
    $sql = "INSERT INTO tbl_add_employee (e_name, e_email, e_contact, e_pre_address, e_per_address, e_nid, e_designation, e_date, ending_date, e_password, e_status, image) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $connect->prepare($sql);
    $stmt->bind_param('ssssssssssss', $_POST['txtEmpName'], $_POST['txtEmpEmail'], $_POST['txtEmpContact'], $_POST['txtEmpPreAddress'], $_POST['txtEmpPerAddress'], $_POST['txtEmpNID'], $_POST['ddlMemberType'], $_POST['txtEmpDate'], $_POST['txtEndingDate'], $e_password, $e_status, $image_url);

    $stmt->execute();
    $stmt->close();
    mysqli_close($connect); // Close the connection

    // Redirect after insertion
    header("Location: " . WEB_URL . "employee/employeelist.php?m=add");
    exit; // Stop further execution
}
?>

<!-- Add Employee Form -->
<form method="post" enctype="multipart/form-data" onsubmit="return validateMe();">
    <input type="text" name="txtEmpName" id="txtEmpName" placeholder="Employee Name" required>
    <input type="email" name="txtEmpEmail" id="txtEmpEmail" placeholder="Employee Email" required>
    <input type="text" name="txtEmpContact" id="txtEmpContact" placeholder="Contact Number" required>
    <textarea name="txtEmpPreAddress" id="txtEmpPreAddress" placeholder="Present Address" required></textarea>
    <textarea name="txtEmpPerAddress" id="txtEmpPerAddress" placeholder="Permanent Address" required></textarea>
    <input type="text" name="txtEmpNID" id="txtEmpNID" placeholder="NID" required>
    <input type="password" name="txtPassword" id="txtPassword" placeholder="Password" required>
    <input type="date" name="txtEmpDate" id="txtEmpDate" required>
    <input type="date" name="txtEndingDate" id="txtEndingDate" required>
    <input type="file" name="uploaded_file" id="uploaded_file">
    <input type="submit" value="Save">
</form>

<?php include('../footer.php'); ?>