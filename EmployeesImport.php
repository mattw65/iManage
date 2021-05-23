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
    $filename=$_FILES["file"]["tmp_name"];
    
    if (($file = fopen($filename, "r")) != FALSE) {
        while (($fData = fgetcsv($file)) !== FALSE)
        {
        $sql = "INSERT INTO {$user}_Employees(employee_id, name, team_name, division_name) values('$fData[0]','$fData[1]','$fData[2]','$fData[3]')";
        if (!mysqli_query($con,$sql))
        {
        die('Error: ' . mysqli_error($con));
        }
        }
        fclose($file);
        echo "CSV File has been successfully Imported.";
    } else {
        echo "CSV File error.";
    }
    
    $url = 'http://cs.virginia.edu/~jjh5bc/DBProject/TableInfo/Employees.php';
    header( "Location: $url" );
    
    mysqli_close($con);
   ?>