<?php 
 class dao{
   private $db = null;
   public function __destruct(){
      $this->db = null;
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
        if($search->getid() != null){
           $row = $this->query('SELECT * FROM `'.$search->gettabela().'` WHERE excluido = "0" and id = ' . (int) $search->getid())->fetch();
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
      //print_r($model->getid());die;
        if ($model->getid() == null) {
           //die;
            return $this->insert($model);
        }
        return $this->update($model);
   }
   public function grava2(Model $model){
      //print_r($model);die;
        if ($model->getid() === null) {
            return $this->insert2($model);
        }
        return $this->update2($model);
   }
   public function grava3(Model $model){
        if ($model->getid() === null) {
            return $this->insert3($model);
        }
        return $this->update3($model);
   }
   public function exclui($id) {
        $sql = 'delete from `ibad`.`lt_membros` WHERE id = :id';
        $statement = $this->getDb()->prepare($sql);
        $this->executeStatement($statement, array(':id' => $id
        ));
        return $statement->rowCount() == 1;
   }
   private function getDb() {
        if ($this->db !== null) {
            return $this->db;
        }
        $config = Config::getConfig("db");
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
        $model->setid(null);
        $model->setexcluido(0);
        $model->setcriado($now);
        $model->setmodificado($now);        
        $sql = 'INSERT INTO `ibad`.`lt_membros` (`id`,`nome`,`email`,`tel`,`endereco`,`dt_batismo`,`dt_nascimento`,`criado`,`modificado`,`excluido`,`dt_ingresso`,`dt_casamento`,`conjuge`,`igbatismo`,`estcivil`,`tit`,`escolaridade`,`rg`,`pai`,`bairro`,`cel`,`sexo`,`mae`,`cep`,`estado`,`prof`,`cidade`,`cpf`,`igorigem`,`tipo`,`numero`,`complemento`,`naturalde`,`foto`) VALUES (:id,:nome,:email,:tel,:endereco,:dt_batismo,:dt_nascimento,:criado,:modificado,:excluido,:dt_ingresso,:dt_casamento,:conjuge,:igbatismo,:estcivil,:tit,:escolaridade,:rg,:pai,:bairro,:cel,:sexo,:mae,:cep,:estado,:prof,:cidade,:cpf,:igorigem,:tipo,:numero,:complemento,:naturalde,:foto)';
	$search = new ModelSearchCriteria();
        $search->settabela('lt_membros');
        //print_r($search);die;
        return $this->execute($sql, $model);
   }
   private function update(Model $model){
        date_default_timezone_set("Brazil/East");
        $now = mktime (date('H'), date('i'), date('s'), date("m")  , date("d"), date("Y"));
        $model->setmodificado($now);
        $sql = 'UPDATE `ibad`.`lt_membros` SET id = :id, nome = :nome, email = :email, tel = :tel, endereco = :endereco, dt_batismo = :dt_batismo, dt_nascimento = :dt_nascimento, criado = :criado, modificado = :modificado, excluido = :excluido, dt_ingresso = :dt_ingresso, dt_casamento = :dt_casamento, conjuge = :conjuge, igbatismo = :igbatismo, estcivil = :estcivil, tit = :tit, escolaridade = :escolaridade, rg = :rg, pai = :pai, bairro = :bairro, cel = :cel, sexo = :sexo, mae = :mae, cep = :cep, estado = :estado, prof = :prof, cidade = :cidade, cpf = :cpf, igorigem = :igorigem, tipo = :tipo, numero = :numero, complemento = :complemento, naturalde = :naturalde, foto = :foto WHERE id = :id ';
        return $this->execute($sql, $model);
   }
   private function insert2(Model $model){
        date_default_timezone_set("Brazil/East");
        $now = mktime (date('H'), date('i'), date('s'), date("m")  , date("d"), date("Y"));
        $model->setid(null);
        $model->setexcluido(0);
        $model->setcriado($now);
        $model->setmodificado($now); 
        $this->execute2($this->criaTabela($model->gettabela()), $model);       
        $sql = 'INSERT INTO `'.$model->gettabela().'` (`id`,`mes`,`dt`,`descricao`,`entrada`,`saida`,`diz_ofe`,`criado`,`modificado`,`excluido`) VALUES (:id,:mes,:dt,:descricao,:entrada,:saida,:diz_ofe,:criado,:modificado,:excluido)';
	return $this->execute2($sql, $model);
   }
   private function update2(Model $model,$tabela){
        $model->setmodificado(new DateTime(), new DateTimeZone('America/Sao_Paulo'));
        $sql = 'UPDATE ibad SET id = :id, mes = :mes, dt = :dt, descricao = :descricao, entrada = :entrada, saida = :saida, diz_ofe = :diz_ofe, criado = :criado, modificado = :modificado, excluido = :excluido WHERE id = :id ';
        return $this->execute2($sql, $model);
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
   public function execute($sql,$model){
        $statement = $this->getDb()->prepare($sql);
        //print_r($statement);die;
        $this->executeStatement($statement, $this->getParams($model));
        $search=new ModelSearchCriteria();
        if (!$model->getid()) {
            //return $this->encontrePorId($search->setid($this->getDb()->lastInsertId()));
        }
        return $model;
   }
   public function execute2($sql,$model){
        $statement = $this->getDb()->prepare($sql);
        $this->executeStatement($statement, $this->getParams2($model));
        $search=new ModelSearchCriteria();
        if (!$model->getid()) {
             //return $this->encontrePorId($search->setid($this->getDb()->lastInsertId()));
        }
        return $model;
   }
   public function execute3($sql,$model){
        $statement = $this->getDb()->prepare($sql);
        $this->executeStatement($statement, $this->getParams3($model));
        $search=new ModelSearchCriteria();
        if (!$model->getid()) {
             return $this->encontrePorId($search->setid($this->getDb()->lastInsertId()));
        }
        return $model;
   }
   private function getParams(Model $model){
        $params = array(':id'=> $model->getid(),':nome'=> $model->getnome(),':email'=> $model->getemail(),':tel'=> $model->gettel(),':endereco'=> $model->getendereco(),':dt_batismo'=> $model->getdt_batismo(),':dt_nascimento'=> $model->getdt_nascimento(),':criado'=> $model->getcriado(),':modificado'=> $model->getmodificado(),':excluido'=> $model->getexcluido(),':dt_ingresso'=> $model->getdt_ingresso(),':dt_casamento'=> $model->getdt_casamento(),':conjuge'=> $model->getconjuge(),':igbatismo'=> $model->getigbatismo(),':estcivil'=> $model->getestcivil(),':tit'=> $model->gettit(),':escolaridade'=> $model->getescolaridade(),':rg'=> $model->getrg(),':pai'=> $model->getpai(),':bairro'=> $model->getbairro(),':cel'=> $model->getcel(),':sexo'=> $model->getsexo(),':mae'=> $model->getmae(),':cep'=> $model->getcep(),':estado'=> $model->getestado(),':prof'=> $model->getprof(),':cidade'=> $model->getcidade(),':cpf'=> $model->getcpf(),':igorigem'=> $model->getigorigem(),':tipo'=> $model->gettipo(),':numero'=> $model->getnumero(),':complemento'=> $model->getcomplemento(),':naturalde'=> $model->getnaturalde(),':foto'=> $model->getfoto(),);
	 return $params;
   }
   private function getParams2(Model $model){
        $params = array(':id'=> $model->getid(),':mes'=> $model->getmes(),':dt'=> $model->getdt(),':descricao'=> $model->getdescricao(),':entrada'=> $model->getentrada(),':saida'=> $model->getsaida(),':diz_ofe'=> $model->getdiz_ofe(),':criado'=> $model->getcriado(),':modificado'=> $model->getmodificado(),':excluido'=> $model->getexcluido(),);
	 return $params;
   }
   private function getParams3(Model $model){
        $params = array(':id'=> $model->getid(),':ano'=> $model->getano(),':mes'=> $model->getmes(),':saldo'=> $model->getsaldo(),':excluido'=> $model->getexcluido(),);
	 return $params;
   }
   private function executeStatement(PDOStatement $statement, array $params){
        if (!$statement->execute($params)){
            self::throwDbError($this->getDb()->errorInfo());
        }
   }
   public function query($sql){
        set_time_limit(3600);
        $statement = $this->getDb()->query($sql, PDO::FETCH_ASSOC);
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
         if ($search !== null) {
             if($search->getmes() && !$search->getano()){
                 $sql="SELECT * FROM `".$search->gettabela()."` WHERE mes='".$search->getmes()."' AND excluido = '0' ";
             }elseif($search->getano()){              
                $sql="SELECT * FROM `".$search->gettabela()."` WHERE mes='".$search->getmes()."' AND ano='".$search->getano()."' AND excluido = '0' ";
             }else{
                 $sql="SELECT * FROM `".$search->gettabela()."` WHERE excluido = '0' ";
             }
          }else{
             $sql = "SELECT * FROM `ibad`.`".$search->gettabela()."` WHERE excluido = '0' ";
          }
          if($search->getorder()){
            $sql .= " ORDER BY `".$search->getorder()."`";
          }
          if($search->getdesc()){
             $sql .= " DESC";
          }
        return $sql;
  }
    private function criaTabela($tabela){
        $sql="CREATE TABLE IF NOT EXISTS `ibad`.`$tabela` ( `id` INT(5) NOT NULL AUTO_INCREMENT , `mes` INT(2) NULL , `dt` DATE NULL , `descricao` TEXT NULL , `entrada` DECIMAL(12,2) NULL , `saida` DECIMAL(12,2) NULL , `diz_ofe` ENUM('diz','ofe') NULL , `criado` varchar(50) NULL , `modificado` varchar(50) NULL , `excluido` INT(1) NOT NULL DEFAULT '0', PRIMARY KEY (`id`)) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci;";
        return $sql;
   }
}