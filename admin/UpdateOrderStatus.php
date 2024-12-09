<?php
require_once("connexionDb.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get data from the POST request
    $orderId = isset($_POST["orderId"]) ? intval($_POST["orderId"]) : 0;
    $action = isset($_POST["action"]) ? $_POST["action"] : ''; // 'validate' or 'reset'

    // Validate input
    if ($orderId <= 0 || empty($action)) {
        echo "Invalid input.";
        exit;
    }

    try {
        // Set the status based on the action
        if ($action === 'validate') {
            $newStatus = 1; // Valider
            header('commandes.php');
        } elseif ($action === 'reset') {
            $newStatus = 0; // Reset
            header('commandes.php');
        } else {
            echo "Invalid action.";
            exit;
        }

        // Update the order status in the database
        $stmt = $pdo->prepare("UPDATE commande SET status = :newStatus WHERE code = :orderId");
        $stmt->bindParam(':newStatus', $newStatus, PDO::PARAM_INT);
        $stmt->bindParam(':orderId', $orderId, PDO::PARAM_INT);
        
        if ($stmt->execute()) {
            // Redirect back to the details page with a success message
            header("Location: viewDetails.php?code=$orderId&statusUpdate=success");
            exit;
        } else {
            // Redirect back with an error message
            header("Location: viewDetails.php?code=$orderId&statusUpdate=error");
            exit;
        }
    } catch (PDOException $e) {
        // Handle database errors
        echo "Error: " . $e->getMessage();
        exit;
    }
} else {
    // Redirect back if the request method is not POST
    header("Location: viewDetails.php?statusUpdate=invalidMethod");
    exit;
}
?>
