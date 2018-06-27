<?php 
    class ModelSearchCriteria{
        protected $id;
        protected $tabela;
        protected $order;
        protected $desc;
        
        private $nome;
        private $dt_nascimento;
        private $cpf;
        private $cep;
        
        public function getId() {
            return $this->id;
        }
        public function getTabela() {
            return $this->tabela;
        }
        public function getOrder() {
            return $this->order;
        }
        public function getDesc() {
            return $this->desc;
        }
        public function getNome() {
            return $this->nome;
        }
        public function getDt_nascimento() {
            return $this->dt_nascimento;
        }
        public function getCpf() {
            return $this->cpf;
        }
        public function getCep() {
            return $this->cep;
        }
        public function setId($id) {
            $this->id = $id;
        }
        public function setTabela($tabela) {
            $this->tabela = $tabela;
        }
        public function setOrder($order) {
            $this->order = $order;
        }
        public function setDesc($desc) {
            $this->desc = $desc;
        }
        public function setNome($nome) {
            $this->nome = $nome;
        }
        public function setDt_nascimento($dt_nascimento) {
            $this->dt_nascimento = $dt_nascimento;
        }
        public function setCpf($cpf) {
            $this->cpf = $cpf;
        }
        public function setCep($cep) {
            $this->cep = $cep;
        }
    }