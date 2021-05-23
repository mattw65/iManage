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
      $sql="SELECT * FROM {$user}_JobTitles WHERE job_title =('$_GET[id]')";
      if (!mysqli_query($con,$sql))
        {
        die('Error: ' . mysqli_error($con));
        }
        $result = mysqli_query($con,$sql);
        $row = mysqli_fetch_array($result);
        echo '<a href="./Jobs.php" class="button">Back</a>
        <h1>Update Job Title: '.$row['job_title'].'</h1><form action="JobsUpdate.php?id='.$_GET[id].'" method="post">
        Role: <input type="text" name="role" value='.$row['role'].'>
        Salary: <input type="text" name="salary" value='.$row['salary'].'>
        <input type="Submit">
            </form>';
        
      
      mysqli_close($con);
   ?>