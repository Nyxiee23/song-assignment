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
            width: 60%;
            margin: 20px auto;
            border-collapse: collapse;
            color: #fff;
            background-color: #282828;
        }

        table, th, td {
            border: 1px solid #1db954;
        }

        th, td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #1db954;
        }

        input[type="radio"] {
            margin-left: 5px;
        }

        input[type="submit"] {
            background-color: #1db954;
            color: #fff;
            padding: 8px 15px;
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

        ?>

        <form action="admin_editStatusDetails.php" method="post" onsubmit="return confirm('Are you sure to edit this record ?')">
            <table border="1">
                <tr>
                    <th>Choose</th>
                    <th>User ID</th>
                    <th>User Status</th>
                </tr>

                <?php
                if ($resultQ->num_rows > 0) {
                    while ($row = $resultQ->fetch_assoc()) {
                        ?>
                        <tr>
                            <td><input type="radio" name="UserID" value="<?php echo $row["userID"]; ?>" required></td>
                            <td><?php echo $row["userID"]; ?></td>
                            <td><?php echo $row["UserStatus"]; ?></td>
                        </tr>
                        <?php
                    }
                } else {
                    echo '<tr><td colspan="3" style="color: red;">NO data selected</td></tr>';
                }
                }
                ?>
            </table>

            <br>

            <input type="submit" value="View Record to Edit">
        </form>

        <?php
        $conn->close();
        ?>

        <br>
    </div>

</body>
</html>