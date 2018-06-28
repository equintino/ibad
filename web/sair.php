<?php
    require_once '../validacao/valida_cookies.php';
    require_once '../dao/dao.php';
    $dao=new dao();
    $dao->backup();
    $cookies=new valida_cookies();
    $cookies->limpaCookies();
    session_destroy();
    header("Location:../index.html");
?>