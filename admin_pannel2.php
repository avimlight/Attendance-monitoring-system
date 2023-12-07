
<?php require 'dbconnect.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Panel</title>
  <!-- Add Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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
      flex: 1; /* Take remaining available space */
    }

    .content-box {
      background-color: #f9f9f9;
      padding: 10px; /* Reduced padding */
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      transition: all 0.3s ease;
      margin-bottom: 20px; /* Reduced margin */
      width: 100%; /* Make the box take full width */
    }

    .content-box p {
      font-size: 16px; /* Reduced font size */
      text-align: center;
      color: #333;
    }

    .content-box span {
      display: block;
      margin-top: 10px;
      font-size: 18px; /* Reduced font size */
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

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">AMS</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item active">
          <a class="nav-link" href="http://localhost/phpglab3/admin_pannel1.php">Home</a>
        </li>
        <!-- Add more navbar links as needed -->
        <li class="nav-item">
          <a class="nav-link" href="#">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="http://localhost/phpglab3/logout.php">Logout</a>
        </li>
      </ul>
    </div>
  </nav>
  
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
        $sql = "SELECT * FROM `students`";
        $result = mysqli_query($conn, $sql);
        $num = mysqli_num_rows($result);
      ?>
      <p>Registered number of students: <div style="color: #008080; font-weight: bold;"><?php echo $num; ?></div></p>
    </div>

    <div class="content-box">
      <?php
        $sql = "SELECT * FROM `staffs`";
        $result = mysqli_query($conn, $sql);
        $num = mysqli_num_rows($result);
      ?>
      <p>Registered number of staffs: <div style="color: #008080; font-weight: bold;"><?php echo $num; ?></div></p>
    </div>

    <div class="content-box">
      <?php
        $sql = "SELECT * FROM `attendance`";
        $result = mysqli_query($conn, $sql);
        $num = mysqli_num_rows($result);
      ?>
      <p>Total classes taken: <div style="color: #008080; font-weight: bold;"><?php echo $num; ?></div></p>
    </div>
  </div>

  <!-- Add Bootstrap JS and Popper.js scripts -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
