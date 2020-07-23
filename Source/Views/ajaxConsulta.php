<?php

//intval
$tipo = ($_POST['tipo']);
$termo = ($_POST['termo']);

switch ($tipo):
    case "Cliente Id":
        echo "Retornar Cliente";

        //echo $restaurante->getClientes()->firstById(1)->getFirstName();
        /**
         *             Não Funciona!
         */
        /*
            $clienteTemp = $restaurante->getClientes()->findById(1);

            echo '</br>';
            echo  'Id: ' . $clienteTemp->getId() . '</br>';
            echo  'Nome: ' . $clienteTemp->getFirstName() . '</br>';
            echo  'Sobrenome: ' . $clienteTemp->getLastName() . '</br>';
            echo  'E-mail: ' . $clienteTemp->getEmail() . '</br>';
        */

        break;
    case "Cliente Nome":
        echo "Retornar Cliente";
        break;
    case "Produto Cod":
        echo "Retornar Produto";
        break;
    case "Pedido Num":
        echo "Retornar Pedido";
        break;
    default:
        echo "Não Localizado";
endswitch;
