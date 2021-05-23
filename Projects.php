<?php session_start(); ?>
<html>
      <body>
      <a href="./InfoSelect.php" class="button">Back</a>
      <h2>Search Projects table</h2>
      <form action="ProjectsSearch.php" method="post">
            Employee ID: <input type="text" name="project_name">
            <input type="Submit">
      </form>
      <h2>Insert into Projects table</h2>
      <form action="ProjectsInsert.php" method="post">
            Project Name: <input type="text" name="project_name">
            Team Name: <input type="text" name="team_name">
            Project Duration: <input type="text" name="duration">
            Project Cost: <input type="text" name="cost">
            Project Status: <input type="text" name="status">
            <input type="Submit">
      </form>
      <h2>Delete from Projects table</h2>
      <form action="ProjectsDelete.php" method="post">
            Project Name: <input type="text" name="project_name">
            <input type="Submit">
      </form>
      <h2>Import table to Projects</h2>
      <form action="ProjectsImport.php" method="post" enctype="multipart/form-data">
            Choose CSV file: <input type="file" name="file">
            <input type="Submit" value="Import">
      </form>
      <h2>Export Projects Table</h2>
      <form action="ProjectsExport.php" method="post" enctype="multipart/form-data">
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
            $sql="SELECT * FROM {$user}_Projects";
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
                        $upd_url = 'ProjectsUpdateForm.php?id='.$row['project_name'];
                        echo '
                              <tr>
                                    <td>'.$row['project_name'].'  </td>
                                    <td>'.$row['team_name'].'  </td>
                                    <td>'.$row['duration'].'  </td>
                                    <td>'.$row['cost'].'  </td>
                                    <td>'.$row['status'].'  </td>
                                    <td><form action='.$upd_url.' method="post"><input type="Submit" value="Update"></td>
                              </tr>';
      }
      mysqli_close($con);
      ?></h1>

      </body>
</html>
