<?php
session_start();
if (isset($_SESSION["UID"])) {
?>

<!DOCTYPE html> 
<html> 
<head> 
    <title>Song Registration Form</title> 
	<style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #121212;
            color: #fff;
            margin: 0;
            padding: 0;
            text-align: center;
        }

        h2 {
            color: #1db954;
            margin-bottom: 20px;
        }

        form {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #282828;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
            color: #fff;
        }

        table, th, td {
            border: 1px solid #1db954;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #1db954;
        }

        input[type="radio"] {
            margin: 0;
        }

        input[type="submit"] {
            margin-top: 20px;
            padding: 10px;
            border: none;
            border-radius: 4px;
            background-color: #1db954;
            color: #fff;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #168038;
        }

        a {
            color: #1db954;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
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
 
    $conn = new mysqli($host, $user, $pass, $db); 
   
    if ($conn->connect_error) { 
        die("Connection Fail " . $conn->connect_error); 
    } else { 
        $queryview = "SELECT * FROM song";
        $resultQ = $conn->query($queryview); 
    } 
    ?> 

    <form action="admin_editSongDetails.php" method="POST">
        <table border="2"> 
            <tr> 
                <th>Choose</th>
                <th>Song Id</th> 
                <th>Song Name</th> 
                <th>Artist Name</th> 
                <th>Media URL</th> 
                <th>Genre</th> 
                <th>Language</th> 
                <th>Release Date</th> 
                <th>Owner ID</th>
                <th>Status</th>
            </tr> 
  
            <?php 
            if ($resultQ->num_rows > 0) { 
                while ($row = $resultQ->fetch_assoc()) { 
            ?> 
            <tr> 
                <td><input type="radio" name="Song_Id" value="<?php echo $row["Song_Id"]; ?>" required></td> 
                <td><?php echo $row["Song_Id"]; ?></td> 
                <td><?php echo $row["Song_Name"]; ?></td> 
                <td><?php echo $row["Artist_Name"]; ?></td> 
                <td><a href= "<?php echo $row["Media"]; ?>" target= "_blank">Visit Link</a></td> 
                <td><?php echo $row["Song_Genre"]; ?></td> 
                <td><?php echo $row["Song_Language"]; ?></td> 
                <td><?php echo $row["Release_Date"]; ?></td> 
                <td><?php echo $row["Owner_Id"]; ?></td>
                <td><?php echo $row["Song_Status"]; ?></td>
            </tr> 
            <?php 
                } 
            } else { 
                echo "<tr><td colspan='9'>No data selected </td></tr>"; 
            } 
            ?> 
        </table> 

        <?php 
        $conn->close(); 
        ?> 

        <br> <br>
        <input type="submit" value="View record to Edit">
    </form>
</body> 

</html>

<?php
} else {
    echo "No session exists or session has expired. Please log in again.<br>";
    echo "<a href=login.html> Login </a>";
}
?>
