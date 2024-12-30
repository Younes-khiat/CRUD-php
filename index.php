<?php
include 'loadEnv.php';  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
</head>
<body>
    <h1>User Management</h1>

    <!-- Display Users Table -->
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Password</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $result = pg_query($conn, "SELECT * FROM users");
            while ($row = pg_fetch_assoc($result)) {
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['name']}</td>
                        <td>{$row['email']}</td>
                        <td>{$row['password']}</td>

                        <td>
                            <a href='edit_user.php?id={$row['id']}'>Edit</a>
                            <a href='delete_user.php?id={$row['id']}'>Delete</a>
                        </td>
                      </tr>";
            }
            ?>
        </tbody>
    </table>

    <!-- Add User Form -->
    <h2>Add User</h2>
    <form action="add_user.php" method="POST">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>
        <br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <br>
        <button type="submit">Add User</button>
    </form>
</body>
</html>
