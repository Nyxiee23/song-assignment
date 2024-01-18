<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Songs Collection</title>
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
            margin-top: 30px;
        }

        form {
            max-width: 400px;
            margin: 20px auto;
            padding: 20px;
            background-color: #282828;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        input[type="radio"] {
            margin-right: 5px;
        }

        input[type="submit"] {
            background-color: #1db954;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #168038;
        }
    </style>
</head>
<body>
<?php
session_start();
$UserID = $_POST["UserID"];
$host = "localhost";
$user = "root";
$pass = "";
$db = "song_collectiondb";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$queryGet = "SELECT * FROM user_info WHERE userID = '" . $UserID . "' ";
$resultGet = $conn->query($queryGet);

if ($resultGet->num_rows > 0) {
    while ($baris = $resultGet->fetch_assoc()) {
        ?>
        <h2>Songs Collection List</h2>
        <p>Update user details</p>
        <form action="admin_editStatusSave.php" name="UpdateForm" method="POST">
            <label>User ID: <b><?php echo $baris['userID']; ?></b></label>
			<br><br>
            <label>User Status:</label>
            <?php $UStatus = $baris['UserStatus']; ?>
            <input type="radio" name="User_Status" value="Active" <?php echo ($UStatus == "Active") ? "checked" : ""; ?> required> Active
            <input type="radio" name="User_Status" value="Blocked" <?php echo ($UStatus == "Blocked") ? "checked" : ""; ?> required> Blocked
            <br><br>
            <input type="hidden" name="UserID" value="<?php echo $baris['userID'] ?>">
            <input type="submit" value="Update New details">
        </form>
        <?php
    }
    $conn->close();
} else {
    echo "No session exists or session has expired. Please log in again.<br>";
    echo "<a href=login.html> Login </a>";
}
?>
</body>
</html>
