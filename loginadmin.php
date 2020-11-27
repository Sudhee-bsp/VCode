<?php include('server1.php'); 
if (isset($_SESSION['username'])) {
    header('location: admin.php');
} ?>
<!DOCTYPE html>
<html>
  <head>
    <title> LOGIN </title>
    <style>
      body {
        font-size : 120%;
      }
      form, .content {
        width : 30%;
        margin: 0px auto;
        padding: 20px;
        border: 1px solid #B0C4DE;
        background: white;
        border-radius: 0px 0px 10px 10px;
      }
        .input-group {
        margin: 10px 0px 10px 0px;
      }
      .input-group label {
        display: block;
        text-align: left;
        margin: 3px;
      }
      .input-group input {
        height: 30px;
        width: 93%;
        padding: 5px 10px;
        font-size: 16px;
        border-radius: 5px;
        border: 1px solid gray;
      }
      .btn {
        padding: 10px;
        font-size: 15px;
        color: white;
        background: #5F9EA0;
        border: none;
        border-radius: 5px;
      }
      </style>
  </head>
  <body>
  <form method="post" action="admin.php">
    <center>
  <div class="input-group">
        <label>Username</label>
        <input type="text" name="username">
      </div>

      <div class="input-group">
        <label>Password</label>
        <input type="password" name="password">
      </div>

      <div class="input-group">
        <button type="submit" name="login" class="btn">Login</button>
      </div>
      
      <div class="input-group">
          <a href="index.php"><strong> GO Live Score!</strong></a>
      </div>
    </center>
      </form>
  </body>
</html>
