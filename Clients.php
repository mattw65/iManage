<?php session_start(); ?>
<html>
      <body>
      <a href="./InfoSelect.php" class="button">Back</a>
      <h2>Search Clients table</h2>
      <form action="ClientsSearch.php" method="post">
            Client Name: <input type="text" name="client_name">
            <input type="Submit">
      </form>
      <h2>Insert into Clients table</h2>
      <form action="ClientsInsert.php" method="post">
            Client name: <input type="text" name="client_name">
            Street: <input type="text" name="street">
            City: <input type="text" name="city">
            Zip Code: <input type="text" name="zip_code">
            Phone Number: <input type="text" name="phone_number">
            <input type="Submit">
      </form>
      <h2>Delete from Clients table</h2>
      <form action="ClientsDelete.php" method="post">
            Client Name: <input type="text" name="cli_name">
            <input type="Submit">
      </form>
      <h2>Import table to Clients</h2>
      <form action="ClientsImport.php" method="post" enctype="multipart/form-data">
            Choose CSV file: <input type="file" name="file">
            <input type="Submit" value="Import">
      </form>
      <h2>Export Clients Table</h2>
      <form action="ClientsExport.php" method="post" enctype="multipart/form-data">
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
            $sql="SELECT * FROM {$user}_Clients";
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
                        <th>Phone</th>
                  </tr>';
                  while($row = mysqli_fetch_array($result)) {
                        $upd_url = 'ClientsUpdateForm.php?id='.$row['client_name'];
                        echo '
                              <tr>
                                    <td>'.$row['client_name'].'  </td>
                                    <td>'.$row['street'].'  </td>
                                    <td>'.$row['city'].'  </td>
                                    <td>'.$row['zip_code'].'  </td>
                                    <td>'.$row['phone_number'].'  </td>
                                    <td><form action='.$upd_url.' method="post"><input type="Submit" value="Update"></td>
                              </tr>';
      }
      mysqli_close($con);
      ?></h1>

      </body>
</html>
