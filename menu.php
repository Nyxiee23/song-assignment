<?php
session_start();

if (isset($_SESSION["UID"])) {
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
            background-color: #1e1e1e;
            color: #fff;
            margin: 0;
            padding: 0;
            text-align: center;
        }

        h2 {
            color: #1db954;
        }

        p {
            margin: 20px 0;
            font-size: 18px;
        }

        a {
            display: block;
            margin: 10px 0;
            padding: 10px;
            border: 1px solid #1db954;
            border-radius: 4px;
            text-decoration: none;
            color: #fff;
            background-color: #333;
            transition: background-color 0.3s ease-in-out;
        }

        a:hover {
            background-color: #1db954;
        }
    </style>
</head>
<body>
    <h2>WELCOME, Hi <?php echo $_SESSION["UID"]; ?></h2>
    <p>Choose your menu:</p>

    <?php
    if ($_SESSION["userType"] == "admin") {
    ?>
        <a href="admin_viewSong.php">View and Edit Song Details</a>
        <a href="admin_userStatusView.php">Active/Block User Account</a>
		
        <br><br>
    <?php
    } else {
    ?>
        <a href="song_register.php">Register Song</a>
        <a href="song_editView.php">Edit Song Details</a>
        <a href="song_deleteView.php">Delete Song Record</a>
        <a href="viewSong.php">View Song List</a>
    <?php
    }
    ?>
    <a href="logout.php">Logout</a><br>
</body>
</html>
<?php
} else {
    echo "No session exists or the session has expired. Please log in again.<br>";
    echo "<a href='login.html'>Login</a>";
}
?>
