<?php
try {
    session_start();
    // ini_set('session.save_path', '/tmp');
    // ini_set('session.cookie_path', '/');
} catch (Exception $e) {
    print("session already started");
}
