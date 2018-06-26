<?php
/**
 * @service PedidoVendaProdutoJsonClient
 * @author omie
 */
class PedidoVendaProdutoJsonClient {
	/**
	 * The WSDL URI
	 *
	 * @var string
	 */
	public static $_WsdlUri='http://app.omie.com.br/api/v1/produtos/pedido/?WSDL';
	/**
	 * The PHP SoapClient object
	 *
	 * @var object
	 */
	public static $_Server=null;
	/**
	 * The endpoint URI
	 *
	 * @var string
	 */
	public static $_EndPoint='http://app.omie.com.br/api/v1/produtos/pedido/';

	/**
	 * Send a SOAP request to the server
	 *
	 * @param string $method The method name
	 * @param array $param The parameters
	 * @return mixed The server response
	 */
        
	public static function _Call($method,$param){
		$call=Array(
			"call"=>$method,
			"param"=>$param,
			"app_key"=>OMIE_APP_KEY,
			"app_secret"=>OMIE_APP_SECRET
		);
		return json_decode(file_get_contents(self::$_EndPoint."?JSON=".urlencode(json_encode($call))));
	}

	/**
	 * Inclui um pedido de venda de produto
	 *
	 * @param pedido_venda_produto $pedido_venda_produto Estrutura do Pedido de Vendas de Produtos.<BR>Preenchimento Obrigatório.
	 * @return pedido_venda_produto_response Resposta da Inclusão de Pedido de Venda de Produtos.&nbsp;
	 */
	public function IncluirPedido($pedido_venda_produto){
		return self::_Call('IncluirPedido',Array(
			$pedido_venda_produto
		));
	}

	/**
	 * Alteração do Pedido de Venda
	 *
	 * @param pedido_venda_produto $pedido_venda_produto Estrutura do Pedido de Vendas de Produtos.<BR>Preenchimento Obrigatório.
	 * @return pedido_venda_produto_response Resposta da Inclusão de Pedido de Venda de Produtos.&nbsp;
	 */
	public function AlterarPedidoVenda($pedido_venda_produto){
		return self::_Call('AlterarPedidoVenda',Array(
			$pedido_venda_produto
		));
	}

	/**
	 * Consulta de Pedido de Venda de Produto
	 *
	 * @param pvpConsultarRequest $pvpConsultarRequest Solicitação de consulta de pedido de venda.
	 * @return pvpConsultarResponse Resposta da solicitação de consulta de pedido de venda.
	 */
	public function ConsultarPedido($pvpConsultarRequest){
		return self::_Call('ConsultarPedido',Array(
			$pvpConsultarRequest
		));
	}

	/**
	 * Listar os pedidos de venda de produto
	 *
	 * @param pvpListarRequest $pvpListarRequest Solicitação de listagem de pedidos de venda.
	 * @return pvpListarResponse Resposta da solicitação de listagem de pedidos de venda.
	 */
	public function ListarPedidos($pvpListarRequest){
		return self::_Call('ListarPedidos',Array(
			$pvpListarRequest
		));
	}

	/**
	 * Consulta do Status do Pedido
	 *
	 * @param pvpStatusRequest $pvpStatusRequest Solicitação de consulta do Status do Pedido de Venda.
	 * @return pvpStatusResponse Resposta da solicitação de consulta do Status do Pedido de Venda.
	 */
	public function StatusPedido($pvpStatusRequest){
		return self::_Call('StatusPedido',Array(
			$pvpStatusRequest
		));
	}

	/**
	 * Troca etapa do pedido.
	 *
	 * @param pvpTrocarEtapaRequest $pvpTrocarEtapaRequest Solicitação de troca de etapa do Pedido de Venda.
	 * @return pvpTrocarEtapaResponse Resposta da solicitação de troca de etapa do Pedido de Venda.
	 */
	public function TrocarEtapaPedido($pvpTrocarEtapaRequest){
		return self::_Call('TrocarEtapaPedido',Array(
			$pvpTrocarEtapaRequest
		));
	}
}

/**
 * Informações do cabeçalho do pedido.
 *
 * @pw_element integer $codigo_pedido ID do pedido do venda.<BR>Preenchimento automático na inclusão - Informe esse campo somente para pesquisa.<BR><BR>Esse campo não é exibido na tela do Pedido de Vendas. <BR>É uma informação interna, utilizada apenas nas APIs.
 * @pw_element string $codigo_pedido_integracao Código de integração do pedido de venda.<BR>Preenchimento Obrigatório na inclusão/alteração.<BR>Preenchimento Opcional na Consulta/Pesquisa.<BR><BR>Preencha esse campo com o código do pedido no aplicativo que você está integração com o Omie. A função dele é servir como uma mapa de relacionamento entre as aplicações. Ao realizar uma consulta/listagem de pedidos você conseguirá ver a relação entre o id do pedido gerado no Omie e o código de pedido existente em sua aplicação.<BR>
 * @pw_element string $numero_pedido Número do pedido de venda.<BR>Preenchimento automático na inclusão/alteração.<BR>Preenchimento disponível apenas na consulta/pesquisa.<BR><BR>Esse é o número do pedido de venda no Omie, que é gerado automaticamente e exibido na tela.<BR>
 * @pw_element integer $codigo_cliente Código do cliente.<BR>Preenchimento Obrigatório.<BR><BR>Utilize a tag 'codigo_cliente_omie' do método 'ListarClientes' da API<BR>http://app.omie.com.br/api/v1/geral/clientes/<BR>para obter essa informação.<BR>
 * @pw_element string $codigo_cliente_integracao Código Integração da Transportadora.<BR>Preenchimento Opcional.<BR><BR>Esse campo deve ser informado apenas se você incluiu o cliente (transportadora) via API e informou um código de integração para o cliente. Do contrário, informe sempre a tag 'codigo_cliente'.<BR>
 * @pw_element string $data_previsao Data de Previsão de Faturamento.<BR>Preenchimento Obrigatório.<BR><BR>Utilize o formato 'dd/mm/aaaa'.<BR><BR>Esse campo indica a data da previsão do faturamento do pedido e deve ser informado com uma data igual ou superior a data corrente.<BR>
 * @pw_element integer $quantidade_itens Quantidade de Itens.<BR>Preenchimento automático - Não informar.
 * @pw_element string $etapa Etapa do pedido de venda.<BR>Preenchimento Obrigatório.<BR><BR>Esse campo indica em que coluna o pedido de venda irá figurar no processo de faturamento do Omie.<BR><BR>Utilize a tag 'codigo' do método 'ListarEtapasFaturamento' da API<BR>http://app.omie.com.br/api/v1/produtos/etapafat/<BR>para obter essa informação.<BR><BR>Os valores são fixos, mas as descrições (funções atribuídas a cada coluna pode mudar. A API irá indicar a descrição de cada coluna.<BR><BR>Os valores disponíveis para esse campo podem ser:<BR><BR>'10' - Primeira coluna<BR>'20' - Segunda coluna<BR>'30' - Terceira coluna<BR>'40' - Quarta coluna<BR>'50' - Faturar
 * @pw_element string $codigo_parcela Código da parcela/Condição de pagamento.<BR>Preenchimento Obrigatório.<BR><BR>Utilize a tag 'nCodigo' do método 'ListarFormasPagVendas' da API<BR>http://app.omie.com.br/api/v1/produtos/formaspagvendas/<BR>para obter essa informação.<BR><BR>O código '999' é o único que permite uma definição de forma de pagamento customizada. Caso você escolha essa opção, deve também informar a tag 'qtde_parcelas' e a estrutura 'lista_parcelas'.<BR><BR>Alguns dos valores disponíveis são:<BR><BR>'000' - A Vista                                                     <BR>'A03' - Para 3 dias                                                 <BR>'A05' - Para 5 dias                                                 <BR>'A07' - Para 7 dias                                                 <BR>'A08' - Para 8 dias                                                 <BR>'A09' - Para 9 dias                                                 <BR>'A10' - Para 10 dias                                                <BR>'A13' - Para 13 dias                                                <BR>'A14' - Para 14 dias                                                <BR>'A15' - Para 15 dias                                                <BR>'A17' - Para 17 dias                                                <BR>'A20' - Para 20 dias                                                <BR>'A21' - Para 21 dias                                                <BR>'A25' - Para 25 dias                                                <BR>'A26' - Para 26 dias                                                <BR>'A28' - Para 28 dias                                                <BR>'A35' - Para 35 dias                                                <BR>'A36' - Para 36 dias                                                <BR>'A40' - Para 40 dias                                                <BR>'A42' - Para 42 dias                                                <BR>'A45' - Para 45 dias                                                <BR>'A50' - Para 50 dias                                                <BR>'A56' - Para 56 dias                                                <BR>'A60' - Para 60 dias                                                <BR>'A70' - Para 70 dias                                                <BR>'A75' - Para 75 dias                                                <BR>'A90' - Para 90 dias                                                <BR>'A98' - Para 98 dias                                                <BR>'B20' - Para 120 dias                                               <BR>'001' - 1 Parcela (para 30 dias)                                    <BR>'002' - 2 Parcelas                                                  <BR>'003' - 3 Parcelas                                                  <BR>'004' - 4 Parcelas                                                  <BR>'005' - 5 Parcelas                                                  <BR>'006' - 6 Parcelas                                                  <BR>'007' - 7 Parcelas                                                  <BR>'010' - 10 Parcelas                                                 <BR>'012' - 12 Parcelas                                                 <BR>'024' - 24 Parcelas                                                 <BR>'036' - 36 Parcelas                                                 <BR>'048' - 48 Parcelas                                                 <BR>'S01' - 30/60                                                       <BR>'S02' - 45/60                                                       <BR>'S03' - 21/28/35                                                    <BR>'S04' - 21/28/35/42                                                 <BR>'S05' - 28/35/42                                                    <BR>'S06' - 28/35/42/49                                                 <BR>'S07' - 30/45/60/75/90                                              <BR>'S08' - 25/56                                                       <BR>'S09' - 30/45                                                       <BR>'S10' - 28/56                                                       <BR>'S11' - 10/30/60                                                    <BR>'S12' - 15/30/60                                                    <BR>'S13' - 28/35                                                       <BR>'S14' - 7/14/21                                                     <BR>'S15' - 10/30/60/90                                                 <BR>'S16' - 60/90/120                                                   <BR>'S17' - 45/60/90                                                    <BR>'S18' - 30/60/90                                                    <BR>'S19' - 14/21                                                       <BR>'S20' - 7/14                                                        <BR>'S21' - 14/21/28                                                    <BR>'S22' - 45/75                                                       <BR>'S23' - 30/45/60                                                    <BR>'S24' - 3/20/40                                                     <BR>'S25' - 30/60/90/120                                                <BR>'S26' - 21/28                                                       <BR>'S27' - a Vista/15                                                  <BR>'S28' - a Vista/30                                                  <BR>'S29' - a Vista/30/60                                               <BR>'S30' - a Vista/30/60/90                                            <BR>'S31' - a Vista/30/60/90/120/150                                    <BR>'S41' - 28/42/56                                                    <BR>'S32' - 15/45/75                                                    <BR>'S33' - 14/28/42                                                    <BR>'S34' - 14/21/28/35/42                                              <BR>'S35' - 30/42/54/66/78/90                                           <BR>'S36' - 14/21/28/35                                                 <BR>'S37' - 28/42                                                       <BR>'S38' - 30/45/60                                                    <BR>'S39' - 35/42/49/56                                                 <BR>'S40' - 28/42/56/70                                                 <BR>'S42' - 30/40/50/60                                                 <BR>'S43' - 30/50/70/90                                                 <BR>'S44' - 14/28                                                       <BR>'S45' - 45/60/75/90                                                 <BR>'S46' - a Vista/30/60/90/120                                        <BR>'S47' - a vista/20/40/60                                            <BR>'S48' - 21/42                                                       <BR>'S49' - 15/30/45                                                    <BR>'S50' - 14/42                                                       <BR>'S51' - 21/35                                                       <BR>'S52' - 28/56/84                                                    <BR>'S53' - 28/42/56/70/84                                              <BR>'S54' - a Vista/30/45                                               <BR>'S55' - 21/45                                                       <BR>'S56' - a Vista/28                                                  <BR>'S57' - a Vista/60/90                                               <BR>'S58' - 35/45/55                                                    <BR>'S59' - 28/35/42/56                                                 <BR>'S60' - 30/45/60/75                                                 <BR>'S61' - 28/35/42/49/56                                              <BR>'S62' - 40/70/100                                                   <BR>'S63' - 42/56                                                       <BR>'S64' - a Vista/28/35                                               <BR>'S65' - 35/42                                                       <BR>'S66' - 20/40                                                       <BR>'S67' - a Vista/28/35/42                                            <BR>'S68' - a vista/20/40/60/80                                         <BR>'S69' - a vista/20/40/60/80/100                                     <BR>'S70' - a vista/20/40/60/80/100/120                                 <BR>'S71' - a vista/30/60/90/120/150/180/210/240/270/300/330/360        <BR>'S72' - a vista/30/60/90/120/150/180/210/240/270/300                <BR>'S73' - 28/56/84/112                                                <BR>'S74' - 14/28/42/56                                                 <BR>'S75' - 28/42/56/70/84/98                                           <BR>'S76' - 15/30/45/60/75                                              <BR>'S77' - a Vista/15/30                                               <BR>'S78' - a Vista/20/40                                               <BR>'S79' - 35/42/56                                                    <BR>'S80' - 10/30/60/90/120                                             <BR>'S81' - 15/30/45/75/90/105/120                                      <BR>'S82' - 30/45/75/90/105/120                                         <BR>'S83' - 42/49/56                                                    <BR>'S84' - 35/42/49                                                    <BR>'S85' - a Vista/60/90/120/150                                       <BR>'S86' - a Vista/30/45/60                                            <BR>'S87' - 20/40/60/80/100                                             <BR>'S89' - 15/30                                                       <BR>'S90' - 10/30/50                                                    <BR>'S91' - 45/52/60                                                    <BR>'S92' - 10/30                                                       <BR>'S93' - 20/30/40/50/60/70                                           <BR>'S94' - 45/52/59/66                                                 <BR>'S95' - 15/30/45/60                                                 <BR>'S96' - 40/50                                                       <BR>'S97' - 21/42/56                                                    <BR>'S98' - a vista/60/90/120/150/180/240/300/330                       <BR>'S99' - a vista/180                                                 <BR>'T01' - 30/40/50                                                    <BR>'T02' - 21/28/35/42/49                                              <BR>'T03' - 30/37/45/60                                                 <BR>'T04' - a vista/30/60/90/120/150/180/210/240/270                    <BR>'T05' - a vista/30/60/90/120/150/180/210                            <BR>'T06' - 30/60/90/120/150/180/210/240                                <BR>'T07' - 56/84/112                                                   <BR>'T08' - 15/30/45/60/75/90/105                                       <BR>'T09' - 21/35/42                                                    <BR>'T10' - 35/49                                                       <BR>'T11' - 30/45/60/75/90/105/120                                      <BR>'T12' - 45/75/105/135                                               <BR>'T13' - 35/60/75                                                    <BR>'T14' - 10/40/70/100/130                                            <BR>'T15' - 45/60/75                                                    <BR>'T16' - 40/55/70                                                    <BR>'T17' - 40/70                                                       <BR>'T18' - 20/40/60                                                    <BR>'T19' - 60/90                                                       <BR>'T20' - 25/35/45/55                                                 <BR>'T21' - 15/45                                                       <BR>'T22' - 7/30/45                                                     <BR>'T23' - 7/30/60                                                     <BR>'T24' - 64/71                                                       <BR>'T25' - 20/30/40                                                    <BR>'999' - Informar o número de parcelas
 * @pw_element integer $qtde_parcelas Quantidade de parcelas.<BR>Preenchimento Obrigatório quando o conteúdo da tag 'codigo_parcela' for '999'.<BR><BR>Valores permitidos de 1 a 999.
 * @pw_element string $bloqueado Pedido Bloqueado pela API.<BR>Preenchimento automático - Não informar.
 * @pw_element string $importado_api Pedido de venda de produto importada pela API.<BR>Preenchimento automático - Não informar.
 * @pw_element integer $codigo_empresa DEPRECATED
 * @pw_element string $codigo_empresa_integracao DEPRECATED
 * @pw_complex cabecalho
 */
class cabecalho{
	/**
	 * ID do pedido do venda.<BR>Preenchimento automático na inclusão - Informe esse campo somente para pesquisa.<BR><BR>Esse campo não é exibido na tela do Pedido de Vendas. <BR>É uma informação interna, utilizada apenas nas APIs.
	 *
	 * @var integer
	 */
	public $codigo_pedido;
	/**
	 * Código de integração do pedido de venda.<BR>Preenchimento Obrigatório na inclusão/alteração.<BR>Preenchimento Opcional na Consulta/Pesquisa.<BR><BR>Preencha esse campo com o código do pedido no aplicativo que você está integração com o Omie. A função dele é servir como uma mapa de relacionamento entre as aplicações. Ao realizar uma consulta/listagem de pedidos você conseguirá ver a relação entre o id do pedido gerado no Omie e o código de pedido existente em sua aplicação.<BR>
	 *
	 * @var string
	 */
	public $codigo_pedido_integracao;
	/**
	 * Número do pedido de venda.<BR>Preenchimento automático na inclusão/alteração.<BR>Preenchimento disponível apenas na consulta/pesquisa.<BR><BR>Esse é o número do pedido de venda no Omie, que é gerado automaticamente e exibido na tela.<BR>
	 *
	 * @var string
	 */
	public $numero_pedido;
	/**
	 * Código do cliente.<BR>Preenchimento Obrigatório.<BR><BR>Utilize a tag 'codigo_cliente_omie' do método 'ListarClientes' da API<BR>http://app.omie.com.br/api/v1/geral/clientes/<BR>para obter essa informação.<BR>
	 *
	 * @var integer
	 */
	public $codigo_cliente;
	/**
	 * Código Integração da Transportadora.<BR>Preenchimento Opcional.<BR><BR>Esse campo deve ser informado apenas se você incluiu o cliente (transportadora) via API e informou um código de integração para o cliente. Do contrário, informe sempre a tag 'codigo_cliente'.<BR>
	 *
	 * @var string
	 */
	public $codigo_cliente_integracao;
	/**
	 * Data de Previsão de Faturamento.<BR>Preenchimento Obrigatório.<BR><BR>Utilize o formato 'dd/mm/aaaa'.<BR><BR>Esse campo indica a data da previsão do faturamento do pedido e deve ser informado com uma data igual ou superior a data corrente.<BR>
	 *
	 * @var string
	 */
	public $data_previsao;
	/**
	 * Quantidade de Itens.<BR>Preenchimento automático - Não informar.
	 *
	 * @var integer
	 */
	public $quantidade_itens;
	/**
	 * Etapa do pedido de venda.<BR>Preenchimento Obrigatório.<BR><BR>Esse campo indica em que coluna o pedido de venda irá figurar no processo de faturamento do Omie.<BR><BR>Utilize a tag 'codigo' do método 'ListarEtapasFaturamento' da API<BR>http://app.omie.com.br/api/v1/produtos/etapafat/<BR>para obter essa informação.<BR><BR>Os valores são fixos, mas as descrições (funções atribuídas a cada coluna pode mudar. A API irá indicar a descrição de cada coluna.<BR><BR>Os valores disponíveis para esse campo podem ser:<BR><BR>'10' - Primeira coluna<BR>'20' - Segunda coluna<BR>'30' - Terceira coluna<BR>'40' - Quarta coluna<BR>'50' - Faturar
	 *
	 * @var string
	 */
	public $etapa;
	/**
	 * Código da parcela/Condição de pagamento.<BR>Preenchimento Obrigatório.<BR><BR>Utilize a tag 'nCodigo' do método 'ListarFormasPagVendas' da API<BR>http://app.omie.com.br/api/v1/produtos/formaspagvendas/<BR>para obter essa informação.<BR><BR>O código '999' é o único que permite uma definição de forma de pagamento customizada. Caso você escolha essa opção, deve também informar a tag 'qtde_parcelas' e a estrutura 'lista_parcelas'.<BR><BR>Alguns dos valores disponíveis são:<BR><BR>'000' - A Vista                                                     <BR>'A03' - Para 3 dias                                                 <BR>'A05' - Para 5 dias                                                 <BR>'A07' - Para 7 dias                                                 <BR>'A08' - Para 8 dias                                                 <BR>'A09' - Para 9 dias                                                 <BR>'A10' - Para 10 dias                                                <BR>'A13' - Para 13 dias                                                <BR>'A14' - Para 14 dias                                                <BR>'A15' - Para 15 dias                                                <BR>'A17' - Para 17 dias                                                <BR>'A20' - Para 20 dias                                                <BR>'A21' - Para 21 dias                                                <BR>'A25' - Para 25 dias                                                <BR>'A26' - Para 26 dias                                                <BR>'A28' - Para 28 dias                                                <BR>'A35' - Para 35 dias                                                <BR>'A36' - Para 36 dias                                                <BR>'A40' - Para 40 dias                                                <BR>'A42' - Para 42 dias                                                <BR>'A45' - Para 45 dias                                                <BR>'A50' - Para 50 dias                                                <BR>'A56' - Para 56 dias                                                <BR>'A60' - Para 60 dias                                                <BR>'A70' - Para 70 dias                                                <BR>'A75' - Para 75 dias                                                <BR>'A90' - Para 90 dias                                                <BR>'A98' - Para 98 dias                                                <BR>'B20' - Para 120 dias                                               <BR>'001' - 1 Parcela (para 30 dias)                                    <BR>'002' - 2 Parcelas                                                  <BR>'003' - 3 Parcelas                                                  <BR>'004' - 4 Parcelas                                                  <BR>'005' - 5 Parcelas                                                  <BR>'006' - 6 Parcelas                                                  <BR>'007' - 7 Parcelas                                                  <BR>'010' - 10 Parcelas                                                 <BR>'012' - 12 Parcelas                                                 <BR>'024' - 24 Parcelas                                                 <BR>'036' - 36 Parcelas                                                 <BR>'048' - 48 Parcelas                                                 <BR>'S01' - 30/60                                                       <BR>'S02' - 45/60                                                       <BR>'S03' - 21/28/35                                                    <BR>'S04' - 21/28/35/42                                                 <BR>'S05' - 28/35/42                                                    <BR>'S06' - 28/35/42/49                                                 <BR>'S07' - 30/45/60/75/90                                              <BR>'S08' - 25/56                                                       <BR>'S09' - 30/45                                                       <BR>'S10' - 28/56                                                       <BR>'S11' - 10/30/60                                                    <BR>'S12' - 15/30/60                                                    <BR>'S13' - 28/35                                                       <BR>'S14' - 7/14/21                                                     <BR>'S15' - 10/30/60/90                                                 <BR>'S16' - 60/90/120                                                   <BR>'S17' - 45/60/90                                                    <BR>'S18' - 30/60/90                                                    <BR>'S19' - 14/21                                                       <BR>'S20' - 7/14                                                        <BR>'S21' - 14/21/28                                                    <BR>'S22' - 45/75                                                       <BR>'S23' - 30/45/60                                                    <BR>'S24' - 3/20/40                                                     <BR>'S25' - 30/60/90/120                                                <BR>'S26' - 21/28                                                       <BR>'S27' - a Vista/15                                                  <BR>'S28' - a Vista/30                                                  <BR>'S29' - a Vista/30/60                                               <BR>'S30' - a Vista/30/60/90                                            <BR>'S31' - a Vista/30/60/90/120/150                                    <BR>'S41' - 28/42/56                                                    <BR>'S32' - 15/45/75                                                    <BR>'S33' - 14/28/42                                                    <BR>'S34' - 14/21/28/35/42                                              <BR>'S35' - 30/42/54/66/78/90                                           <BR>'S36' - 14/21/28/35                                                 <BR>'S37' - 28/42                                                       <BR>'S38' - 30/45/60                                                    <BR>'S39' - 35/42/49/56                                                 <BR>'S40' - 28/42/56/70                                                 <BR>'S42' - 30/40/50/60                                                 <BR>'S43' - 30/50/70/90                                                 <BR>'S44' - 14/28                                                       <BR>'S45' - 45/60/75/90                                                 <BR>'S46' - a Vista/30/60/90/120                                        <BR>'S47' - a vista/20/40/60                                            <BR>'S48' - 21/42                                                       <BR>'S49' - 15/30/45                                                    <BR>'S50' - 14/42                                                       <BR>'S51' - 21/35                                                       <BR>'S52' - 28/56/84                                                    <BR>'S53' - 28/42/56/70/84                                              <BR>'S54' - a Vista/30/45                                               <BR>'S55' - 21/45                                                       <BR>'S56' - a Vista/28                                                  <BR>'S57' - a Vista/60/90                                               <BR>'S58' - 35/45/55                                                    <BR>'S59' - 28/35/42/56                                                 <BR>'S60' - 30/45/60/75                                                 <BR>'S61' - 28/35/42/49/56                                              <BR>'S62' - 40/70/100                                                   <BR>'S63' - 42/56                                                       <BR>'S64' - a Vista/28/35                                               <BR>'S65' - 35/42                                                       <BR>'S66' - 20/40                                                       <BR>'S67' - a Vista/28/35/42                                            <BR>'S68' - a vista/20/40/60/80                                         <BR>'S69' - a vista/20/40/60/80/100                                     <BR>'S70' - a vista/20/40/60/80/100/120                                 <BR>'S71' - a vista/30/60/90/120/150/180/210/240/270/300/330/360        <BR>'S72' - a vista/30/60/90/120/150/180/210/240/270/300                <BR>'S73' - 28/56/84/112                                                <BR>'S74' - 14/28/42/56                                                 <BR>'S75' - 28/42/56/70/84/98                                           <BR>'S76' - 15/30/45/60/75                                              <BR>'S77' - a Vista/15/30                                               <BR>'S78' - a Vista/20/40                                               <BR>'S79' - 35/42/56                                                    <BR>'S80' - 10/30/60/90/120                                             <BR>'S81' - 15/30/45/75/90/105/120                                      <BR>'S82' - 30/45/75/90/105/120                                         <BR>'S83' - 42/49/56                                                    <BR>'S84' - 35/42/49                                                    <BR>'S85' - a Vista/60/90/120/150                                       <BR>'S86' - a Vista/30/45/60                                            <BR>'S87' - 20/40/60/80/100                                             <BR>'S89' - 15/30                                                       <BR>'S90' - 10/30/50                                                    <BR>'S91' - 45/52/60                                                    <BR>'S92' - 10/30                                                       <BR>'S93' - 20/30/40/50/60/70                                           <BR>'S94' - 45/52/59/66                                                 <BR>'S95' - 15/30/45/60                                                 <BR>'S96' - 40/50                                                       <BR>'S97' - 21/42/56                                                    <BR>'S98' - a vista/60/90/120/150/180/240/300/330                       <BR>'S99' - a vista/180                                                 <BR>'T01' - 30/40/50                                                    <BR>'T02' - 21/28/35/42/49                                              <BR>'T03' - 30/37/45/60                                                 <BR>'T04' - a vista/30/60/90/120/150/180/210/240/270                    <BR>'T05' - a vista/30/60/90/120/150/180/210                            <BR>'T06' - 30/60/90/120/150/180/210/240                                <BR>'T07' - 56/84/112                                                   <BR>'T08' - 15/30/45/60/75/90/105                                       <BR>'T09' - 21/35/42                                                    <BR>'T10' - 35/49                                                       <BR>'T11' - 30/45/60/75/90/105/120                                      <BR>'T12' - 45/75/105/135                                               <BR>'T13' - 35/60/75                                                    <BR>'T14' - 10/40/70/100/130                                            <BR>'T15' - 45/60/75                                                    <BR>'T16' - 40/55/70                                                    <BR>'T17' - 40/70                                                       <BR>'T18' - 20/40/60                                                    <BR>'T19' - 60/90                                                       <BR>'T20' - 25/35/45/55                                                 <BR>'T21' - 15/45                                                       <BR>'T22' - 7/30/45                                                     <BR>'T23' - 7/30/60                                                     <BR>'T24' - 64/71                                                       <BR>'T25' - 20/30/40                                                    <BR>'999' - Informar o número de parcelas
	 *
	 * @var string
	 */
	public $codigo_parcela;
	/**
	 * Quantidade de parcelas.<BR>Preenchimento Obrigatório quando o conteúdo da tag 'codigo_parcela' for '999'.<BR><BR>Valores permitidos de 1 a 999.
	 *
	 * @var integer
	 */
	public $qtde_parcelas;
	/**
	 * Pedido Bloqueado pela API.<BR>Preenchimento automático - Não informar.
	 *
	 * @var string
	 */
	public $bloqueado;
	/**
	 * Pedido de venda de produto importada pela API.<BR>Preenchimento automático - Não informar.
	 *
	 * @var string
	 */
	public $importado_api;
	/**
	 * DEPRECATED
	 *
	 * @var integer
	 */
	public $codigo_empresa;
	/**
	 * DEPRECATED
	 *
	 * @var string
	 */
	public $codigo_empresa_integracao;
}

/**
 * COFINS.
 *
 * @pw_element string $cod_sit_trib_cofins Código da Situação Tributária do COFINS
 * @pw_element string $tipo_calculo_cofins Tipo de cálculo para obtenção do valor do PIS
 * @pw_element decimal $base_cofins Base de Cálculo do COFINS
 * @pw_element decimal $aliq_cofins Alíquota do COFINS
 * @pw_element decimal $qtde_unid_trib_cofins Quantidade de Unidades Tributáveis do COFINS
 * @pw_element decimal $valor_unid_trib_cofins Valor do COFINS por Unidade Tributável
 * @pw_element decimal $valor_cofins Valor do COFINS
 * @pw_complex cofins_padrao
 */
class cofins_padrao{
	/**
	 * Código da Situação Tributária do COFINS
	 *
	 * @var string
	 */
	public $cod_sit_trib_cofins;
	/**
	 * Tipo de cálculo para obtenção do valor do PIS
	 *
	 * @var string
	 */
	public $tipo_calculo_cofins;
	/**
	 * Base de Cálculo do COFINS
	 *
	 * @var decimal
	 */
	public $base_cofins;
	/**
	 * Alíquota do COFINS
	 *
	 * @var decimal
	 */
	public $aliq_cofins;
	/**
	 * Quantidade de Unidades Tributáveis do COFINS
	 *
	 * @var decimal
	 */
	public $qtde_unid_trib_cofins;
	/**
	 * Valor do COFINS por Unidade Tributável
	 *
	 * @var decimal
	 */
	public $valor_unid_trib_cofins;
	/**
	 * Valor do COFINS
	 *
	 * @var decimal
	 */
	public $valor_cofins;
}

/**
 * COFINS - Substituição Tributária.
 *
 * @pw_element string $cod_sit_trib_cofins_st Código da Situação Tributária do COFINS
 * @pw_element string $tipo_calculo_cofins_st Tipo de cálculo para obtenção do valor do PIS Substituição Tributária
 * @pw_element decimal $base_cofins_st Base de Cálculo do COFINS Substituição Tributária
 * @pw_element decimal $aliq_cofins_st Alíquota do COFINS Substituição Tributária
 * @pw_element decimal $qtde_unid_trib_cofins_st Quantidade de Unidades Tributáveis do PIS Substituição Tributária
 * @pw_element decimal $valor_unid_trib_cofins_st Valor do PIS Substituição Tributária por Unidade Tributável
 * @pw_element decimal $margem_cofins_st Margem de valor adicional para obter a base de cálculo do COFINS Substituição Tributária
 * @pw_element decimal $valor_cofins_st Valor do PIS Substituição Tributária
 * @pw_complex cofins_st
 */
class cofins_st{
	/**
	 * Código da Situação Tributária do COFINS
	 *
	 * @var string
	 */
	public $cod_sit_trib_cofins_st;
	/**
	 * Tipo de cálculo para obtenção do valor do PIS Substituição Tributária
	 *
	 * @var string
	 */
	public $tipo_calculo_cofins_st;
	/**
	 * Base de Cálculo do COFINS Substituição Tributária
	 *
	 * @var decimal
	 */
	public $base_cofins_st;
	/**
	 * Alíquota do COFINS Substituição Tributária
	 *
	 * @var decimal
	 */
	public $aliq_cofins_st;
	/**
	 * Quantidade de Unidades Tributáveis do PIS Substituição Tributária
	 *
	 * @var decimal
	 */
	public $qtde_unid_trib_cofins_st;
	/**
	 * Valor do PIS Substituição Tributária por Unidade Tributável
	 *
	 * @var decimal
	 */
	public $valor_unid_trib_cofins_st;
	/**
	 * Margem de valor adicional para obter a base de cálculo do COFINS Substituição Tributária
	 *
	 * @var decimal
	 */
	public $margem_cofins_st;
	/**
	 * Valor do PIS Substituição Tributária
	 *
	 * @var decimal
	 */
	public $valor_cofins_st;
}

/**
 * CSLL.
 *
 * @pw_element decimal $aliq_csll Alíquota do CSLL
 * @pw_element decimal $valor_csll Valor do CSLL
 * @pw_complex csll
 */
class csll{
	/**
	 * Alíquota do CSLL
	 *
	 * @var decimal
	 */
	public $aliq_csll;
	/**
	 * Valor do CSLL
	 *
	 * @var decimal
	 */
	public $valor_csll;
}

/**
 * Dados da Aba "Departamentos" do Pedido de Venda.
 *
 * @pw_element string $cCodDepto ID do Departamento.<BR>Preenchimento Obrigatório.<BR><BR>Informação localizada na Aba "Departamentos" do Pedido de Venda.<BR><BR>Utilize a tag 'codigo' do método 'ListarDepatartamentos' da API<BR>http://app.omie.com.br/api/v1/geral/departamentos/<BR>para obter essa informação.
 * @pw_element decimal $nPerc Percentual de Rateio.<BR>Preenchimento Obrigatório.<BR><BR>Informação localizada na Aba "Departamentos" do Pedido de Venda.<BR>
 * @pw_element decimal $nValor Valor do Rateio.<BR>Preenchimento Obrigatório.<BR><BR>Informação localizada na Aba "Departamentos" do Pedido de Venda.<BR>
 * @pw_element string $nValorFixo Indica que o valor foi fixado na distribuição do rateio.<BR>Preenchimento Obrigatório.<BR><BR>Informar "S" ou "N".<BR><BR>Informação localizada na Aba "Departamentos" do Pedido de Venda.<BR>
 * @pw_complex departamentos
 */
class departamentos{
	/**
	 * ID do Departamento.<BR>Preenchimento Obrigatório.<BR><BR>Informação localizada na Aba "Departamentos" do Pedido de Venda.<BR><BR>Utilize a tag 'codigo' do método 'ListarDepatartamentos' da API<BR>http://app.omie.com.br/api/v1/geral/departamentos/<BR>para obter essa informação.
	 *
	 * @var string
	 */
	public $cCodDepto;
	/**
	 * Percentual de Rateio.<BR>Preenchimento Obrigatório.<BR><BR>Informação localizada na Aba "Departamentos" do Pedido de Venda.<BR>
	 *
	 * @var decimal
	 */
	public $nPerc;
	/**
	 * Valor do Rateio.<BR>Preenchimento Obrigatório.<BR><BR>Informação localizada na Aba "Departamentos" do Pedido de Venda.<BR>
	 *
	 * @var decimal
	 */
	public $nValor;
	/**
	 * Indica que o valor foi fixado na distribuição do rateio.<BR>Preenchimento Obrigatório.<BR><BR>Informar "S" ou "N".<BR><BR>Informação localizada na Aba "Departamentos" do Pedido de Venda.<BR>
	 *
	 * @var string
	 */
	public $nValorFixo;
}


/**
 * Dados da Aba 'Itens da Venda' do Pedido de Venda.
 *
 * @pw_element ide $ide Identificação do Item do Pedido de Vendas.<BR>Preenchimento Obrigatório.
 * @pw_element produto $produto Identificação do Produto do Item do Pedido de Vendas.<BR>Preenchimento Obrigatório.
 * @pw_element observacao $observacao Dados da aba 'Observações' do Item do Pedido de Vendas.<BR>Preenchimento Opcional.
 * @pw_element inf_adic $inf_adic Dados da aba 'Informações Adicionais' do Item do Pedido de Vendas.<BR>Preenchimento Opcional.
 * @pw_element imposto $imposto Informações referentes aos impostos do Item do Pedido de Vendas.<BR>Preenchimento Opcional.<BR><BR>Essa estrutura deve ser preenchida quando os dados dos impostos devem ser respeitados tais como foram enviados na API.<BR><BR>Caso essa estrutura não seja enviada, o Omie irá identificar a regra de imposto que melhor se ajusta as condições da venda realizada.<BR>Para utilizar essa opção esteja seguro de que as regras e cenários de impostos estejam cadastrados corretamente no Omie. As infomações preenchidas serão decorrentes dos dados configurados.<BR><BR><BR>
 * @pw_complex det
 */
class det{
	/**
	 * Identificação do Item do Pedido de Vendas.<BR>Preenchimento Obrigatório.
	 *
	 * @var ide
	 */
	public $ide;
	/**
	 * Identificação do Produto do Item do Pedido de Vendas.<BR>Preenchimento Obrigatório.
	 *
	 * @var produto
	 */
	public $produto;
	/**
	 * Dados da aba 'Observações' do Item do Pedido de Vendas.<BR>Preenchimento Opcional.
	 *
	 * @var observacao
	 */
	public $observacao;
	/**
	 * Dados da aba 'Informações Adicionais' do Item do Pedido de Vendas.<BR>Preenchimento Opcional.
	 *
	 * @var inf_adic
	 */
	public $inf_adic;
	/**
	 * Informações referentes aos impostos do Item do Pedido de Vendas.<BR>Preenchimento Opcional.<BR><BR>Essa estrutura deve ser preenchida quando os dados dos impostos devem ser respeitados tais como foram enviados na API.<BR><BR>Caso essa estrutura não seja enviada, o Omie irá identificar a regra de imposto que melhor se ajusta as condições da venda realizada.<BR>Para utilizar essa opção esteja seguro de que as regras e cenários de impostos estejam cadastrados corretamente no Omie. As infomações preenchidas serão decorrentes dos dados configurados.<BR><BR><BR>
	 *
	 * @var imposto
	 */
	public $imposto;
}


/**
 * Identificação do Item do Pedido de Vendas.
 *
 * @pw_element string $codigo_item_integracao Código de Integração do Item do Pedido de Venda.<BR>Preenchimento Obrigatório.<BR><BR>Informe a identificação do Item do Pedido de Venda. Caso você não tenha essa informação no seu aplicativo, informe o número sequencial de cada item do pedido.<BR><BR>Informa de 1 a 199.<BR><BR>
 * @pw_element integer $codigo_item ID do Item do Pedido.<BR>Preenchimento automático - Não informar.
 * @pw_element string $simples_nacional Indica que a empresa é Optante pelo Simples Nacional.<BR>Preenchimento Opcional.<BR><BR>Informar "S" ou "N".
 * @pw_element integer $regra_impostos DEPRECATED
 * @pw_complex ide
 */
class ide{
	/**
	 * Código de Integração do Item do Pedido de Venda.<BR>Preenchimento Obrigatório.<BR><BR>Informe a identificação do Item do Pedido de Venda. Caso você não tenha essa informação no seu aplicativo, informe o número sequencial de cada item do pedido.<BR><BR>Informa de 1 a 199.<BR><BR>
	 *
	 * @var string
	 */
	public $codigo_item_integracao;
	/**
	 * ID do Item do Pedido.<BR>Preenchimento automático - Não informar.
	 *
	 * @var integer
	 */
	public $codigo_item;
	/**
	 * Indica que a empresa é Optante pelo Simples Nacional.<BR>Preenchimento Opcional.<BR><BR>Informar "S" ou "N".
	 *
	 * @var string
	 */
	public $simples_nacional;
	/**
	 * DEPRECATED
	 *
	 * @var integer
	 */
	public $regra_impostos;
}

/**
 * Identificação do Produto do Item do Pedido de Vendas.
 *
 * @pw_element integer $codigo_produto ID do Produto.<BR>Preenchimento Obrigatório.<BR><BR>Esse campo não é exibido na tela do Pedido de Vendas. <BR>É uma informação interna, utilizada apenas nas APIs.<BR><BR>Utilize a tag 'codigo_produto' do método 'ListarProdutos' da API<BR>http://app.omie.com.br/api/v1/geral/produtos/<BR>para obter essa informação.<BR><BR>
 * @pw_element string $codigo_produto_integracao Código de integração do Produto.<BR>Preenchimento Opcional.<BR><BR>Esse campo deve ser informado apenas se você incluiu o produto via API e informou um código de integração para o produto. Do contrário, informe sempre a tag 'codigo_produto'.<BR>&nbsp;
 * @pw_element string $codigo Código do Produto exibido na tela do Pedido de Vendas.<BR>Preenchimento Opcional.
 * @pw_element string $descricao Descrição do Produto.<BR>Preenchimento Opcional.
 * @pw_element string $cfop CFOP - Código Fiscal de Operações e Prestações.<BR>Preenchimento Opcional.<BR><BR>Utilize a tag 'nCodigo' do método 'ListarCFOP' da API<BR>http://app.omie.com.br/api/v1/produtos/cfop/<BR>para obter essa informação.
 * @pw_element string $ncm NCM - Nomenclatura Comum do Mercosul<BR>Preenchimento Opcional.<BR><BR>Utilize a tag 'cCodigo' do método 'ListarNCM' da API<BR>http://app.omie.com.br/api/v1/produtos/ncm/<BR>para obter essa informação.
 * @pw_element string $ean EAN - European Article Number<BR>Preenchimento Opcional.
 * @pw_element string $unidade Unidade.<BR>Preenchimento Opcional.<BR><BR>Utilize a tag 'codigo' do método 'ListarUnidades' da API<BR>http://app.omie.com.br/api/v1/geral/unidade/<BR>para obter essa informação.<BR>
 * @pw_element decimal $quantidade Quantidade<BR>Preenchimento obrigatório.
 * @pw_element decimal $valor_unitario Valor Únitário<BR>Preenchimento Obrigatório.
 * @pw_element integer $codigo_tabela_preco Código da tabela de preço.<BR><BR>(Interno, utilizado apenas na integração via API, não é exibido na tela).<BR>Deve ser informada opcionalmente, caso a tabela de preços esteja configurada no Omie.
 * @pw_element decimal $valor_mercadoria Valor da Mercadoria<BR>Preenchimento Opcional
 * @pw_element string $tipo_desconto Tipo de Desconto.<BR>Preenchimento Opcional
 * @pw_element decimal $percentual_desconto Percentual de Desconto.<BR>Preenchimento Opcional
 * @pw_element decimal $valor_desconto Valor do Desconto<BR>Preenchimento Opcional
 * @pw_element decimal $valor_deducao Valor da Dedução<BR>Preenchimento Opcional
 * @pw_element decimal $valor_total Valor Total.<BR>Preenchimento Opcional
 * @pw_complex produto
 */
class produto{
	/**
	 * ID do Produto.<BR>Preenchimento Obrigatório.<BR><BR>Esse campo não é exibido na tela do Pedido de Vendas. <BR>É uma informação interna, utilizada apenas nas APIs.<BR><BR>Utilize a tag 'codigo_produto' do método 'ListarProdutos' da API<BR>http://app.omie.com.br/api/v1/geral/produtos/<BR>para obter essa informação.<BR><BR>
	 *
	 * @var integer
	 */
	public $codigo_produto;
	/**
	 * Código de integração do Produto.<BR>Preenchimento Opcional.<BR><BR>Esse campo deve ser informado apenas se você incluiu o produto via API e informou um código de integração para o produto. Do contrário, informe sempre a tag 'codigo_produto'.<BR>&nbsp;
	 *
	 * @var string
	 */
	public $codigo_produto_integracao;
	/**
	 * Código do Produto exibido na tela do Pedido de Vendas.<BR>Preenchimento Opcional.
	 *
	 * @var string
	 */
	public $codigo;
	/**
	 * Descrição do Produto.<BR>Preenchimento Opcional.
	 *
	 * @var string
	 */
	public $descricao;
	/**
	 * CFOP - Código Fiscal de Operações e Prestações.<BR>Preenchimento Opcional.<BR><BR>Utilize a tag 'nCodigo' do método 'ListarCFOP' da API<BR>http://app.omie.com.br/api/v1/produtos/cfop/<BR>para obter essa informação.
	 *
	 * @var string
	 */
	public $cfop;
	/**
	 * NCM - Nomenclatura Comum do Mercosul<BR>Preenchimento Opcional.<BR><BR>Utilize a tag 'cCodigo' do método 'ListarNCM' da API<BR>http://app.omie.com.br/api/v1/produtos/ncm/<BR>para obter essa informação.
	 *
	 * @var string
	 */
	public $ncm;
	/**
	 * EAN - European Article Number<BR>Preenchimento Opcional.
	 *
	 * @var string
	 */
	public $ean;
	/**
	 * Unidade.<BR>Preenchimento Opcional.<BR><BR>Utilize a tag 'codigo' do método 'ListarUnidades' da API<BR>http://app.omie.com.br/api/v1/geral/unidade/<BR>para obter essa informação.<BR>
	 *
	 * @var string
	 */
	public $unidade;
	/**
	 * Quantidade<BR>Preenchimento obrigatório.
	 *
	 * @var decimal
	 */
	public $quantidade;
	/**
	 * Valor Únitário<BR>Preenchimento Obrigatório.
	 *
	 * @var decimal
	 */
	public $valor_unitario;
	/**
	 * Código da tabela de preço.<BR><BR>(Interno, utilizado apenas na integração via API, não é exibido na tela).<BR>Deve ser informada opcionalmente, caso a tabela de preços esteja configurada no Omie.
	 *
	 * @var integer
	 */
	public $codigo_tabela_preco;
	/**
	 * Valor da Mercadoria<BR>Preenchimento Opcional
	 *
	 * @var decimal
	 */
	public $valor_mercadoria;
	/**
	 * Tipo de Desconto.<BR>Preenchimento Opcional
	 *
	 * @var string
	 */
	public $tipo_desconto;
	/**
	 * Percentual de Desconto.<BR>Preenchimento Opcional
	 *
	 * @var decimal
	 */
	public $percentual_desconto;
	/**
	 * Valor do Desconto<BR>Preenchimento Opcional
	 *
	 * @var decimal
	 */
	public $valor_desconto;
	/**
	 * Valor da Dedução<BR>Preenchimento Opcional
	 *
	 * @var decimal
	 */
	public $valor_deducao;
	/**
	 * Valor Total.<BR>Preenchimento Opcional
	 *
	 * @var decimal
	 */
	public $valor_total;
}

/**
 * Dados da aba 'Observações' do Item do Pedido de Vendas.
 *
 * @pw_element string $obs_item Observações do item (elas não serão exibidas na Nota Fisca, mas serão impressas no pedido de vendal).<BR>Preenchimento Opcional.<BR><BR>Informação localizada na Aba 'Observações' do Item do Pedido de Venda.
 * @pw_complex observacao
 */
class observacao{
	/**
	 * Observações do item (elas não serão exibidas na Nota Fisca, mas serão impressas no pedido de vendal).<BR>Preenchimento Opcional.<BR><BR>Informação localizada na Aba 'Observações' do Item do Pedido de Venda.
	 *
	 * @var string
	 */
	public $obs_item;
}

/**
 * Dados da aba 'Informações Adicionais' do Item do Pedido de Vendas.
 *
 * @pw_element decimal $peso_liquido Peso Líquido (Kg).<BR>Preenchimento Opcional.
 * @pw_element decimal $peso_bruto Peso Bruto (Kg).<BR>Preenchimento Opcional.
 * @pw_element string $numero_pedido_compra Número do Pedido de Compra.<BR>Preenchimento Opcional.
 * @pw_element integer $item_pedido_compra Item do Pedido de Compra.<BR>Preenchimento Opcional.<BR>
 * @pw_element string $dados_adicionais_item Informações para a Nota Fiscal.<BR>Preenchimento Opcional.
 * @pw_element string $nao_movimentar_estoque Não gerar a saída de estoque deste item ao emitir NF-e.<BR>Preenchimento Opcional.<BR><BR>Informar "S" ou "N".<BR>(informe 'S' para ativar essa opção).
 * @pw_element string $nao_gerar_financeiro Não gerar conta a receber para este item.<BR>Preenchimento Opcional.<BR><BR>Informar "S" ou "N".<BR>(Informe 'S' para ativar essa opção).
 * @pw_complex inf_adic
 */
class inf_adic{
	/**
	 * Peso Líquido (Kg).<BR>Preenchimento Opcional.
	 *
	 * @var decimal
	 */
	public $peso_liquido;
	/**
	 * Peso Bruto (Kg).<BR>Preenchimento Opcional.
	 *
	 * @var decimal
	 */
	public $peso_bruto;
	/**
	 * Número do Pedido de Compra.<BR>Preenchimento Opcional.
	 *
	 * @var string
	 */
	public $numero_pedido_compra;
	/**
	 * Item do Pedido de Compra.<BR>Preenchimento Opcional.<BR>
	 *
	 * @var integer
	 */
	public $item_pedido_compra;
	/**
	 * Informações para a Nota Fiscal.<BR>Preenchimento Opcional.
	 *
	 * @var string
	 */
	public $dados_adicionais_item;
	/**
	 * Não gerar a saída de estoque deste item ao emitir NF-e.<BR>Preenchimento Opcional.<BR><BR>Informar "S" ou "N".<BR>(informe 'S' para ativar essa opção).
	 *
	 * @var string
	 */
	public $nao_movimentar_estoque;
	/**
	 * Não gerar conta a receber para este item.<BR>Preenchimento Opcional.<BR><BR>Informar "S" ou "N".<BR>(Informe 'S' para ativar essa opção).
	 *
	 * @var string
	 */
	public $nao_gerar_financeiro;
}

/**
 * Informações referentes aos impostos do Item do Pedido de Vendas.
 *
 * @pw_element icms_sn $icms_sn ICMS - Simples Nacional.<BR>Preenchimento Obrigatório quando optante pelo Simples Nacional.
 * @pw_element icms $icms ICMS<BR>Preenchimento Obrigatório.
 * @pw_element icms_st $icms_st ICMS - Substituição Tributária.<BR>Preenchimento Obrigatório.
 * @pw_element icms_ie $icms_ie ICMS Interestadual.<BR>Preenchimento Obrigatório.
 * @pw_element ipi $ipi IPI.<BR>Preenchimento Obrigatório.
 * @pw_element pis_padrao $pis_padrao PIS.<BR>Preenchimento Obrigatório.
 * @pw_element pis_st $pis_st PIS - Substituíção Tributária.<BR>Preenchimento Obrigatório.
 * @pw_element cofins_padrao $cofins_padrao COFINS.<BR>Preenchimento Obrigatório.
 * @pw_element cofins_st $cofins_st COFINS - Substituição Tributária.<BR>Preenchimento Obrigatório.
 * @pw_element inss $inss INSS.<BR>Preenchimento Obrigatório.
 * @pw_element csll $csll CSLL.<BR>Preenchimento Obrigatório.
 * @pw_element irrf $irrf IRRF.<BR>Preenchimento Obrigatório.
 * @pw_element iss $iss ISS.<BR>Preenchimento Obrigatório.
 * @pw_complex imposto
 */
class imposto{
	/**
	 * ICMS - Simples Nacional.<BR>Preenchimento Obrigatório quando optante pelo Simples Nacional.
	 *
	 * @var icms_sn
	 */
	public $icms_sn;
	/**
	 * ICMS<BR>Preenchimento Obrigatório.
	 *
	 * @var icms
	 */
	public $icms;
	/**
	 * ICMS - Substituição Tributária.<BR>Preenchimento Obrigatório.
	 *
	 * @var icms_st
	 */
	public $icms_st;
	/**
	 * ICMS Interestadual.<BR>Preenchimento Obrigatório.
	 *
	 * @var icms_ie
	 */
	public $icms_ie;
	/**
	 * IPI.<BR>Preenchimento Obrigatório.
	 *
	 * @var ipi
	 */
	public $ipi;
	/**
	 * PIS.<BR>Preenchimento Obrigatório.
	 *
	 * @var pis_padrao
	 */
	public $pis_padrao;
	/**
	 * PIS - Substituíção Tributária.<BR>Preenchimento Obrigatório.
	 *
	 * @var pis_st
	 */
	public $pis_st;
	/**
	 * COFINS.<BR>Preenchimento Obrigatório.
	 *
	 * @var cofins_padrao
	 */
	public $cofins_padrao;
	/**
	 * COFINS - Substituição Tributária.<BR>Preenchimento Obrigatório.
	 *
	 * @var cofins_st
	 */
	public $cofins_st;
	/**
	 * INSS.<BR>Preenchimento Obrigatório.
	 *
	 * @var inss
	 */
	public $inss;
	/**
	 * CSLL.<BR>Preenchimento Obrigatório.
	 *
	 * @var csll
	 */
	public $csll;
	/**
	 * IRRF.<BR>Preenchimento Obrigatório.
	 *
	 * @var irrf
	 */
	public $irrf;
	/**
	 * ISS.<BR>Preenchimento Obrigatório.
	 *
	 * @var iss
	 */
	public $iss;
}

/**
 * Dados da Aba 'Frete e Outras Despesas' do Pedido de Venda.
 *
 * @pw_element integer $codigo_transportadora ID da transportadora.<BR>Preenchimento Opcional.<BR><BR>Esse campo não é exibido na tela do Pedido de Vendas. <BR>É uma informação interna, utilizada apenas nas APIs.<BR><BR>Informação localizada na Aba "Frete e Outras Despesas" do Pedido de Venda.<BR><BR>Utilize a tag 'codigo_cliente_omie' do método 'ListarClientes' da API<BR>http://app.omie.com.br/api/v1/geral/clientes/<BR>para obter essa informação.<BR><BR>OBS: O Omie uitliza o cadastro de clientes para registrar também fornecedores e transportadoras.<BR>
 * @pw_element string $codigo_transportadora_integracao Código Integração da Transportadora.<BR>Preenchimento Opcional.<BR><BR>Esse campo deve ser informado apenas se você incluiu o cliente (transportadora) via API e informou um código de integração para o cliente. Do contrário, informe sempre a tag 'codigo_cliente'.<BR>
 * @pw_element string $modalidade Tipo de  Frete.<BR>Preenchimento Obrigatório.<BR><BR>Informação localizada na Aba "Frete e Outras Despesas" do Pedido de Venda.<BR><BR>Valores disponíveis:<BR><BR>'0' - Frete por conta do emitente.<BR>'1' - Frete por conta do destinatário.<BR>'2' - Frete por conta de terceiros.<BR>'9' - Sem frete.<BR>
 * @pw_element string $placa Placa do Veículo.<BR>Preenchimento Opcional.<BR><BR>Informação localizada na Aba "Frete e Outras Despesas" do Pedido de Venda.
 * @pw_element string $placa_estado Estado da Placa do Veículo.<BR>Preenchimento Opcional.<BR><BR>Informação localizada na Aba "Frete e Outras Despesas" do Pedido de Venda.
 * @pw_element string $registro_transportador RNTRC (ANTT) - Registro Nacional de Transportador de Cargas.<BR>Preenchimento Opcional.<BR><BR>Informação localizada na Aba "Frete e Outras Despesas" do Pedido de Venda.
 * @pw_element integer $quantidade_volumes Quantidade de Volumes.<BR>Preenchimento Opcional.<BR><BR>Informação localizada na Aba "Frete e Outras Despesas" do Pedido de Venda.
 * @pw_element string $especie_volumes Espécie dos Volumes.<BR>Preenchimento Opcional.<BR><BR>Informação localizada na Aba "Frete e Outras Despesas" do Pedido de Venda.
 * @pw_element string $marca_volumes Marca dos Volumes.<BR>Preenchimento Opcional.<BR><BR>Informação localizada na Aba "Frete e Outras Despesas" do Pedido de Venda.
 * @pw_element string $numeracao_volumes Numeração dos Volumes.<BR>Preenchimento Opcional.<BR><BR>Informação localizada na Aba "Frete e Outras Despesas" do Pedido de Venda.
 * @pw_element decimal $peso_liquido Peso Líquido (Kg).<BR>Preenchimento Opcional.<BR><BR>Informação localizada na Aba "Frete e Outras Despesas" do Pedido de Venda.
 * @pw_element decimal $peso_bruto Peso Bruto (Kg).<BR>Preenchimento Opcional.<BR><BR>Informação localizada na Aba "Frete e Outras Despesas" do Pedido de Venda.
 * @pw_element decimal $valor_frete Valor do Frete.<BR>Preenchimento Opcional.<BR><BR>Informação localizada na Aba "Frete e Outras Despesas" do Pedido de Venda.
 * @pw_element decimal $valor_seguro Valor do Seguro.<BR>Preenchimento Opcional.<BR><BR>Informação localizada na Aba "Frete e Outras Despesas" do Pedido de Venda.
 * @pw_element string $numero_lacre Número do Lacre.<BR>Preenchimento Opcional.<BR><BR>Informação localizada na Aba "Frete e Outras Despesas" do Pedido de Venda.
 * @pw_element decimal $outras_despesas Outras Despesas Acessórias.<BR>Preenchimento Opcional.<BR><BR>Informação localizada na Aba "Frete e Outras Despesas" do Pedido de Venda.
 * @pw_element string $veiculo_proprio O transporte será realizado com veículo próprio.<BR>Preenchimento Opcional.<BR><BR>Informar "S" ou "N".<BR><BR>Informação localizada na Aba "Frete e Outras Despesas" do Pedido de Venda.
 * @pw_element icms_retido $icms_retido Dados do ICMS Retido do Serviço de Transporte.<BR><BR>Informação localizada na Aba "Frete e Outras Despesas" do Pedido de Venda.
 * @pw_complex frete
 */
class frete{
	/**
	 * ID da transportadora.<BR>Preenchimento Opcional.<BR><BR>Esse campo não é exibido na tela do Pedido de Vendas. <BR>É uma informação interna, utilizada apenas nas APIs.<BR><BR>Informação localizada na Aba "Frete e Outras Despesas" do Pedido de Venda.<BR><BR>Utilize a tag 'codigo_cliente_omie' do método 'ListarClientes' da API<BR>http://app.omie.com.br/api/v1/geral/clientes/<BR>para obter essa informação.<BR><BR>OBS: O Omie uitliza o cadastro de clientes para registrar também fornecedores e transportadoras.<BR>
	 *
	 * @var integer
	 */
	public $codigo_transportadora;
	/**
	 * Código Integração da Transportadora.<BR>Preenchimento Opcional.<BR><BR>Esse campo deve ser informado apenas se você incluiu o cliente (transportadora) via API e informou um código de integração para o cliente. Do contrário, informe sempre a tag 'codigo_cliente'.<BR>
	 *
	 * @var string
	 */
	public $codigo_transportadora_integracao;
	/**
	 * Tipo de  Frete.<BR>Preenchimento Obrigatório.<BR><BR>Informação localizada na Aba "Frete e Outras Despesas" do Pedido de Venda.<BR><BR>Valores disponíveis:<BR><BR>'0' - Frete por conta do emitente.<BR>'1' - Frete por conta do destinatário.<BR>'2' - Frete por conta de terceiros.<BR>'9' - Sem frete.<BR>
	 *
	 * @var string
	 */
	public $modalidade;
	/**
	 * Placa do Veículo.<BR>Preenchimento Opcional.<BR><BR>Informação localizada na Aba "Frete e Outras Despesas" do Pedido de Venda.
	 *
	 * @var string
	 */
	public $placa;
	/**
	 * Estado da Placa do Veículo.<BR>Preenchimento Opcional.<BR><BR>Informação localizada na Aba "Frete e Outras Despesas" do Pedido de Venda.
	 *
	 * @var string
	 */
	public $placa_estado;
	/**
	 * RNTRC (ANTT) - Registro Nacional de Transportador de Cargas.<BR>Preenchimento Opcional.<BR><BR>Informação localizada na Aba "Frete e Outras Despesas" do Pedido de Venda.
	 *
	 * @var string
	 */
	public $registro_transportador;
	/**
	 * Quantidade de Volumes.<BR>Preenchimento Opcional.<BR><BR>Informação localizada na Aba "Frete e Outras Despesas" do Pedido de Venda.
	 *
	 * @var integer
	 */
	public $quantidade_volumes;
	/**
	 * Espécie dos Volumes.<BR>Preenchimento Opcional.<BR><BR>Informação localizada na Aba "Frete e Outras Despesas" do Pedido de Venda.
	 *
	 * @var string
	 */
	public $especie_volumes;
	/**
	 * Marca dos Volumes.<BR>Preenchimento Opcional.<BR><BR>Informação localizada na Aba "Frete e Outras Despesas" do Pedido de Venda.
	 *
	 * @var string
	 */
	public $marca_volumes;
	/**
	 * Numeração dos Volumes.<BR>Preenchimento Opcional.<BR><BR>Informação localizada na Aba "Frete e Outras Despesas" do Pedido de Venda.
	 *
	 * @var string
	 */
	public $numeracao_volumes;
	/**
	 * Peso Líquido (Kg).<BR>Preenchimento Opcional.<BR><BR>Informação localizada na Aba "Frete e Outras Despesas" do Pedido de Venda.
	 *
	 * @var decimal
	 */
	public $peso_liquido;
	/**
	 * Peso Bruto (Kg).<BR>Preenchimento Opcional.<BR><BR>Informação localizada na Aba "Frete e Outras Despesas" do Pedido de Venda.
	 *
	 * @var decimal
	 */
	public $peso_bruto;
	/**
	 * Valor do Frete.<BR>Preenchimento Opcional.<BR><BR>Informação localizada na Aba "Frete e Outras Despesas" do Pedido de Venda.
	 *
	 * @var decimal
	 */
	public $valor_frete;
	/**
	 * Valor do Seguro.<BR>Preenchimento Opcional.<BR><BR>Informação localizada na Aba "Frete e Outras Despesas" do Pedido de Venda.
	 *
	 * @var decimal
	 */
	public $valor_seguro;
	/**
	 * Número do Lacre.<BR>Preenchimento Opcional.<BR><BR>Informação localizada na Aba "Frete e Outras Despesas" do Pedido de Venda.
	 *
	 * @var string
	 */
	public $numero_lacre;
	/**
	 * Outras Despesas Acessórias.<BR>Preenchimento Opcional.<BR><BR>Informação localizada na Aba "Frete e Outras Despesas" do Pedido de Venda.
	 *
	 * @var decimal
	 */
	public $outras_despesas;
	/**
	 * O transporte será realizado com veículo próprio.<BR>Preenchimento Opcional.<BR><BR>Informar "S" ou "N".<BR><BR>Informação localizada na Aba "Frete e Outras Despesas" do Pedido de Venda.
	 *
	 * @var string
	 */
	public $veiculo_proprio;
	/**
	 * Dados do ICMS Retido do Serviço de Transporte.<BR><BR>Informação localizada na Aba "Frete e Outras Despesas" do Pedido de Venda.
	 *
	 * @var icms_retido
	 */
	public $icms_retido;
}

/**
 * Dados do ICMS Retido do Serviço de Transporte.
 *
 * @pw_element decimal $vServicoTr Valor de Serviço de Transporte.<BR><BR>Informação localizada na Aba "Frete e Outras Despesas" do Pedido de Venda.
 * @pw_element decimal $vBCRetencaoTr Base de Cálculo da Retenção.<BR><BR>Informação localizada na Aba "Frete e Outras Despesas" do Pedido de Venda.
 * @pw_element decimal $vAliquotaRetencaoTr Percentual de Alíquota de Retenção.<BR><BR>Informação localizada na Aba "Frete e Outras Despesas" do Pedido de Venda.
 * @pw_element decimal $vIcmsRetidoTr Valor de ICMS Retido.<BR><BR>Informação localizada na Aba "Frete e Outras Despesas" do Pedido de Venda.
 * @pw_element string $cCfopTr CFOP.<BR><BR>Informação localizada na Aba "Frete e Outras Despesas" do Pedido de Venda.<BR><BR>Utilize a tag 'nCodigo' do método 'ListarCFOP' da API<BR>http://app.omie.com.br/api/v1/produtos/cfop/<BR>para obter essa informação.
 * @pw_element string $cCidadeTr Cidade de Ocorrência do Fato Gerador do ICMS.<BR><BR>Utilize o formato: CIDADE (UF), como no exemplos:<BR><BR>'SAO PAULO (SP)'<BR>'RIO DE JANEIRO (RJ)'<BR>'FLORIANOPOLIS (SC)'<BR><BR>Informação localizada na Aba "Frete e Outras Despesas" do Pedido de Venda.<BR><BR>Utilize a tag 'cCod' do método 'PesquisarCidades' da API<BR>http://app.omie.com.br/api/v1/geral/cidades/<BR>para obter essa informação.<BR>
 * @pw_complex icms_retido
 */
class icms_retido{
	/**
	 * Valor de Serviço de Transporte.<BR><BR>Informação localizada na Aba "Frete e Outras Despesas" do Pedido de Venda.
	 *
	 * @var decimal
	 */
	public $vServicoTr;
	/**
	 * Base de Cálculo da Retenção.<BR><BR>Informação localizada na Aba "Frete e Outras Despesas" do Pedido de Venda.
	 *
	 * @var decimal
	 */
	public $vBCRetencaoTr;
	/**
	 * Percentual de Alíquota de Retenção.<BR><BR>Informação localizada na Aba "Frete e Outras Despesas" do Pedido de Venda.
	 *
	 * @var decimal
	 */
	public $vAliquotaRetencaoTr;
	/**
	 * Valor de ICMS Retido.<BR><BR>Informação localizada na Aba "Frete e Outras Despesas" do Pedido de Venda.
	 *
	 * @var decimal
	 */
	public $vIcmsRetidoTr;
	/**
	 * CFOP.<BR><BR>Informação localizada na Aba "Frete e Outras Despesas" do Pedido de Venda.<BR><BR>Utilize a tag 'nCodigo' do método 'ListarCFOP' da API<BR>http://app.omie.com.br/api/v1/produtos/cfop/<BR>para obter essa informação.
	 *
	 * @var string
	 */
	public $cCfopTr;
	/**
	 * Cidade de Ocorrência do Fato Gerador do ICMS.<BR><BR>Utilize o formato: CIDADE (UF), como no exemplos:<BR><BR>'SAO PAULO (SP)'<BR>'RIO DE JANEIRO (RJ)'<BR>'FLORIANOPOLIS (SC)'<BR><BR>Informação localizada na Aba "Frete e Outras Despesas" do Pedido de Venda.<BR><BR>Utilize a tag 'cCod' do método 'PesquisarCidades' da API<BR>http://app.omie.com.br/api/v1/geral/cidades/<BR>para obter essa informação.<BR>
	 *
	 * @var string
	 */
	public $cCidadeTr;
}

/**
 * ICMS
 *
 * @pw_element string $cod_sit_trib_icms NFe - Situação Tributária
 * @pw_element string $origem_icms NFe - Origem
 * @pw_element string $modalidade_icms NFe - Modalidade para determinação da Base de Cálculo do ICMs
 * @pw_element decimal $perc_red_base_icms Percentual de redução da base de cálculo do ICMS
 * @pw_element decimal $base_icms Base de cálculo do ICMS
 * @pw_element decimal $aliq_icms Alíquota do ICMS
 * @pw_element decimal $valor_icms Valor do ICMS
 * @pw_complex icms
 */
class icms{
	/**
	 * NFe - Situação Tributária
	 *
	 * @var string
	 */
	public $cod_sit_trib_icms;
	/**
	 * NFe - Origem
	 *
	 * @var string
	 */
	public $origem_icms;
	/**
	 * NFe - Modalidade para determinação da Base de Cálculo do ICMs
	 *
	 * @var string
	 */
	public $modalidade_icms;
	/**
	 * Percentual de redução da base de cálculo do ICMS
	 *
	 * @var decimal
	 */
	public $perc_red_base_icms;
	/**
	 * Base de cálculo do ICMS
	 *
	 * @var decimal
	 */
	public $base_icms;
	/**
	 * Alíquota do ICMS
	 *
	 * @var decimal
	 */
	public $aliq_icms;
	/**
	 * Valor do ICMS
	 *
	 * @var decimal
	 */
	public $valor_icms;
}

/**
 * ICMS Interestadual.
 *
 * @pw_element decimal $base_icms_uf_destino BC do ICMS na UF de Destino
 * @pw_element decimal $aliq_icms_FCP Percentual do ICMS relativo ao Fundo de Combate à Pobreza (FCP) na UF de Destino
 * @pw_element decimal $aliq_interna_uf_destino Alíquota Interna da UF de Destino
 * @pw_element decimal $aliq_interestadual Alíquota Interestadual das UFs Envolvidas
 * @pw_element decimal $aliq_partilha_icms Percentual Provisório de Partilha do ICMS Interestadual
 * @pw_element decimal $valor_fcp_icms_inter Valor do fundo de combate a pobreza.
 * @pw_element decimal $valor_icms_uf_dest Valor do ICMS - UF Destino
 * @pw_element decimal $valor_icms_uf_remet Valor do ICMS - UF Remetente
 * @pw_complex icms_ie
 */
class icms_ie{
	/**
	 * BC do ICMS na UF de Destino
	 *
	 * @var decimal
	 */
	public $base_icms_uf_destino;
	/**
	 * Percentual do ICMS relativo ao Fundo de Combate à Pobreza (FCP) na UF de Destino
	 *
	 * @var decimal
	 */
	public $aliq_icms_FCP;
	/**
	 * Alíquota Interna da UF de Destino
	 *
	 * @var decimal
	 */
	public $aliq_interna_uf_destino;
	/**
	 * Alíquota Interestadual das UFs Envolvidas
	 *
	 * @var decimal
	 */
	public $aliq_interestadual;
	/**
	 * Percentual Provisório de Partilha do ICMS Interestadual
	 *
	 * @var decimal
	 */
	public $aliq_partilha_icms;
	/**
	 * Valor do fundo de combate a pobreza.
	 *
	 * @var decimal
	 */
	public $valor_fcp_icms_inter;
	/**
	 * Valor do ICMS - UF Destino
	 *
	 * @var decimal
	 */
	public $valor_icms_uf_dest;
	/**
	 * Valor do ICMS - UF Remetente
	 *
	 * @var decimal
	 */
	public $valor_icms_uf_remet;
}

/**
 * ICMS - Simples Nacional.
 *
 * @pw_element string $cod_sit_trib_icms_sn Código da situação tributária pelo Simples
 * @pw_element string $origem_icms_sn NFe - Origem
 * @pw_element decimal $aliq_icms_sn Alíquota aplicável de cálculo do crédito de ICMS no Simples Nacional
 * @pw_element decimal $valor_credito_icms_sn Valor do crédito de ICMS no Simples Nacional
 * @pw_element decimal $base_icms_sn Base de Cálculo do ICMS retido anteriormente por Substituição Tributária
 * @pw_element decimal $valor_icms_sn Valor do ICMS retido anteriormente por Substituição Tributária
 * @pw_complex icms_sn
 */
class icms_sn{
	/**
	 * Código da situação tributária pelo Simples
	 *
	 * @var string
	 */
	public $cod_sit_trib_icms_sn;
	/**
	 * NFe - Origem
	 *
	 * @var string
	 */
	public $origem_icms_sn;
	/**
	 * Alíquota aplicável de cálculo do crédito de ICMS no Simples Nacional
	 *
	 * @var decimal
	 */
	public $aliq_icms_sn;
	/**
	 * Valor do crédito de ICMS no Simples Nacional
	 *
	 * @var decimal
	 */
	public $valor_credito_icms_sn;
	/**
	 * Base de Cálculo do ICMS retido anteriormente por Substituição Tributária
	 *
	 * @var decimal
	 */
	public $base_icms_sn;
	/**
	 * Valor do ICMS retido anteriormente por Substituição Tributária
	 *
	 * @var decimal
	 */
	public $valor_icms_sn;
}

/**
 * ICMS - Substituição Tributária.
 *
 * @pw_element string $cod_sit_trib_icms_st NFe - Situação Tributária
 * @pw_element string $modalidade_icms_st NFe - Código da Modalidade de determinação da Base de Cálculo do ICMS ST
 * @pw_element decimal $perc_red_base_icms_st Percentual de redução da base de cálculo do ICMS
 * @pw_element decimal $base_icms_st Base de cálculo do ICMS Substituição Tributária
 * @pw_element decimal $aliq_icms_st Alíquota do ICMS Substituição Tributária
 * @pw_element decimal $margem_icms_st Percentual da margem do valor adicionado da base de cálculo do ICMS ST
 * @pw_element decimal $valor_icms_st Valor do ICMS Substituição Tributária
 * @pw_element decimal $aliq_icms_opprop Alíquota de ICMS Operação Própria.
 * @pw_element string $cest CEST - Código Especificador da Substituíção Tributária.<BR>Preenchimento Opcional
 * @pw_complex icms_st
 */
class icms_st{
	/**
	 * NFe - Situação Tributária
	 *
	 * @var string
	 */
	public $cod_sit_trib_icms_st;
	/**
	 * NFe - Código da Modalidade de determinação da Base de Cálculo do ICMS ST
	 *
	 * @var string
	 */
	public $modalidade_icms_st;
	/**
	 * Percentual de redução da base de cálculo do ICMS
	 *
	 * @var decimal
	 */
	public $perc_red_base_icms_st;
	/**
	 * Base de cálculo do ICMS Substituição Tributária
	 *
	 * @var decimal
	 */
	public $base_icms_st;
	/**
	 * Alíquota do ICMS Substituição Tributária
	 *
	 * @var decimal
	 */
	public $aliq_icms_st;
	/**
	 * Percentual da margem do valor adicionado da base de cálculo do ICMS ST
	 *
	 * @var decimal
	 */
	public $margem_icms_st;
	/**
	 * Valor do ICMS Substituição Tributária
	 *
	 * @var decimal
	 */
	public $valor_icms_st;
	/**
	 * Alíquota de ICMS Operação Própria.
	 *
	 * @var decimal
	 */
	public $aliq_icms_opprop;
	/**
	 * CEST - Código Especificador da Substituíção Tributária.<BR>Preenchimento Opcional
	 *
	 * @var string
	 */
	public $cest;
}

/**
 * IPI.
 *
 * @pw_element string $cod_sit_trib_ipi Código da situação tributária do IPI
 * @pw_element string $tipo_calculo_ipi Tipo de cálculo para obtenção do valor do IPI
 * @pw_element string $enquadramento_ipi Enquadramento do IPI
 * @pw_element decimal $base_ipi Base de Cálculo do IPI
 * @pw_element decimal $aliq_ipi Alíquota do IPI
 * @pw_element decimal $qtde_unid_trib_ipi Quantidade de Unidades Tributáveis do IPI
 * @pw_element decimal $valor_unid_trib_ipi Valor do IPI por Unidade Tributável
 * @pw_element decimal $valor_ipi Valor do IPI
 * @pw_complex ipi
 */
class ipi{
	/**
	 * Código da situação tributária do IPI
	 *
	 * @var string
	 */
	public $cod_sit_trib_ipi;
	/**
	 * Tipo de cálculo para obtenção do valor do IPI
	 *
	 * @var string
	 */
	public $tipo_calculo_ipi;
	/**
	 * Enquadramento do IPI
	 *
	 * @var string
	 */
	public $enquadramento_ipi;
	/**
	 * Base de Cálculo do IPI
	 *
	 * @var decimal
	 */
	public $base_ipi;
	/**
	 * Alíquota do IPI
	 *
	 * @var decimal
	 */
	public $aliq_ipi;
	/**
	 * Quantidade de Unidades Tributáveis do IPI
	 *
	 * @var decimal
	 */
	public $qtde_unid_trib_ipi;
	/**
	 * Valor do IPI por Unidade Tributável
	 *
	 * @var decimal
	 */
	public $valor_unid_trib_ipi;
	/**
	 * Valor do IPI
	 *
	 * @var decimal
	 */
	public $valor_ipi;
}

/**
 * PIS.
 *
 * @pw_element string $cod_sit_trib_pis Código da Situação Tributária do PIS
 * @pw_element string $tipo_calculo_pis Tipo de cálculo para obtenção do valor do PIS
 * @pw_element decimal $base_pis Base de Cálculo do PIS
 * @pw_element decimal $aliq_pis Alíquota do PIS
 * @pw_element decimal $qtde_unid_trib_pis Quantidade de Unidades Tributáveis do PIS
 * @pw_element decimal $valor_unid_trib_pis Valor do PIS por Unidade Tributável
 * @pw_element decimal $valor_pis Valor do PIS
 * @pw_complex pis_padrao
 */
class pis_padrao{
	/**
	 * Código da Situação Tributária do PIS
	 *
	 * @var string
	 */
	public $cod_sit_trib_pis;
	/**
	 * Tipo de cálculo para obtenção do valor do PIS
	 *
	 * @var string
	 */
	public $tipo_calculo_pis;
	/**
	 * Base de Cálculo do PIS
	 *
	 * @var decimal
	 */
	public $base_pis;
	/**
	 * Alíquota do PIS
	 *
	 * @var decimal
	 */
	public $aliq_pis;
	/**
	 * Quantidade de Unidades Tributáveis do PIS
	 *
	 * @var decimal
	 */
	public $qtde_unid_trib_pis;
	/**
	 * Valor do PIS por Unidade Tributável
	 *
	 * @var decimal
	 */
	public $valor_unid_trib_pis;
	/**
	 * Valor do PIS
	 *
	 * @var decimal
	 */
	public $valor_pis;
}

/**
 * PIS - Substituíção Tributária.
 *
 * @pw_element string $cod_sit_trib_pis_st Código da Situação Tributária do PIS
 * @pw_element string $tipo_calculo_pis_st Tipo de cálculo para obtenção do valor do PIS Substituição Tributária
 * @pw_element decimal $base_pis_st Base de Cálculo do PIS Substituição Tributária
 * @pw_element decimal $aliq_pis_st Alíquota do PIS Substituição Tributária
 * @pw_element decimal $qtde_unid_trib_pis_st Quantidade de Unidades Tributáveis do PIS Substituição Tributária
 * @pw_element decimal $valor_unid_trib_pis_st Valor do PIS Substituição Tributária por Unidade Tributável
 * @pw_element decimal $margem_pis_st Margem de valor adicional para obter a base de cálculo do PIS Substituição Tributária
 * @pw_element decimal $valor_pis_st Valor do PIS Substituição Tributária
 * @pw_complex pis_st
 */
class pis_st{
	/**
	 * Código da Situação Tributária do PIS
	 *
	 * @var string
	 */
	public $cod_sit_trib_pis_st;
	/**
	 * Tipo de cálculo para obtenção do valor do PIS Substituição Tributária
	 *
	 * @var string
	 */
	public $tipo_calculo_pis_st;
	/**
	 * Base de Cálculo do PIS Substituição Tributária
	 *
	 * @var decimal
	 */
	public $base_pis_st;
	/**
	 * Alíquota do PIS Substituição Tributária
	 *
	 * @var decimal
	 */
	public $aliq_pis_st;
	/**
	 * Quantidade de Unidades Tributáveis do PIS Substituição Tributária
	 *
	 * @var decimal
	 */
	public $qtde_unid_trib_pis_st;
	/**
	 * Valor do PIS Substituição Tributária por Unidade Tributável
	 *
	 * @var decimal
	 */
	public $valor_unid_trib_pis_st;
	/**
	 * Margem de valor adicional para obter a base de cálculo do PIS Substituição Tributária
	 *
	 * @var decimal
	 */
	public $margem_pis_st;
	/**
	 * Valor do PIS Substituição Tributária
	 *
	 * @var decimal
	 */
	public $valor_pis_st;
}

/**
 * INSS.
 *
 * @pw_element decimal $aliq_inss Alíquota do INSS
 * @pw_element decimal $valor_inss Valor do INSS
 * @pw_complex inss
 */
class inss{
	/**
	 * Alíquota do INSS
	 *
	 * @var decimal
	 */
	public $aliq_inss;
	/**
	 * Valor do INSS
	 *
	 * @var decimal
	 */
	public $valor_inss;
}

/**
 * IRRF.
 *
 * @pw_element decimal $aliq_irrf Alíquota do IRRF
 * @pw_element decimal $valor_irrf Valor do IRRF
 * @pw_complex irrf
 */
class irrf{
	/**
	 * Alíquota do IRRF
	 *
	 * @var decimal
	 */
	public $aliq_irrf;
	/**
	 * Valor do IRRF
	 *
	 * @var decimal
	 */
	public $valor_irrf;
}

/**
 * ISS.
 *
 * @pw_element decimal $base_iss Base de cálculo do ISS
 * @pw_element decimal $aliq_iss Alíquota do ISS
 * @pw_element decimal $valor_iss Valor do ISS
 * @pw_element string $retem_iss Indica que o valor do ISS será retido pelo tomador do serviço
 * @pw_complex iss
 */
class iss{
	/**
	 * Base de cálculo do ISS
	 *
	 * @var decimal
	 */
	public $base_iss;
	/**
	 * Alíquota do ISS
	 *
	 * @var decimal
	 */
	public $aliq_iss;
	/**
	 * Valor do ISS
	 *
	 * @var decimal
	 */
	public $valor_iss;
	/**
	 * Indica que o valor do ISS será retido pelo tomador do serviço
	 *
	 * @var string
	 */
	public $retem_iss;
}

/**
 * Informações complementares do pedido.
 *
 * @pw_element string $dInc Data da Inclusão.<BR>Preenchimento automático - Não informar.
 * @pw_element string $hInc Hora da Inclusão.<BR>Preenchimento automático - Não informar.
 * @pw_element string $uInc Usuário da Inclusão.<BR>Preenchimento automático - Não informar.
 * @pw_element string $dAlt Data da Alteração.<BR>Preenchimento automático - Não informar.
 * @pw_element string $hAlt Hora da Alteração.<BR>Preenchimento automático - Não informar.
 * @pw_element string $uAlt Usuário da Alteração.<BR>Preenchimento automático - Não informar.
 * @pw_element string $cImpAPI Importado pela API.<BR>Preenchimento automático - Não informar.
 * @pw_complex infoCadastro
 */
class infoCadastro{
	/**
	 * Data da Inclusão.<BR>Preenchimento automático - Não informar.
	 *
	 * @var string
	 */
	public $dInc;
	/**
	 * Hora da Inclusão.<BR>Preenchimento automático - Não informar.
	 *
	 * @var string
	 */
	public $hInc;
	/**
	 * Usuário da Inclusão.<BR>Preenchimento automático - Não informar.
	 *
	 * @var string
	 */
	public $uInc;
	/**
	 * Data da Alteração.<BR>Preenchimento automático - Não informar.
	 *
	 * @var string
	 */
	public $dAlt;
	/**
	 * Hora da Alteração.<BR>Preenchimento automático - Não informar.
	 *
	 * @var string
	 */
	public $hAlt;
	/**
	 * Usuário da Alteração.<BR>Preenchimento automático - Não informar.
	 *
	 * @var string
	 */
	public $uAlt;
	/**
	 * Importado pela API.<BR>Preenchimento automático - Não informar.
	 *
	 * @var string
	 */
	public $cImpAPI;
}

/**
 * Dados da Aba 'Informações Adicionais' do Pedido de Venda.
 *
 * @pw_element string $codigo_categoria Código da categoria.<BR>Preenchimento Obrigatório.<BR><BR>Informação localizada na Aba "Informações Adicionais" do Pedido de Venda.<BR><BR>Utilize a tag 'codigo' do método 'ListarCategorias' da API<BR>http://app.omie.com.br/api/v1/geral/categorias/<BR>para obter essa informação.
 * @pw_element integer $codigo_conta_corrente Código da Conta Corrente.<BR>Preenchimento Obrigatório.<BR><BR>Informação localizada na Aba "Informações Adicionais" do Pedido de Venda.<BR><BR>Utilize a tag 'codigo' do método 'PesquisarContaCorrente' da API<BR>http://app.omie.com.br/api/v1/geral/contacorrente/<BR>para obter essa informação.
 * @pw_element string $numero_pedido_cliente Número do pedido do cliente.<BR>Preenchimento Opcional.<BR><BR>Informação localizada na Aba "Informações Adicionais" do Pedido de Venda.
 * @pw_element string $numero_contrato Número do Contrato de Venda.<BR>Preenchimento Opcional.<BR><BR>Informação localizada na Aba "Informações Adicionais" do Pedido de Venda.
 * @pw_element string $contato Contato.<BR>Preenchimento Opcional.<BR><BR>Informação localizada na Aba "Informações Adicionais" do Pedido de Venda.
 * @pw_element string $dados_adicionais_nf Dados adicionais para a Nota Fiscal.<BR>Preenchimento Opcional.<BR><BR>Utilize o caracter pipe ( | ) como separador de linha.<BR><BR>Informação localizada na Aba "Informações Adicionais" do Pedido de Venda.
 * @pw_element string $consumidor_final Nota Fiscal para Consumo Final.<BR>Preenchimento Obrigatório.<BR><BR>Informar "S" ou "N".<BR><BR>Informação localizada na Aba "Informações Adicionais" do Pedido de Venda.
 * @pw_element string $utilizar_emails Utilizar os seguintes endereços de e-mail.<BR>Preenchimento Obrigatório.<BR><BR>Informar a lista de e-mail que receberão a Nota Fiscal.<BR>Utilize a virgula (,) como separador.<BR><BR>Informação localizada na Aba "E-mail para o Cliente" do Pedido de Venda.
 * @pw_element string $enviar_email Enviar e-mail com o boleto de cobrança gerado pelo faturamento (juntamente com o DANFE e o XML da NF-e).<BR>Preenchimento Obrigatório.<BR><BR>Informar "S" ou "N".<BR><BR>Informação localizada na Aba "E-mail para o Cliente" do Pedido de Venda.
 * @pw_element integer $codVend Código do Vendedor.<BR>Preenchimento Opcional.<BR><BR>Informação localizada no cabeçalho do Pedido de Venda.<BR><BR>Utilize a tag 'codigo' do método 'ListarVendedores' da API<BR>http://app.omie.com.br/api/v1/geral/vendedores/<BR>para obter essa informação.
 * @pw_element integer $codProj Código do Projeto.<BR>Preenchimento Opcional.<BR><BR>Informação localizada na Aba "Informações Adicionais" do Pedido de Venda.<BR><BR>Utilize a tag 'codigo' do método 'ListarProjetos' da API<BR>http://app.omie.com.br/api/v1/geral/projetos/<BR>para obter essa informação.
 * @pw_element outros_detalhes $outros_detalhes Outros detalhes da NF-e.<BR>Preenchimento Opcional.
 * @pw_complex informacoes_adicionais
 */
class informacoes_adicionais{
	/**
	 * Código da categoria.<BR>Preenchimento Obrigatório.<BR><BR>Informação localizada na Aba "Informações Adicionais" do Pedido de Venda.<BR><BR>Utilize a tag 'codigo' do método 'ListarCategorias' da API<BR>http://app.omie.com.br/api/v1/geral/categorias/<BR>para obter essa informação.
	 *
	 * @var string
	 */
	public $codigo_categoria;
	/**
	 * Código da Conta Corrente.<BR>Preenchimento Obrigatório.<BR><BR>Informação localizada na Aba "Informações Adicionais" do Pedido de Venda.<BR><BR>Utilize a tag 'codigo' do método 'PesquisarContaCorrente' da API<BR>http://app.omie.com.br/api/v1/geral/contacorrente/<BR>para obter essa informação.
	 *
	 * @var integer
	 */
	public $codigo_conta_corrente;
	/**
	 * Número do pedido do cliente.<BR>Preenchimento Opcional.<BR><BR>Informação localizada na Aba "Informações Adicionais" do Pedido de Venda.
	 *
	 * @var string
	 */
	public $numero_pedido_cliente;
	/**
	 * Número do Contrato de Venda.<BR>Preenchimento Opcional.<BR><BR>Informação localizada na Aba "Informações Adicionais" do Pedido de Venda.
	 *
	 * @var string
	 */
	public $numero_contrato;
	/**
	 * Contato.<BR>Preenchimento Opcional.<BR><BR>Informação localizada na Aba "Informações Adicionais" do Pedido de Venda.
	 *
	 * @var string
	 */
	public $contato;
	/**
	 * Dados adicionais para a Nota Fiscal.<BR>Preenchimento Opcional.<BR><BR>Utilize o caracter pipe ( | ) como separador de linha.<BR><BR>Informação localizada na Aba "Informações Adicionais" do Pedido de Venda.
	 *
	 * @var string
	 */
	public $dados_adicionais_nf;
	/**
	 * Nota Fiscal para Consumo Final.<BR>Preenchimento Obrigatório.<BR><BR>Informar "S" ou "N".<BR><BR>Informação localizada na Aba "Informações Adicionais" do Pedido de Venda.
	 *
	 * @var string
	 */
	public $consumidor_final;
	/**
	 * Utilizar os seguintes endereços de e-mail.<BR>Preenchimento Obrigatório.<BR><BR>Informar a lista de e-mail que receberão a Nota Fiscal.<BR>Utilize a virgula (,) como separador.<BR><BR>Informação localizada na Aba "E-mail para o Cliente" do Pedido de Venda.
	 *
	 * @var string
	 */
	public $utilizar_emails;
	/**
	 * Enviar e-mail com o boleto de cobrança gerado pelo faturamento (juntamente com o DANFE e o XML da NF-e).<BR>Preenchimento Obrigatório.<BR><BR>Informar "S" ou "N".<BR><BR>Informação localizada na Aba "E-mail para o Cliente" do Pedido de Venda.
	 *
	 * @var string
	 */
	public $enviar_email;
	/**
	 * Código do Vendedor.<BR>Preenchimento Opcional.<BR><BR>Informação localizada no cabeçalho do Pedido de Venda.<BR><BR>Utilize a tag 'codigo' do método 'ListarVendedores' da API<BR>http://app.omie.com.br/api/v1/geral/vendedores/<BR>para obter essa informação.
	 *
	 * @var integer
	 */
	public $codVend;
	/**
	 * Código do Projeto.<BR>Preenchimento Opcional.<BR><BR>Informação localizada na Aba "Informações Adicionais" do Pedido de Venda.<BR><BR>Utilize a tag 'codigo' do método 'ListarProjetos' da API<BR>http://app.omie.com.br/api/v1/geral/projetos/<BR>para obter essa informação.
	 *
	 * @var integer
	 */
	public $codProj;
	/**
	 * Outros detalhes da NF-e.<BR>Preenchimento Opcional.
	 *
	 * @var outros_detalhes
	 */
	public $outros_detalhes;
}

/**
 * Outros detalhes da NF-e.
 *
 * @pw_element string $cNatOperacaoOd Natureza da Operação.<BR>Preenchimento Opcional.<BR><BR>Informação localizada na Aba "Informações Adicionais" do Pedido de Venda.
 * @pw_element string $cIndicadorOd Indicador de Presença da Operação.<BR>Preenchimento Opcional.<BR><BR>Se não informado, utilizaremos automaticamente o "9 - Outros".<BR><BR>Informação localizada na Aba "Informações Adicionais" do Pedido de Venda.
 * @pw_element string $dDataSaidaOd Data de Saída.<BR>Preenchimento Opcional.<BR><BR>Informação localizada na Aba "Informações Adicionais" do Pedido de Venda.
 * @pw_element string $cHoraSaidaOd Hora de Saída.<BR>Preenchimento Opcional.<BR><BR>Informação localizada na Aba "Informações Adicionais" do Pedido de Venda.
 * @pw_element string $cCnpjCpfOd CNPJ / CPF (do recebedor).<BR>Preenchimento Opcional.<BR><BR>Informação localizada na Aba "Informações Adicionais" do Pedido de Venda.
 * @pw_element string $cEnderecoOd Endereço.<BR>Preenchimento Opcional.<BR><BR>Informação localizada na Aba "Informações Adicionais" do Pedido de Venda.
 * @pw_element string $cNumeroOd Número do endereço.<BR>Preenchimento Opcional.<BR><BR>Informação localizada na Aba "Informações Adicionais" do Pedido de Venda.
 * @pw_element string $cComplementoOd Complemento do endereço.<BR>Preenchimento Opcional.<BR><BR>Informação localizada na Aba "Informações Adicionais" do Pedido de Venda.
 * @pw_element string $cBairroOd Bairro.<BR>Preenchimento Opcional.<BR><BR>Informação localizada na Aba "Informações Adicionais" do Pedido de Venda.
 * @pw_element string $cEstadoOd Estado.<BR>Preenchimento Opcional.<BR><BR>Informação localizada na Aba "Informações Adicionais" do Pedido de Venda.
 * @pw_element string $cCidadeOd Cidade.<BR>Preenchimento Opcional.<BR><BR>Utilize o padrão: CIDADE (UF), como no exemplo:<BR><BR>'SAO PAULO (SP)'<BR><BR>Informação localizada na Aba "Informações Adicionais" do Pedido de Venda.<BR><BR>Utilize a tag 'cCod' do método 'PesquisarCidades' da API<BR>http://app.omie.com.br/api/v1/geral/cidades/<BR>para obter essa informação.
 * @pw_complex outros_detalhes
 */
class outros_detalhes{
	/**
	 * Natureza da Operação.<BR>Preenchimento Opcional.<BR><BR>Informação localizada na Aba "Informações Adicionais" do Pedido de Venda.
	 *
	 * @var string
	 */
	public $cNatOperacaoOd;
	/**
	 * Indicador de Presença da Operação.<BR>Preenchimento Opcional.<BR><BR>Se não informado, utilizaremos automaticamente o "9 - Outros".<BR><BR>Informação localizada na Aba "Informações Adicionais" do Pedido de Venda.
	 *
	 * @var string
	 */
	public $cIndicadorOd;
	/**
	 * Data de Saída.<BR>Preenchimento Opcional.<BR><BR>Informação localizada na Aba "Informações Adicionais" do Pedido de Venda.
	 *
	 * @var string
	 */
	public $dDataSaidaOd;
	/**
	 * Hora de Saída.<BR>Preenchimento Opcional.<BR><BR>Informação localizada na Aba "Informações Adicionais" do Pedido de Venda.
	 *
	 * @var string
	 */
	public $cHoraSaidaOd;
	/**
	 * CNPJ / CPF (do recebedor).<BR>Preenchimento Opcional.<BR><BR>Informação localizada na Aba "Informações Adicionais" do Pedido de Venda.
	 *
	 * @var string
	 */
	public $cCnpjCpfOd;
	/**
	 * Endereço.<BR>Preenchimento Opcional.<BR><BR>Informação localizada na Aba "Informações Adicionais" do Pedido de Venda.
	 *
	 * @var string
	 */
	public $cEnderecoOd;
	/**
	 * Número do endereço.<BR>Preenchimento Opcional.<BR><BR>Informação localizada na Aba "Informações Adicionais" do Pedido de Venda.
	 *
	 * @var string
	 */
	public $cNumeroOd;
	/**
	 * Complemento do endereço.<BR>Preenchimento Opcional.<BR><BR>Informação localizada na Aba "Informações Adicionais" do Pedido de Venda.
	 *
	 * @var string
	 */
	public $cComplementoOd;
	/**
	 * Bairro.<BR>Preenchimento Opcional.<BR><BR>Informação localizada na Aba "Informações Adicionais" do Pedido de Venda.
	 *
	 * @var string
	 */
	public $cBairroOd;
	/**
	 * Estado.<BR>Preenchimento Opcional.<BR><BR>Informação localizada na Aba "Informações Adicionais" do Pedido de Venda.
	 *
	 * @var string
	 */
	public $cEstadoOd;
	/**
	 * Cidade.<BR>Preenchimento Opcional.<BR><BR>Utilize o padrão: CIDADE (UF), como no exemplo:<BR><BR>'SAO PAULO (SP)'<BR><BR>Informação localizada na Aba "Informações Adicionais" do Pedido de Venda.<BR><BR>Utilize a tag 'cCod' do método 'PesquisarCidades' da API<BR>http://app.omie.com.br/api/v1/geral/cidades/<BR>para obter essa informação.
	 *
	 * @var string
	 */
	public $cCidadeOd;
}

/**
 * Dados da Aba 'Parcelas' do Pedido de Venda.
 *
 * @pw_element parcelaArray $parcela Dados da parcela.
 * @pw_complex lista_parcelas
 */
class lista_parcelas{
	/**
	 * Dados da parcela.
	 *
	 * @var parcelaArray
	 */
	public $parcela;
}

/**
 * Dados da parcela.
 *
 * @pw_element integer $numero_parcela Número da Parcela.<BR>Preenchimento Obrigatório.<BR><BR>Informação localizada na Aba "Parcelas" do Pedido de Venda.
 * @pw_element decimal $valor Valor da Parcela.<BR>Preenchimento Obrigatório.<BR><BR>Informação localizada na Aba "Parcelas" do Pedido de Venda.
 * @pw_element decimal $percentual Percentual.<BR>Preenchimento Obrigatório.<BR><BR>Informação localizada na Aba "Parcelas" do Pedido de Venda.
 * @pw_element string $data_vencimento Data de Vencimento.<BR>Preenchimento Obrigatório.<BR><BR>Informação localizada na Aba "Parcelas" do Pedido de Venda.
 * @pw_element integer $quantidade_dias Quantidade de dias até o vencimento.<BR>Preenchimento Opcional.<BR><BR>Informação localizada na Aba "Parcelas" do Pedido de Venda.
 * @pw_complex parcela
 */
class parcela{
	/**
	 * Número da Parcela.<BR>Preenchimento Obrigatório.<BR><BR>Informação localizada na Aba "Parcelas" do Pedido de Venda.
	 *
	 * @var integer
	 */
	public $numero_parcela;
	/**
	 * Valor da Parcela.<BR>Preenchimento Obrigatório.<BR><BR>Informação localizada na Aba "Parcelas" do Pedido de Venda.
	 *
	 * @var decimal
	 */
	public $valor;
	/**
	 * Percentual.<BR>Preenchimento Obrigatório.<BR><BR>Informação localizada na Aba "Parcelas" do Pedido de Venda.
	 *
	 * @var decimal
	 */
	public $percentual;
	/**
	 * Data de Vencimento.<BR>Preenchimento Obrigatório.<BR><BR>Informação localizada na Aba "Parcelas" do Pedido de Venda.
	 *
	 * @var string
	 */
	public $data_vencimento;
	/**
	 * Quantidade de dias até o vencimento.<BR>Preenchimento Opcional.<BR><BR>Informação localizada na Aba "Parcelas" do Pedido de Venda.
	 *
	 * @var integer
	 */
	public $quantidade_dias;
}


/**
 * Lista de NF-es geradas
 *
 * @pw_element integer $numero_lote Número do lote da NF-e
 * @pw_element string $status_lote Status do Lote da NF-e.
 * @pw_element integer $recibo Recibo
 * @pw_element string $contingencia NF-e emitida em contingência
 * @pw_element string $numero_nfe Número da NF-e gerada
 * @pw_element string $status_nfe Chave de Acesso da NF-e
 * @pw_element string $chave_nfe Chave de Acesso da NF-e
 * @pw_element integer $protocolo Número do Protocolo
 * @pw_element string $tipo Tipo de Emissão.<BR>Pode ser:<BR>E - Entrada<BR>S - Saída
 * @pw_element string $data_emissao Data da Emissão da NF-e
 * @pw_element string $hora_emissao Hora da Emissão da NF-e
 * @pw_element string $data_fatura Data do faturamento
 * @pw_element string $hora_fatura Hora de Faturamento
 * @pw_element string $data_saida Data de Saída
 * @pw_element string $hora_saida Hora de Saída da NF-e
 * @pw_element mensagensArray $mensagens Mensagens de Erros
 * @pw_element string $xml_distr XML de distribuição da NF-e
 * @pw_element string $danfe Link para o DANFE da NF-e gerada.
 * @pw_complex ListaNfe
 */
class ListaNfe{
	/**
	 * Número do lote da NF-e
	 *
	 * @var integer
	 */
	public $numero_lote;
	/**
	 * Status do Lote da NF-e.
	 *
	 * @var string
	 */
	public $status_lote;
	/**
	 * Recibo
	 *
	 * @var integer
	 */
	public $recibo;
	/**
	 * NF-e emitida em contingência
	 *
	 * @var string
	 */
	public $contingencia;
	/**
	 * Número da NF-e gerada
	 *
	 * @var string
	 */
	public $numero_nfe;
	/**
	 * Chave de Acesso da NF-e
	 *
	 * @var string
	 */
	public $status_nfe;
	/**
	 * Chave de Acesso da NF-e
	 *
	 * @var string
	 */
	public $chave_nfe;
	/**
	 * Número do Protocolo
	 *
	 * @var integer
	 */
	public $protocolo;
	/**
	 * Tipo de Emissão.<BR>Pode ser:<BR>E - Entrada<BR>S - Saída
	 *
	 * @var string
	 */
	public $tipo;
	/**
	 * Data da Emissão da NF-e
	 *
	 * @var string
	 */
	public $data_emissao;
	/**
	 * Hora da Emissão da NF-e
	 *
	 * @var string
	 */
	public $hora_emissao;
	/**
	 * Data do faturamento
	 *
	 * @var string
	 */
	public $data_fatura;
	/**
	 * Hora de Faturamento
	 *
	 * @var string
	 */
	public $hora_fatura;
	/**
	 * Data de Saída
	 *
	 * @var string
	 */
	public $data_saida;
	/**
	 * Hora de Saída da NF-e
	 *
	 * @var string
	 */
	public $hora_saida;
	/**
	 * Mensagens de Erros
	 *
	 * @var mensagensArray
	 */
	public $mensagens;
	/**
	 * XML de distribuição da NF-e
	 *
	 * @var string
	 */
	public $xml_distr;
	/**
	 * Link para o DANFE da NF-e gerada.
	 *
	 * @var string
	 */
	public $danfe;
}


/**
 * Mensagens de Erros
 *
 * @pw_element string $cCodigo Código da mensagem de erro/aviso
 * @pw_element string $cDescricao Descrição da mensagem de erro/aviso.
 * @pw_element string $cCorrecao Correção da descrição de mensagem de erro/aviso.
 * @pw_complex mensagens
 */
class mensagens{
	/**
	 * Código da mensagem de erro/aviso
	 *
	 * @var string
	 */
	public $cCodigo;
	/**
	 * Descrição da mensagem de erro/aviso.
	 *
	 * @var string
	 */
	public $cDescricao;
	/**
	 * Correção da descrição de mensagem de erro/aviso.
	 *
	 * @var string
	 */
	public $cCorrecao;
}


/**
 * Dados da Aba 'Observações' do Pedido de Venda.
 *
 * @pw_element string $obs_venda Observações da venda (elas não serão exibidas na Nota Fiscal).<BR>Preenchimento Opcional.<BR><BR>Informação localizada na Aba 'Observações' do Pedido de Venda.<BR>
 * @pw_complex observacoes
 */
class observacoes{
	/**
	 * Observações da venda (elas não serão exibidas na Nota Fiscal).<BR>Preenchimento Opcional.<BR><BR>Informação localizada na Aba 'Observações' do Pedido de Venda.<BR>
	 *
	 * @var string
	 */
	public $obs_venda;
}

/**
 * Estrutura do Pedido de Vendas de Produtos.
 *
 * @pw_element cabecalho $cabecalho Informações do cabeçalho do pedido.<BR>Preenchimento Obrigatório.
 * @pw_element departamentosArray $departamentos Dados da Aba "Departamentos" do Pedido de Venda.
 * @pw_element frete $frete Dados da Aba 'Frete e Outras Despesas' do Pedido de Venda.<BR>Preenchimento Opcional.
 * @pw_element informacoes_adicionais $informacoes_adicionais Dados da Aba 'Informações Adicionais' do Pedido de Venda.<BR>Preenchimento Obrigatório.<BR><BR>
 * @pw_element lista_parcelas $lista_parcelas Dados da Aba 'Parcelas' do Pedido de Venda.<BR><BR>Preenchimento Obrigatório quando a conteúdo da tag "codigo_parcela" for igual a '999'. <BR>Para todos os outros códigos o preenchimento é automático - Não informar essa estrutura.
 * @pw_element observacoes $observacoes Dados da Aba 'Observações' do Pedido de Venda.<BR>Preenchimento Opcional.
 * @pw_element detArray $det Dados da Aba 'Itens da Venda' do Pedido de Venda.<BR>Preenchimento Obrigatório.
 * @pw_element total_pedido $total_pedido Valores totais do pedido.<BR>Preenchimento automático - Não informar.
 * @pw_element infoCadastro $infoCadastro Informações complementares do pedido.<BR>Preenchimento automático - Não informar.
 * @pw_complex pedido_venda_produto
 */
class pedido_venda_produto{
	/**
	 * Informações do cabeçalho do pedido.<BR>Preenchimento Obrigatório.
	 *
	 * @var cabecalho
	 */
	public $cabecalho;
	/**
	 * Dados da Aba "Departamentos" do Pedido de Venda.
	 *
	 * @var departamentosArray
	 */
	public $departamentos;
	/**
	 * Dados da Aba 'Frete e Outras Despesas' do Pedido de Venda.<BR>Preenchimento Opcional.
	 *
	 * @var frete
	 */
	public $frete;
	/**
	 * Dados da Aba 'Informações Adicionais' do Pedido de Venda.<BR>Preenchimento Obrigatório.<BR><BR>
	 *
	 * @var informacoes_adicionais
	 */
	public $informacoes_adicionais;
	/**
	 * Dados da Aba 'Parcelas' do Pedido de Venda.<BR><BR>Preenchimento Obrigatório quando a conteúdo da tag "codigo_parcela" for igual a '999'. <BR>Para todos os outros códigos o preenchimento é automático - Não informar essa estrutura.
	 *
	 * @var lista_parcelas
	 */
	public $lista_parcelas;
	/**
	 * Dados da Aba 'Observações' do Pedido de Venda.<BR>Preenchimento Opcional.
	 *
	 * @var observacoes
	 */
	public $observacoes;
	/**
	 * Dados da Aba 'Itens da Venda' do Pedido de Venda.<BR>Preenchimento Obrigatório.
	 *
	 * @var detArray
	 */
	public $det;
	/**
	 * Valores totais do pedido.<BR>Preenchimento automático - Não informar.
	 *
	 * @var total_pedido
	 */
	public $total_pedido;
	/**
	 * Informações complementares do pedido.<BR>Preenchimento automático - Não informar.
	 *
	 * @var infoCadastro
	 */
	public $infoCadastro;
}


/**
 * Valores totais do pedido.
 *
 * @pw_element decimal $base_calculo_icms Base de Cálculo do ICMS.<BR>Preenchimento automático - Não informar.
 * @pw_element decimal $base_calculo_st Base de cálculo da substituição tributária.<BR>Preenchimento automático - Não informar.
 * @pw_element decimal $valor_pis Valor do PIS.<BR>Preenchimento automático - Não informar.
 * @pw_element decimal $valor_cofins Valor do cofins.<BR>Preenchimento automático - Não informar.
 * @pw_element decimal $valor_csll Valor da CSLL.<BR>Preenchimento automático - Não informar.
 * @pw_element decimal $valor_icms Valor total do ICMS.<BR>Preenchimento automático - Não informar.
 * @pw_element decimal $valor_st Valor total da ST.<BR>Preenchimento automático - Não informar.&nbsp;
 * @pw_element decimal $valor_inss Valor do INSS.<BR>Preenchimento automático - Não informar.&nbsp;
 * @pw_element decimal $valor_IPI Valor do IPI.<BR>Preenchimento automático - Não informar.&nbsp;
 * @pw_element decimal $valor_ir Valor do IR.<BR>.Preenchimento automático - Não informar.
 * @pw_element decimal $valor_iss Valor do ISS.<BR>Preenchimento automático - Não informar.&nbsp;
 * @pw_element decimal $valor_deducoes Valor das deduções.<BR>Preenchimento automático - Não informar.
 * @pw_element decimal $valor_descontos Valor dos descontos.<BR>Preenchimento automático - Não informar.
 * @pw_element decimal $valor_mercadorias valor das mercadorias.<BR>Preenchimento automático - Não informar.
 * @pw_element decimal $valor_total_pedido Valor total do pedido
 * @pw_complex total_pedido
 */
class total_pedido{
	/**
	 * Base de Cálculo do ICMS.<BR>Preenchimento automático - Não informar.
	 *
	 * @var decimal
	 */
	public $base_calculo_icms;
	/**
	 * Base de cálculo da substituição tributária.<BR>Preenchimento automático - Não informar.
	 *
	 * @var decimal
	 */
	public $base_calculo_st;
	/**
	 * Valor do PIS.<BR>Preenchimento automático - Não informar.
	 *
	 * @var decimal
	 */
	public $valor_pis;
	/**
	 * Valor do cofins.<BR>Preenchimento automático - Não informar.
	 *
	 * @var decimal
	 */
	public $valor_cofins;
	/**
	 * Valor da CSLL.<BR>Preenchimento automático - Não informar.
	 *
	 * @var decimal
	 */
	public $valor_csll;
	/**
	 * Valor total do ICMS.<BR>Preenchimento automático - Não informar.
	 *
	 * @var decimal
	 */
	public $valor_icms;
	/**
	 * Valor total da ST.<BR>Preenchimento automático - Não informar.&nbsp;
	 *
	 * @var decimal
	 */
	public $valor_st;
	/**
	 * Valor do INSS.<BR>Preenchimento automático - Não informar.&nbsp;
	 *
	 * @var decimal
	 */
	public $valor_inss;
	/**
	 * Valor do IPI.<BR>Preenchimento automático - Não informar.&nbsp;
	 *
	 * @var decimal
	 */
	public $valor_IPI;
	/**
	 * Valor do IR.<BR>.Preenchimento automático - Não informar.
	 *
	 * @var decimal
	 */
	public $valor_ir;
	/**
	 * Valor do ISS.<BR>Preenchimento automático - Não informar.&nbsp;
	 *
	 * @var decimal
	 */
	public $valor_iss;
	/**
	 * Valor das deduções.<BR>Preenchimento automático - Não informar.
	 *
	 * @var decimal
	 */
	public $valor_deducoes;
	/**
	 * Valor dos descontos.<BR>Preenchimento automático - Não informar.
	 *
	 * @var decimal
	 */
	public $valor_descontos;
	/**
	 * valor das mercadorias.<BR>Preenchimento automático - Não informar.
	 *
	 * @var decimal
	 */
	public $valor_mercadorias;
	/**
	 * Valor total do pedido
	 *
	 * @var decimal
	 */
	public $valor_total_pedido;
}

/**
 * Resposta da Inclusão de Pedido de Venda de Produtos.
 *
 * @pw_element integer $codigo_pedido ID do pedido do venda.<BR>Preenchimento automático na inclusão - Informe esse campo somente para pesquisa.<BR><BR>Esse campo não é exibido na tela do Pedido de Vendas. <BR>É uma informação interna, utilizada apenas nas APIs.
 * @pw_element string $codigo_pedido_integracao Código de integração do pedido de venda.<BR>Preenchimento Obrigatório na inclusão/alteração.<BR>Preenchimento Opcional na Consulta/Pesquisa.<BR><BR>Preencha esse campo com o código do pedido no aplicativo que você está integração com o Omie. A função dele é servir como uma mapa de relacionamento entre as aplicações. Ao realizar uma consulta/listagem de pedidos você conseguirá ver a relação entre o id do pedido gerado no Omie e o código de pedido existente em sua aplicação.<BR>
 * @pw_element string $codigo_status Código do Status do Pedido de Venda.
 * @pw_element string $descricao_status Descrição do status&nbsp;&nbsp;
 * @pw_element string $numero_pedido Número do pedido de venda.<BR>Preenchimento automático na inclusão/alteração.<BR>Preenchimento disponível apenas na consulta/pesquisa.<BR><BR>Esse é o número do pedido de venda no Omie, que é gerado automaticamente e exibido na tela.<BR>
 * @pw_complex pedido_venda_produto_response
 */
class pedido_venda_produto_response{
	/**
	 * ID do pedido do venda.<BR>Preenchimento automático na inclusão - Informe esse campo somente para pesquisa.<BR><BR>Esse campo não é exibido na tela do Pedido de Vendas. <BR>É uma informação interna, utilizada apenas nas APIs.
	 *
	 * @var integer
	 */
	public $codigo_pedido;
	/**
	 * Código de integração do pedido de venda.<BR>Preenchimento Obrigatório na inclusão/alteração.<BR>Preenchimento Opcional na Consulta/Pesquisa.<BR><BR>Preencha esse campo com o código do pedido no aplicativo que você está integração com o Omie. A função dele é servir como uma mapa de relacionamento entre as aplicações. Ao realizar uma consulta/listagem de pedidos você conseguirá ver a relação entre o id do pedido gerado no Omie e o código de pedido existente em sua aplicação.<BR>
	 *
	 * @var string
	 */
	public $codigo_pedido_integracao;
	/**
	 * Código do Status do Pedido de Venda.
	 *
	 * @var string
	 */
	public $codigo_status;
	/**
	 * Descrição do status&nbsp;&nbsp;
	 *
	 * @var string
	 */
	public $descricao_status;
	/**
	 * Número do pedido de venda.<BR>Preenchimento automático na inclusão/alteração.<BR>Preenchimento disponível apenas na consulta/pesquisa.<BR><BR>Esse é o número do pedido de venda no Omie, que é gerado automaticamente e exibido na tela.<BR>
	 *
	 * @var string
	 */
	public $numero_pedido;
}

/**
 * Solicitação de consulta de pedido de venda.
 *
 * @pw_element integer $codigo_pedido ID do pedido do venda.<BR>Preenchimento automático na inclusão - Informe esse campo somente para pesquisa.<BR><BR>Esse campo não é exibido na tela do Pedido de Vendas. <BR>É uma informação interna, utilizada apenas nas APIs.
 * @pw_element string $codigo_pedido_integracao Código de integração do pedido de venda.<BR>Preenchimento Obrigatório na inclusão/alteração.<BR>Preenchimento Opcional na Consulta/Pesquisa.<BR><BR>Preencha esse campo com o código do pedido no aplicativo que você está integração com o Omie. A função dele é servir como uma mapa de relacionamento entre as aplicações. Ao realizar uma consulta/listagem de pedidos você conseguirá ver a relação entre o id do pedido gerado no Omie e o código de pedido existente em sua aplicação.<BR>
 * @pw_element string $numero_pedido Número do pedido de venda.<BR>Preenchimento automático na inclusão/alteração.<BR>Preenchimento disponível apenas na consulta/pesquisa.<BR><BR>Esse é o número do pedido de venda no Omie, que é gerado automaticamente e exibido na tela.<BR>
 * @pw_complex pvpConsultarRequest
 */
class pvpConsultarRequest{
	/**
	 * ID do pedido do venda.<BR>Preenchimento automático na inclusão - Informe esse campo somente para pesquisa.<BR><BR>Esse campo não é exibido na tela do Pedido de Vendas. <BR>É uma informação interna, utilizada apenas nas APIs.
	 *
	 * @var integer
	 */
	public $codigo_pedido;
	/**
	 * Código de integração do pedido de venda.<BR>Preenchimento Obrigatório na inclusão/alteração.<BR>Preenchimento Opcional na Consulta/Pesquisa.<BR><BR>Preencha esse campo com o código do pedido no aplicativo que você está integração com o Omie. A função dele é servir como uma mapa de relacionamento entre as aplicações. Ao realizar uma consulta/listagem de pedidos você conseguirá ver a relação entre o id do pedido gerado no Omie e o código de pedido existente em sua aplicação.<BR>
	 *
	 * @var string
	 */
	public $codigo_pedido_integracao;
	/**
	 * Número do pedido de venda.<BR>Preenchimento automático na inclusão/alteração.<BR>Preenchimento disponível apenas na consulta/pesquisa.<BR><BR>Esse é o número do pedido de venda no Omie, que é gerado automaticamente e exibido na tela.<BR>
	 *
	 * @var string
	 */
	public $numero_pedido;
}

/**
 * Resposta da solicitação de consulta de pedido de venda.
 *
 * @pw_element pedido_venda_produto $pedido_venda_produto Estrutura do Pedido de Vendas de Produtos.<BR>Preenchimento Obrigatório.
 * @pw_complex pvpConsultarResponse
 */
class pvpConsultarResponse{
	/**
	 * Estrutura do Pedido de Vendas de Produtos.<BR>Preenchimento Obrigatório.
	 *
	 * @var pedido_venda_produto
	 */
	public $pedido_venda_produto;
}

/**
 * Solicitação de listagem de pedidos de venda.
 *
 * @pw_element integer $pagina Número da página que será listada.
 * @pw_element integer $registros_por_pagina Número de registros por página.
 * @pw_element string $apenas_importado_api Exibir apenas os registros gerados pela API.
 * @pw_element string $ordenar_por Ordem de exibição dos dados. <BR>O padrão é 'CODIGO'
 * @pw_element string $ordem_descrescente Exibir em Ordem Crescente ou Decrescente
 * @pw_element string $filtrar_por_data_de Filtra os registros até a data especificada.
 * @pw_element string $filtrar_por_data_ate Filtra os registros até a data especificada.
 * @pw_element string $filtrar_apenas_inclusao Filtra os registros exibindos apenas os incluídos.
 * @pw_element string $filtrar_apenas_alteracao Filtra os registros exibindos apenas os alterados.
 * @pw_element integer $filtrar_por_cliente Filtro por Cliente de Pedidos de Venda
 * @pw_element string $etapa Etapa do pedido de venda.<BR>Preenchimento Obrigatório.<BR><BR>Esse campo indica em que coluna o pedido de venda irá figurar no processo de faturamento do Omie.<BR><BR>Utilize a tag 'codigo' do método 'ListarEtapasFaturamento' da API<BR>http://app.omie.com.br/api/v1/produtos/etapafat/<BR>para obter essa informação.<BR><BR>Os valores são fixos, mas as descrições (funções atribuídas a cada coluna pode mudar. A API irá indicar a descrição de cada coluna.<BR><BR>Os valores disponíveis para esse campo podem ser:<BR><BR>'10' - Primeira coluna<BR>'20' - Segunda coluna<BR>'30' - Terceira coluna<BR>'40' - Quarta coluna<BR>'50' - Faturar
 * @pw_complex pvpListarRequest
 */
class pvpListarRequest{
	/**
	 * Número da página que será listada.
	 *
	 * @var integer
	 */
	public $pagina;
	/**
	 * Número de registros por página.
	 *
	 * @var integer
	 */
	public $registros_por_pagina;
	/**
	 * Exibir apenas os registros gerados pela API.
	 *
	 * @var string
	 */
	public $apenas_importado_api;
	/**
	 * Ordem de exibição dos dados. <BR>O padrão é 'CODIGO'
	 *
	 * @var string
	 */
	public $ordenar_por;
	/**
	 * Exibir em Ordem Crescente ou Decrescente
	 *
	 * @var string
	 */
	public $ordem_descrescente;
	/**
	 * Filtra os registros até a data especificada.
	 *
	 * @var string
	 */
	public $filtrar_por_data_de;
	/**
	 * Filtra os registros até a data especificada.
	 *
	 * @var string
	 */
	public $filtrar_por_data_ate;
	/**
	 * Filtra os registros exibindos apenas os incluídos.
	 *
	 * @var string
	 */
	public $filtrar_apenas_inclusao;
	/**
	 * Filtra os registros exibindos apenas os alterados.
	 *
	 * @var string
	 */
	public $filtrar_apenas_alteracao;
	/**
	 * Filtro por Cliente de Pedidos de Venda
	 *
	 * @var integer
	 */
	public $filtrar_por_cliente;
	/**
	 * Etapa do pedido de venda.<BR>Preenchimento Obrigatório.<BR><BR>Esse campo indica em que coluna o pedido de venda irá figurar no processo de faturamento do Omie.<BR><BR>Utilize a tag 'codigo' do método 'ListarEtapasFaturamento' da API<BR>http://app.omie.com.br/api/v1/produtos/etapafat/<BR>para obter essa informação.<BR><BR>Os valores são fixos, mas as descrições (funções atribuídas a cada coluna pode mudar. A API irá indicar a descrição de cada coluna.<BR><BR>Os valores disponíveis para esse campo podem ser:<BR><BR>'10' - Primeira coluna<BR>'20' - Segunda coluna<BR>'30' - Terceira coluna<BR>'40' - Quarta coluna<BR>'50' - Faturar
	 *
	 * @var string
	 */
	public $etapa;
}

/**
 * Resposta da solicitação de listagem de pedidos de venda.
 *
 * @pw_element integer $pagina Número da página que será listada.
 * @pw_element integer $total_de_paginas Total de páginas encontradas.
 * @pw_element integer $registros Número de registros por página.
 * @pw_element integer $total_de_registros Total de registros encontrados.
 * @pw_element pedido_venda_produtoArray $pedido_venda_produto Estrutura do Pedido de Vendas de Produtos.<BR>Preenchimento Obrigatório.
 * @pw_complex pvpListarResponse
 */
class pvpListarResponse{
	/**
	 * Número da página que será listada.
	 *
	 * @var integer
	 */
	public $pagina;
	/**
	 * Total de páginas encontradas.
	 *
	 * @var integer
	 */
	public $total_de_paginas;
	/**
	 * Número de registros por página.
	 *
	 * @var integer
	 */
	public $registros;
	/**
	 * Total de registros encontrados.
	 *
	 * @var integer
	 */
	public $total_de_registros;
	/**
	 * Estrutura do Pedido de Vendas de Produtos.<BR>Preenchimento Obrigatório.
	 *
	 * @var pedido_venda_produtoArray
	 */
	public $pedido_venda_produto;
}

/**
 * Solicitação de consulta do Status do Pedido de Venda.
 *
 * @pw_element integer $codigo_pedido ID do pedido do venda.<BR>Preenchimento automático na inclusão - Informe esse campo somente para pesquisa.<BR><BR>Esse campo não é exibido na tela do Pedido de Vendas. <BR>É uma informação interna, utilizada apenas nas APIs.
 * @pw_element string $codigo_pedido_integracao Código de integração do pedido de venda.<BR>Preenchimento Obrigatório na inclusão/alteração.<BR>Preenchimento Opcional na Consulta/Pesquisa.<BR><BR>Preencha esse campo com o código do pedido no aplicativo que você está integração com o Omie. A função dele é servir como uma mapa de relacionamento entre as aplicações. Ao realizar uma consulta/listagem de pedidos você conseguirá ver a relação entre o id do pedido gerado no Omie e o código de pedido existente em sua aplicação.<BR>
 * @pw_complex pvpStatusRequest
 */
class pvpStatusRequest{
	/**
	 * ID do pedido do venda.<BR>Preenchimento automático na inclusão - Informe esse campo somente para pesquisa.<BR><BR>Esse campo não é exibido na tela do Pedido de Vendas. <BR>É uma informação interna, utilizada apenas nas APIs.
	 *
	 * @var integer
	 */
	public $codigo_pedido;
	/**
	 * Código de integração do pedido de venda.<BR>Preenchimento Obrigatório na inclusão/alteração.<BR>Preenchimento Opcional na Consulta/Pesquisa.<BR><BR>Preencha esse campo com o código do pedido no aplicativo que você está integração com o Omie. A função dele é servir como uma mapa de relacionamento entre as aplicações. Ao realizar uma consulta/listagem de pedidos você conseguirá ver a relação entre o id do pedido gerado no Omie e o código de pedido existente em sua aplicação.<BR>
	 *
	 * @var string
	 */
	public $codigo_pedido_integracao;
}

/**
 * Resposta da solicitação de consulta do Status do Pedido de Venda.
 *
 * @pw_element integer $codigo_pedido ID do pedido do venda.<BR>Preenchimento automático na inclusão - Informe esse campo somente para pesquisa.<BR><BR>Esse campo não é exibido na tela do Pedido de Vendas. <BR>É uma informação interna, utilizada apenas nas APIs.
 * @pw_element string $codigo_pedido_integracao Código de integração do pedido de venda.<BR>Preenchimento Obrigatório na inclusão/alteração.<BR>Preenchimento Opcional na Consulta/Pesquisa.<BR><BR>Preencha esse campo com o código do pedido no aplicativo que você está integração com o Omie. A função dele é servir como uma mapa de relacionamento entre as aplicações. Ao realizar uma consulta/listagem de pedidos você conseguirá ver a relação entre o id do pedido gerado no Omie e o código de pedido existente em sua aplicação.<BR>
 * @pw_element string $numero_pedido Número do pedido de venda.<BR>Preenchimento automático na inclusão/alteração.<BR>Preenchimento disponível apenas na consulta/pesquisa.<BR><BR>Esse é o número do pedido de venda no Omie, que é gerado automaticamente e exibido na tela.<BR>
 * @pw_element string $etapa Etapa do pedido de venda.<BR>Preenchimento Obrigatório.<BR><BR>Esse campo indica em que coluna o pedido de venda irá figurar no processo de faturamento do Omie.<BR><BR>Utilize a tag 'codigo' do método 'ListarEtapasFaturamento' da API<BR>http://app.omie.com.br/api/v1/produtos/etapafat/<BR>para obter essa informação.<BR><BR>Os valores são fixos, mas as descrições (funções atribuídas a cada coluna pode mudar. A API irá indicar a descrição de cada coluna.<BR><BR>Os valores disponíveis para esse campo podem ser:<BR><BR>'10' - Primeira coluna<BR>'20' - Segunda coluna<BR>'30' - Terceira coluna<BR>'40' - Quarta coluna<BR>'50' - Faturar
 * @pw_element string $cancelada NF-e Cancelada?
 * @pw_element string $faturada Indica que o pedido foi Faturado
 * @pw_element string $ambiente Ambiente da NF-e (Danfe)
 * @pw_element decimal $valor_total_pedido Valor total do pedido
 * @pw_element ListaNfeArray $ListaNfe Lista de NF-es geradas
 * @pw_complex pvpStatusResponse
 */
class pvpStatusResponse{
	/**
	 * ID do pedido do venda.<BR>Preenchimento automático na inclusão - Informe esse campo somente para pesquisa.<BR><BR>Esse campo não é exibido na tela do Pedido de Vendas. <BR>É uma informação interna, utilizada apenas nas APIs.
	 *
	 * @var integer
	 */
	public $codigo_pedido;
	/**
	 * Código de integração do pedido de venda.<BR>Preenchimento Obrigatório na inclusão/alteração.<BR>Preenchimento Opcional na Consulta/Pesquisa.<BR><BR>Preencha esse campo com o código do pedido no aplicativo que você está integração com o Omie. A função dele é servir como uma mapa de relacionamento entre as aplicações. Ao realizar uma consulta/listagem de pedidos você conseguirá ver a relação entre o id do pedido gerado no Omie e o código de pedido existente em sua aplicação.<BR>
	 *
	 * @var string
	 */
	public $codigo_pedido_integracao;
	/**
	 * Número do pedido de venda.<BR>Preenchimento automático na inclusão/alteração.<BR>Preenchimento disponível apenas na consulta/pesquisa.<BR><BR>Esse é o número do pedido de venda no Omie, que é gerado automaticamente e exibido na tela.<BR>
	 *
	 * @var string
	 */
	public $numero_pedido;
	/**
	 * Etapa do pedido de venda.<BR>Preenchimento Obrigatório.<BR><BR>Esse campo indica em que coluna o pedido de venda irá figurar no processo de faturamento do Omie.<BR><BR>Utilize a tag 'codigo' do método 'ListarEtapasFaturamento' da API<BR>http://app.omie.com.br/api/v1/produtos/etapafat/<BR>para obter essa informação.<BR><BR>Os valores são fixos, mas as descrições (funções atribuídas a cada coluna pode mudar. A API irá indicar a descrição de cada coluna.<BR><BR>Os valores disponíveis para esse campo podem ser:<BR><BR>'10' - Primeira coluna<BR>'20' - Segunda coluna<BR>'30' - Terceira coluna<BR>'40' - Quarta coluna<BR>'50' - Faturar
	 *
	 * @var string
	 */
	public $etapa;
	/**
	 * NF-e Cancelada?
	 *
	 * @var string
	 */
	public $cancelada;
	/**
	 * Indica que o pedido foi Faturado
	 *
	 * @var string
	 */
	public $faturada;
	/**
	 * Ambiente da NF-e (Danfe)
	 *
	 * @var string
	 */
	public $ambiente;
	/**
	 * Valor total do pedido
	 *
	 * @var decimal
	 */
	public $valor_total_pedido;
	/**
	 * Lista de NF-es geradas
	 *
	 * @var ListaNfeArray
	 */
	public $ListaNfe;
}

/**
 * Solicitação de troca de etapa do Pedido de Venda.
 *
 * @pw_element integer $codigo_pedido ID do pedido do venda.<BR>Preenchimento automático na inclusão - Informe esse campo somente para pesquisa.<BR><BR>Esse campo não é exibido na tela do Pedido de Vendas. <BR>É uma informação interna, utilizada apenas nas APIs.
 * @pw_element string $codigo_pedido_integracao Código de integração do pedido de venda.<BR>Preenchimento Obrigatório na inclusão/alteração.<BR>Preenchimento Opcional na Consulta/Pesquisa.<BR><BR>Preencha esse campo com o código do pedido no aplicativo que você está integração com o Omie. A função dele é servir como uma mapa de relacionamento entre as aplicações. Ao realizar uma consulta/listagem de pedidos você conseguirá ver a relação entre o id do pedido gerado no Omie e o código de pedido existente em sua aplicação.<BR>
 * @pw_element string $numero_pedido Número do pedido de venda.<BR>Preenchimento automático na inclusão/alteração.<BR>Preenchimento disponível apenas na consulta/pesquisa.<BR><BR>Esse é o número do pedido de venda no Omie, que é gerado automaticamente e exibido na tela.<BR>
 * @pw_element string $etapa Etapa do pedido de venda.<BR>Preenchimento Obrigatório.<BR><BR>Esse campo indica em que coluna o pedido de venda irá figurar no processo de faturamento do Omie.<BR><BR>Utilize a tag 'codigo' do método 'ListarEtapasFaturamento' da API<BR>http://app.omie.com.br/api/v1/produtos/etapafat/<BR>para obter essa informação.<BR><BR>Os valores são fixos, mas as descrições (funções atribuídas a cada coluna pode mudar. A API irá indicar a descrição de cada coluna.<BR><BR>Os valores disponíveis para esse campo podem ser:<BR><BR>'10' - Primeira coluna<BR>'20' - Segunda coluna<BR>'30' - Terceira coluna<BR>'40' - Quarta coluna<BR>'50' - Faturar
 * @pw_complex pvpTrocarEtapaRequest
 */
class pvpTrocarEtapaRequest{
	/**
	 * ID do pedido do venda.<BR>Preenchimento automático na inclusão - Informe esse campo somente para pesquisa.<BR><BR>Esse campo não é exibido na tela do Pedido de Vendas. <BR>É uma informação interna, utilizada apenas nas APIs.
	 *
	 * @var integer
	 */
	public $codigo_pedido;
	/**
	 * Código de integração do pedido de venda.<BR>Preenchimento Obrigatório na inclusão/alteração.<BR>Preenchimento Opcional na Consulta/Pesquisa.<BR><BR>Preencha esse campo com o código do pedido no aplicativo que você está integração com o Omie. A função dele é servir como uma mapa de relacionamento entre as aplicações. Ao realizar uma consulta/listagem de pedidos você conseguirá ver a relação entre o id do pedido gerado no Omie e o código de pedido existente em sua aplicação.<BR>
	 *
	 * @var string
	 */
	public $codigo_pedido_integracao;
	/**
	 * Número do pedido de venda.<BR>Preenchimento automático na inclusão/alteração.<BR>Preenchimento disponível apenas na consulta/pesquisa.<BR><BR>Esse é o número do pedido de venda no Omie, que é gerado automaticamente e exibido na tela.<BR>
	 *
	 * @var string
	 */
	public $numero_pedido;
	/**
	 * Etapa do pedido de venda.<BR>Preenchimento Obrigatório.<BR><BR>Esse campo indica em que coluna o pedido de venda irá figurar no processo de faturamento do Omie.<BR><BR>Utilize a tag 'codigo' do método 'ListarEtapasFaturamento' da API<BR>http://app.omie.com.br/api/v1/produtos/etapafat/<BR>para obter essa informação.<BR><BR>Os valores são fixos, mas as descrições (funções atribuídas a cada coluna pode mudar. A API irá indicar a descrição de cada coluna.<BR><BR>Os valores disponíveis para esse campo podem ser:<BR><BR>'10' - Primeira coluna<BR>'20' - Segunda coluna<BR>'30' - Terceira coluna<BR>'40' - Quarta coluna<BR>'50' - Faturar
	 *
	 * @var string
	 */
	public $etapa;
}

/**
 * Resposta da solicitação de troca de etapa do Pedido de Venda.
 *
 * @pw_element integer $codigo_pedido ID do pedido do venda.<BR>Preenchimento automático na inclusão - Informe esse campo somente para pesquisa.<BR><BR>Esse campo não é exibido na tela do Pedido de Vendas. <BR>É uma informação interna, utilizada apenas nas APIs.
 * @pw_element string $codigo_pedido_integracao Código de integração do pedido de venda.<BR>Preenchimento Obrigatório na inclusão/alteração.<BR>Preenchimento Opcional na Consulta/Pesquisa.<BR><BR>Preencha esse campo com o código do pedido no aplicativo que você está integração com o Omie. A função dele é servir como uma mapa de relacionamento entre as aplicações. Ao realizar uma consulta/listagem de pedidos você conseguirá ver a relação entre o id do pedido gerado no Omie e o código de pedido existente em sua aplicação.<BR>
 * @pw_element string $numero_pedido Número do pedido de venda.<BR>Preenchimento automático na inclusão/alteração.<BR>Preenchimento disponível apenas na consulta/pesquisa.<BR><BR>Esse é o número do pedido de venda no Omie, que é gerado automaticamente e exibido na tela.<BR>
 * @pw_element string $codigo_status Código do Status do Pedido de Venda.
 * @pw_element string $descricao_status Descrição do status&nbsp;&nbsp;
 * @pw_complex pvpTrocarEtapaResponse
 */
class pvpTrocarEtapaResponse{
	/**
	 * ID do pedido do venda.<BR>Preenchimento automático na inclusão - Informe esse campo somente para pesquisa.<BR><BR>Esse campo não é exibido na tela do Pedido de Vendas. <BR>É uma informação interna, utilizada apenas nas APIs.
	 *
	 * @var integer
	 */
	public $codigo_pedido;
	/**
	 * Código de integração do pedido de venda.<BR>Preenchimento Obrigatório na inclusão/alteração.<BR>Preenchimento Opcional na Consulta/Pesquisa.<BR><BR>Preencha esse campo com o código do pedido no aplicativo que você está integração com o Omie. A função dele é servir como uma mapa de relacionamento entre as aplicações. Ao realizar uma consulta/listagem de pedidos você conseguirá ver a relação entre o id do pedido gerado no Omie e o código de pedido existente em sua aplicação.<BR>
	 *
	 * @var string
	 */
	public $codigo_pedido_integracao;
	/**
	 * Número do pedido de venda.<BR>Preenchimento automático na inclusão/alteração.<BR>Preenchimento disponível apenas na consulta/pesquisa.<BR><BR>Esse é o número do pedido de venda no Omie, que é gerado automaticamente e exibido na tela.<BR>
	 *
	 * @var string
	 */
	public $numero_pedido;
	/**
	 * Código do Status do Pedido de Venda.
	 *
	 * @var string
	 */
	public $codigo_status;
	/**
	 * Descrição do status&nbsp;&nbsp;
	 *
	 * @var string
	 */
	public $descricao_status;
}

/**
 * Erro gerado pela aplicação.
 *
 * @pw_element integer $code Codigo do erro
 * @pw_element string $description Descricao do erro
 * @pw_element string $referer Origem do erro
 * @pw_element boolean $fatal Indica se eh um erro fatal
 * @pw_complex omie_fail
 */
if (!class_exists('omie_fail')) {
class omie_fail{
	/**
	 * Codigo do erro
	 *
	 * @var integer
	 */
	public $code;
	/**
	 * Descricao do erro
	 *
	 * @var string
	 */
	public $description;
	/**
	 * Origem do erro
	 *
	 * @var string
	 */
	public $referer;
	/**
	 * Indica se eh um erro fatal
	 *
	 * @var boolean
	 */
	public $fatal;
}
}