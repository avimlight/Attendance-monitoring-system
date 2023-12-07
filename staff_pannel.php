<?php

$insert=false;
$update=false;
$delete=false;
$servername="localhost";
$username="root";
$password="";
$database="attendance1";
$conn=mysqli_connect($servername,$username,$password,$database);


if(!$conn){
die("connection failed".mysqli_connect_error());  

}

if(isset($_GET['delete']))
{

  $sno=$_GET['delete'];
 $delete=true;
  $sql="DELETE FROM `attendance` WHERE `sno`=$sno";
  $result=mysqli_query($conn,$sql);
}
if($_SERVER["REQUEST_METHOD"]=="POST"){
  if(isset($_POST['snoEdit'])){
    //update the record
$sno=$_POST["snoEdit"];
 $names=$_POST["nameedit"];
 $usernames=$_POST["usernameedit"];
 $passwords=$_POST["passwordedit"];


 $sql="UPDATE `attendance` SET `subjectName`='$names',`classesHeld` = '$usernames',`classesAttended`='$passwords' WHERE `attendance`.`sno` = $sno";
$result=mysqli_query($conn,$sql);
if($result){
$update=true;
}
else{
  echo "coouldnt update successfully";
}
 

  }
  else{
    if (isset($_POST['names']) && isset($_POST['userName']) && isset($_POST['passwords'])) {
$name=$_POST["names"];
$username=$_POST["userName"];
$password=$_POST["passwords"];


$sql="INSERT INTO `attendance` (`subjectName`,`classesHeld`,`classesAttended`) VALUES ('$name','$username','$password')";
$result=mysqli_query($conn,$sql);

if($result){

  // echo "the record has been inserted succesfully<br>";
  $insert=true;
 }
 else{
 
   echo "the record was not inserted succesfully ".mysqli_error($conn);
 }
 
 }
 }
    }


?>
<!DOCTYPE html>
<html lang="en">
  <head>
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

  </head>
  <body>
    <!-- Button Eddit modal -->
<!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal">
   editModallabel
</button> -->

<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="editModalLabel">Edit this List</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      . <form action="/phpglab3/staff_pannel.php" method="POST">
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

    <!-- Making an container class -->
    <?php
if($insert){

  echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success</strong></strong> You note has been inserted succesfully
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}

?>
    <?php
if($delete){

  echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success</strong></strong> You note has been deleted succesfully
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}

?>
    <?php
if($update){

  echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success</strong></strong> You note has been updated succesfully
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}

?>

<?php require 'nav.php'?>;

    <div class="container mt-3">
      <h2>Add the attendance</h2>
      
      <form action="/phpglab3/staff_pannel.php?" method="POST">
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

    
          <input
            type="text"
            class="form-control"
            id="names" name="names"
            aria-describedby="emailHelp"
          />
        </div>
        <div class="mb-3">
          <label for="userName" class="form-label">classes Held</label>
          <input
            type="number"
            class="form-control"
            id="userName" name="userName"
            aria-describedby="emailHelp"
          />
        </div>


        <div class="mb-3">
          <label for="passwords" class="form-label">classes Attended</label>
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
$sql="SELECT * FROM `attendance`";
$result=mysqli_query($conn,$sql);
$sno=0;
while($row=mysqli_fetch_assoc($result)){
  $sno=$sno+1;
  echo "<tr>
  <th scope='row'> ".$sno."</th>
  <td>".$row['subjectName']."</td>
  <td>".$row['classesHeld']."</td>
  <td>".$row['classesAttended']."</td>
  <td><button class='edit btn btn-sm btn-primary' id=".$row['sno'].">Edit</button> <button class='delete btn btn-sm btn-danger' id=d".$row['sno'].">Delete</button></td>

</tr>";
 
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
  window.location=`/phpglab3/staff_pannel.php?delete=${sno}`;
 }
 else{
  console.log("no");
 }
})
  
});
   </script>
  </body>
</html>