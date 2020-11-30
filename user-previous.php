<?php

require_once('config.php');
require_once('core/controller.Class.php');
include('./server.php');


$quesTest = "";

$query4 = "SELECT question, question_number FROM questions ORDER BY question_number";
$result4 = mysqli_query($conn, $query4);


$resultt = mysqli_query($conn, "SELECT * FROM timer ORDER BY question_number DESC LIMIT 1");
while($res = mysqli_fetch_array($resultt)) { 
  $dated = $res['date'];
  $h = $res['h'];
  $m = $res['m'];
  $s = $res['s'];
}

?>
<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>V-Quiz</title>
    <link
      rel="stylesheet"
      href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
    />
    <!--jQuery library-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!--Latest compiled and minified JavaScript-->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!-- Custom CSS -->
    <link href="style1.css" rel="stylesheet" />
  </head>
  <?php if(isset($_COOKIE['id']) && isset($_COOKIE['sess'])){
            $Controller = new Controller;
            if($Controller -> checkUserStatus($_COOKIE['id'], $_COOKIE['sess'])){?>
  <body>
    <div
      class="navbar navbar-inverse navbar-fixed-top"
      style="background-color: #345657"
    >
      <div class="container-fluid">
        <div class="navbar-header">
          <button
            type="button"
            class="navbar-toggle"
            data-toggle="collapse"
            data-target="#myNavbar"
          >
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a
            class="navbar-brand"
            href="index.php"
            style="font-size: 25px; color: white"
            >V-Quiz</a
          >
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
          <ul class="nav navbar-nav navbar-right">
          <li>
              
            </li>
            <li>
              <a href=""
                ><button
                  class="btn b1"
                  style="margin-top: -10px; margin-right: -10px; color: #345657"
                >
                  <?php
                  $quer = "SELECT * FROM questions ORDER BY question_number DESC LIMIT 1";
                  $resul = mysqli_query($conn, $quer);
                  while($r=mysqli_fetch_array($resul)){
                    $date=date_create($r['date']);
                    echo "<p style='color: white'> Last Question posted on: ".date_format($date,"d M Y")."</p>";
                  }
                   ?>
                </button></a
              >
            </li>
            <li>
              <a href=""
                ><button
                  class="btn b1"
                  style="margin-top: -10px; margin-right: -10px; color: #345657"
                >
                <p id="demo" style="color: white"></p>
                </button></a
              >
              <script>
                    console.log("This is Timer")
                    var countDownDate = <?php 
                        echo strtotime("$dated $h:$m:$s" ) ?> * 1000;
                        var now = <?php echo time() ?> * 1000;

                        // Update the count down every 1 second
                        var x = setInterval(function() {
                        now = now + 1000;
                        // Find the distance between now an the count down date
                        var distance = countDownDate - now;
                        // Time calculations for days, hours, minutes and seconds
                        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                        var seconds = Math.floor((distance % (1000 * 60)) / 1000);
                        // Output the result in an element with id="demo"
                        document.getElementById("demo").innerHTML = days + "d " + hours + "h " +
                        minutes + "m " + seconds + "s ";
                        // If the count down is over, write some text 
                        if (distance < 0) {
                        clearInterval(x);
                        document.getElementById("demo").innerHTML = "EXPIRED";
                        }
                            
                        }, 1000);
               </script>
            </li>
            <li>
              <a
                href="logout.php"
                style="font-size: 30px; margin-top: -10px; color: white"
                ><span class="glyphicon glyphicon-log-out"></span
              ></a>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <div class="container-fluid">
      <div class="col-sm-6  col-sm-offset-1" style="margin-top: 50px">
      <h2>Questions</h2>
      <div class="previous">
      <?php while($row1 = mysqli_fetch_array($result4)){ 
                $que_num = $row1['question_number']; ?>
                
                <div class="panel panel-primary pp" style="">
                  
                <a  style="text-decoration:none; color: darkgrey;" data-toggle="collapse"  href="#<?php echo $row1['question_number'];?>">
                  <div class="panel-heading"  style="background-color: #345657;">
                    <h4 class="panel-title">
                      Question: <?php echo $row1['question_number']; ?>
                    </h4>
                  </div></a>
                  <div id="<?php echo $row1['question_number'];?>" class="panel-collapse collapse">
                    <div class="panel-body pb" style="background-color: lightgrey;">
                    <form action="user-previous.php" method="POST">
                    <input type="hidden" name='que' value=<?php echo $que_num; ?> readonly>
                    <button type="submit" name="res" class="btn-danger form-control" style="text-decoration:none; color: whitesmoke; border: none; border-radius:4px; font-size: 20px;">Scoreboard</button>
                    
                    <textarea class="current" readonly style="background:none; font-size:large; resize:none; border:none;  size:max-content;"><?php echo $row1['question']; ?></textarea>
                    </form>
                    </div>
                  </div>
                </div>
      <?php } ?>
      </div>
      </div><?php
      if(isset($_POST['res'])){
        $que=$_POST['que'];
        $quer1 = "SELECT * FROM questions WHERE question_number='$que' ";
        $resul1 = mysqli_query($conn, $quer1);
        $query5 = "SELECT  question_number, first, second, third, fourth, fifth FROM winners WHERE question_number= '$que' ";
        $result5 = mysqli_query($conn, $query5);
        while ($row2 = mysqli_fetch_array($result5) and $row=mysqli_fetch_array($resul1)) {
          $first = $row2['first'];
          $second = $row2['second'];
          $third = $row2['third'];
          $fourth = $row2['fourth'];
          $fifth = $row2['fifth'];
      ?>
      <div class="col-sm-4" style="margin-top: 100px">
        <div
          style="
            background: linear-gradient(315deg, #20b2aa, #e64a19);
            border-radius: 18px;
            height: 265px;
          "
        >
          
        <center><h2 style="text-decoration: underline;padding-top:9px; font-family:Apple Chancery, cursive">Winners</h2></center>
            <h4 style="font-family:Apple Chancery, cursive; margin-left: 40px">Question: <?php echo $que; ?> 
              <!-- <br /> --> &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
             Posted On: <?php echo date_format(date_create($row['date']),"d M Y"); ?> </h4>
            <p style="margin-left: 100px; font-size: 18px">  1. <?php echo $first; ?></p>
            <p style="margin-left: 100px; font-size: 18px">  2. <?php echo $second; ?> </p>
            <p style="margin-left: 100px; font-size: 18px">  3. <?php echo $third; ?></p>
            <p style="margin-left: 100px; font-size: 18px">  4. <?php echo $fourth; ?></p>
            <p style="margin-left: 100px; font-size: 18px">  5. <?php echo $fifth; ?></p>
          
        </div>
        <div class="download">
          <center>
            <h3 style="color: #c8c8c8">To Download Solution:-</h3>
            <a href="download.php?id=<?php echo $que ?>"
              class="btn b2"
              style="
                margin-top: 5px;
                margin-right: 10px;
                background-color: #345657;
                color: white;
              "
              >C</a
            >
            <a href="download.php?id=<?php echo $que ?>"
              class="btn b2"
              style="margin-top: 5px; background-color: #345657; color: white"
              >Java</a
            >
            <a href="download.php?id=<?php echo $que ?>"
              class="btn b2"
              style="margin-top: 5px; background-color: #345657; color: white"
              >Python</a
            >
          </center>
        </div>
      </div>
        <?php }
        }
        ?>
    </div>
    
    <center><footer>Developed by CSI VIT-AP</footer></center>
  </body>
            <?php }
  } 
  else{
    header('location:index.php');
  }?>
</html>
