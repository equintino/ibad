<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pt-br" lang="pt-br">
<head>   
    <link href="https://fonts.googleapis.com/css?family=Alex+Brush|Great+Vibes|Pinyon+Script|Tangerine" rel="stylesheet"> 
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <meta charset="utf-8" />
<style>  
    .certificado img, .certificadoVerso img{
        height: 660px;
        margin-left: 25px;
    }   
    .membro{
        position: absolute;
        top: 199px;
        left: 235px;
        font-size: 50px;
        width: 580px;
        text-align: center;
        font-family: 'Alex Brush';
        font-weight: 900;
    }
    .pai{
        position: absolute;
        top: 314px;
        left: 65px;
        font-size: 36px;
        width: 435px;
        text-align: center;
        font-family: 'Great Vibes';
        font-weight: 700;
    } 
    .mae{
        position: absolute;
        top: 312px;
        left: 495px;
        font-size: 36px;
        width: 440px;
        text-align: center;
        font-family: 'Great Vibes';
        font-weight: 700;
    }
    .dt_batismo{
        position: absolute;
        top: 505px;
        left: 155px;
        font-size: 36px;
        font-weight: 700;
    }
    @media print {
        .noprint {
          visibility: hidden;
        }
    }
</style>
<script>
    $(document).ready(function(){
        $('.certificado img').mouseover(function(){
            $(this).css({
                cursor: 'pointer'                
            })
            $(this).click(function(){
                $(location).attr('href','../web/certificado.php?id='+id+'&act=verso');
            })
        })
        $('.certificadoVerso').append('<img width=925px src="../web/img/'+batizado+'Beca.jpg" />')
        $('.certificadoVerso').append('<img src="../web/img/certificado (ATRAS)branco.png" />')
        $('.certificadoVerso img').wrap('<div class=beca></div>')
        $('.beca').css({
            position: 'absolute'
        })
        $('.certificadoVerso img').mouseover(function(){
            $(this).attr('title','Clique para virar.');
            $(this).css({
                cursor: 'pointer'                
            })
            $(this).click(function(){
                $(location).attr('href','../web/certificado.php?&id='+id+'&act=cert');
            })
        })
        $('#btnPrint').css({
            position:'absolute',
            top: '670px',
            zIndex: '1'
        })
        $("#btnPrint").click(function(){
            print();
        });
    });
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
    $id=$_GET['id'];
    $act=$_GET['act'];
    
    $dao = new Dao();
    $search = new ModelSearchCriteria();
    $search->settabela('lt_membros');
    $search->setid($id);
    $model=$dao->encontrePorId($search);
    $nome=$model->getnome();
    $pai=$model->getpai();
    $mae=$model->getmae();
    $batismo=$model->getdt_batismo();
    $dd=substr($batismo,-2,2);
    $mm=substr($batismo,-5,2);
    $aa=substr($batismo,0,4);
    
    
    $nome=ModelValidador::iniciaisMaiusculas($nome);
    $pai=ModelValidador::iniciaisMaiusculas($pai);
    $mae=ModelValidador::iniciaisMaiusculas($mae);
    $nomes=explode(' ',$nome);
    $membro=strtolower($nomes[0]);
    $esp="&nbsp&nbsp&nbsp&nbsp";
    
    echo '<script>var batizado="'.$membro.'";
                  var id="'.$id.'"; 
                  var nome="'.$nome.'";
                  var pai="'.$pai.'";
                  var mae="'.$mae.'";
                  var act="'.$act.'";
         </script>';
?>
<div class="conteudo" id="printable">
<?php if($act=='cert'): ?>    
    <div class="certificado">
        <img title="Clique para ver o verso." src="../web/img/certificado Frente.png" />
        <div class="membro"><?= $nome ?></div>
        <div class="pai"><?= $pai ?></div>
        <div class="mae"><?= $mae ?></div>
        <div class="dt_batismo"><?= $dd.$esp.$mm.$esp.$aa ?></div>
    </div>
<?php elseif($act=='verso'): ?>
    <div class="certificadoVerso">
        <div></div>
    </div>
<?php endif; ?>
</div>
    <button id="btnPrint" class="noprint">Imprimir</button>
</body>
</html>