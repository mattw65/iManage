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
    $url = 'http://cs.virginia.edu/~jjh5bc/DBProject/TableInfo/Managers.php';
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
    $sql="SELECT * FROM {$user}_Managers WHERE manager_id=('$_POST[managerID]')";
    $result = mysqli_query($con,$sql);
    // Print the data from the table row by row
    echo "Managers:";
    echo "<br>";
    echo '<table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Team</th>
                <th>Division</th>
                <th>Level</th>
            </tr>';
    while($row = mysqli_fetch_array($result)) {
        echo '
                <tr>
                    <td>'.$row['manager_id'].'  </td>
                    <td>'.$row['name'].'  </td>
                    <td>'.$row['team_name'].'  </td>
                    <td>'.$row['division_name'].'  </td>
                    <td>'.$row['level'].'  </td>
                    <td><form action="ManagersUpdateForm.php?id=".row[manager_id] method="post"><input type="Submit" value="Update"></td>
                </tr>';
      }
      
      mysqli_close($con);
      ?>