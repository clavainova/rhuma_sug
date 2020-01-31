<!DOCTYPE html>
<html>
<?php
include "components/head.php";
?>

<body>
  <?php
  include "components/header.php";
  include "components/nav.php";
  if (isset($_GET['page'])) {
    $page = $_GET['page'];
  } else {
    $page = "produits";
  }
  //custom stuff inserted here
  switch ($page) {
    case ("produits"):
      include "components/produits.php";
      break;
    case ("about"):
      include "components/about.php";
      break;
    case ("connexion"):
      include "components/connexion.php";
      break;
    case ("panier"):
      include "components/panier.php";
      break;
    default: ?> <h2>404 Page Not Found</h2><br><br>
  <?php
      break;
  }
  include "components/footer.php";
  ?>

</body>

</html>