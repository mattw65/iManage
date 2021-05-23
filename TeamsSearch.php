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
    $url = 'http://cs.virginia.edu/~jjh5bc/DBProject/TableInfo/Teams.php';
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
    $sql="SELECT * FROM {$user}_Teams WHERE team_name=('$_POST[team_name]')";
    $result = mysqli_query($con,$sql);
    // Print the data from the table row by row
    echo "Teams:";
    echo "<br>";
    echo '<table>
            <tr>
                <th>Team Name</th>
                <th>Street</th>
                <th>City</th>
                <th>Zip Code</th>
                <th>Division Name</th>
                <th>Manager ID</th>
            </tr>';
    while($row = mysqli_fetch_array($result)) {
        echo '
                <tr>
                    <td>'.$row['team_name'].'  </td>
                    <td>'.$row['street'].'  </td>
                    <td>'.$row['city'].'  </td>
                    <td>'.$row['zip_code'].'  </td>
                    <td>'.$row['division_name'].'  </td>
                    <td>'.$row['manager_id'].'  </td>
                    <td><form action="TeamsUpdateForm.php?id=".row[team_name] method="post"><input type="Submit" value="Update"></td>
                </tr>';
      }
      
      mysqli_close($con);
      ?>