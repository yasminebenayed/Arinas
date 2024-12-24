<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
    <link rel="icon" type="image/jpg" href="assests/images/logo.jpg">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <style>
       body {
            font-family: 'Playfair Display', serif;
            background-image: url('assests/images/photo kbira.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
          
        }
        .container {
            background-color: rgba(11, 9, 9, 0.33);
            padding: 30px;
            border-radius: 10px;
            margin-top: 50px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
        h2 {
            text-align: center;
            font-size: 36px;
            font-weight: bold;
            margin-bottom: 30px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            font-weight: bold;
            rgba(43, 41, 13, 0.81);
        }
        input, select, textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 3px;
            margin-bottom: 15px;
            background-color:rgb(230, 230, 231);
            color: black;
        }
        textarea {
            height: 150px;
        }
        .error-message {
            color: red;
            display: none;
        }
        .btn-primary {
            background-color:rgb(110, 149, 111);
            border-color:rgb(7, 12, 7);
            color: black;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 18px;
            width: 100%;
        }
        .btn-primary:hover {
            background-color:rgb(155, 179, 156);
            border-color:rgb(206, 233, 207);
        }
    </style>
    <script>
        function fetchSubCategories(categoryCode) {
            if (categoryCode) {
                fetch(`getSubCategories.php?category_code=${categoryCode}`)
                    .then(response => response.json())
                    .then(data => {
                        const subCategorySelect = document.getElementById('sous_categorie');
                        subCategorySelect.innerHTML = '<option value="">Select Subcategory</option>';
                        data.forEach(subCategory => {
                            const option = document.createElement('option');
                            option.value = subCategory.code;
                            option.textContent = subCategory.nom_sous_cat;
                            subCategorySelect.appendChild(option);
                        });
                    })
                    .catch(error => console.error('Error fetching subcategories:', error));
            } else {
                document.getElementById('sous_categorie').innerHTML = '<option value="">Select Subcategory</option>';
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            const categorySelect = document.getElementById('categorie');
            categorySelect.addEventListener('change', function() {
                fetchSubCategories(this.value);
            });
        });
    </script>
</head>
<body>
    <?php include 'HeaderActions.php'; ?>
    <div class="container">
        <h2>Add Product</h2>
        <form action="index.php?action=addProduct" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nomProduit">Produit:</label>
                <input type="text" class="form-control" id="nomProduit" name="nomProduit" required>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea class="form-control" id="description" name="description" required></textarea>
            </div>
            <div class="form-group">
                <label for="designation">Designation:</label>
                <textarea class="form-control" id="designation" name="designation" required></textarea>
            </div>
            <div class="form-group">
                <label for="categorie">Catégorie:</label>
                <select class="form-control" id="categorie" name="categorie" required>
                    <option value="">Select Category</option>
                    <?php foreach ($categories as $c): ?>
                        <option value="<?= htmlspecialchars($c->code) ?>"><?= htmlspecialchars($c->nomCategorie) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="sous_categorie">Sous-Catégorie:</label>
                <select class="form-control" id="sous_categorie" name="sous_categorie" required>
                    <option value="">Select Subcategory</option>
                </select>
            </div>
            <div class="form-group">
                <label for="marque">Marque:</label>
                <select class="form-control" id="marque" name="marque" required>
                    <?php foreach ($marques as $m): ?>
                        <option value="<?= htmlspecialchars($m->code) ?>"><?= htmlspecialchars($m->nomMarque) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="quantite">Quantité en stock:</label>
                <input type="number" class="form-control" id="quantite" name="quantite" required>
            </div>
            <div class="form-group">
                <label for="prix">Prix unitaire:</label>
                <input type="number" class="form-control" id="prix" name="prix" required>
            </div>
            <div class="form-group">
                <label for="promo">Promotion:</label>
                <input type="number" class="form-control" id="promo" name="promo" required min="0" max="100" oninput="validatePromo()">
                <div id="promo-error" class="error-message">La promotion doit être entre 0% et 100%.</div>
            </div>
            <div class="form-group">
                <label for="image">Image:</label>
                <input type="file" class="form-control" id="image" name="image" accept="image/*">
            </div>
            <button type="submit" name="addProduct" class="btn btn-primary">Ajouter le produit</button>
        </form>
    </div>

    <script>
        function validatePromo() {
            var promoInput = document.getElementById("promo");
            var errorMessage = document.getElementById("promo-error");

            if (promoInput.value < 0 || promoInput.value >= 100) {
                promoInput.style.borderColor = "red";
                errorMessage.style.display = "block";
            } else {
                promoInput.style.borderColor = "";
                errorMessage.style.display = "none";
            }
        }
    </script>
</body>
</html>