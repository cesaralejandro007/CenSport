var keyup_nombre = /^[A-ZÁÉÍÓÚ][a-zñáéíóú]{3,30}$/;
 carga();
function carga() {

/*--------------VALIDACION PARA NOMBRE--------------------*/
    document.getElementById("nombre_deporte").maxLength = 30;
    document.getElementById("nombre_deporte").onkeypress = function (e) {
        er = /^[A-Za-z\s\b\u00f1\u00d1\u00E0-\u00FC]*$/;
        validarkeypress(er, e);
    };
    document.getElementById("nombre_deporte").onkeyup = function () {
        r = validarkeyup(
            keyup_nombre,
            this,
            document.getElementById("snombre_deporte"),
            "* Solo letras de 3 a 30 caracteres, siendo la primera en mayúscula."
        );
    };
/*--------------FIN VALIDACION PARA NOMBRE--------------------*/

/*----------------------CRUD DEL MODULO------------------------*/
document.getElementById("enviar").onclick = function () {
    a = valida_registrar();
    if (a != "") {
    }else {
        var datos = new FormData();
        datos.append("accion", $("#accion").val());
        datos.append("id", $("#id_deporte").val());
        datos.append("nombre_deporte", $("#nombre_deporte").val());
        enviaAjax(datos);
    }
};

    document.getElementById("evento").onclick = function () {
        limpiar();
        $("#accion").val("registrar");
        $("#titulo").text("Registrar Funcionario");
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
    $("#nombre_deporte").val("");
    document.getElementById("snombre_deporte").innerText = "";
    document.getElementById("nombre_deporte").classList.remove("is-invalid", "is-valid");
}

function valida_registrar() {
    var error = false;
    nombre_deporte = validarkeyup(
        keyup_nombre,
        document.getElementById("nombre_deporte"),
        document.getElementById("snombre_deporte"),
        "* Solo letras de 3 a 30 caracteres, siendo la primera en mayúscula."
    );
    if(
        nombre_deporte == 0
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
    text: "Se eliminarán los grupos deportivos asociados a este deporte.",
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
        datos.append("id_deporte", id);
        enviaAjax(datos);
      }, 10);
    }
  });
}

function cargar_datos(id_persona) {
    var datos = new FormData();
    datos.append("accion", "editar");
    datos.append("id_deporte", id_persona);
    mostrar(datos);
  }

function enviaAjax(datos) {
  var toastMixin = Swal.mixin({
    showConfirmButton: false,
    timer: 1500,
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
        }, 1500);
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
    $("#id_deporte").val(res.id_deporte);
    $("#nombre_deporte").val(res.nombre_deporte);
    $("#enviar").text("Modificar");
    $("#staticBackdrop").modal("show");
    $("#accion").val("modificar");
    document.getElementById("accion").innerText = "modificar";
    $("#titulo").text("Modificar Deporte");
    },
    error: (err) => {
    Toast.fire({
        icon: error.icon,
    });
    },
});
}
