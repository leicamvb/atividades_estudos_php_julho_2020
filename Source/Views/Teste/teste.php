<?php
print_r($restaurante);



$tipo = ($_POST['tipo']);
$termo = ($_POST['termo']);

echo '</br>' . 'Tipo: ' . $tipo . ', Termo: ' . $termo . '</br>';

$clienteTemp = $restaurante->getClientes()->findById(1);

echo '</br>';
echo  'Id: ' . $clienteTemp->getId() . '</br>';
echo  'Nome: ' . $clienteTemp->getFirstName() . '</br>';
echo  'Sobrenome: ' . $clienteTemp->getLastName() . '</br>';
echo  'E-mail: ' . $clienteTemp->getEmail() . '</br>';
