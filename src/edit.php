<?php
require_once "backend/vendor/check_connexion.php";
require_once "backend/vendor/fonctions.php";
require_once "backend/vendor/param_connexion.php";
require_once "backend/vendor/pdo_agile.php";
$conn = OuvrirConnexionPDO($db, $db_username, $db_password);

$tab = getPersonne($conn, $_SESSION['user_id']);
?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <title>Etude réalisé</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="styles/styles.css">
</head>

<body>
  <header>
    <nav class="navbar navbar-expand-lg fixed-top navbar-dark navbar-scrolled">
      <div class="container-fluid">
        <a class="navbar-brand" href="index.html">
          <img id="imageLogo" src="image/logo.png" alt="Logo" width="100" height="40" class="d-inline-block imageLogo">
          Accueil
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item">
              <a class="nav-link" href="randonnee.php">Randonnée</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Informations
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="infoeco.html">Informations économiques</a>
                <a class="dropdown-item" href="infoecolo.html">Informations écologiques</a>
                <a class="dropdown-item" href="#">Statistiques</a>

            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Questionnaires
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="questhab.html">Questionnaire Habitant</a>
                <a class="dropdown-item" href="questmairie.html">Questionnaire Mairie</a>
                <a class="dropdown-item" href="questasso.html">Questionnaire Entreprise / Associations</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="faq.html">FAQ</a>
            </li>
            <li class="nav-item">
              <?php
              session_start();
              if (isset($_SESSION['user_id'])) {
                echo '<a class="nav-link" href="profil.php">Profil</a>';
              } else {
                echo '<a class="nav-link" href="connexion.html">Connexion</a>';
              }
              ?>
            </li>
          </ul>

        </div>
      </div>
    </nav>
  </header>

  <main class="container mt-5">
    <h2 class="my-5 text-center">Modifier son Profil</h2>
    <div class="container">
      <div class="main-body">
        <div class="row">
          <div class="col-lg-4">
            <div class="card">
              <div class="card-body">
                <div class="d-flex flex-column align-items-center text-center">
                  <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Admin" class="rounded-circle p-1 bg-primary" width="110">
                  <div class="mt-3">
                    <?php

                    echo '<h4>' . $tab['PER_PRENOM'] . ' ' . $tab['PER_NOM'] . '</h4>';
                    if (ifOrga($conn, $_SESSION['user_id'])) {
                      echo '<button class="btn btn-outline-primary m-2">Organisateur</button>';
                    }
                    if (ifClient($conn, $_SESSION['user_id'])) {
                      echo '<button class="btn btn-outline-primary m-2">Randonneur</button>';
                    }
                    if (ifGuide($conn, $_SESSION['user_id'])) {
                      echo '<button class="btn btn-outline-primary m-2">Guide</button>';
                    }
                    ?>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <form class="col-lg-8 m-0" action="backend/account/editForm.php" method="post">
            <div class="card">
              <div class="card-body">
                <div class="row mb-3">
                  <div class="col-sm-3">
                    <h6 class="mb-0">Nom</h6>
                  </div>
                  <div class="col-sm-9 text-secondary">
                    <?php
                    echo '<input type="text" name="nom" class="form-control" value="' . $tab['PER_NOM'] . '">'; ?>
                  </div>
                </div>
                <div class="row mb-3">
                  <div class="col-sm-3">
                    <h6 class="mb-0">Prénom</h6>
                  </div>
                  <div class="col-sm-9 text-secondary">
                    <?php
                    echo '<input type="text" name = "prenom" class="form-control" value="' . $tab['PER_PRENOM'] . '">'; ?>
                  </div>
                </div>
                <div class="row mb-3">
                  <div class="col-sm-3">
                    <h6 class="mb-0">Email</h6>
                  </div>
                  <div class="col-sm-9 text-secondary">
                    <?php
                    echo '<input type="text" name = "courriel" class="form-control" value="' . $tab['PER_COURRIEL'] . '">'; ?>
                  </div>
                </div>
                <div class="row mb-3">
                  <div class="col-sm-3">
                    <h6 class="mb-0">Téléphone</h6>
                  </div>
                  <div class="col-sm-9 text-secondary">
                    <?php
                    echo '<input type="text" name = "tel" class="form-control" value="' . $tab['PER_TELEPHONE'] . '">'; ?>
                  </div>
                </div>
                <div class="row mb-3">
                  <div class="col-sm-3">
                    <h6 class="mb-0">Ville</h6>
                  </div>
                  <div class="col-sm-9 text-secondary">
                    <?php
                    echo '<input type="text" name = "ville" class="form-control" value="' . $tab['PER_VILLE'] . '">'; ?>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-3"></div>
                  <div class="col-sm-9 text-secondary">
                    <input type="submit" class="btn btn-primary px-4" value="Sauvegarder">
                    <a class="btn btn-outline-primary btn-rounded" href="profil.php" role="button">Annuler</a>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
  </main>


  <footer class="text-center text-lg-start text-white" style="background-color: black">
    <div class="container p-4 pb-0">
      <!-- Section: Links -->
      <section class="">
        <!--Grid row-->
        <div class="row">
          <!--Grid column-->
          <div class="col-lg-4 col-md-6 mb-4 mb-md-0">
            <h5 class="text-uppercase">Newsletter</h5>

            <p>
              La newsletter de Paris 2024 est votre rendez-vous pour tout savoir des Jeux qui se préparent près de chez vous.
            </p>
            <div class="text-center ronded-1 mt-5">
              <a class="btn btn-outline-light btn-rounded" href="https://www.paris2024.org/fr/newsletter/" role="button">En savoir plus</a>
            </div>
          </div>
          <!--Grid column-->

          <!--Grid column-->
          <div class="col-md-6 mb-4">
            <h5 class="text-uppercase">Liens utiles</h5>

            <ul class="list-unstyled mb-0 lien">
              <li>
                <a href="https://olympics.com/en/" class="text-white">CIO</a>
              </li>
              <li>
                <a href="https://www.paralympic.org/" class="text-white">IPC</a>
              </li>
              <li>
                <a href="#!" class="text-white">CNOSF</a>
              </li>
              <li>
                <a href="#!" class="text-white">Beijing 2022</a>
              </li>
              <li>
                <a href="#!" class="text-white">Milano Cortina 2026</a>
              </li>
              <li>
                <a href="#!" class="text-white">LA 2028</a>
              </li>
              <li>
                <a href="#!" class="text-white">Olympic channel</a>
              </li>
            </ul>
          </div>
          <hr class="m-4 mb-4" />
          <div class="text-center p-3">
            <a href="#!" class="text-white">Mentions légales</a>
            <a href="#!" class="text-white">Accessibilité Site</a>
            <a href="#!" class="text-white">Politique de confidentialité</a>
            <a href="#!" class="text-white">Cybersécurité</a>
            <a href="#!" class="text-white">Cookies</a>
            <a href="#!" class="text-white">Appels d’Offres et Consultations</a>
            <a href="#!" class="text-white">Conditions Générales d’Achat</a>
          </div>


          <!-- Copyright -->
          <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2)">
            © 2020 Copyright:
            <a class="text-white" href="https://mdbootstrap.com/">MDBootstrap.com</a>
          </div>
        </div>
      </section>
    </div>
    <!-- Copyright -->
  </footer>
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="script.js"></script>
  <script src="navbar.js"></script>
</body>

</html>