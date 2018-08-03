<?php
require_once 'dao.php';
class BuscaOrdenada extends dao{
    public function encontre(ModelSearchCriteria $search = null){ 
        set_time_limit(3600);
        ini_set('memory_limit', '-1');
        $result = array();
        foreach ($this->query($this->getEncontreSql($search)) as $row){
            $model = new Model();
            modelMapper::map($model, $row);
            $result[$model->getid()] = $model;
        } 
        return $result;
    }
    private function getEncontreSql(ModelSearchCriteria $search = null){
        if($search->getorder()){
            $sql = "SELECT * FROM `".$search->gettabela()."` WHERE excluido = '0' ORDER BY ".$search->getorder();
        }elseif($search->getId()){
            $sql = "SELECT * FROM `".$search->gettabela()."` WHERE excluido = '0' AND id=".$search->getId();
        }else{
            $sql = "SELECT * FROM `".$search->gettabela()."` WHERE excluido = '0' ";
        }
        return $sql;
    }
}
