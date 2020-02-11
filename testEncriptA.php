<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
</head>
<body>
<h1> Prueba de encriptar y desencriptar </h1>
<form method="get">
<input type=text name='msg' size=30>
</form>
<?php 

include_once 'app/plantilla/Encriptador.php';

if (!empty($_GET['msg'])){
    $texto = $_GET['msg'];
    $texto_encriptado = Encriptador::encripta($texto);
    $texto_original = Encriptador::desencripta($texto_encriptado);
    echo " Texto Encriptado= $texto_encriptado  <br>";
    echo " Texto Original  = $texto_original    <br>";
    echo " Generar IV = ".Encriptador::getIV(). "<br>";
}


?>
</body>
</html>