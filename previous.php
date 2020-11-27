<?php

include('./server.php');
include('server1.php'); 
if (isset($_SESSION['username'])) {

$quesTest = "";

$query4 = "SELECT question, question_number FROM questions ORDER BY question_number DESC";
$result4 = mysqli_query($conn, $query4);

// if ($result4){
//     echo "<br> <br> Previous questions fetched successfully!";
// }
// else{
//     die("Sorry we failed to insert: ". mysqli_error($conn));
// }




$query5 = "SELECT question_number, first, second, third, fourth, fifth FROM winners";
$result5 = mysqli_query($conn, $query5);

// if ($result5){
//     echo "<br> <br> Previous results fetched successfully!";
// }
// else{
//     die("Sorry we failed to insert: ". mysqli_error($conn));
// }



?>

<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>V-Quiz</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
        <!--jQuery library--> 
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <!--Latest compiled and minified JavaScript--> 
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <!-- Custom CSS -->
        <link href="style.css" rel="stylesheet">
    </head>
    <body>
        <div class="navbar navbar-inverse navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar" style="background-color:white;">
                        <span class="icon-bar" style="background-color:black;"></span>
                        <span class="icon-bar " style="background-color:black;"></span>
                        <span class="icon-bar" style="background-color:black;"></span>                        
                    </button>
                    <a class="navbar-brand" href="" >V-Quiz  - ADMIN PORTAL </a>
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav navbar-right">
                        <li><button class="btn b1" style="margin-top:5px;margin-right:10px;"><a href="./admin.php">Home</a></button></li>
                        <li><button  class="btn b1" style="margin-top:5px;"><a href="logoutadmin.php" >Logout</a></button></li>
                    </ul>
                </div>
            </div>
        </div>
        <hr style="border-top:1px dashed black;">
            <br>  <br>  <br> 

        <div class="col-sm-10 col-sm-offset-1">
            <?php
                if(mysqli_num_rows($result4)>0){
                    while ($row1 = mysqli_fetch_array($result4)) {
                        $quesTest = $row1['question'];  

            ?>
            <br>
            <div class="previous">
                <p style="display:inline;"><h4>Question Number: <?php echo $row1['question_number'] ?></h4></p>
                <textarea rows="6" cols="180" readonly><?php echo $quesTest; ?></textarea>
            </div>
            <br>

                    <?php }
                } ?>

            <!-- <div class="col-sm-4 col-sm-offset-1">
                <div class="download">
                    <h3>To Download Solution:-</h3>
                    <a class="btn b2" style="margin-top:5px;margin-right:10px;">C</a>
                    <a  class="btn b2" style="margin-top:5px;">Java</a>
                    <a  class="btn b2" style="margin-top:5px;">Python</a>
                </div>
            </div> -->

            <?php 
                if(mysqli_num_rows($result5)>0){
                    while ($row2 = mysqli_fetch_array($result5)) {
                        $first = $row2['first'];
                        $second = $row2['second'];
                        $third = $row2['third'];
                        $fourth = $row2['fourth'];
                        $fifth = $row2['fifth'];
            ?>
                <br>
            <div class="col-sm-3 col-sm-offset-1" style="margin:20px;background-color:#E4DED7;height:250px;border-radius:5px;">
                <p style="display:inline;"><h3>Results for Question Number: <?php echo $row2['question_number'] ?></h3></p>
                    <p>1.) <?php echo $first; ?></p>
                    <p>2.) <?php echo $second; ?> </p>
                    <p>3.) <?php echo $third; ?></p>
                    <p>4.) <?php echo $fourth; ?></p>
                    <p>5.) <?php echo $fifth; ?></p>
            </div>
            <br>
                    <?php }
                }?>
        </div>
            <?php }
            else{
                header("location: loginadmin.php");
                
              }?>
    </body>
</html>