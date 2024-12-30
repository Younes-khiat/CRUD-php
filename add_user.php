<?php
include 'loadEnv.php';  

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "INSERT INTO users (name, email, password) VALUES ($1, $2, $3)";
    $result = pg_query_params($conn, $query, [$name, $email, $password]);

    if ($result) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . pg_last_error($conn);
    }
}
?>
