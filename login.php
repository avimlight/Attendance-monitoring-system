

//  $login=false;
//  $showError=false;
// include 'dbconnect.php';
// if($_SERVER["REQUEST_METHOD"]=="POST"){
   
// $username=$_POST["username"];
// $password=$_POST["password"];




// // $sql="Select *from users where username='$username' AND password='$password'";
// $sql="Select *from users where username='$username'";
// $result=mysqli_query($conn,$sql);

// $num=mysqli_num_rows($result);


// if($num==1){
//     while($row=mysqli_fetch_assoc($result)){
//         if(password_verify($password,$row['password'])){
//             $login=true;

//             session_start();
// $_SESSION['loggedin']=true;
// $_SESSION['username']=$username;
// header("location: welcome.php");

//         }
//         else{

//             $showError="invalid credentails";
//         }
        
//     }




// }
// else{

//     $showError="invalid credentails";
// }

// }


<?php
$login = false;
$showError = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $userType = $_POST["userType"];

    // Define an array to map user types to database connection files
    $dbConnectionFiles = [
        'Admin' => 'dbconnect.php',
        'Staff' => 'dbconnect.php',
        'Student' => 'dbconnect.php',
        // Add more as needed
    ];

    // Check if the user type exists in the array
    if (array_key_exists($userType, $dbConnectionFiles)) {
        // Include the corresponding database connection file
        include $dbConnectionFiles[$userType];

        // Perform authentication checks
        if (isset($conn)) {
            $sql = "SELECT * FROM users_table WHERE Username='$username' AND password='$password'";
            $result = mysqli_query($conn, $sql);
            $num = mysqli_num_rows($result);

            if ($num == 1) {
                // Redirect based on user type
                switch ($userType) {
                    case "Admin":
                        header("Location: http://localhost/phpglab3/admin_pannel1.php");
                        break;
                    case "Staff":
                        header("Location: http://localhost/phpglab3/staff_pannel.php");
                        break;
                    case "Student":
                        header("Location: http://localhost/phpglab3/studentpanel.php");
                        break;
                    // Add more cases as needed
                    default:
                        $showError = "Invalid user type";
                }
                exit;
            } else {
                $showError = "Invalid credentials";
            }

            // Close the database connection
            mysqli_close($conn);
        }
    } else {
        // Handle unsupported user type
        $showError = "Invalid user type";
    }
}
?>








<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login to our website</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
  <body>
  <?php require 'nav.php' ?>
<?php
if($login){
  echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success</strong>Your logged in
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}

if($showError){
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Error</strong>'.$showError.'
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
  }
?>
  <div class="container my-4">
    <h1 class="text-center">Login to our website</h1>
    <form action="/phpglab3/login.php" method="post">
  <div class="mb-3 ">
    <label for="username" class="form-label">Username</label>
    <input type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp">
  
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
</html>