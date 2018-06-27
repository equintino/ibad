<meta charset="utf-8" />
<style>
    .aniv{
        width: 90%;
        margin: auto;
        text-align: center;
    }
    .aniv img{
        padding: 5px;
    }
</style>
<?php
        include '../validacao/ModelValidador.php';
        include '../dao/RelBusca.php';
        include '../dao/dao.php';
        include '../config/Config.php';
        include '../model/Model.php';
        include '../mapping/modelMapper.php';
        
        $dao = new dao();
        $search = new RelBusca();
        
        $search->settabela('lt_membros');
        $search->setorder('dt_nascimento');
        $model=$dao->encontre($search);
        
        echo '<div class=aniv>';
        echo '<h2>ANIVERSARIANTES DO MÊS</h2>';
        $nascimento=array();
        foreach($model as $item){
            if(date('m') == substr($item->getdt_nascimento(),5,2)){
                $nascimento[$item->getfoto()]=substr($item->getdt_nascimento(),-2,2);
            }
        }
        asort($nascimento);
        foreach($nascimento as $keys => $item){
            echo '<img height=100px src="'.$keys.'" title="dia '.$item.'"/>';
        }
        echo '</div>';