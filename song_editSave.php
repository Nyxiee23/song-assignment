<?php
session_start();
if (isset($_SESSION["UID"])) {
    ?>

    <!DOCTYPE html>
    <html>
    <head>
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

        .update-save-container {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            background-color: #282828;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h3 {
            color: #1db954;
            margin-top: 0;
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
    <h3> SONG UPDATE SAVE </h3>
    <?php
    $Song_Id = $_POST["Song_Id"]; // Add this line to retrieve Song_Id from the form
    $Songname = $_POST["Songname"];
    $Artistname = $_POST["Artistname"];
    $Media = $_POST["Media"];
    $Genre = $_POST["Genre"];
    $Language = $_POST["Language"];
    $Releasedate = $_POST["Releasedate"];

    $host = "localhost";
    $user = "root";
    $pass = "";
    $db = "song_collectiondb";

    $conn = new mysqli($host, $user, $pass, $db);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } else {
        $queryUpdate = "UPDATE song SET
        Song_Name = '" . $Songname . "', Artist_Name = '" . $Artistname . "',
        Media = '" . $Media . "', Song_Genre = '" . $Genre . "',
        Song_Language = '" . $Language . "', Release_Date = '" . $Releasedate . "'
        WHERE Song_Id = '" . $Song_Id . "'"; // Remove the extra comma here

        if ($conn->query($queryUpdate) === TRUE) {
            echo "Success update data";
            echo "<br><br>";
            echo "Click <a href='viewSong.php'> here </a> to view song list ";
        } else {
            echo "Error updating record: " . $conn->error;
        }
    }
    $conn->close();
    ?>

    </body>
    </html>

    <?php
} else {
    echo "No session exists or session has expired. Please log in again.<br>";
    echo "<a href=login.html> Login </a>";
}
?>
