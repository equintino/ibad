<?php
   include '../validacao/valida_cookies.php';
    $cookies=new valida_cookies();
    $cookies->limpaCookies();
    header("Location:../index.html");
?>