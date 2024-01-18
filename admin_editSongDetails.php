<?php
session_start();
if(isset($_SESSION["UID"])) {
?>

<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Song Registration Form</title>
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
            margin-bottom: 20px;
        }

        p {
            color: blue;
            font-weight: bold;
        }

        form {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #282828;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        label {
            color: #1db954;
            font-weight: bold;
        }

        table {
            width: 100%;
            margin-top: 20px;
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

        input[type="radio"] {
            margin: 0;
        }

        input[type="submit"] {
            margin-top: 20px;
            padding: 10px;
            border: none;
            border-radius: 4px;
            background-color: #1db954;
            color: #fff;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #168038;
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
    <h2>Song Registration Form</h2>
    <p>Update song details</p>

    <?php
    $Song_Id = $_POST["Song_Id"];
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

        if ($resultGet->num_rows > 0) {
            ?>
            <form action="admin_editSongSave.php" name="UpdateForm" method="POST">
                <?php
                while ($baris = $resultGet->fetch_assoc()) {
                    ?>
                    <label>Song Id: <b><?php echo $baris['Song_Id']; ?></b></label><br><br>
                    <label>Song Name: <?php echo $baris['Song_Name'] ?></label><br><br>
                    <label>Artist Name: <?php echo $baris['Artist_Name'] ?></label><br><br>
                    <label>Audio/Video URL: <td><a href= "<?php echo $row["Media"]; ?>" target= "_blank">Visit Link</a></td><br><br>
                    <label>Genre: <?php echo $baris['Song_Genre']; ?></label><br><br>
                    <label>Language: <?php echo $baris['Song_Language'] ?></label><br><br>
                    <label>Release Date: <?php echo $baris['Release_Date'] ?></label><br><br>
                    <label>Song Status: 
                        <?php $SStatus = $baris['Song_Status']; ?>
                        <input type="radio" name="Song_Status" value="Pending" <?php if ($SStatus == "Pending") echo "checked"; ?> required> Pending
                        <input type="radio" name="Song_Status" value="Approved" <?php if ($SStatus == "Approved") echo "checked"; ?> required> Approved
                        <input type="radio" name="Song_Status" value="Rejected" <?php if ($SStatus == "Rejected") echo "checked"; ?> required> Rejected
                    </label><br><br>
                    <input type="hidden" name="Song_Id" value="<?php echo $baris['Song_Id']?>">
                    <input type="submit" value="Update New details">
                <?php
                }
            }
        }
        $conn->close();
        ?>
    </form>
</body>
</html>

<?php
} else {
    echo "No session exists or session has expired. Please log in again.<br>";
    echo "<a href=login.html> Login </a>";
}
?>
