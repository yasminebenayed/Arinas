<?php
require_once("connexionDb.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $orderId = isset($_POST["orderId"]) ? intval($_POST["orderId"]) : 0;
    $newStatus = isset($_POST["newStatus"]) ? $_POST["newStatus"] : '';

    if ($orderId > 0) {
        try {
            $stmt = $pdo->prepare("UPDATE commande SET status = :newStatus WHERE code = :orderId");
            $stmt->bindParam(':newStatus', $newStatus, PDO::PARAM_STR);
            $stmt->bindParam(':orderId', $orderId, PDO::PARAM_INT);

            if ($stmt->execute()) {
                header("Location: commandes.php?statusUpdate=success");
            } else {
                header("Location: commandes.php?statusUpdate=error");
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
        echo "Invalid order ID.";
    }
    exit;
}
?>
