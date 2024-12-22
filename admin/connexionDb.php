<?php
try {
    $pdo = new PDO("mysql:host=localhost;dbname=arinas;port=4307", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    echo "Database connection failed: " . $e->getMessage();
}
?>
