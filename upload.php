<?php
include('./server.php');
include('server1.php'); 
if (isset($_SESSION['username'])) {
    


if(isset($_POST['solution'])){
    $ques_numo = $_POST['ques_numr'];
    $filename = $_FILES['myfile']['name'];

    // destination of the file on the server
    $destination = 'solutions/' . $filename;

    // get the file extension
    $extension = pathinfo($filename, PATHINFO_EXTENSION);

    // the physical file on a temporary solutions directory on the server
    $file = $_FILES['myfile']['tmp_name'];
    $size = $_FILES['myfile']['size'];

    if (!in_array($extension, ['zip', 'pdf', 'docx'])) {
        echo "You file extension must be .zip, .pdf or .docx";
    } elseif ($_FILES['myfile']['size'] > 1000000) { // file shouldn't be larger than 1Megabyte
        echo "File too large!";
    } else {
        // move the uploaded (temporary) file to the specified destination
        if (move_uploaded_file($file, $destination)) {
            $sql = "INSERT INTO answers (question_number,solution) VALUES ('$ques_numo','$filename') ";
            $result = mysqli_query($conn, $sql);
            
            if ($result) {
                echo 'File uploaded successfully';
                header('location: admin.php');
            }
        } else {
            echo "Failed to upload file.";
        }
    }

}
}
else{
    header("location: loginadmin.php");
    
  }
?>