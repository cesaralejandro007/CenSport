function Limitar(event, cantidad) {
    if (event.value.length >= cantidad) {
        event.value = event.value.substring(0, cantidad);
    }
}
    // Array para almacenar los integrantes agregados
    var integrantes = [];

    // Función para agregar integrante a la tabla y al array
    document.getElementById('agregar').addEventListener('click', function() {
        var input = document.getElementById('cedula_persona_grupo');
        var selectedOption = document.querySelector('#opcion_persona option[value="' + input.value + '"]');
        var nombre = selectedOption ? selectedOption.textContent : '';
        if (nombre && !integrantes.includes(input.value)) {
            if(input.value != "" && nombre != ""){
                comprobar_pers_deporte(input.value,nombre);
            }
            integrantes.push(input.value);
            var tbody = document.getElementById('tbody_integrantes');
            var newRow = document.createElement('tr');
            newRow.innerHTML = '<td>' + input.value + '</td><td>' + nombre + '</td><td><button class="btn btn-danger btn-sm" onclick="eliminarIntegrante(this)">Eliminar</button></td>';
            tbody.appendChild(newRow);
            input.value = '';
        }else if(nombre == ''){
            Swal.fire({
                icon: 'error',
                title: nombre + 'Ingrese una cedula!',
                showConfirmButton: true,
                confirmButtonColor: '#007bff', // Color primario de Bootstrap
                confirmButtonText: 'Aceptar'
            });
        }else{
            Swal.fire({
                icon: 'warning',
                title: nombre + 'ya está seleccionad@!',
                showConfirmButton: true,
                confirmButtonColor: '#007bff', // Color primario de Bootstrap
                confirmButtonText: 'Aceptar'
            });
        }
    });

    // Función para eliminar integrante de la tabla y del array
    function eliminarIntegrante(button) {
        var row = button.parentNode.parentNode;
        var cedula = row.firstChild.textContent;
        var index = integrantes.indexOf(cedula);
        if (index !== -1) {
            integrantes.splice(index, 1);
            row.parentNode.removeChild(row);
        }
    }

var keyup_nombre = /^(?!.*\s{2})[A-ZÁÉÍÓÚÑ][a-záéíóúñ]*(?:\s[A-ZÁÉÍÓÚÑ][a-záéíóúñ]*){0,49}$/;
var keyup_descripcion = /^.{3,200}$/;

document.onload = carga();
function carga() {

/*--------------VALIDACION PARA SELECT DEPORTE--------------------*/
    document.getElementById("deporte_selec").maxLength = 9;
    document.getElementById("deporte_selec").onchange = function () {
        r = validarselect(
            this,
            document.getElementById("sdeporte"),
            "* Seleccione un Deporte"
        );
    };
/*--------------FIN VALIDACION PARA SELECT DEPORTE--------------------*/
/*--------------VALIDACION PARA NOMBRE GRUPO--------------------*/
    document.getElementById("nombre_grupo").maxLength = 50;
    document.getElementById("nombre_grupo").onkeypress = function (e) {
        var er = /^[A-Za-z0-9\s\u00f1\u00d1áéíóúÁÉÍÓÚ!"#$%&'()*+,\-./:;<=>?@[\\\]^_`{|}~]*$/;
        validarkeypress(er, e);
    };
    document.getElementById("nombre_grupo").onkeyup = function () {
        r = validarkeyup(
            keyup_nombre,
            this,
            document.getElementById("snombre_grupo"),
            "* Solo letras de 3 a 50 caracteres, comenzando cada palabra con la primera letra en mayúscula."
        );
    };
/*--------------FIN VALIDACION PARA NOMBRE GRUPO--------------------*/
/*--------------VALIDACION PARA DESCRIPCION GRUPO--------------------*/
    document.getElementById("descripcion_grupo").maxLength = 200;
    document.getElementById("descripcion_grupo").onkeypress = function (e) {
        var er = /^[A-Za-z0-9\s\u00f1\u00d1áéíóúÁÉÍÓÚ!"#$%&'()*+,\-./:;<=>?@[\\\]^_`{|}~]*$/;
        validarkeypress(er, e);
    };
    document.getElementById("descripcion_grupo").onkeyup = function () {
        r = validarkeyup(
            keyup_descripcion,
            this,
            document.getElementById("sdescripcion_grupo"),
            "* La cadena debe tener entre 3 y 200 caracteres."
        );
    };
/*--------------FIN VALIDACION PARA DESCRIPCION GRUPO--------------------*/

document.getElementById("enviar").onclick = function () {
    a = valida_registrar();
    if (a != "") {
    }else if(integrantes.length == 0){
        Swal.fire({
            icon: 'error',
            title: 'Seleccione al menos 1 integrante en el grupo!',
            showConfirmButton: true,
            confirmButtonColor: '#007bff', // Color primario de Bootstrap
            confirmButtonText: 'Aceptar'
            });
            }else {
        var datos = new FormData();
        datos.append("accion", $("#accion").val());
        datos.append("id_grupo_deportivo", $("#id_grupo_deportivo").val());
        datos.append("id_deporte", $("#deporte_selec").val());
        datos.append("nombre_grupo", $("#nombre_grupo").val());
        datos.append("descripcion_grupo", $("#descripcion_grupo").val());
        datos.append("integrantes",integrantes);
        enviaAjax(datos);
    }
};

    document.getElementById("evento").onclick = function () {
        document.getElementById('tbody_integrantes').innerHTML = '';
        integrantes = [];
        limpiar();
        $("#accion").val("registrar");
        $("#titulo").text("Registrar Grupo Deportivo");
        $("#enviar").text("Incluir");
        $("#staticBackdrop").modal("show");
    };
}
/*--------------------FIN DE CRUD DEL MODULO----------------------*/
/*-------------------FUNCIONES DE HERRAMIENTAS-------------------*/
function validarkeypress(er, e) {
    key = e.keyCode || e.which;
    tecla = String.fromCharCode(key);
    a = er.test(tecla);
    if (!a) {
        e.preventDefault();
    }
}

function validarselect(etiqueta, etiquetamensaje, mensaje) {
    if(etiqueta.value == 0){
        etiquetamensaje.innerText = mensaje;
        etiquetamensaje.style.color = "red";
        etiqueta.classList.add("is-invalid");
    }else{
        etiquetamensaje.innerText = "";
        etiqueta.classList.remove("is-invalid");
        etiqueta.classList.add("is-valid");
    }
}

function validarkeyup(er, etiqueta, etiquetamensaje, mensaje) {
    a = er.test(etiqueta.value);
    if (!a) {
        etiquetamensaje.innerText = mensaje;
        etiquetamensaje.style.color = "red";
        etiqueta.classList.add("is-invalid");
        return 0;
    } else {
        etiquetamensaje.innerText = "";
        etiqueta.classList.remove("is-invalid");
        etiqueta.classList.add("is-valid");
        return 1;
    }
}

function limpiar() {
    $("#deporte_selec").val(0);
    $("#nombre_grupo").val("");
    $("#descripcion_grupo").val("");
    document.getElementById("sdeporte").innerText = "";
    document.getElementById("snombre_grupo").innerText = "";
    document.getElementById("sdescripcion_grupo").innerText = "";
   /*  document.getElementById("sarea").innerText = ""; */

    document.getElementById("deporte_selec").classList.remove("is-invalid", "is-valid");
    document.getElementById("nombre_grupo").classList.remove("is-invalid", "is-valid");
    document.getElementById("descripcion_grupo").classList.remove("is-invalid", "is-valid");
    /* document.getElementById("area").classList.remove("is-invalid", "is-valid"); */
}

function valida_registrar() {
    var error = false;
    if(document.getElementById("deporte_selec").value == 0){
        document.getElementById("sdeporte").innerHTML ="* Seleccione un genero";
        document.getElementById("sdeporte").style.color = "red";
        document.getElementById("deporte_selec").classList.add("is-invalid");
    }else{
        document.getElementById("sdeporte").innerHTML ="";
        document.getElementById("deporte_selec").classList.remove("is-invalid");
        document.getElementById("deporte_selec").classList.add("is-valid");
    }
    nombre_grupo = validarkeyup(
        keyup_nombre,
        document.getElementById("nombre_grupo"),
        document.getElementById("snombre_grupo"),
        "* Solo letras de 3 a 50 caracteres, comenzando cada palabra con la primera letra en mayúscula."
    );
    descripcion_grupo = validarkeyup(
        keyup_nombre,
        document.getElementById("descripcion_grupo"),
        document.getElementById("sdescripcion_grupo"),
         "* La cadena debe tener entre 3 y 200 caracteres."
    );
    if(
        document.getElementById("deporte_selec").value == 0 ||
        nombre_grupo == 0 ||
        descripcion_grupo == 0
    ){
        error = true;
    }
    return error;
}
function comprobar_pers_deporte(cedula, nombre) {
    var datos = new FormData();
    datos.append("accion", "comprobar_pers_deporte");
    datos.append("cedula", cedula);
    datos.append("nombre", nombre);
    var toastMixin = Swal.mixin({
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
    });
    $.ajax({
        url: "",
        type: "POST",
        contentType: false,
        data: datos,
        processData: false,
        cache: false,
        success: (response) => {
            var res = JSON.parse(response);
            if (res.estatus == 2) {
                var index = integrantes.indexOf(cedula);
                if (index !== -1) {
                    integrantes.splice(index, 1);
                }
                toastMixin.fire({
                    title: res.title,
                    text: res.message,
                    icon: res.icon,
                });

                // Eliminar la fila de la tabla
                eliminarFilaPorCedula(cedula);
            }
            return 1;
        },
        error: (err) => {
            Toast.fire({
                icon: res.error,
            });
        },
    });
}

function eliminarFilaPorCedula(cedula) {
    var tbody = document.getElementById('tbody_integrantes');
    var rows = tbody.getElementsByTagName('tr');

    for (let i = 0; i < rows.length; i++) {
        let cell = rows[i].getElementsByTagName('td')[0];
        if (cell.textContent === cedula) {
            tbody.deleteRow(i);
            break;
        }
    }
}

function cargar_datos(valor) {
    var datos = new FormData();
    datos.append("accion", "editar");
    datos.append("id", valor);
    mostrar(datos);
}
/*-------------------FIN DE FUNCIONES DE HERRAMIENTAS-------------------*/

/*--------------------FUNCIONES CON AJAX----------------------*/
function eliminar(id) {
  Swal.fire({
    title: "¿Está seguro de eliminar?",
    text: "¡No podrás revertir esto!",
    icon: "warning",
    showCloseButton: true,
    showCancelButton: true,
    confirmButtonColor: "#0C72C4",
    cancelButtonColor: "#9D2323",
    confirmButtonText: "Confirmar",
    cancelButtonText: "Cancelar",
  }).then((result) => {
    if (result.isConfirmed) {
      setTimeout(function () {
        var datos = new FormData();
        datos.append("accion", "eliminar");
        datos.append("id_grupo_derportivo", id);
        enviaAjax(datos);
      }, 10);
    }
  });
}


function eliminarIntegranteEditado(id_persona, id_grupo_deportivo) {
    Swal.fire({
      title: "¿Está seguro de eliminar?",
      text: "¡No podrás revertir esto!",
      icon: "warning",
      showCloseButton: true,
      showCancelButton: true,
      confirmButtonColor: "#0C72C4",
      cancelButtonColor: "#9D2323",
      confirmButtonText: "Confirmar",
      cancelButtonText: "Cancelar",
    }).then((result) => {
      if (result.isConfirmed) {
        setTimeout(function () {
          var datos = new FormData();
          datos.append("accion", "eliminar_persona_grupo");
          datos.append("id_grupos_deportivo", id_grupo_deportivo);
          datos.append("id_persona", id_persona);
          mostrar(datos);
        }, 10);
      }
    });
  }

function cargar_datos(id_grupos){
    var datos = new FormData();
    datos.append("accion", "editar");
    datos.append("id_grupos_deportivo", id_grupos);
    mostrar(datos);
}

function enviaAjax(datos) {
  var toastMixin = Swal.mixin({
    showConfirmButton: false,
    width: 450,
    padding: '3.5em',
    timer: 2000,
    timerProgressBar: true,
  });
  $.ajax({
    url: "",
    type: "POST",
    contentType: false,
    data: datos,
    processData: false,
    cache: false,
    success: (response) => {
      var res = JSON.parse(response);
      //alert(res.title);
      if (res.estatus == 1) {
        toastMixin.fire({
          title: res.title,
          text: res.message,
          icon: res.icon,
        });

        limpiar();
        setTimeout(function () {
          window.location.reload();
        }, 3000);
      } else {
        toastMixin.fire({

          text: res.message,
          title: res.title,
          icon: res.icon,
        });
      }
    },
    error: (err) => {
      Toast.fire({
        icon: res.error,
      });
    },
  });
}

function enviadatosAjax(datos) {
var toastMixin = Swal.mixin({
    toast: true,
    width: 300,
    position: "top-right",
    showConfirmButton: false,
    timer: 2000,
    timerProgressBar: true,
});
$.ajax({
    url: "",
    type: "POST",
    contentType: false,
    data: datos,
    processData: false,
    cache: false,
    success: (response) => {
    var res = JSON.parse(response);
    //alert(res.title);
    if (res.estatus == 1) {
        toastMixin.fire({
        title: res.title,
        text: res.message,
        icon: res.icon,
        });
    } else {
        toastMixin.fire({

        text: res.message,
        title: res.title,
        icon: res.icon,
        });
    }
    },
    error: (err) => {
    Toast.fire({
        icon: res.error,
    });
    },
});
}


function mostrar(datos) {
var toastMixin = Swal.mixin({
    toast: true,
    width: 300,
    position: "top-right",
    showConfirmButton: false,
    timer: 2000,
    timerProgressBar: true,
});
$.ajax({
    async: true,
    url: "",
    type: "POST",
    contentType: false,
    data: datos,
    processData: false,
    cache: false,
    success: (response) => {
    var res = JSON.parse(response);
    if(typeof res.resultado == 'undefined'){
        limpiar();
        document.getElementById('tbody_integrantes').innerHTML = '';
        integrantes = [];
        var tableHTML = '';
        res[0].integrantes.forEach(function(item) {
            integrantes.push(item.cedula);
            tableHTML += '<tr>';
            tableHTML += '<td>' + item.cedula + '</td>';
            tableHTML += '<td>' + item.nombres + " " + item.apellidos+ '</td>';
            tableHTML += '<td><button class="btn btn-danger btn-sm" onclick="eliminarIntegranteEditado(' + item.id_persona +","+ res[0].id_grupo_deportivo + ')">Eliminar</button></td>';
            tableHTML += '</tr>';
        });
        document.getElementById('tbody_integrantes').innerHTML = tableHTML;

        $("#id_grupo_deportivo").val(res[0].id_grupo_deportivo);
        $("#deporte_selec").val(res[0].id_deporte);
        $("#nombre_grupo").val(res[0].nombre_grupo);
        $("#descripcion_grupo").val(res[0].descripcion_grupo);
        $("#enviar").text("Modificar");
        $("#staticBackdrop").modal("show");
        $("#accion").val("modificar");
        document.getElementById("accion").innerText = "modificar";
        $("#titulo").text("Modificar Grupo Deportivo");
    }else{
        toastMixin.fire({
            title: "Grupos Deportivos",
            text: "Debe quedar un integrante en el grupo.",
            icon: "warning",
        });
    }
    },
    error: (err) => {
    Toast.fire({
        icon: error.icon,
    });
    },
});
}
