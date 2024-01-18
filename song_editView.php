<?php
session_start();
if(isset($_SESSION["UID"])) {
?>
<!DOCTYPE html> 
<html> 
<head> 
 <title>Song Registration Form</title>
<style>
        body {
            font-family: Arial, sans-serif;
            background-color: #191414;
            color: #fff; /* White text color */
            text-align: center;
            margin: 0;
            padding: 0;
        }

        h2 {
            color: #1DB954;
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            border: 2px solid #1DB954;
        }

        th, td {
            padding: 10px;
            border: 1px solid #1DB954;
        }

        th {
            background-color: #191414;
            color: #1DB954;
        }

        td {
            background-color: #282828;
        }

        input[type="submit"] {
            background-color: #1DB954;
            color: #191414;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: #168038;
        }
    </style> 
</head> 
 
<body> 
 <h2>Song Registration Form</h2> 
   
 <?php 
  
  $host = "localhost"; 
  $user = "root"; 
  $pass = ""; 
  $db = "song_collectiondb"; 
 
  $conn = new mysqli ($host, $user, $pass, $db); 
   
  if ($conn -> connect_error) { 
   die ("Connection Fail ". $conn -> connect_error); 
  } 
  else { 
   $queryview = "SELECT * FROM song  where Owner_Id = '".$_SESSION["UID"]."' "; 
   $resultQ = $conn -> query($queryview); 
  } 
 ?> 
 <form action="song_editDetails.php" method="POST">
 
 <table border="2"> 
 <tr> 
 <th> Choose </th>
  <th>Song Id</th> 
  <th>Song Name</th> 
  <th>Artist Name</th> 
  <th>Media URL</th> 
  <th>Genre</th> 
  <th>Language</th> 
  <th>Release Date</th> 
  <th>Owner ID</th>
 </tr> 
  
 <?php 
  if ($resultQ -> num_rows > 0) { 
   while ($row = $resultQ -> fetch_assoc()) { 
 ?> 
 <tr> 
 <td><input type="radio" name="Song_Id" value="<?php echo $row["Song_Id"]; ?>"required></td> 
  <td><?php echo $row["Song_Id"]; ?></td> 
  <td><?php echo $row["Song_Name"]; ?></td> 
  <td><?php echo $row["Artist_Name"]; ?></td> 
  <td><a href="<?php echo $row["Media"]; ?>" target="_blank">visitlink</a></td>
  <td><?php echo $row["Song_Genre"]; ?></td> 
  <td><?php echo $row["Song_Language"]; ?></td> 
  <td><?php echo $row["Release_Date"]; ?></td> 
  <td><?php echo $row["Owner_Id"]; ?></td>
 </tr> 
 <?php 
  } 
  } else { 
   echo "<tr><td colspan='8'>No data selected </td></tr>"; 
  } 
 ?> 
 </table> 

 <?php 
  $conn -> close(); 
 ?> 
  
 <br> <br>
 <input type="submit" value="View record to Edit">

</form>
 </body> 
  
 </html>

 <?php
}
else
{
echo "No session exists or session has expired. Please
log in again.<br>";
echo "<a href=login.html> Login </a>";
}
?>
