<?php
include_once 'loadEnv.php';  

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "UPDATE users SET name = $1, email = $2, password = $3 WHERE id = $4";
    $result = pg_query_params($conn, $query, [$name, $email, $password, $id]);

    if ($result) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . pg_last_error($conn);
    }
}
?>




<?php
include_once 'loadEnv.php';  
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = pg_query_params($conn, "SELECT * FROM users WHERE id = $1", [$id]);
    $user = pg_fetch_assoc($result);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
</head>
<body>
    <h1>Edit User</h1>
    <form action="edit_user.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?php echo $user['name']; ?>" required>
        <br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo $user['email']; ?>" required>
        <br>
        <label for="password">password:</label>
        <input type="password" id="password" name="password" value="<?php echo $user['password']; ?>" required>
        <br>
        <button type="submit">Update User</button>
    </form>
</body>
</html>
