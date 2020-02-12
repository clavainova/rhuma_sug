<?php
//destroy the basket
if (isset($_COOKIE["basket"])) {
        setcookie('basket', "");
}
//back to the homepage
header("Location: http://localhost/RhumaSug/index.php?page=panier"); 
