<?php
session_start(); // Start the session

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

// Initialize $selectedStudentId
$selectedStudentId = null;

// Check if a student is selected
if (isset($_POST['studentId'])) {
    $selectedStudentId = $_POST['studentId'];
    $selectedStudentQuery = "SELECT * FROM `students` WHERE `sno` = $selectedStudentId";
    $selectedStudentResult = mysqli_query($conn, $selectedStudentQuery);

    if ($selectedStudentResult) {
        $currentStudentInfo = mysqli_fetch_assoc($selectedStudentResult);

        // Store the selected student's information in a session
        $_SESSION['currentStudentInfo'] = $currentStudentInfo;
    }
}
if (isset($_GET['delete']) && $selectedStudentId !== null) {
    $sno = $_GET['delete'];
    $delete = true;
    $sql = "DELETE FROM `attendance` WHERE `id` = $sno AND `studentId` = $selectedStudentId";

    // Debugging: Output the SQL query
    echo "SQL Query: $sql";

    $result = mysqli_query($conn, $sql);

    // Debugging: Output the result
    echo "Result: $result";

    if ($result) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to delete record']);
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['snoEdit'])) {
        $sno = $_POST["snoEdit"];
        $names = $_POST["nameedit"];
        $usernames = $_POST["usernameedit"];
        $passwords = $_POST["passwordedit"];

        // Use the selected student's ID from the session in the SQL query
        $selectedStudentId = $_SESSION['currentStudentInfo']['sno'];
        $sql = "UPDATE `attendance` SET `subjectName`='$names', `classesHeld`='$usernames', `classesAttended`='$passwords' WHERE `id`='$sno' AND `studentId`='$selectedStudentId'";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            $update = true;
        } else {
            echo "Couldn't update successfully";
        }
    } else {
        if (isset($_POST['userName']) && isset($_POST['passwords']) && isset($_POST['subjectName']) && $selectedStudentId !== null) {
            $username = $_POST["userName"];
            $password = $_POST["passwords"];
            $selectedSubject = $_POST['subjectName']; // Get the selected subject

            // Use the selected student's ID from the session in the SQL query
            $selectedStudentId = $_SESSION['currentStudentInfo']['sno'];
            $sql = "INSERT INTO `attendance` (`subjectName`, `classesHeld`, `classesAttended`, `studentId`) VALUES ('$selectedSubject', '$username', '$password', '$selectedStudentId')";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                $insert = true;
            } else {
                echo "The record was not inserted successfully " . mysqli_error($conn);
            }
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Rest of your head content... -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>iNotes Notes taking made easy</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
</head>
<body>
    <!-- Rest of your HTML content... -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="editModalLabel">Edit this List</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="/phpglab3/staff_pannel3.php" method="POST">
      <div class="modal-body">
        
         <input type="hidden" name="snoEdit" id="snoEdit">
        <div class="mb-3">
          <label for="title" class="form-label">Subject Name</label>
          <input
            type="text"
            class="form-control"
            id="nameedit" name="nameedit"
            aria-describedby="emailHelp"
          />
        </div>

        <div class="mb-3">
          <label for="title" class="form-label">Class Held</label>
          <input
            type="number"
            class="form-control"
            id="usernameedit" name="usernameedit"
            aria-describedby="emailHelp"
          />
        </div>

        <div class="mb-3">
          <label for="title" class="form-label">Class Attended</label>
          <input
            type="number"
            class="form-control"
            id="passwordedit" name="passwordedit"
            aria-describedby="emailHelp"
          />
        </div>
      

        <button type="submit" class="btn btn-primary">Update Note</button>
      
      </div>
   
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
      </form>
    </div>
  </div>
</div>

    <!-- Making a container class -->
    <?php
if($insert){

  echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success</strong></strong> You note has been inserted successfully
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}

?>
    <?php
if($delete){

  echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success</strong></strong> You note has been deleted successfully
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}

?>
    <?php
if($update){

  echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success</strong></strong> You note has been updated successfully
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}

?>

<?php require 'nav.php'; ?>

    <div class="container mt-3">
      <h2>Add Attendance</h2>
      
      <form action="/phpglab3/staff_pannel3.php?" method="POST">
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
        <label for="subjectName" class="form-label">Subject Name</label>
    <select class="form-control" id="subjectName" name="subjectName">
        <option value="">Select Subject</option>
        <option value="TOC">TOC</option>
        <option value="DBMS">DBMS</option>
        <option value="OS">OS</option>
        <option value="RM">RM</option>
        <option value="FMSS">FMSS</option>
        <option value="CNC">CNC</option>
        <option value="EVS">EVS</option>
    </select>
</div>

        <div class="mb-3">
          <label for="userName" class="form-label">Classes Held</label>
          <input
            type="number"
            class="form-control"
            id="userName" name="userName"
            aria-describedby="emailHelp"
          />
        </div>


        <div class="mb-3">
          <label for="passwords" class="form-label">Classes Attended</label>
          <input
            type="number"
            class="form-control"
            id="passwords" name="passwords"
            aria-describedby="emailHelp"
          />
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
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
                if ($selectedStudentId !== null) {
                    $sql = "SELECT * FROM `attendance` WHERE `studentId` = $selectedStudentId";
                    $result = mysqli_query($conn, $sql);
                    $sno = 0;
                    while ($row = mysqli_fetch_assoc($result)) {
                        $sno = $sno + 1;
                        echo "<tr>
                            <th scope='row'>" . $sno . "</th>
                            <td>" . $row['subjectName'] . "</td>
                            <td>" . $row['classesHeld'] . "</td>
                            <td>" . $row['classesAttended'] . "</td>
                            <td><button class='edit btn btn-sm btn-primary' id=" . $row['id'] . ">Edit</button> </td>
                        </tr>";
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
    <hr>
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
        $(document).ready(function () {
            $('#myTable').DataTable();
        });
    </script>

    <script>
        edits = document.getElementsByClassName('edit');
        Array.from(edits).forEach((element) => {
            element.addEventListener("click", (e) => {
                console.log("edit");
                tr = e.target.parentNode.parentNode;
                name = tr.getElementsByTagName("td")[0].innerText;
                username = tr.getElementsByTagName("td")[1].innerText;
                passwword = tr.getElementsByTagName("td")[2].innerText;

                nameedit.value = name;
                usernameedit.value = username;
                passwordedit.value = passwword;
                snoEdit.value = e.target.id;
                console.log(e.target.id);
                $('#editModal').modal('toggle');
            })
        });

    
        deletes = document.getElementsByClassName('delete');
    Array.from(deletes).forEach((element) => {
        element.addEventListener("click", (e) => {
            sno = e.target.id.substr(1,);
            if (confirm("Are you sure you want to delete this note?")) {
                console.log("yes");
                window.location = `/phpglab3/staff_pannel3.php?delete=${sno}`;
            } else {
                console.log("no");
            }
        });
    });

       
    </script>
</body>
</html>
