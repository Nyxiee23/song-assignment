<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Song Registration Form</title>
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

        input[type="submit"] {
            background-color: #1DB954;
            color: #fff;
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            cursor: pointer;
            border-radius: 4px;
        }

        input[type="submit"]:hover {
            background-color: #168038;
        }

        p {
            color: #fff;
        }
    </style>
</head>
<body>
  <h1>Song Registration Details</h1>
  <form method="post" action="song_confirm.php">
    <table>
      <tr>
        <td><label for="Songname">Title of the Song:</label></td>
        <td><input type="text" id="Songname" name="Songname" required></td>
    <tr>
        <td><label for="Artistname">Artist/Band Name:</label></td>
        <td><input type="text" id="Artistname" name="Artistname" required></td>
      </tr>
      <tr>
        <td><label for="Media">Audio/Video URL:</label></td>
        <td><input type="text" id="Media" name="Media" required></td>
      </tr>
      <tr>
        <td><label for="Genre">Genre:</label></td>
        <td>
          <select id="Genre" name="Genre" required>
            <option value="">Select Genre</option>
            <option value="Rock">Rock</option>
            <option value="Pop">Pop</option>
            <option value="Hip Hop">Hip Hop</option>
            <option value="R&B">R&B</option>
            <option value="Country">Country</option>
            <option value="Electronic">Electronic</option>
            <option value="Jazz">Jazz</option>
            <option value="Blues">Blues</option>
            <option value="Indie">Indie</option>
          </select>
        </td>
      </tr>
      <tr>
        <td><label for="Language">Language:</label></td>
        <td><input type="text" id="Language" name="Language" required></td>
      </tr>
      <tr>
        <td><label for="Releasedate">Release Date:</label></td>
        <td><input type="date" id="Releasedate" name="Releasedate" required></td>
      </tr>
    </table>
    <br>
    <input type="submit" value="Submit">
  </form>

<?php
session_start(); // Start the session
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

</body>
</html>