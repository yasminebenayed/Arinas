<?php
require_once("connexionDb.php");

$req = "SELECT * FROM categorie";
$results = $pdo->query($req);
$categorie = $results->fetchAll(PDO::FETCH_OBJ);
$req1 = "SELECT * FROM marque";
$results1 = $pdo->query($req1);
$marque = $results1->fetchAll(PDO::FETCH_OBJ);
$code = isset($_POST["categorie"]) ? $_POST["categorie"] : null;
$code_sous_cat = isset($_POST["sous_categorie"]) ? $_POST["sous_categorie"] : null;


//!!!!!!!!!!!!!!!!!!!!!!!__________AJAXXX_____________!!!!!!!!!!!!!!!!!!!!//
if (isset($_POST['code'])) {
    $selectedCode = $_POST['code'];

    // Fetch sous_categorie based on the selected code
    $req2 = "SELECT * FROM sous_categorie WHERE code_categorie = :code";
    $results2 = $pdo->prepare($req2);
    $results2->execute(['code' => $selectedCode]);
    $sous_cat = $results2->fetchAll(PDO::FETCH_OBJ);

    // Output the options
    foreach ($sous_cat as $sc) {
        echo "<option value='" . $sc->code . "'>" . $sc->nom_sous_cat . "</option>";
    }

    // Terminate the script after handling the AJAX request
    exit();
}
if (isset($_POST['sous_categorie'])) {
    $selectedsouscat = $_POST['sous_categorie'];
}

$defaultSelectedCode = 1;

$req3 = "SELECT * FROM sous_categorie WHERE code_categorie = :code";
$results3 = $pdo->prepare($req3);
$results3->execute(['code' => $defaultSelectedCode]);
$sous_cat = $results3->fetchAll(PDO::FETCH_OBJ);

//**********************//
/* $req2 = "SELECT * FROM sous_categorie ";
 $results2 = $pdo->query($req2);
 $sous_cat = $results2->fetchAll(PDO::FETCH_OBJ);
 var_dump($sous_cat);*/
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
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
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

        input[type="number"],
        select {
            width: 100%;
            padding: 8px;
            border-radius: 3px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }

        .form-control {

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

<body class="sub_page">
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
                    <a class="nav-link text-white active" href="admin.php">

                        <div class="text-white text-center  me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">table_view</i>
                        </div>
                        <span class="nav-link-text ms-1">Produits</span>
                    </a>
                </li>
              
                <li class="nav-item">
                    <a class="nav-link text-white " href="users.php">


                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
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
                    <a class="nav-link text-white " href="commandes.php">

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
    </main>
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
    <div class="container mt-4" style="width: 80%;margin:20%">
        <form action="add.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="produit">Produit:</label>
                <input type="text" class="form-control" id="nomProduit" name="nomProduit" required>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea type="text" class="form-control" id="description" name="description" style="height: 150px;"
                    required></textarea>
            </div>
            <div class="form-group">
                <label for="designation">Designation:</label>
                <textarea type="text" class="form-control" id="designation" name="designation" style="height: 150px;"
                    required></textarea>
            </div>
            <div class="form-group">
                <label for="categorie">Catégorie:</label>
                <select class="form-control" id="categorie" name="categorie" required>
                    <?php
                    foreach ($categorie as $c) {
                        $selected = ($c->code == $code) ? "selected" : "";
                        echo "<option value='" . $c->code . "' $selected>" . $c->nomCategorie . "</option>";
                    }

                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="sous_categorie">Sous_Catégorie:</label>
                <select class="form-control" id="sous_categorie" name="sous_categorie" required>
                    <?php
                    foreach ($sous_cat as $sc) {
                        $selectedsouscat = ($sc->code == $code_sous_cat) ? "selected" : "";
                        echo "<option value='" . $sc->code . "'  $selectedsouscat>" . $sc->nom_sous_cat . "</option>";
                    }
                    ?>
                </select>

            </div>


            <script>
                $(document).ready(function () {
                    $('#categorie').change(function () {
                        var selectedCode = $(this).val();

                        // Make an AJAX request to get the sous_categorie options
                        $.ajax({
                            type: 'POST',
                            url: window.location.href,
                            data: { code: selectedCode },
                            success: function (response) {
                                $('#sous_categorie').html(response);
                                //console.log(response);
                            },
                            error: function (error) {
                                console.log(error);
                            }
                        });
                    });
                });
            </script>
            <script>
                var selectedsouscat;
                $(document).ready(function () {
                    $('#sous_categorie').change(function () {
                        selectedsouscat = parseInt($(this).val(), 10);
                    })
                });
            </script>
            <div class="form-group">
                <label for="marque">Marque:</label>
                <select class="form-control" id="marque" name="marque" required>
                    <?php
                    foreach ($marque as $m) {
                        echo "<option value='1'>" . $m->nomMarque . "</option>";
                    }
                    ?>
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
                <input type="number" class="form-control" id="promo" name="promo" required min="0" max="100"
                    oninput="validatePromo()">
                <div id="promo-error" class="error-message" style="display: none;">La promotion doit etre entre supérieure ou égale à 0% et inférieure 100%</div>
            </div>
            <style>
                .error-message {
                    color: red;
                }
            </style>
            <script>
                function validatePromo() {
                    var promoInput = document.getElementById("promo");
                    var errorMessage = document.getElementById("promo-error");

                    // Trim leading and trailing whitespaces and convert to lowercase
                    var value = promoInput.value.trim().toLowerCase();

                    if (value != "" && (isNaN(value) || value < 0 || value >= 100)) {
                        promoInput.style.borderColor = "red";
                        errorMessage.style.display = "block";
                    } else {
                        promoInput.style.borderColor = ""; // Reset border color
                        errorMessage.style.display = "none"; // Hide error message
                    }
                }
            </script>
            <div class="form-group">
                <label for="image">Image:</label>
                <input type="file" class="form-control-file" id="image" name="image" accept="image/*" required>
            </div>
            <button type="submit" class="btn btn-primary">Ajouter</button>
        </form>
    </div>
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
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>


</body>

</html>