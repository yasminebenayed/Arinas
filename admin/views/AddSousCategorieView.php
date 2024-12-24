<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../assets/images/logo.jpg">
    <title>Ajouter une Sous-Catégorie</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
       body {
            font-family: 'Playfair Display', serif;
            background-image: url('assests/images/background.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
          
        }
        .container {
            background: rgba(61, 50, 50, 0.6);
            padding: 30px;
            border-radius: 10px;
            margin-top: 50px;
            max-width: 800px;
        }
        h4 {
            text-align: center;
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 30px;
            color:white;
        }
        .form-group label {
            font-weight: bold;
            color: while;
        }
        .form-control {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: rgba(255, 255, 255, 0.8);
            color: #000;
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
</head>
<body>
 
    <div class="container mt-4">
        <h4 class="mb-4">Ajouter une Sous-Catégorie</h4>
        <form action="index.php?action=addSousCategorie" method="POST">
            <div class="form-group">
                <label for="categoryCode">Catégorie</label>
                <select class="form-control" id="categoryCode" name="categoryCode" required>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?= htmlspecialchars($category->code) ?>"><?= htmlspecialchars($category->nomCategorie) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="sousCategorieName">Sous-Catégorie à ajouter</label>
                <input type="text" class="form-control" id="sousCategorieName" name="sousCategorieName" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</body>
</html>