<?php
include "sessionstart.php";
try {
    //remove session
    unset($_SESSION['username']);
    unset($_SESSION['pass']);
    session_destroy();
} catch (Exception $e) {
    print("logout failed" . $e);
} ?>
<script type="text/javascript">
    window.location.href = "index.php";
</script>