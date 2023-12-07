

<?php
// Include the student database connection file
include('dbconnect.php'); 




session_start();

// Function to validate staff credentials
function isValidStaffCredentials($username, $password, $conn) {
    $sql = "SELECT * FROM `staffs` WHERE `Username`='$username' AND `password`='$password'";
    $result = mysqli_query($conn, $sql);
    return mysqli_num_rows($result) > 0;
}

// Function to validate student credentials
function isValidStudentCredentials($username, $password, $conn) {
    $sql = "SELECT * FROM `students` WHERE `Username`='$username' AND `password`='$password'";
    $result = mysqli_query($conn, $sql);
    return mysqli_num_rows($result) > 0;
}

// Your existing code...

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $userType = strtolower($_POST["userType"]);

    // Perform proper validation for user credentials
    if ($userType == "admin" && $username == "admin" && $password == "lightyagami@2003") {
        header("Location: http://localhost/phpglab3/admin_pannel1.php");
        exit;
    } elseif ($userType == "staff" && isValidStaffCredentials($username, $password, $conn)) {
        header("Location: http://localhost/phpglab3/staff_pannel3.php");

        exit;
    } elseif ($userType == "student" && isValidStudentCredentials($username, $password, $conn)) {
        header("Location: http://localhost/phpglab3/studentpanel.php");
        $_SESSION['username'] = $username;
     
        exit;
    } else {
        // Handle invalid credentials
        $showError = "Invalid CredentialsTry again ";
        // echo '<p class="error-message">' . $showError . '</p>';
        
    }
}

// include('dbconnect.php');
// include('dbconnect1.php');

// session_start();

// // Function to validate staff credentials
// function isValidStaffCredentials($username, $password, $conn_staffs) {
//     $sql = "SELECT * FROM `staffs` WHERE `Username`=? AND `password`=?";
//     $stmt = mysqli_prepare($conn_staffs, $sql);
//     mysqli_stmt_bind_param($stmt, "ss", $username, $password);
//     mysqli_stmt_execute($stmt);
//     $result = mysqli_stmt_get_result($stmt);
//     return mysqli_num_rows($result) > 0;
// }

// // Function to validate student credentials
// function isValidStudentCredentials($username, $password, $conn_students) {
//     $sql = "SELECT * FROM `students` WHERE `Username`=? AND `password`=?";
//     $stmt = mysqli_prepare($conn_students, $sql);
//     mysqli_stmt_bind_param($stmt, "ss", $username, $password);
//     mysqli_stmt_execute($stmt);
//     $result = mysqli_stmt_get_result($stmt);
//     return mysqli_num_rows($result) > 0;
// }

// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     $username = filter_var($_POST["username"], FILTER_SANITIZE_STRING);
//     $password = filter_var($_POST["password"], FILTER_SANITIZE_STRING);
//     $userType = strtolower($_POST["userType"]);

//     if ($userType == "admin" && $username == "admin" && $password == "admin123") {
//         header("Location: http://localhost/phpglab1/admin_pannel1.php");
//         exit;
//     } elseif ($userType == "staff" && isValidStaffCredentials($username, $password, $conn_staffs)) {
//         header("Location: http://localhost/phpglab1/staff_pannel.php");
//         exit;
//     } elseif ($userType == "student" && isValidStudentCredentials($username, $password, $conn_students)) {
//         header("Location: http://localhost/phpglab1/studentpanel.php");
//         $_SESSION['username'] = $username;
//         exit;
//     } else {
//         $showError = "Invalid username or password for the selected user type";
//     }
// }



// error_reporting(E_ALL);
// ini_set('display_errors', 1);

// $login = false;
// $showError = false;

// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     $username = $_POST["username"];
//     $password = $_POST["password"];
//     $userType = strtolower($_POST["userType"]);

//     // Special case for admin
//     if ($userType == "admin" && $username == "admin" && $password == "admin123") {
//         header("Location: http://localhost/phpglab1/admin_pannel1.php");
//         exit;
//     }

//     // Define an array to map user types to redirection pages
//     $redirectPages = [
//         'staff' => 'staff_pannel.php',
//         'student' => 'studentpanel.php',
//         // Add more user types and pages as needed
//     ];

//     // Check if the user type exists in the array
//     if (array_key_exists($userType, $redirectPages)) {
//         // Redirect to the corresponding page
//         header("Location: http://localhost/phpglab1/" . $redirectPages[$userType]);
//         exit;
//     } else {
//         // Handle unsupported user type
//         $showError = "Invalid user type";
//     }
// }




?>


 







<!-- <!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login to our website</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
  <body>

<?php
if($login){
  echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success</strong>Your logged in
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}

// if($showError){
//     echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
//     <strong>Error</strong>'.$showError.'
//     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
//   </div>';
//   }
// ?>
  <div class="container my-4">
    <h1 class="text-center">Login to our website</h1>
    <form action="/loginf/login.php" method="post">
  <div class="mb-3 ">
    <label for="username" class="form-label">Username</label>
    <input type="text" class="for m-control" id="username" name="username" aria-describedby="emailHelp">
  
  </div>
  <div class="mb-3 ">
    <label for="password" class="form-label">Password</label>
    <input type="password" class="form-control" id="password" name="password">
  </div>


  <button type="submit" class="btn btn-primary ">Login</button>
</form>
  </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
  </body>
</html> --> --> 
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login Page</title>
    <link rel="stylesheet" href="style.css" />
  </head>

  <body>


  <?php

  // Display error message if present
  if (isset($showError)) {
    echo '<p class="error-message" >' . $showError . '</p>';
}


?>
    <div class="login-form">
      <h1 class="text-center">Attendance Monitoring System</h1>
      <form
        id="loginForm"
        action="/phpglab3/index.php"
        method="post"
      >
        <div class="form-group">
          <input
            type="text"
            class="form-control"
            placeholder="Username"
            id="username"
            name="username"
            required
          />
        </div>
        <div class="form-group">
          <input
            type="password"
            class="form-control"
            placeholder="Password"
            id="password"
            name="password"
            required
          />
        </div>
        <div class="form-group">
          <select class="form-control" id="userType" name="userType">
            <option value="admin">Admin</option>
            <option value="staff">Staff</option>
           
            <option value="student">Student</option>
          </select>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Login</button>
      </form>
    </div>
  </body>
</html>
