<?php
session_start();
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

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>iNotes Notes taking made easy</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <style>
        .table {
            color: black;
            width: 80%;
            margin: auto;
            margin-top: 50px;
        }

        th,
        td {
            border: 1px solid black;
            padding: 10px;
            text-align: center;
        }

        th {
            background-color: #343a40;
            color: white;
        }

        tbody tr:nth-of-type(odd) {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>

    <?php include 'nav.php' ?>;
    <div class="container my-4">
        <div class="alert alert-success" role="alert">
            <h4 class="alert-heading"> Welcome <?php echo $_SESSION["username"]; ?></h4>
            <p>Hey how are you you are logged in as <?php echo $_SESSION["username"]; ?> Aww yeah, you successfully read this important alert message. This example text is going to run a bit longer so that you can see how spacing within an alert works with this kind of content.</p>
            <hr>
            <p class="mb-0">Whenever you need to, be sure to logout using this link <a href="/phpglab3/logout.php">Logout </a>.</p>
        </div>
    </div>

    <table class="table" id="myTable">
        <thead>
            <tr>
                <th scope="col">S.No</th>
                <th scope="col">Subject Name</th>
                <th scope="col">Classes Held</th>
                <th scope="col">Classes Attended</th>
                <th scope="col">Attendance Percentage</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Retrieve the student ID of the logged-in user
            $loggedInUsername = $_SESSION['username'];
            $studentIdQuery = "SELECT `sno` FROM `students` WHERE `Username` = '$loggedInUsername'";
            $studentIdResult = mysqli_query($conn, $studentIdQuery);
            
            if ($studentIdResult && $row = mysqli_fetch_assoc($studentIdResult)) {
                $studentId = $row['sno'];

                // Use the student ID to fetch attendance records
                $sql = "SELECT * FROM `attendance` WHERE `studentId` = $studentId";
                $result = mysqli_query($conn, $sql);
                $sno = 0;
                while ($row = mysqli_fetch_assoc($result)) {
                    $sno = $sno + 1;
                    $attendancePercentage = ($row['classesAttended'] / $row['classesHeld']) * 100;
                    echo "<tr>
                        <th scope='row'>" . $sno . "</th>
                        <td>" . $row['subjectName'] . "</td>
                        <td>" . $row['classesHeld'] . "</td>
                        <td>" . $row['classesAttended'] . "</td>
                        <td>" . number_format($attendancePercentage, 2) . "</td>
                    </tr>";
                }
            }
            ?>
        </tbody>
    </table>

    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>
