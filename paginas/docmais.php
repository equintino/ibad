<?php
    require_once '../dao/dao.php';
    
    array_key_exists('ano',$_GET)?$ano=$_GET['ano']:$ano=null;
    $dao = new dao();
    $search = new ModelSearchCriteria();
    //echo '<pre>';
    $anos = Array();
    foreach($dao->listaTabela() as $item){
        if(is_numeric($item)){
            array_push($anos, $item);
        }
    }
    if($ano){
        $search->settabela($ano);
        $dados=$dao->encontre($search);
        foreach($dados as $item){
            if($item->getsaida()>0){
                $meses[$item->getmes()][$item->getdescricao()]=array($item->getsaida(),$item->getcomprovante());
            }
        }
        echo '<pre>';print_r($meses);die;
        //$selected=
        //echo '<pre>';print_r($anos);die;
    }