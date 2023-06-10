//Se obtiene los datos del input.
var input = document.getElementById('claveAdmin');

//La función habilitar hace editable el campo para agregar la clave del administrar
function habilitar(elemento) {
  clave = elemento.value;
  //Si la clave que se envia es igual a estudiante no se pedira este requisito de agregar una clave.
  if(clave == "Estudiante"){
    input.disabled = true;
  }else{
    //En cambio, si es administrador o profesor debe activarse este campo para ser solicitado.
    input.disabled = false;
  }
}