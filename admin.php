<?php
// Assume you have a database connection established

// Function to get all songs
function getAllSongs() {
    // Query to retrieve all songs
    $query = "SELECT * FROM song";
    // Execute the query and return results
    // (You need to replace this with your actual database interaction code)
}

// Function to update song status
function updateSongStatus($songId, $status) {
    // Query to update song status
    $query = "UPDATE song SET status = '$status' WHERE id = $songID";
    // Execute the query
    // (You need to replace this with your actual database interaction code)
}

// Function to update user status
function updateUserStatus($userId, $status) {
    // Query to update user status
    $query = "UPDATE users SET status = '$status' WHERE id = $userID";
    // Execute the query
    // (You need to replace this with your actual database interaction code)
}

// Function to search songs by keyword
function searchSongs($keyword) {
    // Query to search for songs based on keyword
    $query = "SELECT * FROM songs WHERE Song_Name LIKE '%$keyword%' OR Artist_Name LIKE '%$keyword%'";
    // Execute the query and return results
    // (You need to replace this with your actual database interaction code)
}

// Sample usage of the functions
$songs = getAllSongs();

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['updateStatus'])) {
        $songId = $_POST['Song_Id'];
        $status = $_POST['status'];
        updateSongStatus($songId, $status);
    } elseif (isset($_POST['blockUser'])) {
        $userId = $_POST['userID'];
        updateUserStatus($userId, 'block');
    } elseif (isset($_POST['unblockUser'])) {
        $userId = $_POST['userID'];
        updateUserStatus($userId, 'active');
    } elseif (isset($_POST['search'])) {
        $keyword = $_POST['keyword'];
        $songs = searchSongs($keyword);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
</head>
<body>

<h1>Admin Dashboard</h1>

<!-- Display all songs -->
<h2>All Songs</h2>
<table border="1">
    <tr>
        <th>Song ID</th>
        <th>Title</th>
        <th>Artist</th>
        <th>Status</th>
        <th>Action</th>
    </tr>
    <?php foreach ($Song_Id as $Song_Id): ?>
        <tr>
            <td><?= $song['id'] ?></td>
            <td><?= $song['title'] ?></td>
            <td><?= $song['artist'] ?></td>
            <td><?= $song['status'] ?></td>
            <td>
                <form method="post">
                    <input type="hidden" name="songId" value="<?= $song['id'] ?>">
                    <select name="status">
                        <option value="Approved">Approved</option>
                        <option value="Rejected">Rejected</option>
                    </select>
                    <button type="submit" name="updateStatus">Update Status</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<!-- Block/Unblock Users -->
<h2>User Management</h2>
<table border="1">
    <tr>
        <th>User ID</th>
        <th>Status</th>
        <th>Action</th>
    </tr>
    <?php
    // Fetch users from the database (you need to replace this with actual code)
    $users = getAllUsers();

    foreach ($users as $user):
    ?>
        <tr>
            <td><?= $user['id'] ?></td>
            <td><?= $user['status'] ?></td>
            <td>
                <?php if ($user['status'] === 'active'): ?>
                    <form method="post">
                        <input type="hidden" name="userId" value="<?= $user['id'] ?>">
                        <button type="submit" name="blockUser">Block User</button>
                    </form>
                <?php elseif ($user['status'] === 'block'): ?>
                    <form method="post">
                        <input type="hidden" name="userId" value="<?= $user['id'] ?>">
                        <button type="submit" name="unblockUser">Unblock User</button>
                    </form>
                <?php endif; ?>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<!-- Search Songs -->
<h2>Search Songs</h2>
<form method="post">
    <label for="keyword">Keyword:</label>
    <input type="text" name="keyword" id="keyword">
    <button type="submit" name="search">Search</button>
</form>

</body>
</html>
