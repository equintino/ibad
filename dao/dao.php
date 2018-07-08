<?php 
    class dao{
        protected $db = null;
        private $banco;
        private $variaveis=array('id','nome','email','tel','endereco','dt_batismo','dt_nascimento','criado','modificado','excluido','dt_ingresso','dt_casamento','conjuge','igbatismo','estcivil','tit','escolaridade','rg','pai','bairro','cel','sexo','mae','cep','estado','prof','cidade','cpf','igorigem','tipo','numero','complemento','naturalde','foto', 'certificado');
        
        public function __destruct(){
           $this->db = null;
        }
        public function listaTabela($db=null){
            $db?$db=$db:$db='db';
            $tabelas=array();
            foreach($this->query('SHOW TABLES',$db) as $row){
                array_push($tabelas,$row["Tables_in_$this->banco"]);
            }
            return $tabelas;
        }
        public function backup($db=null){
            $db?$db=$db:$db='db';
            date_default_timezone_set('America/Sao_Paulo');
            $data=date('dmY');
            $banco=preg_replace('/dbname=/','',explode(';',Config::getConfig($db)['dsn'])[1]);
            system('mysqldump -h localhost -u root -B '.$banco.' > "../db/'.$banco.'_'.$data.'.sql"');
        }
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
        public function encontrePorId(ModelSearchCriteria $search=null){
            if($search->getId() != null){
                $row = $this->query('SELECT * FROM `'.$search->gettabela().'` WHERE excluido = "0" and id = ' . (int) $search->getId())->fetch();
            }else{ 
                $row = $this->query('SELECT * FROM `'.$search->gettabela().'` WHERE excluido = "0" ')->fetchAll();
            }
            if (!$row) {
                return null;
            }
            $model = new Model();
            modelMapper::map($model, $row);
            return $model;
        }
        public function grava(Model $model){
            if ($model->getid() == null) {
                return $this->insert($model);
            }
            return $this->update($model);
        }
        public function exclui($id) {
            $sql = 'delete from `lt_membros` WHERE id = :id';
            $statement = $this->getDb()->prepare($sql);
            $this->executeStatement($statement, array(':id' => $id
            ));
            return $statement->rowCount() == 1;
        }
        protected function getDb($a=null) {
            $a?$a=$a:$a='db';
            if ($this->db !== null) {
                return $this->db;
            }
            $config = Config::getConfig($a);
            try {
                $this->db = new PDO($config['dsn'], $config['username'], $config['password']);
            } catch (Exception $ex) {
                throw new Exception('DB connection error: ' . $ex->getMessage());
            }
            return $this->db;
        }
        private function insert(Model $model){
            date_default_timezone_set("Brazil/East");
            $now = mktime (date('H'), date('i'), date('s'), date("m")  , date("d"), date("Y"));
            $model->setid(null);$model->setexcluido(0);$model->setcriado($now);$model->setmodificado($now);
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
            return $this->execute($sql, $model);
        }
        private function update(Model $model){
            date_default_timezone_set("Brazil/East");
            $now = mktime (date('H'), date('i'), date('s'), date("m")  , date("d"), date("Y"));
            $model->setmodificado($now);
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
        private function getParams(Model $model){
            $params = array();
            foreach($this->variaveis as $item){
                $a=":$item";
                $classe='get'.$item;
                $params[$a]=$model->$classe();
            }
            return $params;
        }
        public function execute($sql,$model){
            $statement = $this->getDb()->prepare($sql);
            $this->executeStatement($statement, $this->getParams($model));
            $search=new ModelSearchCriteria();
            if (!$model->getid()) {
                //return $this->encontrePorId($search->setid($this->getDb()->lastInsertId()));
            }
            return $model;
        }
        protected function executeStatement(PDOStatement $statement, array $params){
            if (!$statement->execute($params)){
                self::throwDbError($this->getDb()->errorInfo());
            }
        }
        public function query($sql,$db=null){
            $db?$db_=$db:$db_='db';
            set_time_limit(3600);
            $config = Config::getConfig($db_);
            $banco=preg_replace('/dbname=/','',(explode(';',$config['dsn'])[1]));
            $this->banco=$banco;
            $statement = $this->getDb($db)->query($sql, PDO::FETCH_ASSOC);
            if ($statement === false) {
                self::throwDbError($this->getDb()->errorInfo());
            }
            return $statement;
        }
        private static function throwDbError(array $errorInfo){
             // TODO log error, send email, etc.
            throw new Exception('DB error [' . $errorInfo[0] . ', ' . $errorInfo[1] . ']: ' . $errorInfo[2]);
        }
        private function getEncontreSql(ModelSearchCriteria $search = null){
            if($search->getid()){
                $sql = "SELECT * FROM `".$search->gettabela()."` WHERE excluido = '0' AND id=".$search->getid();
            }else{
                if($search->getnome()){
                    $sql = "SELECT * FROM `".$search->gettabela()."` WHERE excluido = '0' AND nome like '%".$search->getnome()."%'";
                }else{
                    $sql = "SELECT * FROM `".$search->gettabela()."` WHERE excluido = '0' ";
                }
            }
            return $sql;
        }
        public function criaTabela($tabela){
            $sql="CREATE TABLE IF NOT EXISTS `$tabela` ( `id` INT(5) NOT NULL AUTO_INCREMENT , `mes` INT(2) NULL , `dt` DATE NULL , `descricao` TEXT NULL , `entrada` DECIMAL(12,2) NULL , `saida` DECIMAL(12,2) NULL , `diz_ofe` ENUM('diz','ofe') NULL , `criado` varchar(50) NULL , `modificado` varchar(50) NULL , `excluido` INT(1) NOT NULL DEFAULT '0', PRIMARY KEY (`id`)) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci;";
            return $sql;
        }
        
        
   public function grava3(Model $model){
        if ($model->getid() === null) {
            return $this->insert3($model);
        }
        return $this->update3($model);
   }
   private function insert3(Model $model){
        date_default_timezone_set("Brazil/East");
        $now = mktime (date('H'), date('i'), date('s'), date("m")  , date("d"), date("Y"));
        $model->setid(null);
        $model->setexcluido(0);
        $model->setcriado($now);
        $model->setmodificado($now); 
        //$this->execute3($this->criaTabela($model->gettabela()), $model);   
        $sql = 'INSERT INTO `'.$model->gettabela().'` (`id`,`ano`,`mes`,`saldo`,`excluido`) VALUES (:id,:ano,:mes,:saldo,:excluido)';
	return $this->execute3($sql, $model);
   }
   private function update3(Model $model,$tabela){
        $model->setmodificado(new DateTime(), new DateTimeZone('America/Sao_Paulo'));
        $sql = 'UPDATE saldo SET id = :id, ano = :ano, mes = :mes, saldo = :saldo, excluido = :excluido WHERE id = :id ';
        return $this->execute3($sql, $model);
   }
   public function execute3($sql,$model){
        $statement = $this->getDb()->prepare($sql);
        $this->executeStatement($statement, $this->getParams3($model));
        $search=new ModelSearchCriteria();
        if (!$model->getid()) {
             //return $this->encontrePorId($search->setid($this->getDb()->lastInsertId()));
        }
        return $model;
   }
   private function getParams3(Model $model){
        $params = array(':id'=> $model->getid(),':ano'=> $model->getano(),':mes'=> $model->getmes(),':saldo'=> $model->getsaldo(),':excluido'=> $model->getexcluido(),);
	 return $params;
   }
    
}