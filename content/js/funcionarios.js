var keyup_cedula = /^[0-9]{7,8}$/;
var keyup_nombre = /^[A-ZÁÉÍÓÚ][a-zñáéíóú]{2,29}(\s[A-ZÁÉÍÓÚ][a-zñáéíóú]{2,29})?$/;
var keyup_fecha = /^\d{4}-\d{2}-\d{2}$/;
var keyup_telefono =/^[0-9]{4}-\d{7,8}$/

document.onload = carga();
function carga() {
/*--------------VALIDACION PARA CEDULA--------------------*/
    document.getElementById("cedula").maxLength = 8;
    document.getElementById("cedula").onkeypress = function (e) {
        er = /^[0-9]*$/;
        validarkeypress(er, e);
    };
    document.getElementById("cedula").onkeyup = function () {
        r = validarkeyup(
            keyup_cedula,
            this,
            document.getElementById("scedula"),
            "* El formato debe ser 99999999"
        );
    };
/*--------------FIN VALIDACION PARA CEDULA--------------------*/
/*--------------VALIDACION PARA NOMBRE--------------------*/
    document.getElementById("nombres").maxLength = 30;
    document.getElementById("nombres").onkeypress = function (e) {
        er = /^[A-Za-z\s\b\u00f1\u00d1\u00E0-\u00FC]*$/;
        validarkeypress(er, e);
    };
    document.getElementById("nombres").onkeyup = function () {
        r = validarkeyup(
            keyup_nombre,
            this,
            document.getElementById("snombres"),
            "* Solo letras de 3 a 30 caracteres, siendo la primera en mayúscula."
        );
    };
/*--------------FIN VALIDACION PARA NOMBRE--------------------*/
/*--------------VALIDACION PARA APELLIDO--------------------*/
    document.getElementById("apellidos").maxLength = 30;
    document.getElementById("apellidos").onkeypress = function (e) {
        er = /^[A-Za-z\s\b\u00f1\u00d1\u00E0-\u00FC]*$/;
        validarkeypress(er, e);
    };
    document.getElementById("apellidos").onkeyup = function () {
        r = validarkeyup(
            keyup_nombre,
            this,
            document.getElementById("sapellidos"),
            "* Solo letras de 3 a 30 caracteres, siendo la primera en mayúscula."
        );
    };
/*--------------FIN VALIDACION PARA APELLIDO--------------------*/
/*--------------VALIDACION PARA SEXO--------------------*/
    document.getElementById("sexo").maxLength = 9;
    document.getElementById("sexo").onkeypress = function (e) {
      er = /^[A-Za-z\b\u00f1\u00d1\u00E0-\u00FC]*$/;
      validarkeypress(er, e);
    };
    document.getElementById("sexo").onchange = function () {
        r = validarselect(
            this,
            document.getElementById("ssexo"),
            "* Seleccione un genero"
        );
    };
/*--------------FIN VALIDACION PARA SEXO--------------------*/
/*--------------VALIDACION PARA TELEFONO--------------------*/
    document.getElementById("telefono").maxLength = 15;
    document.getElementById("telefono").onkeypress = function (e) {
        er = /^[0-9\b\u00f1\u00d1\u00E0-\u00FC-]*$/;
        validarkeypress(er, e);
    };
    document.getElementById("telefono").onkeyup = function () {
        r = validarkeyup(
            keyup_telefono,
            this,
            document.getElementById("stelefono"),
             "* El formato debe ser 0426-1234567"
        );
    };
/*--------------FIN VALIDACION PARA TELEFONO--------------------*/
/*--------------VALIDACION PARA FECHA DE NACIMIENTO--------------------*/
document.getElementById("fecha_nacimiento").onkeyup = function () {
    r = validarkeyup(
        keyup_fecha,
        this,
        document.getElementById("sfecha_nacimiento"),
        "* Fecha inválida."
    );
};
/*--------------FIN VALIDACION PARA FECHA DE NACIMIENTO-----------------*/
/*--------------VALIDACION PARA FECHA DE INGRESO--------------------*/
document.getElementById("fecha_ingreso").onkeyup = function () {
    r = validarkeyup(
        keyup_fecha,
        this,
        document.getElementById("sfecha_ingreso"),
        "* Fecha inválida."
    );
};
/*--------------FIN VALIDACION PARA FECHA DE INGRESO--------------------*/
/*----------------------CRUD DEL MODULO------------------------*/
document.getElementById("enviar").onclick = function () {
    a = valida_registrar();
    if (a != "") {
    }else {
        var datos = new FormData();
        datos.append("accion", $("#accion").val());
        datos.append("id", $("#id_persona").val());
        datos.append("cedula", $("#cedula").val());
        datos.append("nombres", $("#nombres").val());
        datos.append("apellidos", $("#apellidos").val());
        datos.append("sexo", $("#sexo").val());
        datos.append("telefono", $("#telefono").val());
        datos.append("fecha_nacimiento", $("#fecha_nacimiento").val());
        datos.append("fecha_ingreso", $("#fecha_ingreso").val());
        datos.append("id_division", $("#select_division").val());
        datos.append("id_area", $("#area").val());
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
    $("#cedula").val("");
    $("#nombres").val("");
    $("#apellidos").val("");
    $("#sexo").val(0);
    $("#telefono").val("");
    $("#fecha_nacimiento").val("");
    $("#fecha_ingreso").val("");
    $("#select_division").val(0);
    $("#area").val(0);
    document.getElementById("scedula").innerText = "";
    document.getElementById("snombres").innerText = "";
    document.getElementById("sapellidos").innerText = "";
    document.getElementById("ssexo").innerText = "";
    document.getElementById("stelefono").innerText = "";
    document.getElementById("sfecha_nacimiento").innerText = "";
    document.getElementById("sfecha_ingreso").innerText = "";
    document.getElementById("sselect_division").innerText = "";
   /*  document.getElementById("sarea").innerText = ""; */

    document.getElementById("cedula").classList.remove("is-invalid", "is-valid");
    document.getElementById("nombres").classList.remove("is-invalid", "is-valid");
    document.getElementById("apellidos").classList.remove("is-invalid", "is-valid");
    document.getElementById("sexo").classList.remove("is-invalid", "is-valid");
    document.getElementById("telefono").classList.remove("is-invalid", "is-valid");
    document.getElementById("fecha_nacimiento").classList.remove("is-invalid", "is-valid");
    document.getElementById("fecha_ingreso").classList.remove("is-invalid", "is-valid");
    document.getElementById("select_division").classList.remove("is-invalid", "is-valid");
    /* document.getElementById("area").classList.remove("is-invalid", "is-valid"); */
}

function valida_registrar() {
    var error = false;
    cedula = validarkeyup(
        keyup_cedula,
        document.getElementById("cedula"),
        document.getElementById("scedula"),
        "* El formato debe ser 99999999."
    );
    nombres = validarkeyup(
        keyup_nombre,
        document.getElementById("nombres"),
        document.getElementById("snombres"),
        "* Solo letras de 3 a 30 caracteres, siendo la primera en mayúscula."
    );
    apellidos = validarkeyup(
        keyup_nombre,
        document.getElementById("apellidos"),
        document.getElementById("sapellidos"),
        "* Solo letras de 3 a 30 caracteres, siendo la primera en mayúscula."
    );
    if(document.getElementById("sexo").value == 0){
        document.getElementById("ssexo").innerHTML ="* Seleccione un genero";
        document.getElementById("ssexo").style.color = "red";
        document.getElementById("sexo").classList.add("is-invalid");
    }else{
        document.getElementById("ssexo").innerHTML ="";
        document.getElementById("sexo").classList.remove("is-invalid");
        document.getElementById("sexo").classList.add("is-valid");
    }
    telefono = validarkeyup(
        keyup_telefono,
        document.getElementById("telefono"),
        document.getElementById("stelefono"),
        "* El formato debe ser 0426-1234567"
    );
    fecha_nacimiento = validarkeyup(
        keyup_fecha,
        document.getElementById("fecha_nacimiento"),
        document.getElementById("sfecha_nacimiento"),
        "* Fecha inválida."
    );
    fecha_ingreso = validarkeyup(
        keyup_fecha,
        document.getElementById("fecha_ingreso"),
        document.getElementById("sfecha_ingreso"),
        "* Fecha inválida."
    );

    if(document.getElementById("select_division").value == 0){
        document.getElementById("sselect_division").innerHTML ="* Seleccione un división";
        document.getElementById("sselect_division").style.color = "red";
        document.getElementById("select_division").classList.add("is-invalid");
      }else{
        if(document.getElementById("area").value == 0){
          document.getElementById("sarea").innerHTML ="* Seleccione un área";
          document.getElementById("sarea").style.color = "red";
          document.getElementById("area").classList.add("is-invalid");
        }else{
          document.getElementById("sarea").innerHTML ="";
          document.getElementById("area").classList.remove("is-invalid");
          document.getElementById("area").classList.add("is-valid");
        }
        document.getElementById("sselect_division").innerHTML ="";
        document.getElementById("select_division").classList.remove("is-invalid");
        document.getElementById("select_division").classList.add("is-valid");
      }

    if(
        cedula == 0 ||
        nombres == 0 ||
        apellidos == 0 ||
        document.getElementById("sexo").value == 0 ||
        telefono == 0 ||
        fecha_nacimiento == 0 ||
        fecha_ingreso == 0 ||
        document.getElementById("select_division").value == 0 ||
        document.getElementById("area").value == 0 
    ){
        error = true;
    }
    return error;
}

document.getElementById("select_division").onchange = function(){
    r = validarselect(
    this,
    document.getElementById("sselect_division"),
    "* Seleccione una división"
    );
    var datos = new FormData();
    datos.append("accion", "buscar_area");
    datos.append("id_division", document.getElementById("select_division").value);
    buscar_division_area(datos);
}

function buscar_division_area(datos) {
    $.ajax({
    url: "",
    type: "POST",
    contentType: false,
    data: datos,
    processData: false,
    cache: false,
    success: (response) => {
        document.getElementById("selec_area").innerHTML = response;
    },
    error: (err) => {
        Toast.fire({
        icon: res.error,
        });
    },
    });
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
    text: "¡Se eliminarán todos los registros de los deportes en los que está inscrita esta persona!",
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
        datos.append("id_persona", id);
        enviaAjax(datos);
      }, 10);
    }
  });
}

function cargar_datos(id_persona) {
    var datos = new FormData();
    datos.append("accion", "editar");
    datos.append("id_persona", id_persona);
    mostrar(datos);
  }

function enviaAjax(datos) {
  var toastMixin = Swal.mixin({
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

    var datos = new FormData();
    datos.append("accion", "buscar_area");
    datos.append("id_division", res.idDivision);
    buscar_division_area(datos);

    $("#id_persona").val(res.id_persona);
    $("#cedula").val(res.cedula);
    $("#nombres").val(res.nombres);
    $("#apellidos").val(res.apellidos);
    $("#sexo").val(res.sexo);
    $("#telefono").val(res.telefono);
    $("#fecha_nacimiento").val(res.fecha_nacimiento);
    $("#fecha_ingreso").val(res.fecha_ingreso);
    $("#select_division").val(res.idDivision);
    $("#enviar").text("Modificar");
    $("#staticBackdrop").modal("show");
    $("#accion").val("modificar");
    document.getElementById("accion").innerText = "modificar";
    $("#titulo").text("Modificar Funcionario");
    setTimeout(function() {
        $("#area").val(res.idArea);
    }, 100);
    },
    error: (err) => {
    Toast.fire({
        icon: error.icon,
    });
    },
});
}
