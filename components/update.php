<button class="back-button" onclick="window.location.href = 'http://localhost/RhumaSug/index.php?page=settings'">BACK</button>

<h2 class="longtitle">Current address:</h2><br>
<?php 
printAddress();
?>

<h2 class="longtitle">Update your personal details</h2>
<?php
include "components/addressForms.php";
?>