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
      $sql="SELECT * FROM {$user}_Clients WHERE client_name=('$_GET[id]')";
      if (!mysqli_query($con,$sql))
        {
        die('Error: ' . mysqli_error($con));
        }
        $result = mysqli_query($con,$sql);
        $row = mysqli_fetch_array($result);
        echo '<a href="./Clients.php" class="button">Back</a>
        <h1>Update Client Name: '.$row['client_name'].'</h1><form action="ClientsUpdate.php?id='.$_GET[id].'" method="post">
        Street: <input type="text" name="street" value='.$row['street'].'>
        City: <input type="text" name="city" value='.$row['city'].'>
        Zip Code: <input type="text" name="zip_code" value='.$row['zip_code'].'>
        Phone Number: <input type="text" name="phone_number" value='.$row['phone_number'].'>
        <input type="Submit">
            </form>';
        
      
      mysqli_close($con);
   ?>