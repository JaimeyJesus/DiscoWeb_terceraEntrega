<?php
// --------------------------------------------------------------
// Controlador que realiza la gestión de ficheros de un usuario
// ---------------------------------------------------------------

include_once 'modeloFile.php';
include_once 'config.php';
include_once 'plantilla/Usuario.php';
include_once 'AccesoDatos.php';
include_once 'plantilla/Usuario.php';
include_once 'plantilla/Encriptador.php';



function ctlFileVerFicheros(){
    if(isset($_SESSION['user'])){
        $usuarios=modeloUserGetAll();
        $userId=$_SESSION['user'];
        $msg="";
        include_once 'plantilla/verFicheros.php';
    }else{
        include_once 'plantilla/facceso.php';
    }
}

function ctlFileSubirFichero(){
    $msg="";
    $fichero = "";
    $userId=$_SESSION['user'];
    if(!isset($_FILES['archivo'])){
        $msg="prueba";
        include_once 'plantilla/subirFichero.php';

    }else{
        $fichero = $_FILES['archivo']; 
        $tamanioFichero = $_FILES['archivo']['size']/1024; 
        
        if(modeloFileUpFile($fichero,$userId,$msg,$tamanioFichero)){
            print_r($tamanioFichero);
            include_once 'plantilla/verFicheros.php';
        }else {
            $msg .= "No se ha podido subir el archivo";
            include_once 'plantilla/subirFichero.php';
        }
    } 

    
}

function ctlFileModificar(){
    if(!isset($_POST['nombre'])){
        $usuarioid=$_SESSION['user'];
        $usuarios = modeloUserGetAll();
        include_once 'plantilla/Modificar.php';
    }  
}

function ctlFileDescargarFichero(){
    $archivo=$_GET['fichero'];
    $userId=$_GET['id'];
    include_once 'plantilla/descarga.php';
}

function ctlFileCambiarNombreFichero() {
    $fichero=$_GET['fichero'];
    $userId=$_GET['id'];
    $NuevoNombre=$userId."/".$_GET['NuevoNombre'];
    
    if(modeloFileCambiarNombre($fichero, $NuevoNombre)){
        $msg="La operación se realizó correctamente.";
        include_once 'plantilla/verFicheros.php';
    }else{
        $msg="No se pudo relaizar la operación.";
    }
}

function ctlFileBorrarFichero(){
    $msg ="";
    $fichero=$_GET['fichero'];

    if(modeloFileBorrar($fichero)){
        $msg="La operación se realizó correctamente.";
        include_once 'plantilla/verFicheros.php';
    }else{
        $msg="No se pudo relaizar la operación.";
    }  
}

function ctlFileBorrarDir($usuarioid){
    $carpeta="app\\dat\\".$usuarioid;
    if(is_dir($carpeta)){
        rmdir($carpeta);
        return true;
    }
    return false;
}

function ctlFileCompartir(){
    $fichero = $_GET['nombre'];
    $usuario = $_SESSION['user'];
    $rutaArchivo= RUTA_FICHEROS.$usuario."/".$fichero;
    
    $rutaencriptada = Encriptador::encripta($rutaArchivo);
    
    // Genero la ruta de descarga
    if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
        $link = "https";
        else
            $link = "http";
            $link .= "://".$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
            $link .="?orden=DescargaDirecta&fdirecto=".html_entity_decode($rutaencriptada);
            echo "<script type='text/javascript'>alert('Fichero $fichero. Enlace de descarga:$link');".
                "document.location.href='index.php?orden=Mis Archivos';</script>";
            
            
            
}

function ctlFileDescargaDirecta(){
    if (!empty($_GET['fdirecto'])) {
        echo $_GET['fdirecto'];
        $rutaArchivo = Encriptador::desencripta($_GET['fdirecto']);
        $pos = strrpos ( $rutaArchivo , "/");
        $fichero = substr($rutaArchivo,$pos+1);
        //echo "Se la solicitado descargar ruta: $rutaArchivo fichero: $fichero <br>";
        procesarDescarga($fichero,$rutaArchivo);
    }
}

function procesarDescarga($fichero,$rutaArchivo){
    header('Content-Type: application/octet-stream');
   // header("Content-Transfer-Encoding: Binary");
    header ("Content-Length: ".filesize($rutaArchivo));
    header("Content-disposition: attachment; filename=$fichero");
    readfile($rutaArchivo);
}

