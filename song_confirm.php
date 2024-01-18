<?php
session_start();
if(isset($_SESSION["UID"])) {
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<title>Song Registration Details</title>
<style>
        body {
            background-color: #191414;
            color: #1DB954;
            font-family: 'Arial', sans-serif;
            text-align: center;
            margin: 0;
            padding: 0;
        }

        h1 {
            color: #1DB954;
        }

        table {
            width: 50%;
            margin: 20px auto;
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

        p {
            color: #fff;
        }

        a {
            color: #1DB954;
        }

        a:hover {
            color: #168038;
        }
    </style>
<?php

    $Songname = $_POST["Songname"];    
    $Artistname = $_POST["Artistname"];   
    $Media = $_POST["Media"];   
    $Genre = $_POST["Genre"] ;  
    $Language = $_POST["Language"];   
    $Releasedate = $_POST["Releasedate"] ;
 
?>
 
<body>
<h1>Song Registration Details</h1>
<br>
<table border =1>
<tr>
<th>Song Title:</th>
<td><b style="color:blue"><?php echo $Songname;?></b></td>
</tr>
<tr>
<th>Artist/Band Name:</th>
<td><b><?php echo $Artistname;?></b></td>
</tr>
<tr>
<th>Media URL:</th>
<td><b><?php echo $Media;?></b></td>
</tr>
<tr>
<th>Genre:</th>
<td><b><?php echo $Genre;?></b></td>
</tr>
<tr>
<th>Language:</th>
<td><b><?php echo $Language;?></b></td>
</tr>
<tr>
<th>Release Date:</th>
<td><b><?php echo $Releasedate;?></b></td>
</tr>
</table>
<?php

$host = "localhost";
$user = "root";
$pass = "";
$db = "song_collectiondb";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) { 
    die("Connection Fail" . $conn->connect_error); 
} else {
    if(isset($_POST["Songname"]) && isset($_POST["Artistname"]) && isset($_POST["Media"]) && isset($_POST["Genre"]) && isset($_POST["Language"]) && isset($_POST["Releasedate"])) {
        $Songname = $_POST["Songname"];    
        $Artistname = $_POST["Artistname"];   
        $Media = $_POST["Media"];   
        $Genre = $_POST["Genre"] ;  
        $Language = $_POST["Language"];   
        $Releasedate = $_POST["Releasedate"] ;  

        $dbquery = "INSERT INTO song (Song_Name, Artist_Name, Media, Song_Genre, Song_Language, Release_Date, Owner_ID) VALUES ('".$Songname."', '".$Artistname."','".$Media."', '".$Genre."', '".$Language."', '".$Releasedate."', '".$_SESSION["UID"]."')"; 

        if ($conn->query($dbquery) === TRUE) { 
            echo "<p style='color:blue;'> Success insert record</p>"; 
        } else { 
            echo "<p style='color:red;'> Failed to insert" . $conn->error. "</p>"; 
        }
    } else {
        echo "<p style='color:red;'> Please fill in all the required fields.</p>";
    }
}

$conn->close(); 
?>
<br> 
<P>click <a href="song_register.php">here</a> to enter new song details.</p>
<P>click <a href ="ViewSong.php">here</a> to view ALL song Details.</p>
</body>
</head>
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