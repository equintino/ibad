<?php
  include_once '../dao/Dao.php';
  include_once '../model/Model.php';
  include_once '../mapping/modelMapper.php';
  include_once '../dao/ModelSearchCriteria.php';
  include_once '../validacao/ModelValidador.php';
  include_once '../validacao/valida_cookies.php';
  include_once 'redimensiona.php';
  
  $dao = new Dao();
  $model = new Model();
  @$mes = ModelValidador::tirarAcento($_POST['mes']);
  @$ano = $_POST['ano'];
  $act=$_GET['act'];
  foreach($_POST as $key => $item){
     if($key=='dia'){
        $key='dt';
        $item=$_POST['ano'].'-'.ModelValidador::numeroMes($mes).'-'.$item;
     }elseif(strstr($key,'_',true)=='dt'){ 
        $ano=str_replace('/','',strrchr($item,'/'));
        $mes=substr($item,3,2);
        $dia=substr($item,0,2);
        if($dia){
         $item=$ano.'-'.$mes.'-'.$dia;
        }
     }elseif($key=='movimentacao'){
        $key=$item;
     }elseif($key=='ano'){
        if(strlen($item)==2){
           $item='20'.$item;
        }
     }elseif($key=='tipo' && $act=='rel'){
        $key='diz_ofe';
        if($item=='dizimo'){
           $item='diz';
        }elseif($item=='oferta'){
           $item='ofe';
           $model->setdescricAo('OFERTA');
        }
     }elseif($key=='valor'||$key=='movimentacao'){
        $key=$_POST['movimentacao'];
        if($item){
           $item=ModelValidador::removePonto($_POST['valor']);
        }
     }elseif($key=='mes'){
        $item=ModelValidador::numeroMes($item);
     }
     if($key!='MAX_FILE_SIZE' && $key!='mesAno'){
        $classe='set'.$key;
        $model->$classe($item);
     }
  }
  $model->settabela($ano);
  if($_FILES['comprovante']['name']){
     $target_dir = "../web/documentos/comprovantes/";
     $target_file = $target_dir.$_POST['dia'].  ModelValidador::numeroMes($_POST['mes']).$_POST['ano'].'_'.basename($_FILES['comprovante']['name']);
     if (move_uploaded_file($_FILES["comprovante"]["tmp_name"], $target_file)){
         echo 'Arquivo salvo.';
        $model->setcomprovante($target_file);
     }else{
         echo 'Erro ao salvar arquivo.';
     }
  }
  if($act == 'cad'){
      if($_FILES['foto']['name'] == null){
           $foto=$_POST['foto'];
      }else{
     ////// enviando arquivo /////////
	$target_dir = "../web/imagens/fotos/";
        $target_file = $target_dir . basename($_FILES["foto"]["name"]);
        
	$uploadOk = 1;

	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	// Check if image file is a actual image or fake image
	if(isset($_POST["submit"])) {
	    $check = getimagesize($_FILES["foto"]["tmp_name"]);
	    if($check !== false) {
		echo "O arquivo é uma imagem - " . $check["mime"] . ".";
		$uploadOk = 1;
	    } else {
		echo "O arquivo não é uma imagem.";
		$uploadOk = 0;
	    }
	}
	// Check if file already exists
	if (file_exists($target_file)) {
	    valida_cookies::popup("Arquivo já existe.");
	    $uploadOk = 0;
	}
	// Check file size
	if ($_FILES["foto"]["size"] > 3000000 || $_FILES["foto"]["size"] == 0) {
	    valida_cookies::popup("Tamanho do arquivo maior que 3Mb.");
	    $uploadOk = 0;
	}
	// Allow certain file formats
	if($imageFileType != "jpg" ) {
            valida_cookies::popup('Favor inserir imagem do formato jpg.');
	    $uploadOk = 0;
	}
	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
	    valida_cookies::popup("O arquivo não pode ser salvo.");
	// if everything is ok, try to upload file
	} else {
            $imagem = new Image();
            $imagem->resize($_FILES["foto"]["tmp_name"], 250, 350);
            $imagem->saveImage("$target_file");
            //print_r(Image::_getImageSize);
            /*echo $target_file;die;
	    if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)){
		echo "The file ". basename( $_FILES["foto"]["name"]). " has been uploaded.";
	    } else {
		valida_cookies::popup("Erro no envio do arquivo.");
	    }*/
	}

	///// /////// //////// //////
	$foto = str_replace('../web/','',$target_file);
      }
        $model->setfoto($foto); 
     $model->setexcluido(0);
     $dao->grava($model);
     }
  
  if($act == 'rel'){ 
     $dao->grava2($model);
  }
?>
<h3>REGISTRO GRAVADO COM SUCESSO</h3>
<?php if($act=='rel'): ?>
<meta HTTP-EQUIV='refresh' CONTENT='1;URL=../web/index.php?pagina=relMensal&mes=<?= ModelValidador::numeroMes($mes).'/'.$ano ?>&act=cad&continua=1'>
<?php elseif($act=='cad'): ?>
<meta HTTP-EQUIV='refresh' CONTENT='1;URL=../web/index.php?pagina=cadastro&act=cad&pag=0'>
<?php endif; ?>
<!--<button onclick="history.go(-1)" >VOLTAR</button>-->
<button onclick= window.location.assign("../web/") >PÁGINA INICIAL</button>