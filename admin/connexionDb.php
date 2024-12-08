<?php
try {
    $pdo = new PDO("mysql:host=localhost;port=4307;dbname=arinas", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    echo "Database connection failed: " . $e->getMessage();
}
?>
