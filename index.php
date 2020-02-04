<!DOCTYPE html>
<html>
<?php
include "components/head.php";
include "classes/utilisateur.php";
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
      //account stuff
    case ("panier"):
      include "components/panier.php";
      break;
      //settings
    case ("settings"):
      include "components/settings.php";
      break;
    case ("history"):
      include "components/history.php";
      break;
    case ("tracking"):
      include "components/tracking.php";
      break;
    case ("update"):
      include "components/update.php";
      break;
    default: ?> <h2>404 Page Not Found</h2><br><br>
  <?php
      break;
  }
  include "components/footer.php";
  ?>

</body>

</html>