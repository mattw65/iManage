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
      $sql="SELECT * FROM {$user}_Offices WHERE street=('$_POST[street]') AND city=('$_POST[city]') AND zip_code=('$_POST[zip_code]')";
      if (!mysqli_query($con,$sql))
        {
        die('Error: ' . mysqli_error($con));
        }
        $result = mysqli_query($con,$sql);
        $row = mysqli_fetch_array($result);
        $upd_url = 'OfficesUpdateForm.php?st='.$row[street].'&ct='.$row[city].'&zp='.$row[zip_code];
        echo '<a href="./Offices.php" class="button">Back</a>
        <h1>Update Office</h1><form action="'.$upd_url.'" method="post">
        Street: <input type="text" name="street" value='.$row['street'].'>
        City: <input type="text" name="city" value='.$row['city'].'>
        Zip Code: <input type="text" name="zip_code" value='.$row['zip_code'].'>
        Number of Employees: <input type="text" name="num_employees" value='.$row['num_employees'].'>
        Number of Teams: <input type="text" name="num_teams" value='.$row['num_teams'].'>
        <input type="Submit">
            </form>';
        
      
      mysqli_close($con);
   ?>