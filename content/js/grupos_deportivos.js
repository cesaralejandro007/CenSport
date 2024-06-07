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


var keyup_nombre = /^[A-Za-z0-9\sÁáÉéÍíÓóÚúÑñ]{3,50}$/;
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
       var er = /^[A-Za-z0-9\s\u00f1\u00d1!"#$%&'()*+,\-./:;<=>?@[\\\]^_`{|}~]*$/;
        validarkeypress(er, e);
    };
    document.getElementById("nombre_grupo").onkeyup = function () {
        r = validarkeyup(
            keyup_nombre,
            this,
            document.getElementById("snombre_grupo"),
            "* Solo letras de 3 a 30 caracteres, siendo la primera en mayúscula."
        );
    };
/*--------------FIN VALIDACION PARA NOMBRE GRUPO--------------------*/
/*--------------VALIDACION PARA DESCRIPCION GRUPO--------------------*/
    document.getElementById("descripcion_grupo").maxLength = 200;
    document.getElementById("descripcion_grupo").onkeypress = function (e) {
       var er = /^[A-Za-z0-9\s\u00f1\u00d1!"#$%&'()*+,\-./:;<=>?@[\\\]^_`{|}~]*$/;
        validarkeypress(er, e);
    };
    document.getElementById("descripcion_grupo").onkeyup = function () {
        r = validarkeyup(
            keyup_descripcion,
            this,
            document.getElementById("sdescripcion_grupo"),
            "* Solo letras de 3 a 30 caracteres, siendo la primera en mayúscula."
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
        datos.append("id_deporte", $("#deporte_selec").val());
        datos.append("nombre_grupo", $("#nombre_grupo").val());
        datos.append("descripcion_grupo", $("#descripcion_grupo").val());
        datos.append("integrantes",integrantes);
        enviaAjax(datos);
    }
};

    document.getElementById("evento").onclick = function () {
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
        "* Solo letras de 3 a 30 caracteres, siendo la primera en mayúscula."
    );
    descripcion_grupo = validarkeyup(
        keyup_nombre,
        document.getElementById("descripcion_grupo"),
        document.getElementById("sdescripcion_grupo"),
        "* Solo letras de 3 a 30 caracteres, siendo la primera en mayúscula."
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

function cargar_datos(id_persona){
    var datos = new FormData();
    datos.append("accion", "editar");
    datos.append("id_persona", id_persona);
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
    limpiar();

    $("#deporte_selec").val(res.id_deporte);
    $("#nombre_grupo").val(res.nombre_grupo);
    $("#descripcion_grupo").val(res.descripcion_grupo);
    $("#integrantes").val(res.integrantes);
    $("#enviar").text("Modificar");
    $("#staticBackdrop").modal("show");
    $("#accion").val("modificar");
    document.getElementById("accion").innerText = "modificar";
    $("#titulo").text("Modificar Grupo Deportivo");
    },
    error: (err) => {
    Toast.fire({
        icon: error.icon,
    });
    },
});
}
