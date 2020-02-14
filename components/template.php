<!DOCTYPE html>
<html lang="fr">

<?php
include_once "account_management/functions.php";
include_once "account_management/sessionstart.php";
include_once "classes/utilisateur.php";
include_once COMPONENTS . '/head.php';
?>

<body>
    <?php

    include_once COMPONENTS . '/header.php';
    include_once COMPONENTS . '/nav.php';
    include_once COMPONENTS . '/' . $template;

    include_once COMPONENTS . '/footer.php';
    ?>
</body>

</html>