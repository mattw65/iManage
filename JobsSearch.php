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
    $url = 'http://cs.virginia.edu/~jjh5bc/DBProject/Jobs.php';
    echo '<a href='.$url.'>Return</a>';
    require_once('./library.php');
    $con = new mysqli($SERVER, $USERNAME, $PASSWORD, $DATABASE);
    // Check connection
    if (mysqli_connect_errno()) {
            echo("Can't connect to MySQL Server. Error code: " .
            mysqli_connect_error());
            return null;
    }
    // Form the SQL query (a SELECT query)
    $sql="SELECT * FROM {$user}_JobTitles WHERE job_title=('$_POST[job_title]')";
    $result = mysqli_query($con,$sql);
    // Print the data from the table row by row
    echo "Job Titles:";
    echo "<br>";
    echo '<table>
            <tr>
                <th>Job</th>
                <th>Role</th>
                <th>Salary</th>
            </tr>';
    while($row = mysqli_fetch_array($result)) {
        echo '
                <tr>
                    <td>'.$row['job_title'].'  </td>
                    <td>'.$row['role'].'  </td>
                    <td>'.$row['salary'].'  </td>
                    <td><form action="JobsUpdate.php?id=".row[job_title] method="post"><input type="Submit" value="Update"></td>
                </tr>';
      }
      
      mysqli_close($con);
      ?>