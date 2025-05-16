<?php
$db = new SQLite3('/home3/eogoaomy/public_html/hugo/db/sqlite.db');

// Insert a new user
$db->exec("INSERT INTO users (name, email) VALUES ('Alice', 'alice@example.com')");

// Query users
$results = $db->query('SELECT * FROM users');

while ($row = $results->fetchArray()) {
    echo "User: {$row['name']}, Email: {$row['email']}<br>";
}
?>
