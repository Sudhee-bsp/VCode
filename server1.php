<?php

session_start();



if($_SERVER["REQUEST_METHOD"] == "POST")
{
  if(isset($_POST['login']))
  {
    $username = $_POST['username'];
    $password = $_POST['password'];
      if($username=="Admin" && $password=="vitap123")
      {
        $_SESSION['username']=$username;
        header("location: admin.php");
      }
      else{
        header("location: loginadmin.php");
        echo "<h3> INVALID ACCESS </h3>";
      }
  }
}
?>