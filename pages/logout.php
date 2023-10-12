<?php
    session_start();
    unset($_SESSION['email']);
    unset($_SESSION['username']);
    unset($_SESSION['role']);
    session_destroy();
    header("Location: /swim-club/pages/login.php");
?>