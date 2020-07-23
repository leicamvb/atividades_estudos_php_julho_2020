<?php

namespace Source\Models;


//use Source\Constantes\Constantes;
//$name = $_POST['name'];
$name = $_GET['name'];
echo $name;

$clienteTemp = $restaurante->getClientes()->findById(1);

//echo Constantes::STATUS[1];

echo 'oi' . '</br>'

?>

</body>

</html>