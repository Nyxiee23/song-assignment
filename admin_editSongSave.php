<?php
session_start();

if (isset($_SESSION["UID"])) {
    ?>
    
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
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

            h3 {
                color: #1db954;
                margin-top: 30px;
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
        <h3>SONG UPDATE SAVE</h3>
        <?php
        $Song_Id = $_POST["Song_Id"];
        $Song_Status = $_POST["Song_Status"];

        $host = "localhost";
        $user = "root";
        $pass = "";
        $db = "song_collectiondb";

        $conn = new mysqli($host, $user, $pass, $db);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } else {
            $queryUpdate = "UPDATE song SET Song_Status = '$Song_Status' WHERE Song_Id = '" . $Song_Id . "'";

            if ($conn->query($queryUpdate) === TRUE) {
                echo "Success update data";
                echo "<br><br>";
                echo "Click <a href='admin_viewSong.php'>here</a> to view song list";
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
