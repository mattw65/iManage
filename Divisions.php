<?php session_start(); ?>
<html>
      <body>
      <a href="./InfoSelect.php" class="button">Back</a>
      <h2>Search Divisions table</h2>
      <form action="DivisionsSearch.php" method="post">
            Division Name: <input type="text" name="division_name">
            <input type="Submit">
      </form>
      <h2>Insert into Divisions table</h2>
      <form action="DivisionsInsert.php" method="post">
            Division name: <input type="text" name="division_name">
            Street: <input type="text" name="street">
            City: <input type="text" name="city">
            Zip Code: <input type="text" name="zip_code">
            Manager ID: <input type="text" name="manager_id">
            <input type="Submit">
      </form>
      <h2>Delete from Divisions table</h2>
      <form action="DivisionsDelete.php" method="post">
            Division Name: <input type="text" name="division_name">
            <input type="Submit">
      </form>
      <h2>Import table to Divisions</h2>
      <form action="DivisionsImport.php" method="post" enctype="multipart/form-data">
            Choose CSV file: <input type="file" name="file">
            <input type="Submit" value="Import">
      </form>
      <h2>Export Divisions Table</h2>
      <form action="DivisionsExport.php" method="post" enctype="multipart/form-data">
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
            $sql="SELECT * FROM {$user}_Divisions";
            $result = mysqli_query($con,$sql);
            // Print the data from the table row by row
            echo "Divisions:";
            echo "<br>";
            echo '<table>
                  <tr>
                        <th>Division Name</th>
                        <th>Street</th>
                        <th>City</th>
                        <th>Zip Code</th>
                        <th>Manager ID</th>
                  </tr>';
                  while($row = mysqli_fetch_array($result)) {
                        $upd_url = 'DivisionsUpdateForm.php?id='.$row['division_name'];
                        echo '
                              <tr>
                                    <td>'.$row['division_name'].'  </td>
                                    <td>'.$row['street'].'  </td>
                                    <td>'.$row['city'].'  </td>
                                    <td>'.$row['zip_code'].'  </td>
                                    <td>'.$row['manager_id'].'  </td>
                                    <td><form action='.$upd_url.' method="post"><input type="Submit" value="Update"></td>
                              </tr>';
      }
      mysqli_close($con);
      ?></h1>

      </body>
</html>
