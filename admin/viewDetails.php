<?php
require_once("connexionDb.php");



//var_dump($_GET);
//var_dump($_GET['code']);
// Check if the category code is set in the URL
$code_commande = "";
if (isset($_GET['codeUser'])) {
    $code_commande = $_GET['codeUser'];
} else if (isset($_GET['code'])) {
    $code_commande = $_GET['code'];
}
//Commandes
$req = "SELECT * FROM commande WHERE code = :code_commande ORDER BY date DESC";
$stmt = $pdo->prepare($req);
$stmt->bindParam(':code_commande', $code_commande);
$stmt->execute();
$commande = $stmt->fetch(PDO::FETCH_OBJ);
//var_dump($commande);
//Status
$status = $commande->status;
//var_dump($status);
//client
$code_client = $commande->code_client;
//var_dump($code_client);
$req1 = "SELECT nom FROM users WHERE code = :code_client";
$stmt = $pdo->prepare($req1);
$stmt->bindParam(':code_client', $code_client);
$stmt->execute();
$nom_client = $stmt->fetch(PDO::FETCH_OBJ);
//var_dump($nom_client);
// Use a prepared statement to prevent SQL injection
//*********Details*******/
$req2 = "SELECT * FROM details_commande WHERE code_commande = :code_commande";
$stmt = $pdo->prepare($req2);
$stmt->bindParam(':code_commande', $code_commande);
$stmt->execute();
$detailsCommande = $stmt->fetchAll(PDO::FETCH_OBJ);
//var_dump($detailsCommande);


// } else {
//     // Handle the case when category code is not provided
//     echo "Commande code not specified.";
//     exit();
// }
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Site Metas -->
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="shortcut icon" href="images/favicon.png" type="">
    <title>Arinas- Beauty & BodyCare</title>
    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="../assests/css/bootstrap_prod.css" />
    <!-- font awesome style -->
    <link href="../assests/css/font-awesome_prod.min.css" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="../assests/css/style_prod.css" rel="stylesheet" />
    <!-- responsive style -->
    <link href="../assests/css/responsive_prod.css" rel="stylesheet" />


    <link rel="apple-touch-icon" sizes="76x76" href="../dashboard/assets/img/apple-icon.png">
    <link rel="icon" type="image/jpg" href="../assests/images/logo.jpg">
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />

    <!-- Nucleo Icons -->
    <link href="../dashboard/assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="../dashboard/assets/css/nucleo-svg.css" rel="stylesheet" />

    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>

    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">

    <!-- CSS Files -->



    <link id="pagestyle" href="../dashboard/assets/css/material-dashboard.css?v=3.1.0" rel="stylesheet" />
    <style>
        /* Style for the modal */
        .delete-modal {
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
            /* Empêche le défilement de la page */
        }

        .overlay-active+.container {
            filter: blur(3px);
            /* Ajustez le flou selon vos préférences */
            pointer-events: none;
            /* Ignore les événements sur les éléments de la page */
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

        .form-group {
            margin-bottom: 15px;
        }

        label {
            font-weight: bold;
        }

        input[type="text"],
        select {
            width: 100%;
            padding: 8px;
            border-radius: 3px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }

        input[type="file"] {
            margin-top: 5px;
        }
    </style>


    <!-- Nepcha Analytics (nepcha.com) -->
    <!-- Nepcha is a easy-to-use web analytics. No cookies and fully compliant with GDPR, CCPA and PECR. -->
    <script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>


</head>

<body class="g-sidenav-show  bg-gray-100">
    <aside
        class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark"
        id="sidenav-main">

        <div class="sidenav-header">
            <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
                aria-hidden="true" id="iconSidenav"></i>
            <a class="navbar-brand m-0" href="admin.php" target="_blank">
                <img src="../assests/images/logo.jpg" class="navbar-brand-img h-100" alt="logo"
                    style=" border-radius: 80%">
                <span class="ms-1 font-weight-bold text-white">Arinas</span>
            </a>
        </div>


        <hr class="horizontal light mt-0 mb-2">

        <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link text-white " href="admin.php">

                        <div class="text-white text-center  me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">table_view</i>
                        </div>
                        <span class="nav-link-text ms-1">Produits</span>
                    </a>
                </li>

                <li class="nav-item">
                    <?php if (isset($_GET['codeUser'])) { ?>
                        <a class="nav-link text-white active" href="users.php">
                        <?php } else { ?>
                            <a class="nav-link text-white " href="users.php">
                            <?php } ?>
                            <div class="text-white text-center  me-2 d-flex align-items-center justify-content-center">


                                <i class="material-icons opacity-10">person</i>
                            </div>
                            <span class="nav-link-text ms-1">Users</span>
                        </a>
                </li>


                <li class="nav-item">
                    <a class="nav-link text-white " href="categorie.php">

                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">receipt_long</i>
                        </div>

                        <span class="nav-link-text ms-1">Categories</span>
                    </a>
                </li>



                <li class="nav-item">
                    <?php if (isset($_GET['codeUser'])) { ?>
                        <a class="nav-link text-white  " href="commandes.php">
                        <?php } else { ?>
                            <a class="nav-link text-white active " href="commandes.php">
                            <?php } ?>
                            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="material-icons opacity-10">notifications</i>
                            </div>

                            <span class="nav-link-text ms-1">Commandes</span>
                        </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-white " href="dashboard.php">

                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">dashboard</i>
                        </div>

                        <span class="nav-link-text ms-1">Dashboard</span>
                    </a>
                </li>


                <li class="nav-item mt-3">
                    <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Account pages
                    </h6>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-white " href="dashboard/pages/profile.html">

                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">person</i>
                        </div>

                        <span class="nav-link-text ms-1">Profile</span>
                    </a>
                </li>


                <li class="nav-item">
                    <a class="nav-link text-white " href="dashboard/pages/sign-in.html">

                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">login</i>
                        </div>

                        <span class="nav-link-text ms-1">Sign In</span>
                    </a>
                </li>


                <li class="nav-item">
                    <a class="nav-link text-white " href="dashboard/sign-up.html">

                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">assignment</i>
                        </div>

                        <span class="nav-link-text ms-1">Sign Up</span>
                    </a>
                </li>
            </ul>
        </div>

    </aside>
    <main class="main-content border-radius-lg ">
        <!-- Navbar -->
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
            data-scroll="true">
            <div class="container-fluid py-1 px-3">
                <nav aria-label="breadcrumb">
                    <div class="container">
                        <div class="heading_container heading_center">
                            <h2>
                                Arinas Admin
                            </h2>
                        </div>
                    </div>

                </nav>
                <div aria-label="breadcrumb" class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                <div class="ms-md-auto pe-md-3 d-flex align-items-center">
</div>    
                    <ul class="navbar-nav  justify-content-end">
                        <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                            <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                                <div class="sidenav-toggler-inner">
                                    <i class="sidenav-toggler-line"></i>
                                    <i class="sidenav-toggler-line"></i>
                                    <i class="sidenav-toggler-line"></i>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item px-3 d-flex align-items-center">
                            <a href="javascript:;" class="nav-link text-body p-0">
                                <i class="fa fa-cog fixed-plugin-button-nav cursor-pointer"></i>
                            </a>
                        </li>
                        <li class="nav-item d-flex align-items-center">
                            <a href="dashboard/pages/sign-in.html" class="nav-link text-body font-weight-bold px-0">
                                <i class="fa fa-user me-sm-1"></i>

                                <span class="d-sm-inline d-none">Sign In</span>

                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3 text-center">
                                <div class="d-flex justify-content-between align-items-center px-3">
                                    <h6 class="text-white text-capitalize" style="margin: 0 auto;">
                                        Les Details de la commande de
                                        <?php echo $nom_client->nom ?> Faite à
                                        <?php echo $commande->date ?>
                                    </h6>
                                    <input type="hidden" id="commandCode" value="<?php echo $commande->code?>" />

                                </div>
                            </div>


                            <div class="card-body px-0 pb-2">
                                <div class="table-responsive p-0">
                                    <table class="table align-items-center mb-0 ">
                                        <thead style="text-align:center">
                                            <tr>
                                                <th class="text-secondary opacity-7" style="width:35%">Nom Produit</th>
                                                <th class="text-secondary opacity-7" style="width:35%">Image
                                                </th>
                                                <th class="text-secondary opacity-7" style="width:35%">Quantité</th>
                                                <th class="text-secondary opacity-7" style="width:35%">Prix</th>

                                                <!-- <th class="text-secondary opacity-7">Modifier catégorie</th> -->
                                            </tr>
                                        </thead>
                                        <tbody style="text-align:center">
                                            <?php
                                            foreach ($detailsCommande as $dc) {
                                                $code_produit = $dc->code_produit;
                                                $stmt = $pdo->prepare("SELECT nomProduit,img FROM produit WHERE code = :code_produit");
                                                $stmt->bindParam(':code_produit', $code_produit);
                                                $stmt->execute();
                                                $nom_prod = $stmt->fetch(PDO::FETCH_OBJ);
                                                //var_dump($nom_prod);
                                                echo "<tr>";
                                                echo "<td>" . $nom_prod->nomProduit . "</td>";
                                                echo "<td><img src='../" . $nom_prod->img . "' width='80' height='80'></td>";
                                                echo "<td>" . $dc->quantite . "</td>";
                                                echo "<td>" . $dc->sous_total . " Dt</td>";
                                                echo "</tr>";
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                            <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

                            <script>
                                // Function to delete sous_categorie using AJAX
                                function deleteSousCategorie(code) {
                                    // Send an AJAX request to delete.php
                                    $.ajax({
                                        type: 'POST',
                                        url: 'sous_cat.php?category_code=<?php echo $categoryCode; ?>',
                                        data: {
                                            delete: code
                                        },
                                        success: function (response) {
                                            // Update the table content after successful deletion
                                            updateTable();
                                        }
                                    });
                                }

                                // Function to update the table content using AJAX
                                function updateTable() {
                                    // Send an AJAX request to fetch.php to get updated data
                                    $.ajax({
                                        type: 'GET',
                                        url: 'fetch_categorie.php?category_code=<?php echo $categoryCode; ?>',
                                        success: function (data) {
                                            // Update the table content with the received data
                                            $('table tbody').html(data);
                                        }
                                    });
                                }

                                // Example: Attach a click event to a delete button
                                $(document).on('click', '.delete-btn', function () {
                                    var code = $(this).data('code');
                                    deleteSousCategorie(code);
                                });

                                // Initial table update when the page loads
                                updateTable();
                            </script>
                        </div>
                    </div>
                    <div class="d-flex align-items-center justify-content-center">
                        <h3 style="padding-right: 5px; margin-right: 50px; margin-bottom: 0;">
                            Prix Total: &nbsp;
                            <?php echo $commande->montant ?> Dt
                        </h3>
                        <?php
                        if ($commande->status === "Accepté") {
                            if (isset($_GET['codeUser'])) {
                                // Code to complete 1
                                echo '<strong style="color: green;">Commande Validée</strong>';
                            } else {
                                echo '<button class="btn btn-primary ml-10" onclick="showAlertAndDisable()">Valider</button>';
                            }
                        } else {
                            if (isset($_GET['codeUser'])) {
                                // Code to complete 2
                                echo '<strong style="color: orange;">Commande En Cours</strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                                echo '<button class="btn btn-primary ml-1" onclick="location.href=\'viewDetails.php?code=' . $commande->code . '&codecomm='.isset($_GET['codeUser']).'\'">Gérer commande</button>';
                            } else {
                                echo '<button class="btn btn-primary ml-10" onclick="validateCommande()">Valider</button>';
                            }

                        }
                        ?>


                        <script>
                            function showAlertAndDisable() {
                                alert("Cette Commande est déjà Validée");
                                var button = document.querySelector('.btn-primary');
                                button.disabled = true; // Disable the button after showing the alert
                            }

                            function validateCommande() {
                                // Assuming the code of the command is stored in a hidden input with ID 'commandCode'
                                var codeCommande = document.getElementById('commandCode').value;

                                // Make an AJAX request to update the status
                                var xhr = new XMLHttpRequest();
                                xhr.open('POST', 'updateOrderStatus.php', true);
                                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                                
                                // Set up the data to send in the request
                                var params = 'orderId=' + encodeURIComponent(codeCommande) + '&newStatus=Accepté';

                                // Set up the callback function to handle the response
                                xhr.onload = function() {
                                    if (xhr.status === 200) {
                                        // Check the response for success
                                        var response = JSON.parse(xhr.responseText);
                                        if (response.success) {
                                         
                                            // If the status update is successful, redirect to commandes.php
                                            window.location.href = 'commandes.php';
                                        } else {
                                            // Handle the case where the update was not successful
                                            alert('Error updating order status. Please try again.');
                                        }
                                    } else {
                                        // Handle other HTTP status codes
                                        alert('Error: ' + xhr.status);
                                    }
                                };

                                // Send the request with the data
                                xhr.send(params);
                            }


                        </script>
                    </div>
                </div>
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
            </div>
    </main>
    <div class="fixed-plugin">
        <a class="fixed-plugin-button text-dark position-fixed px-3 py-2">
            <i class="material-icons py-2">settings</i>
        </a>
        <div class="card shadow-lg">
            <div class="card-header pb-0 pt-3">
                <div class="float-start">
                    <h5 class="mt-3 mb-0">Material UI Configurator</h5>
                    <p>See our dashboard options.</p>
                </div>
                <div class="float-end mt-4">
                    <button class="btn btn-link text-dark p-0 fixed-plugin-close-button">
                        <i class="material-icons">clear</i>
                    </button>
                </div>
                <!-- End Toggle Button -->
            </div>
            <hr class="horizontal dark my-1">
            <div class="card-body pt-sm-3 pt-0">
                <!-- Sidebar Backgrounds -->
                <div>
                    <h6 class="mb-0">Sidebar Colors</h6>
                </div>
                <a href="javascript:void(0)" class="switch-trigger background-color">
                    <div class="badge-colors my-2 text-start">
                        <span class="badge filter bg-gradient-primary active" data-color="primary"
                            onclick="sidebarColor(this)"></span>
                        <span class="badge filter bg-gradient-dark" data-color="dark"
                            onclick="sidebarColor(this)"></span>
                        <span class="badge filter bg-gradient-info" data-color="info"
                            onclick="sidebarColor(this)"></span>
                        <span class="badge filter bg-gradient-success" data-color="success"
                            onclick="sidebarColor(this)"></span>
                        <span class="badge filter bg-gradient-warning" data-color="warning"
                            onclick="sidebarColor(this)"></span>
                        <span class="badge filter bg-gradient-danger" data-color="danger"
                            onclick="sidebarColor(this)"></span>
                    </div>
                </a>

                <!-- Sidenav Type -->

                <div class="mt-3">
                    <h6 class="mb-0">Sidenav Type</h6>
                    <p class="text-sm">Choose between 2 different sidenav types.</p>
                </div>

                <div class="d-flex">
                    <button class="btn bg-gradient-dark px-3 mb-2 active" data-class="bg-gradient-dark"
                        onclick="sidebarType(this)">Dark</button>
                    <button class="btn bg-gradient-dark px-3 mb-2 ms-2" data-class="bg-transparent"
                        onclick="sidebarType(this)">Transparent</button>
                    <button class="btn bg-gradient-dark px-3 mb-2 ms-2" data-class="bg-white"
                        onclick="sidebarType(this)">White</button>
                </div>

                <p class="text-sm d-xl-none d-block mt-2">You can change the sidenav type just on desktop view.</p>


                <!-- Navbar Fixed -->

                <div class="mt-3 d-flex">
                    <h6 class="mb-0">Navbar Fixed</h6>
                    <div class="form-check form-switch ps-0 ms-auto my-auto">
                        <input class="form-check-input mt-1 ms-auto" type="checkbox" id="navbarFixed"
                            onclick="navbarFixed(this)">
                    </div>
                </div>
                <hr class="horizontal dark my-3">
                <div class="mt-2 d-flex">
                    <h6 class="mb-0">Light / Dark</h6>
                    <div class="form-check form-switch ps-0 ms-auto my-auto">
                        <input class="form-check-input mt-1 ms-auto" type="checkbox" id="dark-version"
                            onclick="darkMode(this)">
                    </div>
                </div>
                <hr class="horizontal dark my-sm-4">


                <a class="btn bg-gradient-info w-100"
                    href="https://www.creative-tim.com/product/material-dashboard-pro">Free
                    Download</a>


                <a class="btn btn-outline-dark w-100"
                    href="https://www.creative-tim.com/learning-lab/bootstrap/overview/material-dashboard">View
                    documentation</a>

                <div class="w-100 text-center">
                    <a class="github-button" href="https://github.com/creativetimofficial/material-dashboard"
                        data-icon="octicon-star" data-size="large" data-show-count="true"
                        aria-label="Star creativetimofficial/material-dashboard on GitHub">Star</a>
                    <h6 class="mt-3">Thank you for sharing!</h6>

                    <a href="https://twitter.com/intent/tweet?text=Check%20Material%20UI%20Dashboard%20made%20by%20%40CreativeTim%20%23webdesign%20%23dashboard%20%23bootstrap5&amp;url=https%3A%2F%2Fwww.creative-tim.com%2Fproduct%2Fsoft-ui-dashboard"
                        class="btn btn-dark mb-0 me-2" target="_blank">
                        <i class="fab fa-twitter me-1" aria-hidden="true"></i> Tweet
                    </a>
                    <a href="https://www.facebook.com/sharer/sharer.php?u=https://www.creative-tim.com/product/material-dashboard"
                        class="btn btn-dark mb-0 me-2" target="_blank">
                        <i class="fab fa-facebook-square me-1" aria-hidden="true"></i> Share
                    </a>

                </div>
            </div>
        </div>
    </div>
    <!--   Core JS Files   -->
    <script src="../dashboard/assets/js/core/popper.min.js"></script>
    <script src="../dashboard/assets/js/core/bootstrap.min.js"></script>
    <script src="../dashboard/assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="../dashboard/assets/js/plugins/smooth-scrollbar.min.js"></script>

    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>

    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>


    <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="../dashboard/assets/js/material-dashboard.min.js?v=3.1.0"></script>
</body>

</html>