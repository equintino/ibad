<?php
include 'OmieAppAuth.php';
include 'PedidoVendaProdutoJsonClient.php';

$pedidoVenda=new PedidoVendaProdutoJsonClient();
$method='ConsultarPedido';
//$param=array('1560731700','226dcf372489bb45ceede61bfd98f0f1');
PedidoVendaProdutoJsonClient::_Call($method);
echo '<pre>';
print_r(get_class_methods($pedidoVenda));
$pvpConsultarRequest='{"codigo_pedido": 25953530}';
print_r($pedidoVenda->ConsultarPedido($pvpConsultarRequest));
die;
$json='    {
  "cabecalho": {
    "bloqueado": "N",
    "codigo_cliente": 3792227,
    "codigo_pedido_integracao": "1517943210",
    "data_previsao": "06/02/2018",
    "etapa": "50",
    "numero_pedido": "57435",
    "quantidade_itens": 1
  },
  "det": [
    {
      "ide": {
        "codigo_item_integracao": "4422421",
        "simples_nacional": "S"
      },
      "imposto": {
        "cofins_padrao": {
          "aliq_cofins": 3,
          "base_cofins": 400,
          "cod_sit_trib_cofins": "01",
          "tipo_calculo_cofins": "B",
          "valor_cofins": 12
        },
        "icms_sn": {
          "aliq_icms_sn": 1.25,
          "cod_sit_trib_icms_sn": 101,
          "origem_icms_sn": 0,
          "valor_credito_icms_sn": 5
        },
        "ipi": {
          "cod_sit_trib_ipi": 51
        },
        "pis_padrao": {
          "aliq_pis": 0.65,
          "base_pis": 400,
          "cod_sit_trib_pis": "01",
          "tipo_calculo_pis": "B",
          "valor_pis": 2.6
        }
      },
      "inf_adic": {
        "peso_bruto": 150,
        "peso_liquido": 150
      },
      "produto": {
        "cfop": "5.102",
        "codigo_produto": "4422421",
        "descricao": "Telefone Celular X",
        "ncm": "9403.30.00",
        "quantidade": 1,
        "tipo_desconto": "V",
        "unidade": "UN",
        "valor_desconto": 0,
        "valor_mercadoria": 200,
        "valor_total": 200,
        "valor_unitario": 200
      }
    }
  ],
  "frete": {
    "codigo_transportadora": 2239663,
    "modalidade": "1",
    "placa": "ABC1234",
    "placa_estado": "SP",
    "valor_frete": 30
  },
  "informacoes_adicionais": {
    "codigo_categoria": "1.01.03",
    "codigo_conta_corrente": 11850365,
    "consumidor_final": "S",
    "enviar_email": "N"
  },
  "lista_parcelas": {
    "parcela": [
      {
        "data_vencimento": "07/02/2018",
        "numero_parcela": 1,
        "percentual": 50,
        "valor": 100
      },
      {
        "data_vencimento": "01/07/2018",
        "numero_parcela": 2,
        "percentual": 50,
        "valor": 100
      }
    ]
  },
  "total_pedido": {
    "base_calculo_icms": 200,
    "valor_mercadorias": 200,
    "valor_total_pedido": 200
  }
}';
echo '<pre>';
foreach(json_decode($json) as $item){
    print_r($item);
}
?>