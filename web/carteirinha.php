<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pt-br" lang="pt-br">
<head>   
    <link href="https://fonts.googleapis.com/css?family=Alex+Brush|Great+Vibes|Pinyon+Script|Tangerine" rel="stylesheet"> 
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <meta charset="utf-8" /><link href="https://fonts.googleapis.com/css?family=Kelly+Slab|Medula+One|Stint+Ultra+Condensed|Tulpen+One|Unica+One" rel="stylesheet"> 
<style>  
    .carteirinha{
        font-family: 'Medula One';
        font-size: 31px;
    }
    @media print {
        .noprint {
          visibility: hidden;
        }
    }
</style>
<script>
    $(document).ready(function(){
        //alert(ids);
        //x=1;
        //ids=ids.split(',');
        //var top='0';
        //for(var x=1;x < 2;x++){
            //top=parseInt(top)+parseInt(10);
            //if(x==2){
            //$('.carteirinha').append('<img src="../web/img/carteirinha.png" height="360px" />');
        //$('.carteirinha img').css({
            //position: 'absolute',
            //left: '5px',
            //marginTop: '0px'
            //top: top+'px',
        //})
        //}die;
            //$('.foto1').append('<img src="'+foto1+'" height="125px" width="90px" />')
        $('.foto img').css({
            position: 'absolute',
            margin: '-357px 12px',
            zIndex: -1
        })
        //}
    //}
        $('.nome').css({
            position: 'absolute',
            zIndex: '1',
            margin: '-227px 92px',
            width: '400px'
        })
        $('.pai').css({
            position: 'absolute',
            zIndex: '1',
            margin: '-190px 92px',
            width: '210px'
        })
        $('.mae').css({
            position: 'absolute',
            zIndex: '1',
            margin: '-190px 296px',
            width: '210px',
            //fontSize: '31px',
            //border: 'solid red'
        })
        $('.dt_nascimento').css({
            position: 'absolute',
            zIndex: '1',
            margin: '-136px 82px',
            width: '140px'
        })
        $('.estcivil').css({
            position: 'absolute',
            zIndex: '1',
            margin: '-136px 280px',
            width: '150px',
            textAlign: 'center'
        })
        $('.dt_ingresso').css({
            position: 'absolute',
            zIndex: '1',
            margin: '-85px 82px',
            width: '140px'
        })
        $('.dt_batismo').css({
            position: 'absolute',
            zIndex: '1',
            margin: '-84px 298px',
            width: '140px'
        })
        $('.funcao').css({
            position: 'absolute',
            zIndex: '1',
            margin: '-44px 92px',
            width: '160px',
            //textAlign: 'center'
        })
        $('.rg').css({
            position: 'absolute',
            zIndex: '1',
            margin: '-44px 325px',
            width: '140px'
        })
        $('.endereco').css({
            position: 'absolute',
            zIndex: '1',
            width: '379px',
            margin: '-355px 607px',
            fontSize: '30px'
        })
        $('.ano1').css({
            position: 'absolute',
            zIndex: '1',
            //width: '310px',
            margin: '-194px 560px',
            fontSize: '20px',
            fontFamily: 'sans',
            fontWeight: '900',
            color: '#870000'
        })
        $('.ano2').css({
            position: 'absolute',
            zIndex: '1',
            //width: '310px',
            margin: '-194px 650px',
            fontSize: '20px',
            fontFamily: 'sans',
            fontWeight: '900',
            color: '#870000'
        })
        $('.ano3').css({
            position: 'absolute',
            zIndex: '1',
            //width: '310px',
            margin: '-194px 740px',
            fontSize: '20px',
            fontFamily: 'sans',
            fontWeight: '900',
            color: '#870000'
        })
        $('.ano4').css({
            position: 'absolute',
            zIndex: '1',
            //width: '310px',
            margin: '-194px 830px',
            fontSize: '20px',
            fontFamily: 'sans',
            fontWeight: '900',
            color: '#870000'
        })
        $('.ano5').css({
            position: 'absolute',
            zIndex: '1',
            //width: '310px',
            margin: '-194px 918px',
            fontSize: '20px',
            fontFamily: 'sans',
            fontWeight: '900',
            color: '#870000'
        })
        $('#btnPrint').click(function(){
            window.print();
        })
    })
    </script>
</head>
<body>
<?php
   include '../validacao/ModelValidador.php';
   include '../dao/ModelSearchCriteria.php';
   include '../dao/dao.php';
   include '../config/Config.php';
   include '../model/Model.php';
   include '../mapping/modelMapper.php';
   //print_r([$_POST,$_GET]);die;
    if(array_key_exists('id',$_GET)){
        $id=$_GET['id'];
    }else{
        $id=null;
    }
    if(array_key_exists('ids',$_GET)){
        $ids=$_GET['ids'];
    }else{
        $ids=null;
    }
    $act=$_GET['act'];
    
    $dao = new Dao();
    $search = new ModelSearchCriteria();
    $search->settabela('lt_membros');
    $ano=(date('Y'));
    
    $ids=explode(',',$_GET['ids']);
    $x=1;
    foreach($ids as $id){           
        $search->setid($id);
        $model=$dao->encontrePorId($search);   
        
        $funcao=  ModelValidador::funcao(mb_strtolower($model->getnome(),'utf-8'));
        
        if(!$model->getrg()){
            $rg=000000000;
        }else{
            $rg=$model->getrg();
        }
        
        $dt_nascimento=substr($model->getdt_nascimento(),-2,2).' / '.substr($model->getdt_nascimento(),-5,2).' / '.substr($model->getdt_nascimento(),0,4);
        $dt_ingresso=substr($model->getdt_ingresso(),-2,2).' / '.substr($model->getdt_ingresso(),-5,2).' / '.substr($model->getdt_ingresso(),0,4);
        $dt_batismo=substr($model->getdt_batismo(),-2,2).' / '.substr($model->getdt_batismo(),-5,2).' / '.substr($model->getdt_batismo(),0,4);
        $endereco=ModelValidador::logradouro($model->gettipo()).' '.ModelValidador::iniciaisMaiusculas($model->getendereco()).', '.$model->getnumero().' - ';
        if($model->getcomplemento()){
            $z=explode(' ',$model->getcomplemento());
            $complemento=null;
            foreach($z as $comp){
                $complemento .=ModelValidador::logradouro($comp).' ';
            }
            $endereco .=ModelValidador::iniciaisMaiusculas($complemento).' - ';
        }
        if($model->getbairro()){
            $z=explode(' ',$model->getbairro());
            $bairro=null;
            foreach($z as $bar){
                $bairro .=ModelValidador::logradouro($bar).' ';
            }
        }
        $endereco .=ModelValidador::iniciaisMaiusculas($bairro).'/'.$model->getestado();
        /*
        echo '<script>
                var act="'.$act.'";
                var ids="'.$_GET['ids'].'";
                var foto1="'.$model->getfoto().'";
                var nome1="'.ModelValidador::iniciaisMaiusculas($model->getnome(),"nome").'";
                var pai1="'.ModelValidador::iniciaisMaiusculas($model->getpai(),"carteirinha").'";
                var mae1="'.ModelValidador::iniciaisMaiusculas($model->getmae(),"carteirinha").'";
                var dt_nascimento1="'.$dt_nascimento1.'";
                var estcivil1="'.ModelValidador::iniciaisMaiusculas($model->getestcivil()).'";
                var dt_ingresso1="'.$dt_ingresso1.'";
                var dt_batismo1="'.$dt_batismo1.'";
                var funcao1="'.$funcao.'";
                var rg1="'.$rg.'";
                var endereco1="'.$endereco.'";
                var ano1="'.$ano.'";
                var ano2=parseInt(ano1)+1;
                var ano3=parseInt(ano1)+2;
                var ano4=parseInt(ano1)+3;
                var ano5=parseInt(ano1)+4;

             </script>';*/
        echo '<script>var batizado=null;var id=null;var nome=null;var pai=null;var mae=null;
         </script>';
?>
<div class="conteudo" id="printable">
    <div class="carteirinha">     
        <img src="../web/img/carteirinha.png" height="360px" />
        <div class="foto"><img src="<?= $model->getfoto() ?>" height="120px" width="90px" /></div>
        <div class="nome"><?= ModelValidador::iniciaisMaiusculas($model->getnome(),'nome') ?></div>
        <div class="pai"><?= ModelValidador::iniciaisMaiusculas($model->getpai(),'carteirinha') ?></div>
        <div class="mae"><?= ModelValidador::iniciaisMaiusculas($model->getmae(),'carteirinha') ?></div>
        <div class="dt_nascimento"><?= $dt_nascimento ?></div>
        <div class="estcivil"><?= $model->getestcivil() ?></div>
        <div class="dt_ingresso"><?= $dt_ingresso ?></div>
        <div class="dt_batismo"><?= $dt_batismo ?></div>
        <div class="funcao"><?= $funcao ?></div>
        <div class="rg"><?= $model->getrg() ?></div>
        <div class="endereco"><?= $endereco ?></div>
        <div class="ano1"><?= $ano ?></div>    
        <div class="ano2"><?= $ano+1 ?></div>   
        <div class="ano3"><?= $ano+2 ?></div>   
        <div class="ano4"><?= $ano+3 ?></div>   
        <div class="ano5"><?= $ano+4 ?></div>      
    </div>
</div>
    <script>var x=<?= $x ?>;</script>
<?php
    /*if($x==2){
        die;
    }*/
    //$x++;
  } 
?>
    <button id="btnPrint" class="noprint">Imprimir</button>
</body>
</html>