<?php 

include('./server.php');
include('server1.php'); 
if (isset($_SESSION['username'])) {
    

$ques = "";
$ques_num = 0;

if(isset($_POST['upload_question'])){
    $ques = mysqli_real_escape_string($conn, ($_POST['today_question']));
    $ques_num = ($_POST['ques_num']);
    $date = $_POST['date'];
  
    // echo $ques;
    $query1 = "INSERT INTO questions (question, question_number, date) VALUES ('$ques', $ques_num,'$date')";
    $result = mysqli_query($conn, $query1);
    if ($result){
        echo "<br> <br> Question uploaded successfully!";
    }
    else{
        die("Sorry we failed to insert: ". mysqli_error($conn));
    }
    header('location: previous.php');
}

$first = "";
$second = "";
$third = "";
$fourth = "";
$fifth = "";

if(isset($_POST['declare_win'])){
    $ques_numo = ($_POST['ques_num']);
    $first = $_POST['first_win'];
    $second = $_POST['second_win'];
    $third = $_POST['third_win'];
    $fourth = $_POST['fourth_win'];
    $fifth = $_POST['fifth_win'];
    $query2 = "INSERT INTO winners (question_number, first, second, third, fourth, fifth ) VALUES ( '$ques_numo', '$first', '$second', '$third', '$fourth', '$fifth' )";
    $result2 = mysqli_query($conn, $query2);
    if ($result2){
        echo "<br> <br> Results declared successfully!";
    }
    else{
        die("Sorry we failed to insert: ". mysqli_error($conn));
    }
}


if(isset($_POST['update_previous'])){
    $ques_numo = ($_POST['ques_num']);
    $first = $_POST['first_win'];
    $second = $_POST['second_win'];
    $third = $_POST['third_win'];
    $fourth = $_POST['fourth_win'];
    $fifth = $_POST['fifth_win'];
    $query3 = "UPDATE winners SET first='$first', second='$second', third='$third', fourth='$fourth', fifth='$fifth' WHERE question_number='$ques_numo'";
    $result3 = mysqli_query($conn, $query3);
    if ($result3){
        echo "<br> <br> Previous Results updated successfully!";
    }
    else{
        die("Sorry we failed to insert: ". mysqli_error($conn));
    }
}

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
                        <li><button class="btn b1" style="margin-top:5px;margin-right:10px;">Home</button></li>
                        <li><button  class="btn b1" style="margin-top:5px;"><a href="logoutadmin.php" >Logout</a></button></li>
                    </ul>
                </div>
            </div>
        </div>
        
        <div class="col-sm-8 above">
            <div style="display:inline;">
                <h2>Today Quiz Question:</h2>
                <p>Ends at</p>
            </div>
            <div class="current">

                <form method="post" action="admin.php" id="usrform">
                    <textarea name="today_question" rows="6" cols="180" placeholder="Enter question here..." autofocus form="usrform"></textarea>
                    <div class="upload">
                        <!-- <a  class="btn b2" style="margin-top:5px;">Upload</a> -->
                        <br>
                        <span><b>Select question number: </b></span>
                        <?php

                            $sql1=mysqli_query($conn, "SELECT * FROM questions");

                            // if (mysqli_num_rows($sql1)){
                            //     echo mysqli_num_rows($sql1)."<br> <br> Previous questions fetched successfully!";
                            // }
                            // else{
                            //     die("Sorry we failed to insert: ". mysqli_error($conn));
                            // }
                            
                            if(mysqli_num_rows($sql1) == 0)
                            {
                                echo "<select name='ques_num'>
                                    <option value='1'>question no. 1</option>
                                </select>";
                            }
                            if(mysqli_num_rows($sql1)>0)
                            {
                                echo "<select name='ques_num'>";
                                echo "<option value=''>--- Select ---</option>";
                                while($rs=mysqli_fetch_array($sql1)){
                                    
                                    if($rs['question_number'] == mysqli_num_rows($sql1)){
                                        $num=$rs['question_number']+1;
                                        echo '<option value="'.$num.'">question no. '.$num.'</option>';
                                }
                                }
                                echo "</select>";
                            } 
                            // $select.='</select>';
                            // echo $select;
                        ?>
                        &nbsp 
                        &nbsp 
                        &nbsp
                        <span><b>Select the date: </b></span>
                        <input type="date"   required name="date" placeholder="dd/mm/yyyy">
                        <br>
                        <input name="upload_question" type="submit" value="Upload" class="btn b2" style="margin-top:5px;">
                    </div>
                </form>


            </div>
            <div class="col-sm-4" style="background-color:#E4DED7;height:320px;border-radius:5px;">
                <form method="post" action="admin.php">
                    <p style="display:inline;">
                        <h3>Results</h3>
                        <p>
                            <?php

                                $sql2=mysqli_query($conn, "SELECT question_number FROM questions ORDER BY question_number DESC LIMIT 3");
                                if(mysqli_num_rows($sql2) == 0)
                                {
                                    echo "<select name='ques_num'>
                                        <option value='0'>No questions</option>
                                    </select>";
                                }
                                if(mysqli_num_rows($sql2))
                                {
                                    echo "<select name='ques_num'>";
                                    echo "<option value=''>--- Select ---</option>";
                                    while($rs=mysqli_fetch_array($sql2)){
                                        // $rs['id'] = $rs['id']+1;
                                        echo '<option value="'.$rs['question_number'].'">question no. '.$rs['question_number'].'</option>';
                                    }
                                    echo "</select>";
                                }
                                // echo $select;
                            ?>
                        </p>
                    </p>
                    <p>1.) <input name="first_win" type="text" > </p>
                    <p>2.) <input name="second_win" type="text" > </p>
                    <p>3.) <input name="third_win" type="text" > </p>
                    <p>4.) <input name="fourth_win" type="text" > </p>
                    <p>5.) <input name="fifth_win" type="text" > </p>

                    <input name="declare_win" type="submit" value="Declare" >
                    <input name="update_previous" type="submit" value="Update previous" >
                </form>
            </div>
            
            <div class="container col-sm-8 ">
            <form action="upload.php"  id="usrform" method="POST"  enctype="multipart/form-data">
                <h2>To Upload Solution</h2>

                <?php
                $sql3=mysqli_query($conn, "SELECT question_number FROM questions ORDER BY question_number DESC LIMIT 3");
                if(mysqli_num_rows($sql3) == 0)
                {
                    echo "<select name='ques_numr'>
                        <option value='0'>No questions</option>
                    </select>";
                } 
                if(mysqli_num_rows($sql3))
                {
                    echo "<select name='ques_numr'>";
                    echo "<option value=''>--- Select ---</option>";
                    while($r=mysqli_fetch_array($sql3)){
                        // $rs['id'] = $rs['id']+1;
                        echo '<option value="'.$r['question_number'].'">question no. '.$r['question_number'].'</option>';
                    }
                    echo "</select>";
                }
                ?>

                <div class="upload">
                            <h3> To Upload your Solution:-</h3>
                                <a  class="btn b2" style="margin-top:5px;margin-right:10px;width:280px;"><input type="file" id="myfile" name="myfile"></a>
                                <input name="solution" type="submit"  class="btn b2" style="margin-top:5px;" value="Upload">
                </div>
            </form>
            </div>
        </div>
    
        <hr style="border-top:1px dashed black;">
        
    <center>
        <button style="background-color:#E4DED7;margin-top:20px;margin-bottom:25px;border-radius:25px;width:80%;">
            <center>
                <h4><a href="previous.php"> Click here to see all Previous Questions </a></h4>
            </center>
        </button>
    </center>
    </body>
    <?php }
    else{
        header("location: loginadmin.php");
        
      }?>
</html>
