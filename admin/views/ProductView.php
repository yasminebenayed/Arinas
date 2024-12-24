<!DOCTYPE html>
<html lang="en">
<head>
  
    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="assests/images/logo.jpg">
    <title>Product Management</title>
    <style>
        .page-title {
            font-size: 64px;
            font-family: 'Playfair Display', serif;
            color:rgba(1, 0, 0, 0.88) ;
           
            text-align: center;
            
           
        }
        body {
            font-family: 'Playfair Display', serif;
            background-image: url('assests/images/background.jpg');
            background-color: rgb(230, 230, 231);
        }
        .product-list {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-top: 20px;
        }
        .product-card {
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 15px;
            width: 200px;
            text-align: center;
            background: white;
            transition: transform 0.3s ease, background-color 0.3s ease;
        }
        .product-card:hover {
            transform: translateY(-10px);
            background-color: #333;
            color: white;
        }
        .product-card img {
            width: 100%;
            height: 150px;
            object-fit: cover;
            border-radius: 5px;
        }
        .actions {
            margin-top: 10px;
        }
        .actions a {
            text-decoration: none;
            padding: 5px 10px;
            border-radius: 3px;
            margin: 5px;
            display: inline-block;
        }
        .update {
            background-color: rgb(110, 149, 111);
            color: white;
        }
        .delete {
            background-color: black;
            color: white;
        }
        .modal {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            z-index: 1000;
            text-align: center;
        }
        .modal.active {
            display: block;
        }
        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 999;
        }
        .overlay.active {
            display: block;
        }
    </style>
    <script>
        function confirmDelete(codeProduit) {
            document.getElementById("deleteModal").classList.add("active");
            document.getElementById("overlay").classList.add("active");
            document.getElementById("confirmDelete").setAttribute("data-code", codeProduit);
        }

        function closeModal() {
            document.getElementById("deleteModal").classList.remove("active");
            document.getElementById("overlay").classList.remove("active");
        }

        function deleteProduct() {
            const codeProduit = document.getElementById("confirmDelete").getAttribute("data-code");
            window.location.href = `index.php?action=deleteProduct&delete=${codeProduit}`;
        }
    </script>
</head>
<body>
<?php include 'HeaderActions.php'; ?>
    <h1 class="page-title">Product Management</h1>
    <div class="product-list">
        <?php foreach ($products as $p) { ?>
            <div class="product-card">
                <img src="<?= '' . $p->img ?>" alt=""> 
                <h4><?= $p->nomProduit ?></h4>
                <p>Price: <?= $p->prix ?> Dt</p>
                <p>Promotion: <?= $p->promotion ?></p>
                <div class="actions">
                <a href="index.php?action=updateProduct&update=<?= $p->code ?>" class="update">Update</a>
                <a href="#" class="delete" onclick="confirmDelete('<?= htmlspecialchars($p->code) ?>')">Delete</a>
                </div>
            </div>
        <?php } ?>
    </div>
    <div id="deleteModal" class="modal">
    <p>Are you sure you want to delete this product?</p>
        <button id="confirmDelete" class="delete" onclick="deleteProduct()">Yes, Delete</button>
        <button onclick="closeModal()">Cancel</button>
    </div>
    </div>
    <div id="overlay" class="overlay" onclick="closeModal()"></div>
</body>
</html>