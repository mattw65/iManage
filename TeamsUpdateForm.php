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
      $sql="SELECT * FROM {$user}_Teams WHERE project_name =('$_GET[id]')";
      if (!mysqli_query($con,$sql))
        {
        die('Error: ' . mysqli_error($con));
        }
        $result = mysqli_query($con,$sql);
        $row = mysqli_fetch_array($result);
        echo '<a href="./Teams.php" class="button">Back</a>
        <h1>Update Team: '.$row['team_name'].'</h1><form action="TeamsUpdate.php?id='.$_GET[id].'" method="post">
        Street: <input type="text" name="street" value='.$row['street'].'>
        City: <input type="text" name="city" value='.$row['city'].'>
        Zip Code: <input type="text" name="zip_code" value='.$row['zip_code'].'>
        Division Name: <input type="text" name="division_name" value='.$row['division_name'].'>
        Manager ID: <input type="text" name="manager_id" value='.$row['manager_id'].'>
        <input type="Submit">
            </form>';
        
      
      mysqli_close($con);
   ?>