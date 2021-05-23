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
      $sql="SELECT * FROM {$user}_Projects WHERE project_name =('$_GET[id]')";
      if (!mysqli_query($con,$sql))
        {
        die('Error: ' . mysqli_error($con));
        }
        $result = mysqli_query($con,$sql);
        $row = mysqli_fetch_array($result);
        echo '<a href="./Projects.php" class="button">Back</a>
        <h1>Update Project: '.$row['project_name'].'</h1><form action="ProjectsUpdate.php?id='.$_GET[id].'" method="post">
        Team Name: <input type="text" name="team_name" value='.$row['team_name'].'>
        Project Duration: <input type="text" name="duration" value='.$row['duration'].'>
        Project Cost: <input type="text" name="cost" value='.$row['cost'].'>
        Project Status: <input type="text" name="status" value='.$row['status'].'>
        <input type="Submit">
            </form>';
        
      
      mysqli_close($con);
   ?>