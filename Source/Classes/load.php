<?php

$clientes = new Source\Models\Clientes();
$produtos = new Source\Models\Produtos();
$cuponsDesconto = new Source\Models\CuponsDesconto();

$pedidos = new Source\Models\Pedidos();
$pedido1 = new Source\Models\Pedido();
$pedido2 = new Source\Models\Pedido();
$pedido3 = new Source\Models\Pedido();
$restaurante = new Source\Models\Restaurante();


//Popula os Clientes
$json = new Source\Classes\readJson('Source/Json/clientes.json');
foreach ($json->get() as $registro) :
   $clienteTemp = new Source\Models\Cliente();
   $clienteTemp->setCliente(
      $clientes->lastID() + 1,
      mb_strstr($registro->nome, " ", true),
      mb_strstr($registro->nome, " ", false),
      $registro->email
   );
   $clientes->add($clienteTemp);
endforeach;

//Popula os Produtos
$json = new Source\Classes\readJson('Source/Json/produtos.json');
foreach ($json->get() as $registro) :
   $produtoTemp = new Source\Models\Produto();
   $produtoTemp->setProduto(
      $registro->id,
      $registro->descricao,
      $registro->punit
   );
   $produtos->add($produtoTemp);
endforeach;


//Popula os Cupons de Desconto
$json = new Source\Classes\readJson('Source/Json/cuponsDesconto.json');
foreach ($json->get() as $registro) :
   $cupomDescontoTemp = new Source\Models\CupomDesconto();
   $cupomDescontoTemp->setCupomDesconto(
      $registro->id,
      $registro->percentual,
      $registro->ativo,
      new DateTime($registro->dtEmissao),
      new DateTime($registro->dtValidade)
   );
   $cuponsDesconto->add($cupomDescontoTemp);
endforeach;



//int $id, bool $acumulativo, float $percentual, bool $ativo, DateTime $dtEmissao, DateTime $dtValidade

//echo "<pre>" . print_r($produtos, true) . "</pre>";
/*
echo "<pre>" . print_r($clientes->findById(3)->getFirstName(), true) . "</pre>";
echo "<pre>" . print_r($clientes->findByName('Cliente2'), true) . "</pre>";

echo 'remover   --------------------------------';
$clientes->remove(4);
echo "<pre>" . print_r($clientes, true) . "</pre>";
*/

$pedido1->setPedido(1, "Aberto", 1, '0', $cuponsDesconto->findById(1));
$item1 = new Source\Models\Item(1, 1, 2, '7.20');
$item2 = new Source\Models\Item(2, 2, 2, '2.80');
$pedido1->addItem($item1, $item2);
//echo 'Pedido1 valor total: ' . $pedido1->getValorTotal() . '</br>';
//echo 'Pedido1, frete: ' . $pedido1->getFrete() . '</br>';
//echo 'Pedido1, desconto' . $pedido1->getPercentualDesconto() . '%, valor R$: ' . $pedido1->getValorDesconto() . '</br>';

$pedido2->setPedido(2, "Entregue", 2, '30.40');
$item1 = new Source\Models\Item(1, 1, 12, '7.20');
$item2 = new Source\Models\Item(2, 2, 21, '2.80');
$pedido2->addItem($item1, $item2);

$pedido3->setPedido(3, "Negado", 3);
$item1 = new Source\Models\Item(1, 1, 12, '7.20');
$item2 = new Source\Models\Item(2, 2, 21, '2.80');
$pedido3->addItem($item1, $item2);


$pedidos->add($pedido1, $pedido2, $pedido3);

$restaurante->setClientes($clientes);
$restaurante->setProdutos($produtos);
$restaurante->setCuponsDesconto($cuponsDesconto);
$restaurante->setPedidos($pedidos);






//echo '</br>' . 'Resumo de Pedidos -------------- ' . '</br>';


//echo '</br>' . "<pre>" . print_r($restaurante, true) . "</pre>";



/***
 * if(in_array("valorProcurado", indice))
 * array)keys
 * arrays_values
 * 
 */


/*
$cliente_check = $cliente->setCliente(2, 'Maciel', 'Souza', 'leicamvb@msn.com');

if ($cliente_check) {
   echo "<p class='trigger accept'>Cliente cadastrado com sucesso.</p>";
} else {
   echo "<p class='trigger error'>{$cliente->getError()}</p>";
}

*/
/*
fullStackPHPClassSession("Resumo dos Pedidos", __LINE__);
echo '<h4>Pedidos: ' .
   'Abertos: ' . $pedidos->getQtdeStatus(['Aberto']) . ' | ' .
   'Entregues: ' . $pedidos->getQtdeStatus(['Entregue']) . ' | ' .
   'Negados: ' . $pedidos->getQtdeStatus(['Negado']) . ' | ' .
   '<strong>Total de Pedidos: ' . $pedidos->getQtdePedidos() . '</strong>' .
   '</h4>';
echo '<h4>Total de (+)Fretes: R$ ' . $pedidos->getValorTotalFrete() . '</h4>';
echo '<h4>Total de (-)Descontos: R$ ' . $pedidos->getValorTotalDesconto() . '</h4>';

echo '<h4>' . 'Valor total: R$ ' . $pedidos->getValorTotalGeral() . '</h4>';

fullStackPHPClassSession("Apresentação", __LINE__);
*/
