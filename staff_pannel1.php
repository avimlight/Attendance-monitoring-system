<?php
// Start the session
session_start();

// Clear the current student information from the session if "Next Student" is clicked
if (isset($_GET['next']) && $_GET['next'] == true) {
    unset($_SESSION['current_student']);
    header("Location: /phpglab3/staff_pannel1.php");
    exit();
}

$insert = false;
$update = false;
$delete = false;
$servername = "localhost";
$username = "root";
$password = "";
$database = "attendance1";
$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Insert new record
    if (isset($_POST['studentId']) && isset($_POST['names']) && isset($_POST['userName']) && isset($_POST['passwords'])) {
        $studentId = $_POST['studentId'];
        $name = $_POST["names"];
        $classesHeld = $_POST["userName"];
        $classesAttended = $_POST["passwords"];

        // Insert the new record into the database (use prepared statement to prevent SQL injection)
        $sql = "INSERT INTO `attendance` (`sno`, `subjectName`, `classesHeld`, `classesAttended`) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ssss", $studentId, $name, $classesHeld, $classesAttended);
        $result = mysqli_stmt_execute($stmt);

        if ($result) {
            $insert = true;
        } else {
            echo "Couldn't insert the record";
        }

        // Redirect to the same page
        header("Location: /phpglab3/staff_pannel1.php?" . session_name() . '=' . session_id());
        exit();
    }
}

// Get the currently selected student's information
$currentStudentInfo = array();
if (isset($_SESSION['current_student']) && !empty($_SESSION['current_student'])) {
    $currentStudentInfo = $_SESSION['current_student'];
}

// Display the attendance records from the database for the selected student
$sql = "SELECT * FROM `attendance`";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>iNotes Notes taking made easy</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
</head>
<body>

<?php require 'nav.php'; ?>

<div class="container mt-3">
    <h2>Add attendance</h2>

    <?php
    // Display success messages here
    ?>

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">

        <!-- Dropdown list for selecting student -->
        <div class="mb-3">
            <label for="studentId" class="form-label">Select Student</label>
            <select class="form-control" id="studentId" name="studentId">
                <option value="">Select Student</option>
                <?php
                $studentQuery = "SELECT `sno`, `Username` FROM `students`";
                $studentResult = mysqli_query($conn, $studentQuery);
                while ($studentRow = mysqli_fetch_assoc($studentResult)) {
                    $selected = '';
                    // Check if the student is the current one in the session
                    if (!empty($currentStudentInfo) && $currentStudentInfo['sno'] == $studentRow['sno']) {
                        $selected = 'selected';
                    }
                    echo "<option value='" . $studentRow['sno'] . "' $selected>" . $studentRow['Username'] . "</option>";
                }
                ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="names" class="form-label">Subject Name</label>
            <input type="text" class="form-control" id="names" name="names" aria-describedby="emailHelp" value="<?php echo $currentStudentInfo['subjectName'] ?? ''; ?>" />
        </div>

        <div class="mb-3">
            <label for="userName" class="form-label">Classes Held</label>
            <input type="number" class="form-control" id="userName" name="userName" aria-describedby="emailHelp" value="<?php echo $currentStudentInfo['classesHeld'] ?? ''; ?>" />
        </div>

        <div class="mb-3">
            <label for="passwords" class="form-label">Classes Attended</label>
            <input type="number" class="form-control" id="passwords" name="passwords" aria-describedby="emailHelp" value="<?php echo $currentStudentInfo['classesAttended'] ?? ''; ?>" />
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
        <?php
        // Display a "Next Student" button if there are more students to input
        if (!empty($currentStudentInfo)) {
            echo '<a href="?next=true" class="btn btn-success mt-2">Next Student</a>';
        }
        ?>

    </form>
</div>

<div class="container my-4">
    <table class="table" id="myTable">
        <thead>
            <tr>
                <th scope="col">S.No</th>
                <th scope="col">Subject Name</th>
                <th scope="col">Classes Held</th>
                <th scope="col">Classes Attended</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sno = 0;
            while ($row = mysqli_fetch_assoc($result)) {
                $sno = $sno + 1;
                echo "<tr>
                    <th scope='row'> " . $sno . "</th>
                    <td>" . $row['subjectName'] . "</td>
                    <td>" . $row['classesHeld'] . "</td>
                    <td>" . $row['classesAttended'] . "</td>
                    <td><button class='edit btn btn-sm btn-primary' id=" . $row['sno'] . ">Edit</button> <button class='delete btn btn-sm btn-danger' id=d" . $row['sno'] . ">Delete</button></td>
                </tr>";
            }
            ?>
        </tbody>
    </table>
</div>
<hr>

<!-- ... (your existing script content) ... -->
<script
  src="https://code.jquery.com/jquery-3.7.1.js"
  integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
  crossorigin="anonymous"></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
      crossorigin="anonymous"
    ></script>
 
    <script src="//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
 
    <script>
      $(document).ready(function(){
        $('#myTable').DataTable();
      });
    </script>

<script>

edits=document.getElementsByClassName('edit');
Array.from(edits).forEach((element)=>{
element.addEventListener("click",(e)=>{

  console.log("edit");
  tr=e.target.parentNode.parentNode;
  name=tr.getElementsByTagName("td")[0].innerText;
  username=tr.getElementsByTagName("td")[1].innerText;
  passwword=tr.getElementsByTagName("td")[2].innerText;
  
  nameedit.value=name;
  usernameedit.value=username;
  passwordedit.value=passwword;
  snoEdit.value=e.target.id
  console.log(e.target.id);
  $('#editModal').modal('toggle');

})
  
});


deletes=document.getElementsByClassName('delete');
Array.from(deletes).forEach((element)=>{
element.addEventListener("click",(e)=>{


sno=e.target.id.substr(1,);
 if(confirm("are u sure u want to  delete this note")){

  console.log("yes");
  window.location=`/phpglab3/staff_pannel1.php?delete=${sno}`;
 }
 else{
  console.log("no");
 }
})
  
});
   </script>

</body>
</html>
