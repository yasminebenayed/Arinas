<?php
require_once("connexionDb.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Assuming you have a database connection
    $pdo = new PDO("mysql:host=localhost;dbname=arinas", "root", "");

    // Get data from the AJAX request
    $orderId = isset($_POST["orderId"]) ? intval($_POST["orderId"]) : 0;
    $newStatus = isset($_POST["newStatus"]) ? $_POST["newStatus"] : '';

    // Validate inputs (add more validation as needed)
    if ($orderId <= 0 || empty($newStatus)) {
        echo json_encode(["success" => false, "error" => "Invalid input"]);
        exit;
    }

    // Update the order status in the database
    $stmt = $pdo->prepare("UPDATE commande SET status = :newStatus WHERE code = :orderId");
    $stmt->bindParam(':newStatus', $newStatus);
    $stmt->bindParam(':orderId', $orderId);
    
    if ($stmt->execute()) {
        // Send a success response
        echo json_encode(["success" => true]);
        exit;
    } else {
        // Send an error response if the update fails
        echo json_encode(["success" => false, "error" => "Database error"]);
        exit;
    }
}

// Send an error response if the request method is not POST
echo json_encode(["success" => false, "error" => "Invalid request method"]);