<?php
session_start();
if(isset($_SESSION["UID"])) {
?>

<!DOCTYPE html> 
<html lang="en"> 
<head> 
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Song Collection</title> 
    <style>
        body {
            background-color: #191414;
            color: #1DB954;
            font-family: 'Arial', sans-serif;
            text-align: center;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: 20px auto;
            padding: 20px;
            background-color: #282828;
            border: 1px solid #1DB954;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        }

        h2 {
            color: #1DB954;
        }

        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #1DB954;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #191414;
            color: #1DB954;
        }

        td {
            background-color: #282828;
            color: #fff;
        }

        a {
            color: #1DB954;
            text-decoration: none;
        }

        a:hover {
            color: #168038;
        }

        .links-container {
            margin-top: 20px;
            background-color: #282828;
            border: 1px solid #1DB954;
            border-radius: 10px;
            padding: 10px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.5);
        }

        .links {
            display: flex;
            justify-content: space-around;
        }
    </style>
</head> 
 
<body> 
    <div class="container">
        <h2>Song Collection</h2> 
       
        <?php 
        $host = "localhost"; 
        $user = "root"; 
        $pass = ""; 
        $db = "song_collectiondb"; 

        $conn = new mysqli ($host, $user, $pass, $db); 
           
        if ($conn -> connect_error) { 
            die ("Connection Fail ". $conn -> connect_error); 
        } else { 
            $queryview = "SELECT * FROM song WHERE Song_Status = 'Approved'"; 
            $resultQ = $conn -> query($queryview); 
        } 
        ?> 
        
        <table border="2"> 
            <tr> 
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
            if ($resultQ -> num_rows > 0) { 
                while ($row = $resultQ -> fetch_assoc()) { 
            ?> 
                <tr> 
                    <td><?php echo $row["Song_Id"]; ?></td> 
                    <td><?php echo $row["Song_Name"]; ?></td> 
                    <td><?php echo $row["Artist_Name"]; ?></td> 
                    <td><a href="<?php echo $row["Media"]; ?>" target="_blank">visitlink</a></td> 
                    <td><?php echo $row["Song_Genre"]; ?></td> 
                    <td><?php echo $row["Song_Language"]; ?></td> 
                    <td><?php echo $row["Release_Date"]; ?></td> 
                    <td><?php echo $row["Owner_Id"]; ?></td>
                    <td><?php echo $row["Song_Status"]; ?></td>
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
          
        <div class="links-container">
            <div class="links">
                <a href="song_register.php">Add New Song</a>
                <a href="song_deleteView.php">Delete Song</a>
                <a href="song_editView.php">Edit Song</a>
                <a href="menu.php">Back to Menu</a>
            </div>
        </div>
    </div>
</body> 
  
</html>

<?php
}
else
{
    echo "No session exists or session has expired. Please log in again.<br>";
    echo "<a href=login.html> Login </a>";
}
?>
