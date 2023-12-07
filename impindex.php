
<?php
include('dbconnect.php');


include('dbconnect1.php');

session_start();

// Function to validate staff credentials
function isValidStaffCredentials($username, $password, $conn_staffs) {
    $sql = "SELECT * FROM `staffs` WHERE `Username`='$username' AND `password`='$password'";
    $result = mysqli_query($conn_staffs, $sql);
    return mysqli_num_rows($result) > 0;
}

// Function to validate student credentials
function isValidStudentCredentials($username, $password, $conn_students) {
    $sql = "SELECT * FROM `students` WHERE `Username`='$username' AND `password`='$password'";
    $result = mysqli_query($conn_students, $sql);
    return mysqli_num_rows($result) > 0;
}

// Your existing code...

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $userType = strtolower($_POST["userType"]);

    // Perform proper validation for user credentials
    if ($userType == "admin" && $username == "admin" && $password == "admin123") {
        header("Location: http://localhost/phpglab1/admin_pannel1.php");
        exit;
    } elseif ($userType == "staff" && isValidStaffCredentials($username, $password, $conn_staffs)) {
        header("Location: http://localhost/phpglab1/staff_pannel.php");

        exit;
    } elseif ($userType == "student" && isValidStudentCredentials($username, $password, $conn_students)) {
        header("Location: http://localhost/phpglab1/studentpanel.php");
        $_SESSION['username'] = $username;
        exit;
    } else {
        // Handle invalid credentials
        $showError = "Invalid username or password for the selected user type";
    }
}

?>