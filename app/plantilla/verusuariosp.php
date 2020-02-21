<?php
include_once 'Usuario.php';

ob_start();
$cont=0;
?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="index.php?orden=Mis Archivos">Mis Archivos <span class="sr-only"></span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="index.php?orden=Alta">Nuevo usuario</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="index.php?orden=Cerrar Sesión">Cerrar sesión</a>
      </li>
      <li id="search">
        <i class="fas fa-search" aria-hidden="true"></i>
        <input class="form-control form-control-sm w-20" id="textobuscar" type="text" placeholder="Buscar" aria-label="Search">
      </li>
      <li>
        <input type="button" class="btn btn-secondary" id="buscador" onclick="buscar()"value="buscar"/>
       
      </li>
    </ul>
  </div>
</nav>
<?=(isset($msg))?'<p>'.$msg.'</p>':''?>
 <?php
 if(isset($_GET['contador'])){
  $contador=$_GET['contador'];
 }else{
  $_GET['contador']=0;
   $contador=0;}
   ?>

<div class="grid-cabecera-usuarios">
    <a href="#" id="user" onclick="ordenarId('<?=$contador?>')"><div class="grid-item-cabecera" id="CabId"><b>ID</b><span class="badge ml-5"><img src="iconos/arrow-up-down.svg"></span></div></a>
    <a href="#" id="nombre" onclick="ordenarNombre('<?=$contador?>')"><div class="grid-item-cabecera" id="CabNombre"><b>NOMBRE</b><span class="badge ml-3"><img src="iconos/arrow-up-down.svg"></span></div></a>
    <a href="#" id="correo" onclick="ordenarCorreo('<?=$contador?>')"><div class="grid-item-cabecera" id="CabCorreo"><b>CORREO</b><span class="badge ml-3"><img src="iconos/arrow-up-down.svg"></span></div></a>
    <a href="#" id="plan" onclick="ordenarPlan('<?=$contador?>')"><div class="grid-item-cabecera" id="CabPlan"><b>PLAN</b><span class="badge ml-2"><img src="iconos/arrow-up-down.svg"></span></div></a>
    <a href="#" id="estado" onclick="ordenarEstado('<?=$contador?>')"><div class="grid-item-cabecera" id="CabEstado"><b>ESTADO</b><span class="badge ml-1"><img src="iconos/arrow-up-down.svg"></span></div></a>
    <div class="grid-item-cabecera" id="CabBorrar"><b>OPERACIONES</b></div>
    <!-- <div class="grid-item-cabecera" id="CabModificar"><b>MODIFICAR</b></div> -->
    <!-- <div class="grid-item-cabecera" id="CabDetalles"><b>DETALLES</b></div> -->
</div>
    <?php
    $auto = $_SERVER['PHP_SELF'];    
    ?>
<div class="container-usuarios">
    <?php foreach ($usuarios as $usuario){ ?>    		
    	<div class="grid-item identifer" id="identificador" name="identifer"><?= $usuario->user ?></div>
      <div class="grid-item" ><?=$usuario->nombre ?></div>
      <div class="grid-item" id='Correo' ><?=$usuario->correo ?></div>
      <div class="grid-item" id='plan'><?=PLANES[$usuario->tipo] ?></div>
      <div class="grid-item" id='Estado'><?=ESTADOS[$usuario->estado] ?></div>
      <div class="grid-item"><a href="#"
		  onclick="confirmarBorrar('<?=$usuario->nombre?>','<?=$usuario->user?>')">
		  <img class="icono" title="borrar" src="web/img/papelera.png"></a>
	    </div>
      <div class="grid-item"><a href="<?= $auto?>?orden=Modificar&id=<?= $usuario->user ?>">
    	<img class="icono" title="modificar" src="web/img/editar.png"></a>
	    </div>
      <div class="grid-item"><a href="<?= $auto?>?orden=Detalles&id=<?= $usuario->user ?>">
    	<img class="icono" title="detalles" src="web/img/ojo.png"></a>
	    </div>


    <?php } ?>
</div>
<?php

$contenido = ob_get_clean();
include_once "principal.php";

?>