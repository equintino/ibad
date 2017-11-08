<?php 
 class modelMapper{
  public static function map(Model $model, array $properties){
	if (array_key_exists('id', $properties)){
	  $model->setid($properties['id']);
	}
	if (array_key_exists('nome', $properties)){
	  $model->setnome($properties['nome']);
	}
	if (array_key_exists('email', $properties)){
	  $model->setemail($properties['email']);
	}
	if (array_key_exists('tel', $properties)){
	  $model->settel($properties['tel']);
	}
	if (array_key_exists('endereco', $properties)){
	  $model->setendereco($properties['endereco']);
	}
	if (array_key_exists('dt_batismo', $properties)){
	  $model->setdt_batismo($properties['dt_batismo']);
	}
	if (array_key_exists('dt_nascimento', $properties)){
	  $model->setdt_nascimento($properties['dt_nascimento']);
	}
	if (array_key_exists('criado', $properties)){
	  $model->setcriado($properties['criado']);
	}
	if (array_key_exists('modificado', $properties)){
	  $model->setmodificado($properties['modificado']);
	}
	if (array_key_exists('excluido', $properties)){
	  $model->setexcluido($properties['excluido']);
	}
	if (array_key_exists('dt_ingresso', $properties)){
	  $model->setdt_ingresso($properties['dt_ingresso']);
	}
	if (array_key_exists('dt_casamento', $properties)){
	  $model->setdt_casamento($properties['dt_casamento']);
	}
	if (array_key_exists('conjuge', $properties)){
	  $model->setconjuge($properties['conjuge']);
	}
	if (array_key_exists('igbatismo', $properties)){
	  $model->setigbatismo($properties['igbatismo']);
	}
	if (array_key_exists('estcivil', $properties)){
	  $model->setestcivil($properties['estcivil']);
	}
	if (array_key_exists('tit', $properties)){
	  $model->settit($properties['tit']);
	}
	if (array_key_exists('escolaridade', $properties)){
	  $model->setescolaridade($properties['escolaridade']);
	}
	if (array_key_exists('rg', $properties)){
	  $model->setrg($properties['rg']);
	}
	if (array_key_exists('pai', $properties)){
	  $model->setpai($properties['pai']);
	}
	if (array_key_exists('bairro', $properties)){
	  $model->setbairro($properties['bairro']);
	}
	if (array_key_exists('cel', $properties)){
	  $model->setcel($properties['cel']);
	}
	if (array_key_exists('sexo', $properties)){
	  $model->setsexo($properties['sexo']);
	}
	if (array_key_exists('mae', $properties)){
	  $model->setmae($properties['mae']);
	}
	if (array_key_exists('cep', $properties)){
	  $model->setcep($properties['cep']);
	}
	if (array_key_exists('estado', $properties)){
	  $model->setestado($properties['estado']);
	}
	if (array_key_exists('prof', $properties)){
	  $model->setprof($properties['prof']);
	}
	if (array_key_exists('cidade', $properties)){
	  $model->setcidade($properties['cidade']);
	}
	if (array_key_exists('cpf', $properties)){
	  $model->setcpf($properties['cpf']);
	}
	if (array_key_exists('igorigem', $properties)){
	  $model->setigorigem($properties['igorigem']);
	}
	if (array_key_exists('tipo', $properties)){
	  $model->settipo($properties['tipo']);
	}
	if (array_key_exists('numero', $properties)){
	  $model->setnumero($properties['numero']);
	}
	if (array_key_exists('complemento', $properties)){
	  $model->setcomplemento($properties['complemento']);
	}
	if (array_key_exists('ano', $properties)){
	  $model->setano($properties['ano']);
	}
	if (array_key_exists('mes', $properties)){
	  $model->setmes($properties['mes']);
	}
	if (array_key_exists('saldo', $properties)){
	  $model->setsaldo($properties['saldo']);
	}
	if (array_key_exists('dt', $properties)){
	  $model->setdt($properties['dt']);
	}
	if (array_key_exists('descricao', $properties)){
	  $model->setdescricao($properties['descricao']);
	}
	if (array_key_exists('entrada', $properties)){
	  $model->setentrada($properties['entrada']);
	}
	if (array_key_exists('saida', $properties)){
	  $model->setsaida($properties['saida']);
	}
	if (array_key_exists('diz_ofe', $properties)){
	  $model->setdiz_ofe($properties['diz_ofe']);
	}
	if (array_key_exists('tabela', $properties)){
	  $model->settabela($properties['tabela']);
	}
	if (array_key_exists('order', $properties)){
	  $model->setorder($properties['order']);
	}
	if (array_key_exists('naturalde', $properties)){
	  $model->setnaturalde($properties['naturalde']);
	}
	if (array_key_exists('foto', $properties)){
	  $model->setfoto($properties['foto']);
	}
	if (array_key_exists('desc', $properties)){
	  $model->setdesc($properties['desc']);
	}
  } 
 }