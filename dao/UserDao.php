<?php
final class UserDao {
    /** @var PDO */
    private $db = null;
    public function __destruct() {
        // close db connection
        $this->db = null;
    }
    public function find(UserSearchCriteria $search = null) {
        $result = array();
        foreach ($this->query($this->getFindSql($search)) as $row) {
            $user = new User();
            UserMapper::map($user, $row);
            $result[$user->getId()] = $user;
        }
        return $result;
    }
    public function findById($id) {
        $row = $this->query('SELECT * FROM usuario WHERE deleted = \'0\' and id = ' . (int) $id)->fetch();
        if (!$row) {
            return null;
        }
        $user = new User();
        UserMapper::map($user, $row);
        return $user;
    }
    public function save($user) {
        if ($user->getId() === null) {
            return $this->insert($user);
        }else{
            return $this->update($user);
        }
    }
    public function delete($id) {
        $sql = '
            DELETE FROM usuario 
            WHERE
                id = :id';
        $statement = $this->getDb()->prepare($sql);
        $this->executeStatement($statement, array(
            ':id' => $id,
        ));
        return $statement->rowCount() == 1;
    }
    public function getDb() {
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
    public function getFindSql(UserSearchCriteria $search = null) {
        $sql = 'SELECT * FROM usuario WHERE deleted = \'0\' ';
        $orderBy = 'login';
        if ($search !== null) {
            if ($search->getLogin() !== null) {
                $sql .= ' AND login=\''.$search->getLogin().'\'';
            }
        }
        $sql .= ' ORDER BY ' . $orderBy;
        return $sql;
    }
    private function insert(User $user){
        $sql = '
            INSERT INTO usuario (id, nome, login, senha, email, setor, funcao)
            VALUES (:id, :nome, :login, :senha, :email, :setor, :funcao)';
        return $this->execute($sql, $user);
    }
    private function update(User $user) {
        $sql = '
            UPDATE usuario SET
		senha = :senha
            WHERE
                id = :id';
        return $this->execute($sql, $user);
    }
    private function execute($sql, User $user) {
        $statement = $this->getDb()->prepare($sql);
        $this->executeStatement($statement, $this->getParams($user));
        if (!$user->getId()) {
            return $this->findById($this->getDb()->lastInsertId());
        }
        if (!$statement->rowCount()) {
            throw new NotFoundException('Login "' . $user->getLogin() . '" não existe.');
        }
        return $user;
    }
    private function getParams(User $user) {
        $params = array(
            ':id' => $user->getId(),
            ':nome' => $user->getNome(),
            ':login' => $user->getLogin(),
            ':senha' => $user->getSenha(),
            ':email' => $user->getEmail(),
            ':setor' => $user->getSetor(),
            ':funcao' => $user->getFuncao()
        );
        if ($user->getId()) {
            // unset created date, this one is never updated
            unset($params[':login']);
        }
        return $params;
    }
    private function executeStatement(PDOStatement $statement, array $params) {
        if (!$statement->execute($params)) {
            self::throwDbError($this->getDb()->errorInfo());
        }
    }
    private function query($sql) {
        $statement = $this->getDb()->query($sql, PDO::FETCH_ASSOC);
        if ($statement === false) {
            $sql = "CREATE TABLE IF NOT EXISTS `usuario` (`id` int(5) NOT NULL AUTO_INCREMENT,`nome` varchar(100) DEFAULT NULL,`login` varchar(50) DEFAULT NULL, `senha` varchar(100) DEFAULT NULL, `email` varchar(100) DEFAULT NULL, `deleted` enum('0','1') DEFAULT '0', `setor` varchar(100) DEFAULT NULL, `funcao` varchar(100) DEFAULT NULL, PRIMARY KEY (`id`)) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ";
            $statement = $this->getDb()->query($sql, PDO::FETCH_ASSOC);
            //self::throwDbError($this->getDb()->errorInfo());
        }
        return $statement;
    }
    private static function throwDbError(array $errorInfo) {
        // TODO log error, send email, etc.
        throw new Exception('Erro na conexão com o Banco [' . $errorInfo[0] . ', ' . $errorInfo[1] . ']: ' . $errorInfo[2]);
    }
}
?>