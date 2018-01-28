<?php 
    $dao=new Dao();
    $search=new ModelSearchCriteria();
    $search->settabela('lt_membros');
    $search->setorder('nome');
    $lista=$dao->encontre($search);
    $variaveis=array('NOME COMPLETO '=>'nome','DATA DE NASCIMENTO '=>'dt_nascimento','NATURALIDADE'=>'naturalde','IDENTIDADE'=>'rg','CPF'=>'cpf','TÍTULO ELEITORAL'=>'tit','SEXO'=>'sexo','ESCOLARIDADE'=>'escolaridade','PROFISSÃO'=>'prof','NOME DO PAI'=>'pai','NOME DA MÃE'=>'mae','ESTADO CIVIL'=>'estcivil','DATA DO CASAMENTO'=>'dt_casamento','NOME DO CONJUGÊ'=>'conjuge','ENDEREÇO DE E-MAIL '=>'email','TELEFONE '=>'tel','CELULAR '=>'cel','AV/RUA/TRAV'=>'tipo','ENDEREÇO DE RESIDÊNCIA '=> 'endereco','NÚMERO'=>'numero','COMPLEMENTO'=>'complemento','BAIRRO'=>'bairro','CIDADE'=>'cidade','ESTADO'=>'estado','CEP'=>'cep','DATA DO BATISMO'=>'dt_batismo','IGREJA DO BATISMO'=>'igbatismo','IGREJA DE ORIGEM'=>'igorigem','MEMBRO DESDE'=>'dt_ingresso');
    $act=$_GET['act'];
    $x=$_GET['pag'];
    $y=$x+5;
        if($x==0){ 
           $class='class="disabled"';
        }else{
           $class='title=RECUAR';
        }
?>

