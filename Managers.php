<?php session_start(); ?>
<html>
      <body>
      <a href="./InfoSelect.php" class="button">Back</a>
      <h2>Search Managers table</h2>
      <form action="ManagersSearch.php" method="post">
            Employee ID: <input type="text" name="employeeID">
            <input type="Submit">
      </form>
      <h2>Insert into Managers table</h2>
      <form action="ManagersInsert.php" method="post">
            Employee ID: <input type="text" name="employeeID">
            Name: <input type="text" name="name">
            Team Name: <input type="text" name="teamName">
            Division Name: <input type="text" name="divName">
            Level: <input type="text" name="level">
            <input type="Submit">
      </form>
      <h2>Delete from Managers table</h2>
      <form action="ManagersDelete.php" method="post">
            Manager ID: <input type="text" name="managerID">
            <input type="Submit">
      </form>
      <h2>Import table to Managers</h2>
      <form action="ManagersImport.php" method="post" enctype="multipart/form-data">
            Choose CSV file: <input type="file" name="file">
            <input type="Submit" value="Import">
      </form>
      <h2>Export Managers Table</h2>
      <form action="ManagersExport.php" method="post" enctype="multipart/form-data">
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
            $sql="SELECT * FROM {$user}_Managers";
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
                        $upd_url = 'ManagersUpdateForm.php?id='.$row['manager_id'];
                        echo '
                              <tr>
                                    <td>'.$row['manager_id'].'  </td>
                                    <td>'.$row['name'].'  </td>
                                    <td>'.$row['team_name'].'  </td>
                                    <td>'.$row['division_name'].'  </td>
                                    <td>'.$row['level'].'  </td>
                                    <td><form action='.$upd_url.' method="post"><input type="Submit" value="Update"></td>
                              </tr>';
      }
      mysqli_close($con);
      ?></h1>

      </body>
</html>
