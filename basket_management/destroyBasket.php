<?php
//destroy the basket
if (isset($_COOKIE["basket"])) {
        setcookie('basket', "");
}
//back to the homepage
?>
<script>
        window.location.href = "http://localhost/RhumaSug/index.php?page=produits";
</script>