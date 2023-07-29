<?php
try {
$pdolite = new PDO('sqlite:db.db');
$pdolite->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$createTableQuery = "CREATE TABLE IF NOT EXISTS short_urls (id INTEGER PRIMARY KEY AUTOINCREMENT, hash_url TEXT NOT NULL, html TEXT NOT NULL)";
$pdolite->exec($createTableQuery);
} 
catch (PDOException $e) {die("Error: " . $e->getMessage());
}
?>