<?php 
 class Model{
 private $id;
 private $nome;
 private $email;
 private $tel;
 private $endereco;
 private $dt_batismo;
 private $dt_nascimento;
 private $criado;
 private $modificado;
 private $excluido;
 private $dt_ingresso;
 private $dt_casamento;
 private $conjuge;
 private $igbatismo;
 private $estcivil;
 private $tit;
 private $escolaridade;
 private $rg;
 private $pai;
 private $bairro;
 private $cel;
 private $sexo;
 private $mae;
 private $cep;
 private $estado;
 private $prof;
 private $cidade;
 private $cpf;
 private $igorigem;
 private $tipo;
 private $numero;
 private $complemento;
 private $ano;
 private $mes;
 private $saldo;
 private $dt;
 private $descricao;
 private $entrada;
 private $saida;
 private $diz_ofe;
 private $tabela;
 private $order;
 private $naturalde;
 private $foto;
 private $desc;
 public function getid(){
	return $this->id;
 }
 public function setid($id ){
	$this->id=$id;
 }
 public function getnome(){
	return $this->nome;
 }
 public function setnome($nome ){
	$this->nome=$nome;
 }
 public function getemail(){
	return $this->email;
 }
 public function setemail($email ){
	$this->email=$email;
 }
 public function gettel(){
	return $this->tel;
 }
 public function settel($tel ){
	$this->tel=$tel;
 }
 public function getendereco(){
	return $this->endereco;
 }
 public function setendereco($endereco ){
	$this->endereco=$endereco;
 }
 public function getdt_batismo(){
	return $this->dt_batismo;
 }
 public function setdt_batismo($dt_batismo ){
	$this->dt_batismo=$dt_batismo;
 }
 public function getdt_nascimento(){
	return $this->dt_nascimento;
 }
 public function setdt_nascimento($dt_nascimento ){
	$this->dt_nascimento=$dt_nascimento;
 }
 public function getcriado(){
	return $this->criado;
 }
 public function setcriado($criado ){
	$this->criado=$criado;
 }
 public function getmodificado(){
	return $this->modificado;
 }
 public function setmodificado($modificado ){
	$this->modificado=$modificado;
 }
 public function getexcluido(){
	return $this->excluido;
 }
 public function setexcluido($excluido ){
	$this->excluido=$excluido;
 }
 public function getdt_ingresso(){
	return $this->dt_ingresso;
 }
 public function setdt_ingresso($dt_ingresso ){
	$this->dt_ingresso=$dt_ingresso;
 }
 public function getdt_casamento(){
	return $this->dt_casamento;
 }
 public function setdt_casamento($dt_casamento ){
	$this->dt_casamento=$dt_casamento;
 }
 public function getconjuge(){
	return $this->conjuge;
 }
 public function setconjuge($conjuge ){
	$this->conjuge=$conjuge;
 }
 public function getigbatismo(){
	return $this->igbatismo;
 }
 public function setigbatismo($igbatismo ){
	$this->igbatismo=$igbatismo;
 }
 public function getestcivil(){
	return $this->estcivil;
 }
 public function setestcivil($estcivil ){
	$this->estcivil=$estcivil;
 }
 public function gettit(){
	return $this->tit;
 }
 public function settit($tit ){
	$this->tit=$tit;
 }
 public function getescolaridade(){
	return $this->escolaridade;
 }
 public function setescolaridade($escolaridade ){
	$this->escolaridade=$escolaridade;
 }
 public function getrg(){
	return $this->rg;
 }
 public function setrg($rg ){
	$this->rg=$rg;
 }
 public function getpai(){
	return $this->pai;
 }
 public function setpai($pai ){
	$this->pai=$pai;
 }
 public function getbairro(){
	return $this->bairro;
 }
 public function setbairro($bairro ){
	$this->bairro=$bairro;
 }
 public function getcel(){
	return $this->cel;
 }
 public function setcel($cel ){
	$this->cel=$cel;
 }
 public function getsexo(){
	return $this->sexo;
 }
 public function setsexo($sexo ){
	$this->sexo=$sexo;
 }
 public function getmae(){
	return $this->mae;
 }
 public function setmae($mae ){
	$this->mae=$mae;
 }
 public function getcep(){
	return $this->cep;
 }
 public function setcep($cep ){
	$this->cep=$cep;
 }
 public function getestado(){
	return $this->estado;
 }
 public function setestado($estado ){
	$this->estado=$estado;
 }
 public function getprof(){
	return $this->prof;
 }
 public function setprof($prof ){
	$this->prof=$prof;
 }
 public function getcidade(){
	return $this->cidade;
 }
 public function setcidade($cidade ){
	$this->cidade=$cidade;
 }
 public function getcpf(){
	return $this->cpf;
 }
 public function setcpf($cpf ){
	$this->cpf=$cpf;
 }
 public function getigorigem(){
	return $this->igorigem;
 }
 public function setigorigem($igorigem ){
	$this->igorigem=$igorigem;
 }
 public function gettipo(){
	return $this->tipo;
 }
 public function settipo($tipo ){
	$this->tipo=$tipo;
 }
 public function getnumero(){
	return $this->numero;
 }
 public function setnumero($numero ){
	$this->numero=$numero;
 }
 public function getcomplemento(){
	return $this->complemento;
 }
 public function setcomplemento($complemento ){
	$this->complemento=$complemento;
 }
 public function getano(){
	return $this->ano;
 }
 public function setano($ano ){
	$this->ano=$ano;
 }
 public function getmes(){
	return $this->mes;
 }
 public function setmes($mes ){
	$this->mes=$mes;
 }
 public function getsaldo(){
	return $this->saldo;
 }
 public function setsaldo($saldo ){
	$this->saldo=$saldo;
 }
 public function getdt(){
	return $this->dt;
 }
 public function setdt($dt ){
	$this->dt=$dt;
 }
 public function getdescricao(){
	return $this->descricao;
 }
 public function setdescricao($descricao ){
	$this->descricao=$descricao;
 }
 public function getentrada(){
	return $this->entrada;
 }
 public function setentrada($entrada ){
	$this->entrada=$entrada;
 }
 public function getsaida(){
	return $this->saida;
 }
 public function setsaida($saida ){
	$this->saida=$saida;
 }
 public function getdiz_ofe(){
	return $this->diz_ofe;
 }
 public function setdiz_ofe($diz_ofe ){
	$this->diz_ofe=$diz_ofe;
 }
 public function gettabela(){
	return $this->tabela;
 }
 public function settabela($tabela ){
	$this->tabela=$tabela;
 }
 public function getorder(){
	return $this->order;
 }
 public function setorder($order ){
	$this->order=$order;
 }
 public function getnaturalde(){
	return $this->naturalde;
 }
 public function setnaturalde($naturalde ){
	$this->naturalde=$naturalde;
 }
 public function getfoto(){
	return $this->foto;
 }
 public function setfoto($foto ){
	$this->foto=$foto;
 }
 public function getdesc(){
	return $this->desc;
 }
 public function setdesc($desc ){
	$this->desc=$desc;
 }
 }