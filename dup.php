//  $login=false;
//  $showError=false;

// if($_SERVER["REQUEST_METHOD"]=="POST"){
   
// $username=$_POST["username"];
// $password=$_POST["password"];
// $userType = $_POST["userType"];




// // $sql="Select *from users where username='$username' AND password='$password'";
//  include 'dbconnect1.php';
// $sql="SELECT *FROM staffs WHERE Username='$username' AND password='$password'";
// $result=mysqli_query($conn,$sql);
// $num=mysqli_num_rows($result);


// if($num==1 && $userType=="Staff"){
  
      
      
// header("location:  http://localhost/phpglab1/staff_pannel.php");

//         }
//         else{

//             $showError="invalid credentails";
//         }
        
//     }

// 
//     
//  include 'dbconnect.php';
//  $sql="SELECT *FROM students WHERE Username='$username' AND password='$password'";
//  $result=mysqli_query($conn,$sql);
//  $num=mysqli_num_rows($result);
 
 
//  if($num==1 && $userType=="Student"){
   
       
       
//  header("location:  http://localhost/phpglab1/studentpanel.php");
 
//          }
//          else{
 
//              $showError="invalid credentails";
//          }
         
// $login = false;
// $showError = false;

// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     $username = $_POST["username"];
//     $password = $_POST["password"];
//     $userType = $_POST["userType"];

    // Define an array to map user types to database connection files
//     $dbConnectionFiles = [
//         'Admin' => 'dbconnect.php',
//         'Staff' => 'dbconnect1.php',
//         'Student' => 'dbconnect2.php',
//         // Add more as needed
//     ];

//     // Check if the user type exists in the array
//     if (array_key_exists($userType, $dbConnectionFiles)) {
//         // Include the corresponding database connection file
//         include $dbConnectionFiles[$userType];

//         // Perform authentication checks
//         if (isset($conn)) {
//             $sql = "SELECT * FROM users_table WHERE username='$username' AND password='$password'";
//             $result = mysqli_query($conn, $sql);
//             $num = mysqli_num_rows($result);

//             if ($num == 1) {
//                 // Redirect based on user type
//                 switch ($userType) {
//                     case "Admin":
//                         header("Location: http://localhost/phpglab1/admin_pannel1.php");
//                         break;
//                     case "Staff":
//                         header("Location: http://localhost/phpglab1/staff_pannel.php");
//                         break;
//                     case "Student":
//                         header("Location: http://localhost/phpglab1/studentpanel.php");
//                         break;
//                     // Add more cases as needed
//                     default:
//                         $showError = "Invalid user type";
//                 }
//                 exit;
//             } else {
//                 $showError = "Invalid credentials";
//             }

//             // Close the database connection
//             mysqli_close($conn);
//         }
//     } else {
//         // Handle unsupported user type
//         $showError = "Invalid user type";
//     }
// }
// $login = false;
// $showError = false;

// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     $username = $_POST["username"];
//     $password = $_POST["password"];
//     $userType = $_POST["userType"];

//     // Special case for admin
//     if ($userType == "Admin" && $username == "admin" && $password == "admin123") {
//         header("Location: http://localhost/phpglab1/admin_pannel1.php");
//         exit;
//     }

//     // Define an array to map user types to database connection files
//     $dbConnectionFiles = [
        
//         'Staff' => 'dbconnect1.php',
//         'Student' => 'dbconnect2.php',
//         // Add more as needed
//     ];

//     // Check if the user type exists in the array
//     if (array_key_exists($userType, $dbConnectionFiles)) {
//         // Include the corresponding database connection file
//         include $dbConnectionFiles[$userType];

//         // Perform authentication checks
//         if (isset($conn)) {
//             $sql = "SELECT * FROM users_table WHERE username='$username' AND password='$password'";
//             $result = mysqli_query($conn, $sql);
//             $num = mysqli_num_rows($result);

//             if ($num == 1) {
//                 // Redirect based on user type
//                 switch ($userType) {
                  
//                     case "Staff":
//                         header("Location: http://localhost/phpglab1/staff_pannel.php");
//                         exit;
//                     case "Student":
//                         header("Location: http://localhost/phpglab1/studentpanel.php");
//                         exit;
//                     // Add more cases as needed
//                     default:
//                         $showError = "Invalid user type";
//                 }
//             } else {
//                 $showError = "Invalid credentials";
//             }

//             // Close the database connection
//             mysqli_close($conn);
//         }
//     } else {
//         // Handle unsupported user type
//         $showError = "Invalid user type";
//     }
// }



