<?php session_start(); ?>
<html>
      <body>
      <a href="./InfoSelect.php" class="button">Back</a>
      <h2>Search Job Titles table</h2>
      <form action="JobsSearch.php" method="post">
            Job Title: <input type="text" name="job_title">
            <input type="Submit">
      </form>
      <h2>Insert into Job Titles table</h2>
      <form action="JobsInsert.php" method="post">
            Job Title: <input type="text" name="job_title">
            Role: <input type="text" name="role">
            Salary: <input type="text" name="salary">
            <input type="Submit">
      </form>
      <h2>Delete from Job Titles table</h2>
      <form action="JobsDelete.php" method="post">
            Job Title: <input type="text" name="employeeID">
            <input type="Submit">
      </form>
      <h2>Import table to Job Titles</h2>
      <form action="JobsImport.php" method="post" enctype="multipart/form-data">
            Choose CSV file: <input type="file" name="file">
            <input type="Submit" value="Import">
      </form>
      <h2>Export Job Titles Table</h2>
      <form action="JobsExport.php" method="post" enctype="multipart/form-data">
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
            $sql="SELECT * FROM {$user}_JobTitles";
            $result = mysqli_query($con,$sql);
            // Print the data from the table row by row
            echo "Job Titles:";
            echo "<br>";
            echo '<table>
                  <tr>
                        <th>Job Title</th>
                        <th>Role</th>
                        <th>Salary</th>
                  </tr>';
                  while($row = mysqli_fetch_array($result)) {
                        $upd_url = 'JobsUpdateForm.php?id='.$row['job_title'];
                        echo '
                              <tr>
                                    <td>'.$row['job_title'].'  </td>
                                    <td>'.$row['role'].'  </td>
                                    <td>'.$row['salary'].'  </td>
                                    <td><form action='.$upd_url.' method="post"><input type="Submit" value="Update"></td>
                              </tr>';
      }
      mysqli_close($con);
      ?></h1>

      </body>
</html>
