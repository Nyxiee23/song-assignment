<?php
session_start();
if (isset($_SESSION["UID"])) {
    session_unset();
    session_destroy();
    echo "<!DOCTYPE html>
            <html lang='en'>
            <head>
                <meta charset='UTF-8'>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'>
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

                    .box {
                        max-width: 400px;
                        margin: 50px auto;
                        padding: 20px;
                        background-color: #282828;
                        border-radius: 8px;
                        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                    }

                    p {
                        color: #ff6161;
                        font-size: 18px;
                    }

                    a {
                        color: #1db954;
                        text-decoration: none;
                        border-bottom: 1px solid #1db954;
                        transition: color 0.3s ease-in-out;
                    }

                    a:hover {
                        color: #168038;
                    }
                </style>
            </head>
            <body>
                <div class='box'>
                    <p>You have successfully logged out.</p>
                    <br>
                    Click <a href='login.html'>here</a> to login again.
                </div>
            </body>
            </html>";
} else {
    echo "No session exists or the session has expired. Please log in again.";
    echo "<br>Click <a href='login.html'>here</a> to login again.";
}
?>
