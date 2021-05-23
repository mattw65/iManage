<?php session_start(); ?>
<html>
      <body>
      <a href="./InfoSelect.php" class="button">Back</a>
      <h2>Search Office table</h2>
      <form action="FinancesSearch.php" method="post">
            Street: <input type="text" name="street">
            City: <input type="text" name="city">
            Zip Code: <input type="text" name="zip_code">
            <input type="Submit">
      </form>
      <h2>Insert into Finances table</h2>
      <form action="FinancesInsert.php" method="post">
            Street: <input type="text" name="street">
            City: <input type="text" name="city">
            Zip Code: <input type="text" name="zip_code">
            Budget: <input type="text" name="budget">
            Revenue: <input type="text" name="revenue">
            <input type="Submit">
      </form>
      <h2>Delete from Finances table</h2>
      <form action="FinancesDelete.php" method="post">
            Street: <input type="text" name="street">
            City: <input type="text" name="city">
            Zip Code: <input type="text" name="zip_code">
            <input type="Submit">
      </form>
      <h2>Import table to Finances</h2>
      <form action="FinancesImport.php" method="post" enctype="multipart/form-data">
            Choose CSV file: <input type="file" name="file">
            <input type="Submit" value="Import">
      </form>
      <h2>Export Finances Table</h2>
      <form action="FinancesExport.php" method="post" enctype="multipart/form-data">
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
            $sql="SELECT * FROM {$user}_Finances";
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
      ?></h1>

      </body>
</html>
