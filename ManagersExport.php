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

      $sql="SELECT * FROM {$user}_Managers";   
      
      $result = mysqli_query($con,$sql);

      $filename = "managers.csv";
    
      $fields = array('ID', 'Name', 'Team Name', 'Division Name', 'Level');

      header('Content-Type: text/csv');
      header('Content-Disposition: attachment; filename="' . $filename . '";');

      $f = fopen('php://output', 'w');
      fputcsv($f, $fields);

      while($row = mysqli_fetch_array($result)) {
        $line = array($row['manager_id'], $row['name'], $row['team_name'], $row['division_name'], $row['level']);
        fputcsv($f, $line);
      }
      fclose($f);
      mysqli_close($con);
      exit;
   ?>