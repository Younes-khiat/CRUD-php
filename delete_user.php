<?php
include 'loadEnv.php';  

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = "DELETE FROM users WHERE id = $1";
    $result = pg_query_params($conn, $query, [$id]);

    if ($result) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . pg_last_error($conn);
    }
}
?>
