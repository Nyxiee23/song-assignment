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
<?php
session_start();

if (isset($_SESSION["UID"])) {
    $UserID = $_POST["UserID"];
    $User_Status = $_POST["User_Status"];

    $host = "localhost";
    $user = "root";
    $pass = "";
    $db = "song_collectiondb";

    $conn = new mysqli($host, $user, $pass, $db);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } else {
        $queryUpdate = "UPDATE user_info SET UserStatus = '".$User_Status."' WHERE UserID = '".$UserID."'";

        if ($conn->query($queryUpdate) === TRUE) {
            ?>
            <div class="update-save-container">
                <h3>Success update data</h3>
                <br><br>
                Click <a href='admin_userStatusView.php'> here </a> to view user list.
            </div>
            <?php
        } else {
            echo "Error updating record: " . $conn->error;
        }
    }
    $conn->close();
} else {
    ?>
    <div class="update-save-container">
        No session exists or session has expired. Please log in again.<br>
        <a href="login.html"> Login </a>
    </div>
    <?php
}
?>
</body>
</html>