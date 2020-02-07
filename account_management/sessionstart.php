<?php
//if there isn't a session going, start one
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
    // ini_set('session.save_path', '/tmp');
    // ini_set('session.cookie_path', '/');
}
?>