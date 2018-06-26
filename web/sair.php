<?php
    require_once '../validacao/valida_cookies.php';
    $cookies=new valida_cookies();
    $cookies->limpaCookies();
    session_destroy();
    header("Location:../index.html");
?>