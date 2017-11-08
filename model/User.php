<?php
/**
 * Modelo class representando um item USER.
 */
final class User {
    /** @var int */
    private $id;
    private $nome;
    private $login;
    private $senha;
    private $email;
    private $setor;
    private $funcao;

    public function __construct() {
        $this->setDeleted(false);
    }
    public function getId() {
        return $this->id;
    }
    public function setId($id) {
        if ($this->id !== null && $this->id != $id) {
            throw new Exception('Cannot change identifier to ' . $id . ', already set to ' . $this->id);
        }
        $this->id = (int) $id;
    }
    public function getNome(){
        return $this->nome;
    }
    public function setNome($nome){
        $this->nome = $nome;
    }
    public function getLogin(){
        return $this->login;
    }
    public function setLogin($login){
        $this->login = $login;
    }
    public function getSenha(){
        return $this->senha;
    }
    public function setSenha($senha){
        $this->senha = $senha;
    }
    public function setEmail($email){
        $this->email = $email;
    }
    public function getEmail(){
        return $this->email;
    }
    public function setSetor($setor){
        $this->setor = $setor;
    }
    public function getSetor(){
        return $this->setor;
    }
    public function setFuncao($funcao){
        $this->funcao = $funcao;
    }
    public function getFuncao(){
        return $this->funcao;
    }
    public function getDeleted() {
        return $this->deleted;
    }
    public function setDeleted($deleted) {
        $this->deleted = (bool) $deleted;
    }
}
?>