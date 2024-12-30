<?php
// loadEnv.php

// Function to load .env file
function loadEnv($file)
{
    $lines = file($file);  // Read the file into an array of lines
    $env = [];
    
    foreach ($lines as $line) {
        // Ignore empty lines or lines starting with # (comments)
        if (empty($line) || $line[0] == '#') {
            continue;
        }

        // Parse key=value and trim spaces
        list($key, $value) = explode('=', $line, 2);
        $env[trim($key)] = trim($value);
    }
    
    return $env;
}

// Load environment variables from .env file
$env = loadEnv(__DIR__ . '/.env');  // Make sure the path is correct

// Database connection using environment variables
$host = $env['DB_HOST'];
$port = $env['DB_PORT'];
$dbname = $env['DB_NAME'];
$user = $env['DB_USER'];
$password = $env['DB_PASSWORD'];

// Establish a connection to the PostgreSQL database
$conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");

if (!$conn) {
    die("Error: Unable to connect to the database.");
}

// Return the connection to use in other scripts
return $conn;
?>
