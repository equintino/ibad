<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pt-br" lang="pt-br">
<head>   
    <link href="https://fonts.googleapis.com/css?family=Alex+Brush|Great+Vibes|Pinyon+Script|Tangerine" rel="stylesheet"> 
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <meta charset="utf-8" /><link href="https://fonts.googleapis.com/css?family=Kelly+Slab|Medula+One|Stint+Ultra+Condensed|Tulpen+One|Unica+One" rel="stylesheet"> 
<style>  
    .carteirinha{
        font-family: 'Medula One';
        font-size: 33px;
    }
    @media print {
        .noprint {
          visibility: hidden;
        }
    }
</style>
<script>
    $(document).ready(function(){
        $('.carteirinha').append('<img src="../web/img/carteirinha.png" height="360px" />')
        $('.carteirinha img').css({
            position: 'absolute',
            //left: '5px',
            top: '10px',
        })
        $('.foto1').append('<img src="'+foto1+'" height="125px" width="85px" />')
        $('.foto1 img').css({
            margin: '8px 12px'
        })
        $('.nome1').text(nome1).css({
            position: 'absolute',
            zIndex: '1',
            margin: '-13px 92px',
            width: '400px'
        })
        $('.pai1').text(pai1).css({
            position: 'absolute',
            zIndex: '1',
            margin: '24px 92px',
            width: '200px',
            //fontSize: '33px'
        })
        $('.mae1').text(mae1).css({
            position: 'absolute',
            zIndex: '1',
            margin: '24px 299px',
            width: '198px'
        })
        $('.dt_nascimento1').text(dt_nascimento1).css({
            position: 'absolute',
            zIndex: '1',
            margin: '77px 82px',
            width: '140px'
        })
        $('.estcivil1').text(estcivil1).css({
            position: 'absolute',
            zIndex: '1',
            margin: '77px 280px',
            width: '150px',
            textAlign: 'center'
        })
        $('.dt_ingresso1').text(dt_ingresso1).css({
            position: 'absolute',
            zIndex: '1',
            margin: '129px 82px',
            width: '140px'
        })
        $('.dt_batismo1').text(dt_batismo1).css({
            position: 'absolute',
            zIndex: '1',
            margin: '129px 298px',
            width: '140px'
        })
        $('.funcao1').text(funcao1).css({
            position: 'absolute',
            zIndex: '1',
            margin: '169px 92px',
            width: '160px',
            //textAlign: 'center'
        })
        $('.rg1').text(rg1).css({
            position: 'absolute',
            zIndex: '1',
            margin: '169px 325px',
            width: '140px'
        })
        $('.endereco1').text(endereco1).css({
            position: 'absolute',
            zIndex: '1',
            width: '379px',
            margin: '-130px 607px',
            fontSize: '30px'
        })
        $('.ano1').text(ano1).css({
            position: 'absolute',
            zIndex: '1',
            //width: '310px',
            margin: '28px 560px',
            fontSize: '20px',
            fontFamily: 'sans',
            fontWeight: '900',
            color: '#870000'
        })
        $('.ano2').text(ano2).css({
            position: 'absolute',
            zIndex: '1',
            //width: '310px',
            margin: '28px 650px',
            fontSize: '20px',
            fontFamily: 'sans',
            fontWeight: '900',
            color: '#870000'
        })
        $('.ano3').text(ano3).css({
            position: 'absolute',
            zIndex: '1',
            //width: '310px',
            margin: '28px 740px',
            fontSize: '20px',
            fontFamily: 'sans',
            fontWeight: '900',
            color: '#870000'
        })
        $('.ano4').text(ano4).css({
            position: 'absolute',
            zIndex: '1',
            //width: '310px',
            margin: '28px 830px',
            fontSize: '20px',
            fontFamily: 'sans',
            fontWeight: '900',
            color: '#870000'
        })
        $('.ano5').text(ano5).css({
            position: 'absolute',
            zIndex: '1',
            //width: '310px',
            margin: '28px 918px',
            fontSize: '20px',
            fontFamily: 'sans',
            fontWeight: '900',
            color: '#870000'
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
    foreach($ids as $id){           
        $search->setid($id);
        $model=$dao->encontrePorId($search);   
        
        $funcao=  ModelValidador::funcao(mb_strtolower($model->getnome(),'utf-8'));
        
        if(!$model->getrg()){
            $rg=000000000;
        }else{
            $rg=$model->getrg();
        }
        
        $dt_nascimento1=substr($model->getdt_nascimento(),-2,2).' / '.substr($model->getdt_nascimento(),-5,2).' / '.substr($model->getdt_nascimento(),0,4);
        $dt_ingresso1=substr($model->getdt_ingresso(),-2,2).' / '.substr($model->getdt_ingresso(),-5,2).' / '.substr($model->getdt_ingresso(),0,4);
        $dt_batismo1=substr($model->getdt_batismo(),-2,2).' / '.substr($model->getdt_batismo(),-5,2).' / '.substr($model->getdt_batismo(),0,4);
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
            //$bairro .=ModelValidador::iniciaisMaiusculas($bar).' - ';
        }
        $endereco .=ModelValidador::iniciaisMaiusculas($bairro).'/'.$model->getestado();
        echo '<script>
                var act="'.$act.'";
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

             </script>';
        echo '<script>var batizado=null;var id=null;var ids=null;var nome=null;var pai=null;var mae=null;
         </script>';
    }
?>
<div class="conteudo" id="printable">
    <div class="carteirinha">
        <div class="foto1"></div>
        <div class="nome1"></div>
        <div class="pai1"></div>
        <div class="mae1"></div>
        <div class="dt_nascimento1"></div>
        <div class="estcivil1"></div>
        <div class="dt_ingresso1"></div>
        <div class="dt_batismo1"></div>
        <div class="funcao1"></div>
        <div class="rg1"></div>
        <div class="endereco1"></div>
        <div class="ano1"></div>    
        <div class="ano2"></div>   
        <div class="ano3"></div>   
        <div class="ano4"></div>   
        <div class="ano5"></div>      
    </div>
</div>
    <button id="btnPrint" class="noprint">Imprimir</button>
</body>
</html>