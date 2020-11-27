<?php
require_once('config.php');
require_once('core/controller.Class.php');
include('./server.php');
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
  <body>
  <?php if(isset($_COOKIE['id']) && isset($_COOKIE['sess'])){
            $Controller = new Controller;
            if($Controller -> checkUserStatus($_COOKIE['id'], $_COOKIE['sess'])){?>
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
          <a class="navbar-brand" href="" style="font-size: 25px; color: white"
            >V-Quiz</a
          >
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
          <ul class="nav navbar-nav navbar-right">
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
                    echo "This Que is Posted On: ".date_format($date,"d M Y");
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
                  18 H:43 M:26 s
                </button></a
              >
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
    <div class="col-sm-10 col-sm-offset-1 above">
      <h1 style="color: #c8c8c8">WELCOME <?php echo $Controller -> printData(intval($_COOKIE['id']));?></h1>
      <?php 
            $query= "SELECT * FROM questions ORDER BY question_number DESC LIMIT 1";
            $result = mysqli_query($conn, $query)or die(mysqli_error($conn));
            while($row=mysqli_fetch_array($result)){ ?>
      <h2 style="color: #c8c8c8">Today Quiz Question: <?php echo $row['question_number']; ?></h2>
      <h5 style="color: #c8c8c8">posted on: <?php 
                $que=$row['question_number'];
                $query1= "SELECT * FROM questions WHERE question_number='$que' ";
                $result1= mysqli_query($conn, $query1)or die(mysqli_error($conn));
                while($row1=mysqli_fetch_array($result1)){ 
                    $date=date_create($row1['date']);
                    echo date_format($date,'d M Y');
                } ?></h5>
      <button style="width:100%; background: none; border:none;" id="myBtn"><div class="">
      <h4 style="color: #c8c8c8">
      <textarea class="current" readonly style="background:none; resize:none; border:none;  size:max-content;"><?php echo $row['question']; ?></textarea>
        </h4>
      </div></button>
      <div id="myModal" class="modal">
        <div class="modal-content">
          <span class="close">&times;</span>
          <textarea name="" readonly style="border:none; resize: none;width: 100%; height: 100%; size:max-content;"><?php echo $row['question']; ?></textarea>
        </div>
      </div>
      <script>
      var modal = document.getElementById("myModal");

      // Get the button that opens the modal
      var btn = document.getElementById("myBtn");

      // Get the <span> element that closes the modal
      var span = document.getElementsByClassName("close")[0];

      // When the user clicks on the button, open the modal
      btn.onclick = function() {
        modal.style.display = "block";
      }

      // When the user clicks on <span> (x), close the modal
      span.onclick = function() {
        modal.style.display = "none";
      }

      // When the user clicks anywhere outside of the modal, close it
      window.onclick = function(event) {
        if (event.target == modal) {
          modal.style.display = "none";
        }
      }
      </script>
    </div>
    <div class="container">
      <div class="col-sm-12">
        <form action="user_upload.php" id="usrform" method="POST"  enctype="multipart/form-data" >
        <div class="col-sm-4" style="left: 0">
          <div class="upload">
            <h3 style="color: #c8c8c8">To Upload your Solution:-</h3>
            <form action="user_upload.php" method="POST">
            <input type="hidden" name='que' value=<?php echo $que; ?> readonly>
            <a
              class="btn b2"
              style="
                margin-top: 5px;
                margin-right: 10px;
                width: 280px;
                background-color: white;
              "
              ><input  type="file" id="myfile" name="myfile"
            /></a>
            <br /><br />
            <button
              type="submit"
              name="solution"
              class="btn b2"
              style="margin-top: 5px; background-color: #345657; color: white"
              >Upload</button
            >
            </form>
          </div>
        </div>
        </form>
        <?php } ?>
        <div class="col-sm-4"></div>
        <div
          class="col-sm-4"
          style="background-color: transparent; height: auto; color: #c8c8c8"
        >
          <h3>Note:-</h3>
          <p>1.) Please upload before submission time.</p>
          <p>2.) There will be the winners for every quiz</p>
          <p>3.) Save file in .c/.java/.py</p>
          <p>3.) Then zip all your files and upload</p>
        </div>
      </div>
    </div>
    <br />
    <br />
    <br />
    <center>
      <a href="user-previous.php"
        ><button
          style="
            background-color: #e4ded7;
            margin-top: 10px;
            border-radius: 25px;
            width: 80%;
            color: #345657;
          "
        >
          <center><h4>Click here to see all Previous Questions</h4></center>
        </button></a
      >
    </center>
    <br>
      <br>
      <br>
      <br>
    <footer>Developed by CSI VIT-AP</footer>
  </body>
  <?php }
            
    }else{ ?>
    <body style="background-color: beige;">
                <div class="container">
                    <div class="row row_style">
                    <div class="col-xs-8">

                        <div class="login-div">
                        <form>

                            <div class="logo"></div>
                            <div class="sub-title">EVENT LOGIN</div>

                            <div class="fields">

                            <!-- <div class="username">
                                    <input type="username" name="email" class="user-input" placeholder="Email"/>
                                    </div>
                                    <div class="password">
                                    <input type="password" name="password" class="pass-input" placeholder="Password"/>
                                    </div> -->

                            </div>

                            <!-- <input type="submit" name="login" value="Login" class="loginin-button">
                                <br> <br>  -->
                            
                            <button onclick="window.location = '<?php echo $login_url; ?>'" type="button"  class="loginin-button">Login with Google</button>
                            <div class="link">
                            <a href="signup.php" style="text-decoration: none;">New Member? Please Sign up</a>
                            </div>
                        </form>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
                </div>
      <footer> Developed by CSI VIT-AP </footer>
    </body>
  <?php } ?>
    

</html>
