<?php
require_once 'ModelSearchCriteria.php';
class RelBusca extends ModelSearchCriteria{
    private $ano;
    private $mes;
    
    public function getAno() {
        return $this->ano;
    }
    public function getMes() {
        return $this->mes;
    }
    public function setAno($ano) {
        $this->ano = $ano;
    }
    public function setMes($mes) {
        $this->mes = $mes;
    }
}