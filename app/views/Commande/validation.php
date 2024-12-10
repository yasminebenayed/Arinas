<style>
    /* Style for the modal */
    .order-modal {
        display: none;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        padding: 20px;
        background-color: #fff;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        z-index: 1000;
    }

    .overlay-active {
        overflow: hidden;
        /* Prevent page scrolling */
    }

    .overlay-active+.container {
        filter: blur(3px);
        /* Adjust blur as needed */
        pointer-events: none;
        /* Ignore events on blurred elements */
    }

    .overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 999;
    }

    .message-container {
        text-align: center;
    }

    .order-detail {
        margin-top: 20px;
    }

    .customer-details {
        margin-top: 20px;
    }
</style>
<script src="https://smtpjs.com/v3/smtp.js"></script>
<div class="order-modal" id="orderModal">
    <div class="message-container">
        <h3>Merci d'avoir fait vos achats ! Vous recevez un mail pour les détails</h3>
        <div class="order-detail">
            <p>Quantité totale : <span id="orderQuantity"></span></p>
            <p class="total">Montant total : $<span id="orderAmount"></span></p>
        </div>
        <div class="customer-details">
            <p>Votre nom : <span id="orderName"></span></p>
            <p>Votre e-mail : <span id="orderEmail"></span></p>
            <p>Votre adresse : <span id="orderAddress"></span></p>
            <p>Votre mode de paiement : <span id="orderPayment"></span></p>
        </div>
        <a href='index.php?url=produit' class='btn' onclick="closeOrderModal()">Continuer vos achats</a>
    </div>
</div>
<div class="overlay" id="overlay" onclick="closeOrderModal()"></div>
