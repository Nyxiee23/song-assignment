<?php

$userID = $_POST['userID'];
$userPwd = $_POST['userPwd'];

$host = "localhost";
$username = "root";
$password = "";
$dbname = "song_collectiondb";

$link = new mysqli($host, $username, $password, $dbname);
if ($link->connect_error) {
    die("Connection failed: " . $link->connect_error);
}
else {
    $queryCheck = "SELECT * FROM user_info WHERE userID = '".$userID."' ";
    $resultCheck = $link->query($queryCheck);

    if ($resultCheck->num_rows == 0) {
        echo "<p style='color:red;'>User ID does not exist</p>";
        echo "<br>Click <a href='login.html'>here</a> to log-in again";
    } else {
        $row = $resultCheck->fetch_assoc();

        if ($row["userPwd"] == $userPwd) {
            if ($row["UserStatus"] == "Active") {
                session_start();
                $_SESSION["UID"] = $userID;
                $_SESSION["userType"] = $row["userType"];
                header("Location:menu.php");
            } else {
                echo "<p style='color:red;'>Your account has been blocked. Please contact the administrator.</p>";
                echo "Click <a href='login.html'>here</a> to log in again";
            }
        } else {
            echo "<p style='color:red;'>Wrong password!!!</p>";
            echo "Click <a href='login.html'>here</a> to login again";
        }
    }
}

$link->close();
?>
