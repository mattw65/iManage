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
    $url = 'http://cs.virginia.edu/~jjh5bc/DBProject/TableInfo/Projects.php';
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
    $sql="SELECT * FROM {$user}_Projects WHERE project_name=('$_POST[project_name]')";
    $result = mysqli_query($con,$sql);
    // Print the data from the table row by row
    echo "Projects:";
    echo "<br>";
    echo '<table>
            <tr>
                <th>Project Name</th>
                <th>Team Name</th>
                <th>Duration</th>
                <th>Cost</th>
                <th>Status</th>
            </tr>';
    while($row = mysqli_fetch_array($result)) {
        echo '
                <tr>
                    <td>'.$row['project_name'].'  </td>
                    <td>'.$row['team_name'].'  </td>
                    <td>'.$row['duration'].'  </td>
                    <td>'.$row['cost'].'  </td>
                    <td>'.$row['status'].'  </td>
                    <td><form action="ProjectsUpdateForm.php?id=".row[project_name] method="post"><input type="Submit" value="Update"></td>
                </tr>';
      }
      
      mysqli_close($con);
      ?>