<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
<?php 
include '../validacao/valida_cookies.php';
include '../dao/dao.php';
$dao = new dao();
$dao->backup();
$acesso = new valida_cookies();
@$acesso->setLogin($_POST['login']);
@$acesso->setSenha($_POST['senha']);
if (!$acesso->getLogin()){
    $acesso->popup('Você deve entrar com o usuário.',null);
}else{
    $acesso->loginDb(); 
}
?>
</body>
</html>