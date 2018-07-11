<?php
require_once 'dao.php';
require_once 'RelBusca.php';
class DaoRel extends dao{
    private $variaveis=array('id','mes','dt','descricao','entrada','saida','comprovante','diz_ofe','criado','modificado','excluido');
    
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
        if ($search !== null) {
            if($search->getmes() && !$search->getano()){
                $sql="SELECT * FROM `".$search->gettabela()."` WHERE mes='".$search->getmes()."' AND excluido = '0' ";
            }elseif($search->getano()){              
                $sql="SELECT * FROM `".$search->gettabela()."` WHERE mes='".$search->getmes()."' AND ano='".$search->getano()."' AND excluido = '0' ";
            }elseif($search->getnome()){
                $sql="SELECT * FROM `".$search->gettabela()."` WHERE nome LIKE '%".$search->getnome()."%' AND excluido = '0' ";
            }else{
                $sql="SELECT * FROM `".$search->gettabela()."` WHERE excluido = '0' ";
            }
        }else{
            $sql = "SELECT * FROM `".$search->gettabela()."` WHERE excluido = '0' ";
        }
        if($search->getorder()){
            $sql .= " ORDER BY `".$search->getorder()."`";
        }
        if($search->getdesc()){
            $sql .= " DESC";
        }
        return $sql;
    }
    public function grava(Model $model){
        if ($model->getid() === null) {
            return $this->insert($model);
        }
        return $this->update($model);
    }
    public function gravaComprovante(Model $model){
        $sql="UPDATE `".$model->gettabela()."` SET comprovante='".$model->getcomprovante()."' WHERE id=".$model->getid();
        return $this->execute($sql,$model);die;
    }
    private function insert(Model $model){
        date_default_timezone_set("Brazil/East");
        $now = mktime (date('H'), date('i'), date('s'), date("m")  , date("d"), date("Y"));
        $model->setid(null);
        $model->setexcluido(0);
        $model->setcriado($now);
        $model->setmodificado($now); 
        $this->execute($this->criaTabela($model->gettabela()), $model);
        $sql = 'INSERT INTO `'.$model->gettabela().'` (';
        for($x=0;$x<count($this->variaveis);$x++){
            if($x < count($this->variaveis)-1){
                $sql .= '`'.$this->variaveis[$x].'`,';
            }else{
                $sql .= '`'.$this->variaveis[$x].'`)';
            }
        }
        $sql .= 'VALUES (';
        for($x=0;$x<count($this->variaveis);$x++){
            if($x < count($this->variaveis)-1){
                $sql .= ':'.$this->variaveis[$x].',';
            }else{
                $sql .= ':'.$this->variaveis[$x].')';
            }
        }       
        //$sql = 'INSERT INTO `'.$model->gettabela().'` (`id`,`mes`,`dt`,`descricao`,`entrada`,`saida`,`comprovante`,`diz_ofe`,`criado`,`modificado`,`excluido`) VALUES (:id,:mes,:dt,:descricao,:entrada,:saida,:comprovante,:diz_ofe,:criado,:modificado,:excluido)';
        return $this->execute($sql, $model);
    }
    private function update(Model $model){
        date_default_timezone_set("Brazil/East");
        $now = mktime (date('H'), date('i'), date('s'), date("m")  , date("d"), date("Y"));
        $model->setmodificado($now);
        $model->setexcluido(0);
        $arr = array_filter((array) $model);
        $valores = str_replace('Model','',array_keys($arr));
        foreach($valores as $valor){
            if(in_array(trim($valor),$this->variaveis)){
                $lista[]=$valor;
            }
        }
        if($lista){
            $this->variaveis = $lista;
        }
        $sql = 'UPDATE `'.$model->gettabela().'` SET ';
        for($x=0;$x<count($this->variaveis);$x++){
            if($x < count($this->variaveis)-1){
                $sql .= $this->variaveis[$x].'=:'.$this->variaveis[$x].',';
            }else{
                $sql .= $this->variaveis[$x].'=:'.$this->variaveis[$x].' ';
            }
        }
        $sql .= 'WHERE id = :id ';
        return $this->execute($sql, $model);
    }
    public function execute($sql,$model){
        $statement = $this->getDb()->prepare($sql);
        $this->executeStatement($statement, $this->getParams($model));
        //$search=new RelBusca();
        if (!$model->getid()) {
             //return $this->encontrePorId($search->setid($this->getDb()->lastInsertId()));
        }
        return $model;
    }
    private function getParams(Model $model){
        $params = array();
        foreach($this->variaveis as $item){
            $a=":$item";
            $classe='get'.trim($item);
            $params[$a]=$model->$classe();
        }
        $params = array(':id'=> $model->getid(),/*':mes'=> $model->getmes(),':dt'=> $model->getdt(),':descricao'=> $model->getdescricao(),':entrada'=> $model->getentrada(),':saida'=> $model->getsaida(),*/':comprovante'=> '"'.$model->getcomprovante().'"',/*':diz_ofe'=> $model->getdiz_ofe(),':criado'=> $model->getcriado(),*/':modificado'=> $model->getmodificado(),':excluido'=> $model->getexcluido(),);
        return $params;
    }
    /*protected function executeStatement(PDOStatement $statement, array $params){
        if (!$statement->execute($params)){
            self::throwDbError($this->getDb()->errorInfo());
        }
    } */       
}