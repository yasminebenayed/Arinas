<?php
require_once("connexionDb.php");

// Fetch 'nbrProd' and 'nom' from the 'users' table and order by 'nbrProd' in descending order
$req = "SELECT nbrProd, nom FROM users ORDER BY nbrProd DESC";
$results = $pdo->query($req);
$userData = $results->fetchAll(PDO::FETCH_OBJ);

// Initialize arrays to store numeric values
$user_prod = array();
$user = array();

// Loop through each object and convert 'nbrProd' to integer
foreach ($userData as $item) {
    $user_prod[] = intval($item->nbrProd);
    $user[] = $item->nom;
}

// Generate random colors for the chart
function getRandomColor()
{
    return '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
}

$randomColors = array_map(function () {
    return getRandomColor();
}, $user_prod);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="shortcut icon" href="../assests/images/favicon.png" type="">
    <title>Arinas- Beauty & BodyCare</title>
 
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        /* Button styling for chart type selection */
        button {
            padding: 10px 20px;
            margin: 5px;
            border-radius: 12px;
            border: none;
            background-color: #4caf50;
            color: white;
            cursor: pointer;
        }

        button.active {
            background-color: #ff5722;
        }

        button:hover {
            opacity: 0.9;
        }
    </style>
</head>

<body>
    <div style="width: 70%; margin: 50px auto; text-align: center;">
        <h2>Graphe Clients/Commandes</h2>
        <h4>Choisissez le type de Graphe que vous voulez consulter</h4>
        <button type="button" id="barButton" onclick="changeChartType('bar')" class="active">Bar</button>
        <button type="button" id="lineButton" onclick="changeChartType('line')">Line</button>
        <canvas id="myChart" style="max-width: 100%; margin-top: 20px;"></canvas>
    </div>

    <script>
        // Chart.js initialization
        const ctx = document.getElementById('myChart').getContext('2d');

        const chartData = {
            labels: <?php echo json_encode($user); ?>,
            datasets: [{
                label: 'Commandes/Clients',
                data: <?php echo json_encode($user_prod); ?>,
                backgroundColor: <?php echo json_encode($randomColors); ?>,
                borderWidth: 1
            }]
        };

        const chartOptions = {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        };

        // Create a new Chart.js instance with default type 'bar'
        let myChart = new Chart(ctx, {
            type: 'bar',
            data: chartData,
            options: chartOptions
        });

        // Change chart type function
        function changeChartType(type) {
            // Destroy existing chart
            myChart.destroy();

            // Create a new chart with the selected type
            myChart = new Chart(ctx, {
                type: type,
                data: chartData,
                options: chartOptions
            });

            // Update button styles
            document.getElementById('barButton').classList.toggle('active', type === 'bar');
            document.getElementById('lineButton').classList.toggle('active', type === 'line');
        }
    </script>
</body>

</html>
