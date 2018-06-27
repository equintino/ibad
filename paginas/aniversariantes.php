<meta charset="utf-8" />
<?php
    require_once '../dao/RelBusca.php';
    $dao = new Dao();
    $search = new RelBusca();
    $search->settabela('lt_membros');
    $model=$dao->encontre($search);
    foreach($model as $item){
        $dados[$item->getnome()]=$item->getdt_nascimento();
    }
    function aniversario($str){
        foreach($str as $key => $item){
            $item=explode('-',$item);
            $dados[$key]=$item[1].'-'.$item[2];
        } 
        asort($dados);
        return $dados;
    }