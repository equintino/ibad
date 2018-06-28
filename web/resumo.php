<meta charset="utf-8" />
<style>
    body{   
    }
    .fundo{
       position: relative;
       top: 0;
       left: 0;
       z-index: -1;
       /*background: no-repeat url('../web/imagens/timbrado.png');
       background-size: 595px;
       background-position-x: center;*/
    }
    .rel{
       display: none;
    }
    .resumo{
       width: 1000;
       margin: auto;
    }
    .resumao{
        position: absolute;
        top: 250px;
        margin-left: 200px;
    }
    .assinatura{
       text-align: center;
       margin-top: -300px;
       font-weight: 700;
       font-size: 25px;
    }
    .funcao{
       font-size: 19px;
    }
.rel th, .resumo th{
    background-color: green;
    color: white;
    font-size: 23px;
}
.rel td, .resumo td{
    background-color: white;
    opacity: 0.7;
    font-weight: bolder;
    font-size: 23px;
}
.separa{
    background-color: blue;
}
.totais{
    background-color: darkgray;
}
@media print {
  .botao{
    visibility: hidden;
  }
}
</style>
<?php  
   include '../validacao/ModelValidador.php';
   include '../dao/RelBusca.php';
   include '../dao/DaoRel.php';
   include '../config/Config.php';
   include '../model/Model.php';
   include '../mapping/modelMapper.php';
   
   $dao=new dao();
   
   $mes=$_GET['mes'];
   $ano=$_GET['ano'];
   $variaveis=array('dt','descricao','entrada','saida','diz_ofe');
             $somaEntrada=0;
             $somaSaida=0;
             $mesAnterior=ModelValidador::nomeMes($mes-1);
             if($mes==1){
                $mesAnterior='dezembro';
             }
             $search=new RelBusca();
             $daoRel=new DaoRel();
             $search->settabela('saldo');
             $search->setmes(strtolower(ModelValidador::tirarAcento($mesAnterior)));
             $dados=$daoRel->encontre($search);
             foreach($dados as $saldomes);
             $saldo=$saldoAnterior=($saldomes->getsaldo());
             $search->settabela($ano);
             $search->setmes($mes);
             $relatorios=$daoRel->encontre($search);
          ?>
       <div class="rel" >
         <table border="1" cellspacing="0" class="rel">
             <tr><th colspan="
               <?php                   
                  echo count($variaveis) 
               ?>2" align="center">MOVIMENTO FINANCEIRO DO MÊS - <?php 
                echo mb_strtoupper($mes,'UTF-8');
                foreach($relatorios as $datas);
                echo '('.substr($datas->getdt(),0,4).')';
                ?></th></tr>
             <tr>
                 <?php 
                    foreach($variaveis as $variavel){
                        if($variavel=='dt'){
                           echo '<th>';
                           echo 'DIA';
                        }elseif($variavel=='diz_ofe'){
                           echo '<th>';
                           echo 'DÍZIMO/<br>OFERTA';
                        }elseif($variavel=='descricao'){
                           echo '<th width="100%">';
                           echo 'DESCRIÇÃO';
                        }else{
                           echo '<th>';
                           echo strtoupper($variavel);
                        }
                      echo '</th>';
                    }
                      echo '<th>SALDO</th>';
                 ?>
             </tr>
                     <?php 
                       echo '<tr class=totais><td align=center>01</td><td>SALDO ANTERIOR</td><td align=center></td><td align=center></td><td align=center></td><td align=right>'.number_format($saldo,'2',',','.').'</td></tr>';
                       foreach($relatorios as $relatorio){
                         echo '<tr>';
                          foreach($variaveis as $item){
                           $getnome="get$item";
                             if($relatorio->$getnome() != 0 && is_numeric($relatorio->$getnome())){
                               if($item == 'mes'){  
                                  echo '<td align=center>';
                                  echo $relatorio->$getnome(); 
                               }else{                                 
                                  echo '<td align=right>';
                                  echo number_format($relatorio->$getnome(),2,',','.');
                               }
                             }elseif(!is_numeric($relatorio->$getnome()) && $relatorio->$getnome() != $relatorio->getdescricao()){
                               if($relatorio->$getnome() == $relatorio->getdiz_ofe()){
                                 echo '<td align=center>';
                                   if($relatorio->getdiz_ofe()=='diz'){
                                      echo 'DIZIMO';
                                   }elseif($relatorio->getdiz_ofe()=='ofe'){
                                      echo 'OFERTA';
                                   }
                               }else{
                                echo '<td align=center>';
                                  echo substr($relatorio->$getnome(),8,2);
                               }
                             }elseif($relatorio->$getnome() == $relatorio->getdescricao()){
                                echo '<td align=left>';
                                echo strtoupper($relatorio->$getnome());
                             }else{
                                echo '<td>';
                             }
                             echo '</td>';
                          }
                         if($relatorio->getentrada()!=0){
                            $saldo=$saldo+$relatorio->getentrada();
                            $somaEntrada=$somaEntrada+$relatorio->getentrada();
                         }elseif($relatorio->getsaida()!=0){
                            $saldo=$saldo-$relatorio->getsaida();
                            $somaSaida=$somaSaida+$relatorio->getsaida();
                         }
                            $resumo[]=array('descricao'=>$relatorio->getdescricao(),'saida'=>$relatorio->getsaida(),'entrada'=>$relatorio->getentrada());
                         echo "<td align=right>".number_format($saldo,'2',',','.')."</td>";
                         echo '</tr>';
                       }
                     ?>   
         </table>
       </div>
<div id="printable" class="resumo">  
    <div class="botao"><button onclick="print()">IMPRIME</button></div>
    <div class="fundo"><img height="1224px" src="../web/imagens/timbrado.png" /></div>
         <table border="1" cellspacing="0" class="resumao">
           <tr><th colspan="3" align="center">
                   MOVIMENTO FINANCEIRO DO MÊS - <?= mb_strtoupper(ModelValidador::nomeMes($mes),'UTF-8') ?> / <?= $ano ?>
                </th></tr>
             <tr></tr>
             <?php
             
                echo '<tr class=totais><td>SALDO ANTERIOR</td><td></td><td align=right>'.number_format($saldoAnterior,'2',',','.').'</td></tr>';
             foreach($resumo as $cel){
                   if($cel['saida'] !=0){
                      echo '<tr><td>'.strtoupper($cel['descricao']).'</td><td align=right>'.number_format($cel['saida'],'2',',','.').'</td><td></td></tr>';
                   }elseif($cel['descricao']=='oferta'||$cel['descricao']=='OFERTA'){
                      $ofertas[]=$cel['entrada'];
                   }else{
                      $dizimo[]=$cel['entrada'];
                   }
                }
                echo '<tr><td>OFERTAS</td><td></td><td align=right>'.number_format(array_sum($ofertas),'2',',','.').'</td></tr>';
                echo '<tr><td>DIZIMOS</td><td></td><td align=right>'.number_format(array_sum($dizimo),'2',',','.').'</td></tr>';
                echo '<tr class="totais"><td align=right>TOTAIS</td><td align=right>'.  number_format($somaSaida,'2',',','.').'</td><td align=right>'.number_format($somaEntrada,'2',',','.').'</td></tr>';
                echo '<tr><td colspan=3 ></td></tr>';
                echo '<tr class="totais"><td align=right colspan=2>SALDO PARA O MÊS SEGUINTE</td><td align=right>'.number_format($saldoAnterior+$somaEntrada-$somaSaida,'2',',','.').'</td></tr>';
             ?>
         </table>
    <div class="assinatura">
        __________________________________<br>
        Mônica Cristina Peixoto Quintino<br>
        <span class=funcao>1a Tesoureira</span><br><br>
       
        __________________________________<br>
        Aventino Quintino da Silva<br>
        <span class=funcao>Partor Presidente</span>
    </div>
</div>