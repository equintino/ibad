<?php
// classe mae - aplicação //
final class index{
  const PAGINA_PADRAO = 'home';
  const PAGINA_DIR = '../paginas/';
  const LAYOUT_DIR = '../layout/';
  
  // configuração do sistema //
  public function init(){
    error_reporting(E_ALL | E_STRICT);
    mb_internal_encoding('UTF-8');
    set_exception_handler(array($this, 'handlerException'));
    spl_autoload_register(array($this, 'carregaClasses'));
  }
  
  // carregando as páginas //
  public function carrega(){
    $this->carregaPagina($this->getPagina());
  }
  
  // tratamento das exceções //
  public function handlerException(Exception $ex){
    $extra = array('mensagem' => $ex->getMessage());
    if ($ex instanceof Excecao) {
            header('HTTP/1.0 404 Not Found');
            $this->carregaPagina('404', $extra);
        } else {
            // log exception
            if($_GET['act']=='rel'){
              echo 'Relatório inexistente';die;
              echo Utils::redirect('relMensal',array('mes'=>$_GET['mes'],'act'=>'cad'));die;
            }else{
              header('HTTP/1.1 500 Internal Server Error');
              $this->carregaPagina('500', $extra);
            }
        }
  }
  
  // carregando as classes //
  public function carregaClasses($nome){
    $classes = array(
        'Config' => '../config/Config.php',
        'Erro' => '../validacao/Erro.php',
        'Utils' => '../util/Utils.php',
        'Excecao' => '../excecao/Excecao.php',
        'Flash' => '../flash/Flash.php',
        'Dao' => '../dao/dao.php',
        'Model' => '../model/Model.php',
        'modelMapper' => '../mapping/modelMapper.php',
        'ModelSearchCriteria' => '../dao/ModelSearchCriteria.php',
        'ModelValidador' => '../validacao/ModelValidador.php',
        'valida_cookies'  =>  '../validacao/valida_cookies.php',
    );
    if (!array_key_exists($nome, $classes)){
       die("A classe $nome não existe");
    }
    require_once $classes[$nome];
  }
  
  // obtendo a páginas //
  public function getPagina(){
    $pagina = self::PAGINA_PADRAO;
    if(array_key_exists('pagina', $_GET)){
      $pagina = $_GET['pagina'];
    }
    return $this->checaPagina($pagina);
  }
  
  //  checando a pagina //
  public function checaPagina($pagina){
    if(!preg_match('/^[a-z0-9-]+$/i', $pagina)){
      throw new Excecao("A Página $pagina não é segura");
    }
    if(!$this->temScript($pagina) && !$this->temTemplate($pagina)){
      throw new Excecao("A página $pagina não foi encontrada");
    }
    return $pagina;
  }
  
  // carregando a página //
  private function carregaPagina($pagina, array $extra = array()){
    $carrega = false;
    if($this->temScript($pagina)){
      $carrega = true;
      require $this->getScript($pagina);
    }
    if($this->temTemplate($pagina)){
     $carrega = true;
     $template = $this->getTemplate($pagina);
     $flashes = null;
     if (Flash::hasFlashes()) {
        $flashes = Flash::getFlashes();
     }
     require self::LAYOUT_DIR . 'index.phtml';
    }
    if(!$carrega){
      die("A página $pagina é inexistente");
    }
  }  
  private function getScript($pagina){
    return self::PAGINA_DIR . $pagina .'.php';
  }
  private function getTemplate($pagina){  
    return self::PAGINA_DIR . $pagina .'.phtml';
  }
  private function temScript($pagina){
    return file_exists($this->getScript($pagina));
  }
  private function temTemplate($pagina){
    return file_exists($this->getTemplate($pagina));
  }
}

$index = new index();
$index->init();
    // Exigir o login para acesso
    $valida = new valida_cookies();
    @$valida->setLogin($_COOKIE['login']);
    @$valida->setSenha($_COOKIE['senha']);
    @$valida->setIndex($_GET['index']);
    $valida->fazerLogin();
    // run application!
$index->carrega();
?>