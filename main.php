<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
<?php 
include 'validacao/valida_cookies.php';
$acesso = new valida_cookies();
array_key_exists('login',$_POST)?$acesso->setLogin($_POST['login']):$acesso->setLogin(null);
array_key_exists('senha',$_POST)?$acesso->setSenha($_POST['senha']):$acesso->setSenha(null);
if (!$acesso->getLogin()){
    $acesso->popup('Você deve entrar com o usuário.',null);
}else{
    $acesso->loginDb(); 
}
?>
</body>
</html>