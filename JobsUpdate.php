<?php
      session_start();
      error_reporting(E_ALL);
            ini_set('display_errors', 'On');
            echo "hi"
            if (isset($_SESSION['username'])) {
                  $user= $_SESSION['username'];                
                  }else {
                  header("Location: http://cs.virginia.edu/~jjh5bc/DBProject/DB_loginpage.php");
                  exit();
            }
            echo $user;
      include_once("./library.php"); // To connect to the database
      $con = new mysqli($SERVER, $USERNAME, $PASSWORD, $DATABASE);
      // Check connection
      if (mysqli_connect_errno())
        {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
      // Form the SQL query (an INSERT query)
      $sql="UPDATE {$user}_JobTitles
      SET role = '$_POST[role]', salary = '$_POST[salary]' 
      WHERE job_title=('$_GET[id]')";

      echo $sql;

      if (!mysqli_query($con,$sql))
        {
        die('Error: ' . mysqli_error($con));
        }
        $url = 'http://cs.virginia.edu/~jjh5bc/DBProject/Jobs.php';
        header( "Location: $url" );
      mysqli_close($con);
   ?>