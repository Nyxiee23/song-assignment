<?php
session_start();
if(isset($_SESSION["UID"])) {
?>


<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<title>Song Registration Form </title>
   <style>
        body {
            background-color: #1E1E1E;
            color: #FFFFFF;
            font-family: Arial, sans-serif;
        }

        h2 {
            color: #1DB954;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid #535353;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #282828;
            color: #FFFFFF;
        }

        input[type="text"], input[type="date"], select {
            width: 100%;
            padding: 8px;
            border: 1px solid #535353;
            border-radius: 5px;
            box-sizing: border-box;
            margin-top: 5px;
            margin-bottom: 10px;
            background-color: #282828;
            color: #FFFFFF;
        }

        input[type="submit"] {
            background-color: #1DB954;
            color: #FFFFFF;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #25a25a;
        }
    </style>
</head>

<body>
<h2> Song Registration Form</h2>

<p style="color:blue;font-weight:bold;"> Update pet details </p>

<?php
$Song_Id =$_POST["Song_Id"];
$host = "localhost";
$user = "root";
$pass = "";
$db = "song_collectiondb";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
 die("Connection failed: " . $conn->connect_error);
} else {
 
 $queryGet = "SELECT * FROM song WHERE Song_Id = '".$Song_Id."' ";
 $resultGet = $conn->query($queryGet);
 
 if ($resultGet->num_rows > 0){
?>

<form action="song_editSave.php" name="UpdateForm" method="POST" >

<?php

    while ($row = $resultGet->fetch_assoc()){
?>

Song Id: <b><?php echo $row['Song_Id'];?></b>
<br><br>
Song Name:
<input type="text" name="Songname" value=" <?php echo $row['Song_Name'] ?>" maxlength="20" size ="35" required>
<br><br>
Artist Name: 
<input type="text" name="Artistname" value=" <?php echo $row['Artist_Name'] ?>" maxlength="20" size ="35" required>
<br><br>
Audio/Video URL :
<input type="text" name="Media" value ="<?php echo $row['Media'] ?>" maxlength="30" size="35" required>
<br><br>
Genre : 
<?php $Genre = $row['Song_Genre'];?>
<select id="Genre" name="Genre" required>
            <option value="">Select Genre</option>
            <option value="Rock" <?php if($Genre == "Rock") echo "selected"; ?>> Rock </option>
            <option value="Pop" <?php if($Genre == "Pop") echo "selected"; ?>> Pop </option>
            <option value="Hip Hop" <?php if($Genre == "Hip Hop") echo "selected"; ?>> Hip Hop </option>
            <option value="R&B" <?php if($Genre == "R&B") echo "selected"; ?>> R&B </option>
            <option value="Country" <?php if($Genre == "Country") echo "selected"; ?>> Country </option>
            <option value="Electronic" <?php if($Genre == "Electronic") echo "selected"; ?>> Electronic </option>
            <option value="Jazz" <?php if($Genre == "Jazz") echo "selected"; ?>> Jazz </option>
            <option value="Blues" <?php if($Genre == "Blues") echo "selected"; ?>> Blues </option>
            <option value="Indie" <?php if($Genre == "Indie") echo "selected"; ?>> Indie </option>
    </select>
<br><br>
Language:
<input type="text" name="Language" value="<?php echo $row['Song_Language'] ?>" required>
<br><br>
Release Date:
<input type="date" name="Releasedate" value="<?php echo $row['Release_Date'] ?>" required>
<?php
 
?>
<br><br>
<input type="hidden" name="Song_Id" value="<?php echo $row['Song_Id']?>">
<input type="submit" value="Update New details">
</form>

<?php
    }
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