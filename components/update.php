<button class="back-button" onclick="window.location.href = 'http://localhost/RhumaSug/index.php?page=settings'">BACK</button>

<?php

//if the last thing had an error, display it
if (isset($_SESSION["error"])) :
?>
    <div class="error">
        <?php
        print(ERRORS[$_SESSION["error"]]);
        ?>
    </div>
<?php
    //unset error
    unset($_SESSION['error']);
endif;
?>

<h2 class="longtitle">Update your personal details</h2>
<?php
include "components/addressForms.php";
?>