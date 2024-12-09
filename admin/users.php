<?php
require_once("connexionDb.php");

$req = "SELECT * FROM users";
$results = $pdo->query($req);
$users = $results->fetchAll(PDO::FETCH_OBJ);
//var_dump($users);
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
   
    <link rel="shortcut icon" href="../assests/images/favicon.png" type="">
    <title>Arinas- Beauty & BodyCare</title>
    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="../assests/css/bootstrap_prod.css" />
  


    <link rel="apple-touch-icon" sizes="76x76" href="../dashboard/assets/img/apple-icon.png">
    <link rel="icon" type="image/jpg" href="../assests/images/logo.jpg">
    <!--     Fonts and icons     -->
  

    <!-- CSS Files -->



  
    <style>
        .body{
           background-image: url('../assests/images/final.jpg');
            background-size: cover;
            background-position: center;
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        /* Page title styling */
       .h2 {
            font-size: 64px;
            font-weight: bold;
            color: gold;
            text-shadow: 0 4px 6px rgba(0, 0, 0, 0.5);
            text-align: center;
            background: linear-gradient(to right, #b8860b, #8b7500);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-top: 20px;
        }

        /* Table styling */
        table {
            width: 100%;
            border-collapse: collapse;
            background-color: rgba(139, 69, 19, 0.6); /* Transparent brown */
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

        /* Column title styling */
        th {
            background-color: #730220; /* Brown */
            color: white;
            text-transform: uppercase;
            font-weight: bold;
        }

        /* Row styling */
        tr:nth-child(even) {
            background-color: rgba(255, 215, 0, 0.1);
        }

        tr:hover {
            background-color: rgba(255, 215, 0, 0.3);
        }

        td {
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
            color: white;
        }

        /* Link styling */
        a {
            text-decoration: none;
            padding: 8px 12px;
            border-radius: 5px;
            font-weight: bold;
            color: #000;
        }

        a:hover {
            opacity: 0.8;
        }

        .view-details {
            background-color: #c7522a; /* Dark brown */
            color: white;
        }
    </style>


</head>


<body class="body">


  
        <div >
            <div >
                <div >
                    <div >
                        <div >
                            <div >
                                <h2 class="h2" >Table des clients</h2>
                            </div>
                        </div>
                        <div >
                            <div >
                                <table>
                                    <thead>
                                        <tr>
                                            <th
                                           >
                                                ID</th>
                                            <th
                                            >
                                                Nom</th>
                                            <th
                                           >
                                                Mail</th>
                                            <th
                                           >
                                                Tel</th>
                                            <th
                                               >
                                                Adresse</th>
                                            <th>Commandes</th>
                                        </tr>
                                    </thead>
                                    <tbody style="text-align:center">
                                        <?php
                                        foreach($users as $u) {
                                            echo "<tr>";
                                            echo "<td id='$u->code' name='$u->code'>".$u->code."</td>";
                                            echo "<td>".$u->nom."</td>";
                                            echo "<td>".$u->mail."</td>";
                                            echo "<td>".$u->tel." Dt </td>";
                                            echo "<td>".$u->adresse."</td>";
                                            echo "<td>";
                                            echo "<a href='commandes.php?codeUser=". $u->code . "' class='view' title='View' data-toggle='tooltip'>view commands</a>";
                                            echo "</td>";
                                            echo "</tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end inner page section -->
        <!-- product section -->
        <style>
            .product_section .row {
                display: flex;
                flex-wrap: wrap;
                margin: -10px;
                /* Negative margin to offset the margin on the boxes */
            }

            .box {
                flex: 1 0 calc(25% - 20px);
                /* Adjust the width and margin as needed */
                margin: 10px;
                /* Adjust the margin as needed */
            }

            .box img {
                width: 100%;
                height: auto;
                /* Ensure images don't stretch */
            }

            .detail-box {
                text-align: center;
                /* Center-align the text in the detail-box */
            }

            @media (max-width: 1200px) {
                .box {
                    flex-basis: calc(33.3333% - 20px);
                    /* Adjust the width for medium screens */
                }
            }

            @media (max-width: 992px) {
                .box {
                    flex-basis: calc(50% - 20px);
                    /* Adjust the width for small screens */
                }
            }

            @media (max-width: 768px) {
                .box {
                    flex-basis: calc(100% - 20px);
                    /* Adjust the width for extra small screens */
                }
            }
        </style>
 
    </main>







  
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>

</body>

</html>