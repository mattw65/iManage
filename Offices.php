<?php session_start(); ?>
<html>
      <body>
      <a href="./InfoSelect.php" class="button">Back</a>
      <h2>Search Office table</h2>
      <form action="OfficesSearch.php" method="post">
            Office Street: <input type="text" name="street">
            Office City: <input type="text" name="city">
            Office Zip Code: <input type="text" name="zip_code">
            <input type="Submit">
      </form>
      <h2>Insert into Offices table</h2>
      <form action="OfficesInsert.php" method="post">
            Office Street: <input type="text" name="street">
            Office City: <input type="text" name="city">
            Office Zip Code: <input type="text" name="zip_code">
            Number of Employees: <input type="text" name="num_employees">
            Number of Teams: <input type="text" name="num_teams">
            <input type="Submit">
      </form>
      <h2>Delete from Offices table</h2>
      <form action="OfficesDelete.php" method="post">
            Office Street: <input type="text" name="street">
            Office City: <input type="text" name="city">
            Office Zip Code: <input type="text" name="zip_code">
            <input type="Submit">
      </form>
      <h2>Import table to Offices</h2>
      <form action="OfficesImport.php" method="post" enctype="multipart/form-data">
            Choose CSV file: <input type="file" name="file">
            <input type="Submit" value="Import">
      </form>
      <h2>Export Offices Table</h2>
      <form action="OfficesExport.php" method="post" enctype="multipart/form-data">
            <input type="Submit" value="Export">
      </form>

      <h1><?php
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
            require_once('./library.php');
            $con = new mysqli($SERVER, $USERNAME, $PASSWORD, $DATABASE);
            // Check connection
            if (mysqli_connect_errno()) {
                  echo("Can't connect to MySQL Server. Error code: " .
                  mysqli_connect_error());
                  return null;
            }
            // Form the SQL query (a SELECT query)
            $sql="SELECT * FROM {$user}_Offices";
            $result = mysqli_query($con,$sql);
            // Print the data from the table row by row
            echo "Offices:";
            echo "<br>";
            echo '<table>
                  <tr>
                        <th>Street</th>
                        <th>City</th>
                        <th>Zip Code</th>
                        <th>Number of Employees</th>
                        <th>Number of Teams</th>
                  </tr>';
                  while($row = mysqli_fetch_array($result)) {
                        $upd_url = 'OfficesUpdateForm.php?st='.$row[street].'&ct='.$row[city].'&zp='.$row[zip_code];
                        echo '
                              <tr>
                                    <td>'.$row['street'].'  </td>
                                    <td>'.$row['city'].'  </td>
                                    <td>'.$row['zip_code'].'  </td>
                                    <td>'.$row['num_employees'].'  </td>
                                    <td>'.$row['num_teams'].'  </td>
                                    <td><form action='.$upd_url.' method="post"><input type="Submit" value="Update"></td>
                              </tr>';
      }
      mysqli_close($con);
      ?></h1>

      </body>
</html>
