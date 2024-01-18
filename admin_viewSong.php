<?php
session_start();

if (isset($_SESSION["UID"])) {
    $host = "localhost"; 
    $user = "root"; 
    $pass = ""; 
    $db = "song_collectiondb"; 

    $conn = new mysqli($host, $user, $pass, $db);

    if ($conn->connect_error) { 
        die("Connection Fail " . $conn->connect_error); 
    } else { 
        $searchKeyword = isset($_GET['search']) ? $_GET['search'] : '';
        $queryview = "SELECT * FROM song WHERE 
            Song_Id LIKE '%$searchKeyword%' OR
            Song_Name LIKE '%$searchKeyword%' OR
            Artist_Name LIKE '%$searchKeyword%' OR
            Song_Genre LIKE '%$searchKeyword%' OR
            Song_Language LIKE '%$searchKeyword%' OR
            Release_Date LIKE '%$searchKeyword%' OR
            Owner_Id LIKE '%$searchKeyword%' OR
            Song_Status LIKE '%$searchKeyword%'";

        $resultQ = $conn->query($queryview);
    } 
?>

<!DOCTYPE html> 
<html lang="en"> 
<head> 
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Song Collection</title> 
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
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #282828;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 10px;
            color: #1db954;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            box-sizing: border-box;
            border: 1px solid #1db954;
            border-radius: 4px;
            background-color: #333;
            color: #fff;
            font-size: 16px;
        }

        input[type="submit"] {
            background-color: #1db954;
            color: #fff;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #168038;
        }

        table {
            width: 100%;
            margin-top: 30px;
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
    <h2>Song Collection</h2> 

    <form method="GET" action="">
        <label for="search">Search:</label>
        <input type="text" id="search" name="search" value="<?php echo $searchKeyword; ?>">
        <input type="submit" value="Search">
    </form>

    <table> 
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
        if ($resultQ->num_rows > 0) { 
            while ($row = $resultQ->fetch_assoc()) { 
        ?> 
        <tr> 
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

    <br><br>
    Click <a href="admin_editSongView.php">here</a> to Edit song details. 
    <br><br>
    Click <a href="menu.php">here</a> back to Menu page. 

    <br><br> 
</body> 
</html>

<?php
} else {
    echo "No session exists or session has expired. Please log in again.<br>";
    echo "<a href=login.html> Login </a>";
}
?>
