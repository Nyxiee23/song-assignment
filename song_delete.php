<?php
session_start();
if(isset($_SESSION["UID"])) {
?>

<!DOCTYPE html>
<html>
<head>
<title> Song Collection</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #121212; /* Spotify black background */
            color: #fff;
            text-align: center;
        }

        h2 {
            color: #1DB954; /* Spotify green heading */
        }

        p {
            color: blue; /* Blue color for success message */
        }

        a {
            color: #1DB954; /* Spotify green color for links */
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline; /* Underline effect on hover for links */
        }
    </style>
</head>

<body>
<h2>Song Collection </h2>

<?php
$Song_Id = $_POST["Song_Id"];

 $host="localhost";
 $user="root";
 $pass="";
 $db="song_collectiondb";

 $conn=new mysqli($host, $user, $pass, $db);

if($conn->connect_error){
  die("Connection failed: ".$conn->connect_error);
  
}else{
 $queryDelete = "DELETE FROM song WHERE Song_Id = '".$Song_Id."' ";
 
 if ($conn->query($queryDelete) === TRUE) {
  echo "<p style='color:blue;'> Record has been delete from database !</p>";
  echo "Click <a href='ViewSong.php'> here </a> to view SONG list ";
 }else{
  echo "<p style='color:red;'>Query problems! : " . $conn->error . "</p>";
 }
}
$conn->close();
?>
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
