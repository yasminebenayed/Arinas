<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="../assets/images/favicon.png" type="">
    <title>Arinas- Beauty & BodyCare</title>
    <link rel="stylesheet" type="text/css" href="assests/css/bootstrap_prod.css" />
    <link rel="apple-touch-icon" sizes="76x76" href="../dashboard/assets/img/apple-icon.png">
    <link rel="icon" type="image/jpg" href="assests/images/logo.jpg">
    <style>
         body {
            background-image: url('assests/images/background.jpg');
            background-size: cover;
            background-position: center;
            margin: 0;
            font-family: 'Playfair Display', serif;
        }
        h2 {
            text-align: center;
            color: black;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background-color: rgb(206, 233, 207);
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            margin-top: 20px;
        }
        th, td {
            padding: 12px;
            text-align: center;
            font-size: 16px;
        }
        th {
            background-color: rgba(255, 255, 255, 0.9)
            color:black;
            text-transform: uppercase;
            font-weight: bold;
        }
        tr:nth-child(even) {
            background-color: rgba(0, 0, 0, 0.2);
        }
        tr:hover {
            background-color: rgb(206, 233, 207);
        }
        td {
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
            color:black;
        }
        a {
            text-decoration: none;
            padding: 8px 12px;
            border-radius: 5px;
            font-weight: bold;
            color:black;
        }
        a:hover {
            opacity: 0.8;
        }
        .view-details {
            background-color: rgb(110, 149, 111);
            color:black;
        }
    </style>
</head>
<body class="body">
    <?php include 'HeaderActions.php'; ?>
    <h2 class="h2">Table des clients</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Mail</th>
                <th>Tel</th>
                <th>Adresse</th>
                <th>Commandes</th>
            </tr>
        </thead>
        <tbody style="text-align:center">
            <?php foreach($users as $u): ?>
                <tr>
                    <td><?= htmlspecialchars($u->code); ?></td>
                    <td><?= htmlspecialchars($u->nom); ?></td>
                    <td><?= htmlspecialchars($u->mail); ?></td>
                    <td><?= htmlspecialchars($u->tel); ?> Dt</td>
                    <td><?= htmlspecialchars($u->adresse); ?></td>
                    <td><a href="index.php?action=orders&codeUser=<?= htmlspecialchars($u->code); ?>" class="view" title="View" data-toggle="tooltip">view commands</a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>