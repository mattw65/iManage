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
    $sql="SELECT * FROM {$user}_Finances WHERE street=('$_POST[street]') AND city=('$_POST[city]') AND zip_code=('$_POST[zip_code]')";
    $result = mysqli_query($con,$sql);
    // Print the data from the table row by row
    echo "Finances:";
    echo "<br>";
    echo '<table>
            <tr>
                <th>Street</th>
                <th>City</th>
                <th>Zip Code</th>
                <th>Budget</th>
                <th>Revenue</th>
            </tr>';
    while($row = mysqli_fetch_array($result)) {
        $upd_url = 'FinancesUpdateForm.php?st='.$row[street].'&ct='.$row[city].'&zp='.$row[zip_code];
        echo '
                <tr>
                    <td>'.$row['street'].'  </td>
                    <td>'.$row['city'].'  </td>
                    <td>'.$row['zip_code'].'  </td>
                    <td>'.$row['budget'].'  </td>
                    <td>'.$row['revenue'].'  </td>
                    <td><form action='.$upd_url.' method="post"><input type="Submit" value="Update"></td>
                </tr>';
      }
      
      mysqli_close($con);
      ?>