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
    $url = 'http://cs.virginia.edu/~jjh5bc/DBProject/TableInfo/Clients.php';
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
    $sql="SELECT * FROM {$user}_Clients WHERE client_name=('$_POST[client_name]')";
    $result = mysqli_query($con,$sql);
    // Print the data from the table row by row
    echo "Clients:";
    echo "<br>";
    echo '<table>
            <tr>
                <th>Client Name</th>
                <th>Street</th>
                <th>City</th>
                <th>Zip Code</th>
                <th>Phone Number</th>
            </tr>';
    while($row = mysqli_fetch_array($result)) {
        echo '
                <tr>
                    <td>'.$row['client_name'].'  </td>
                    <td>'.$row['street'].'  </td>
                    <td>'.$row['city'].'  </td>
                    <td>'.$row['zip_code'].'  </td>
                    <td>'.$row['phone_number'].'  </td>
                    <td><form action="ClientsUpdateForm.php?id=".row[client_name] method="post"><input type="Submit" value="Update"></td>
                </tr>';
      }
      
      mysqli_close($con);
      ?>