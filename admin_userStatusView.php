<?php
session_start();
if (isset($_SESSION["UID"])) {
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

        table {
            width: 40%; /* Adjusted width */
            margin: 20px auto;
            border-collapse: collapse;
            color: #fff;
            background-color: #282828;
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

    <h2>Users List</h2>

    <?php

    $host = "localhost";
    $user = "root";
    $pass = "";
    $db = "song_collectiondb";

    $conn = new mysqli($host, $user, $pass, $db);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } else {
        $queryView = "SELECT * FROM user_info WHERE userType = 'user'";
        $resultQ = $conn->query($queryView);
    }
    ?>

    <table>
        <tr>
            <th>User ID</th>
            <th>User Status</th>
        </tr>
        
        <?php
        if ($resultQ->num_rows > 0) {
            while ($row = $resultQ->fetch_assoc()) {
                ?>
                <tr>
                    <td><?php echo $row["userID"]; ?></td>
                    <td><?php echo $row["UserStatus"]; ?></td>
                </tr>
                <?php
            }
        } else {
            echo "<tr><td colspan='2'>NO data selected</td></tr>";
        }
        ?>
    </table>

    <?php
    $conn->close();
    ?>

    <br>

    Click <a href="admin_editStatusView.php">here</a> to EDIT user status.

    <br><br>

    Click <a href="menu.php">here</a> to MENU page.

</div>

</body>
</html>

<?php
} else {
    echo "No session exists or session has expired. Please log in again.<br>";
    echo "<a href=login.html>Login</a>";
}
?>