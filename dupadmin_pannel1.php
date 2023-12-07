<?php
// $validUsername = "admin";
// $validPassword = "admin123";

// if ($_SERVER["REQUEST_METHOD"] === "POST") {
//     $username = $_POST["username"];
//     $password = $_POST["password"];
//     $userType = $_POST["userType"];

//     // Perform authentication checks
//     if ($username === $validUsername && $password === $validPassword) {
//         // Authentication successful, redirect based on userType
//         if ($userType === "admin") {
//             header("Location: http://localhost/phpglab1/admin_pannel1.php");
//             exit;
//         } elseif ($userType === "staff") {
//             header("Location: http://localhost/phpglab1/staff_pannel.php");
//             exit;
//         } elseif ($userType === "parent") {
//             header("Location: parent_panel.php");
//             exit;
//         } elseif ($userType === "student") {
//             header("Location: studentpanel.php");
//             exit;
//         }
//     } else {
//         // Authentication failed, handle as per your application's logic
//         echo "Invalid username or password. Please try again.";
//     }
// }

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Panel</title>
  <link rel="stylesheet" href="admin_panel.css">
  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      display: flex;
    }

    .sidebar {
      height: 100vh;
      width: 200px;
      background-color: #f5f5f5;
      padding: 20px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    .sidebar h2 {
      text-align: center;
    }

    .sidebar ul {
      list-style-type: none;
      padding: 0;
    }

    .sidebar a {
      display: block;
      padding: 10px;
      text-decoration: none;
      color: #000;
    }

    .sidebar a:hover {
      background-color: #e0e0e0;
    }

    .content-wrapper {
      display: flex;
      flex-direction: column;
      margin-top: 20px;
      margin-left: 20px;
    }

    .content-box {
      background-color: #f9f9f9;
      padding: 20px;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      transition: all 0.3s ease;
      margin-bottom: 30px;
    }

    .content-box p {
      font-size: 20px;
      text-align: center;
      color: #333;
    }

    .content-box span {
      display: block;
      margin-top: 10px;
      font-size: 24px;
      color: #008080;
      text-align: center;
    }

    .content-box:hover {
      transform: scale(1.1);
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
    }
  </style>
</head>
<body>


  <div class="sidebar">
    <h2>Menu</h2>
    <ul>
      <li class="submenu">
        <a href="#">Students</a>
        <ul>
          <li>
            <a href="http://localhost/phpglab3/index3.php">Add and view Students</a>
          </li>
        </ul>
      </li>

      <li class="submenu">
        <a href="#">Staff</a>
        <ul>
          <li>
            <a href="http://localhost/phpglab3/index2.php">Add and view staffs</a>
          </li>
        </ul>
      </li>

      <li class="submenu">
        <a href="#">Class Reports</a>
        <ul>
          <li>
            <a href="http://localhost/phpglab3/index4.php">Add and view reports</a>
          </li>
        </ul>
      </li>
    </ul>
  </div>

  <div class="content-wrapper">
    <div class="content-box">
      <?php
        require 'dbconnect.php';

        $sql = "SELECT * FROM `students`";
        $result = mysqli_query($conn, $sql);
        
        $num = mysqli_num_rows($result);
      ?>
      <p>Registered number of students: <span style="color: #008080; font-weight: bold;"><?php echo $num; ?></span></p>
    </div>



    <div class="content-box">
      <?php
        require 'dbconnect.php';

        $sql = "SELECT * FROM `staffs`";
        $result = mysqli_query($conn, $sql);
        
        $num = mysqli_num_rows($result);
      ?>
      <p>Registered number of staffs: <span style="color: #008080; font-weight: bold;"><?php echo $num; ?></span></p>
    </div>


    <div class="content-box">
      <?php
        require 'dbconnect.php';

        $sql = "SELECT * FROM `attendance`";
        $result = mysqli_query($conn, $sql);
        
        $num = mysqli_num_rows($result);
      ?>
      <p>Total classes taken: <span style="color: #008080; font-weight: bold;"><?php echo $num; ?></span></p>
    </div>
  </div>


  

</body>
</html>
