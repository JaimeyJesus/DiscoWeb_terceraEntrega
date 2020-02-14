/**
 * Funciones auxiliares de javascripts 
 */

function confirmarBorrar(nombre,id){
  if (confirm("¿Quieres eliminar el usuario:  "+nombre+"?"))
  {
   document.location.href="?orden=Borrar&id="+id;
  }
}

function confirmarModificar(nombre,id){
	  if (confirm("¿Quieres modificar el usuario:  "+nombre+"?"))
	  {
	   document.location.href="?orden=Modificar&id="+id;
	  }
	}

function BorrarFichero(fichero, id){
	
	  if (confirm("¿Quieres eliminar el fichero:  "+fichero+"?"))
	  {
	   document.location.href="?orden=Borrar Fichero&fichero="+fichero+"&id="+id;
	  }
}

function RenombrarFichero(fichero,id){
	NuevoNombre=prompt("Introduzca el nuevo nombre para el fichero: ", );
	if(NuevoNombre==null){
		NuevoNombre=fichero;
	}else{
	document.location.href="?orden=Modificar Fichero&fichero="+fichero+"&NuevoNombre="+NuevoNombre+"&id="+id;
	}
}
	
function Alta(){
	document.location.href="?orden=Alta";
}

function VerArchivos(){
	document.location.href="?orden=Mis Archivos";
}

function Descargar(id,fichero){
	document.location.href="?orden=Descarga&fichero="+fichero+"&id="+id;
}

function Compartir(fichero){
	document.location.href="?orden=Compartir&nombre="+fichero;
}

function Atras(){
	document.location.href="?orden=Inicio";
}

function VolverListaUsuarios(){
	document.location.href="?orden=VerUsuarios";
}
function buscar(){
	var texto=document.getElementById("textobuscar").value;
	var valorDivs=document.getElementsByClassName("identifer");
	alert(valorDivs[0].innerHTML);
	for(i=0; i<valorDivs.length;i++){
		if(valorDivs[i].innerHTML===texto){
			document.location.href="?orden=Detalles&id="+texto;
		}
	}
	
}
function ordenarId(){
	document.location.href="?orden=VerUsuarios&order=id";
}
function ordenarNombre(){
	document.location.href="?orden=VerUsuarios&order=nombre";
}
function ordenarCorreo(){
	document.location.href="?orden=VerUsuarios&order=correo";
}
function ordenarPlan(){
	document.location.href="?orden=VerUsuarios&order=plan";
}
function ordenarEstado(){
	document.location.href="?orden=VerUsuarios&order=estado";
}


