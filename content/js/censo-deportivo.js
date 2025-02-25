// Array para almacenar las disciplinas agregadas
var disciplinas = [];

// Función para agregar disciplina a la tabla y al array
document.getElementById('agregar').addEventListener('click', function() {
    var input = document.getElementById('id_diciplina');
    var selectedOption = document.querySelector('#opcion_diciplina option[value="' + input.value + '"]');
    var nombreDeporte = selectedOption ? selectedOption.textContent : '';

    if (nombreDeporte && !disciplinas.includes(input.value)) {
        if (disciplinas.length >= 2) {
            Swal.fire({
                icon: 'warning',
                title: 'Solo puedes agregar un máximo de 2 disciplinas!',
                confirmButtonColor: '#007bff',
                confirmButtonText: 'Aceptar'
            });
            return;
        }

        // Agregar disciplina al array
        disciplinas.push(input.value);
        
        // Agregar fila a la tabla
        var tbody = document.getElementById('tbody_disciplinas');
        var newRow = document.createElement('tr');
        newRow.innerHTML = `
            <td class="text-center">${nombreDeporte}</td>
            <td class="text-center">
                <button class="btn btn-danger btn-sm" onclick="eliminarDeporte(this)">Eliminar</button>
            </td>
        `;
        tbody.appendChild(newRow);
        
        // Limpiar el campo de entrada
        input.value = '';
    } else if (nombreDeporte === '') {
        Swal.fire({
            icon: 'error',
            title: 'Seleccione una disciplina válida!',
            confirmButtonColor: '#007bff',
            confirmButtonText: 'Aceptar'
        });
    } else {
        Swal.fire({
            icon: 'warning',
            title: 'Esta disciplina ya está agregada!',
            confirmButtonColor: '#007bff',
            confirmButtonText: 'Aceptar'
        });
    }
});

// Función para eliminar disciplina de la tabla y del array
function eliminarDeporte(button) {
    var row = button.closest('tr');
    var nombreDeporte = row.querySelector('td').textContent.trim(); // Usar trim() para evitar espacios extra

    // Eliminar la disciplina del array
    var index = disciplinas.indexOf(nombreDeporte);
    if (index !== -1) {
        disciplinas.splice(index, 1);
    }

    // Eliminar la fila de la tabla
    row.remove();
}

var keyup_cedula = /^[0-9]{7,8}$/;
var keyup_nombre = /^[A-ZÁÉÍÓÚ][a-zñáéíóú]{2,29}(\s[A-ZÁÉÍÓÚ][a-zñáéíóú]{2,29})?$/;
var keyup_fecha = /^\d{4}-\d{2}-\d{2}$/;
var keyup_telefono = /^[0-9]{4}-\d{7,8}$/

document.onload = carga();
function carga() {
    /*--------------VALIDACION PARA CEDULA--------------------*/
    document.getElementById("cedula_censo").maxLength = 8;
    document.getElementById("cedula_censo").onkeypress = function (e) {
        er = /^[0-9]*$/;
        validarkeypresscenso(er, e);
    };
    document.getElementById("cedula_censo").onkeyup = function () {
        r = validarkeyup(
            keyup_cedula,
            this,
            document.getElementById("scedula_censo"),
            "* El formato debe ser 99999999"
        );
    };
    /*--------------FIN VALIDACION PARA CEDULA--------------------*/
    /*--------------VALIDACION PARA NOMBRE--------------------*/
    document.getElementById("nombres_censo").maxLength = 30;
    document.getElementById("nombres_censo").onkeypress = function (e) {
        er = /^[A-Za-z\s\b\u00f1\u00d1\u00E0-\u00FC]*$/;
        validarkeypresscenso(er, e);
    };
    document.getElementById("nombres_censo").onkeyup = function () {
        r = validarkeyup(
            keyup_nombre,
            this,
            document.getElementById("snombres_censo"),
            "* Solo letras de 3 a 30 caracteres, comenzando cada palabra con la primera letra en mayúscula."
        );
    };
    /*--------------FIN VALIDACION PARA NOMBRE--------------------*/
    /*--------------VALIDACION PARA APELLIDO--------------------*/
    document.getElementById("apellidos_censo").maxLength = 30;
    document.getElementById("apellidos_censo").onkeypress = function (e) {
        er = /^[A-Za-z\s\b\u00f1\u00d1\u00E0-\u00FC]*$/;
        validarkeypresscenso(er, e);
    };
    document.getElementById("apellidos_censo").onkeyup = function () {
        r = validarkeyup(
            keyup_nombre,
            this,
            document.getElementById("sapellidos_censo"),
            "* Solo letras de 3 a 30 caracteres, comenzando cada palabra con la primera letra en mayúscula."
        );
    };
    /*--------------FIN VALIDACION PARA APELLIDO--------------------*/
    /*--------------VALIDACION PARA SEXO--------------------*/
    document.getElementById("sexo_censo").maxLength = 9;
    document.getElementById("sexo_censo").onkeypress = function (e) {
        er = /^[A-Za-z\b\u00f1\u00d1\u00E0-\u00FC]*$/;
        validarkeypresscenso(er, e);
    };
    document.getElementById("sexo_censo").onchange = function () {
        r = validarselect(
            this,
            document.getElementById("ssexo_censo"),
            "* Seleccione un genero"
        );
    };
    /*--------------FIN VALIDACION PARA SEXO--------------------*/
    /*--------------VALIDACION PARA TELEFONO--------------------*/
    document.getElementById("telefono_censo").maxLength = 15;
    document.getElementById("telefono_censo").onkeypress = function (e) {
        er = /^[0-9\b\u00f1\u00d1\u00E0-\u00FC-]*$/;
        validarkeypresscenso(er, e);
    };
    document.getElementById("telefono_censo").onkeyup = function () {
        r = validarkeyup(
            keyup_telefono,
            this,
            document.getElementById("stelefono_censo"),
            "* El formato debe ser 0426-1234567"
        );
    };
    /*--------------FIN VALIDACION PARA TELEFONO--------------------*/
    /*--------------VALIDACION PARA FECHA DE NACIMIENTO--------------------*/
    document.getElementById("fecha_nacimiento_censo").onkeyup = function () {
        r = validarkeyup(
            keyup_fecha,
            this,
            document.getElementById("sfecha_nacimiento_censo"),
            "* Fecha inválida."
        );
    };
    /*--------------FIN VALIDACION PARA FECHA DE NACIMIENTO-----------------*/
    /*--------------VALIDACION PARA FECHA DE INGRESO--------------------*/
    document.getElementById("fecha_ingreso_censo").onkeyup = function () {
        r = validarkeyup(
            keyup_fecha,
            this,
            document.getElementById("sfecha_ingreso_censo"),
            "* Fecha inválida."
        );
    };
    /*--------------FIN VALIDACION PARA FECHA DE INGRESO--------------------*/
    /*----------------------CRUD DEL MODULO------------------------*/
}
function enviar_censo() {
    a = valida_registrar_censo();
    if (a != "") {
    } else if (disciplinas.length == 0) {
        Swal.fire({
            icon: 'error',
            title: 'Seleccione al menos una diciplina!',
            showConfirmButton: true,
            confirmButtonColor: '#007bff', // Color primario de Bootstrap
            confirmButtonText: 'Aceptar'
        });
    } else {
        var datos = new FormData();
        datos.append("accion", $("#accion_censo").val());
        datos.append("cedula", $("#cedula_censo").val());
        datos.append("nombres", $("#nombres_censo").val());
        datos.append("apellidos", $("#apellidos_censo").val());
        datos.append("sexo", $("#sexo_censo").val());
        datos.append("telefono", $("#telefono_censo").val());
        datos.append("fecha_nacimiento", $("#fecha_nacimiento_censo").val());
        datos.append("fecha_ingreso", $("#fecha_ingreso_censo").val());
        datos.append("id_division", $("#select_division_censo").val());
        datos.append("id_area", $("#area").val());
        datos.append("disciplinas", disciplinas);
        enviaAjaxCenso(datos);
    }
};

function activar_censo () {
    document.getElementById('tbody_disciplinas').innerHTML = '';
    disciplinas = [];
    limpiar_censo();
    $("#accion_censo").val("registrar");
    $("#titulo_censo").text("Datos personales");
    $("#staticBackdrop").modal("show");
};
/*--------------------FIN DE CRUD DEL MODULO----------------------*/
/*-------------------FUNCIONES DE HERRAMIENTAS-------------------*/
function validarkeypresscenso(er, e) {
    key = e.keyCode || e.which;
    tecla = String.fromCharCode(key);
    a = er.test(tecla);
    if (!a) {
        e.preventDefault();
    }
}

function validarselect(etiqueta, etiquetamensaje, mensaje) {
    if (etiqueta.value == 0) {
        etiquetamensaje.innerText = mensaje;
        etiquetamensaje.style.color = "red";
        etiqueta.classList.add("is-invalid");
    } else {
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

function limpiar_censo() {
    $("#cedula_censo").val("");
    $("#nombres_censo").val("");
    $("#apellidos_censo").val("");
    $("#sexo_censo").val(0);
    $("#telefono_censo").val("");
    $("#fecha_nacimiento_censo").val("");
    $("#fecha_ingreso_censo").val("");
    $("#select_division_censo").val(0);
    $("#area").val(0);
    document.getElementById("scedula_censo").innerText = "";
    document.getElementById("snombres_censo").innerText = "";
    document.getElementById("sapellidos_censo").innerText = "";
    document.getElementById("ssexo_censo").innerText = "";
    document.getElementById("stelefono_censo").innerText = "";
    document.getElementById("sfecha_nacimiento_censo").innerText = "";
    document.getElementById("sfecha_ingreso_censo").innerText = "";
    document.getElementById("sselect_division_censo").innerText = "";
    /*  document.getElementById("sarea").innerText = ""; */

    document.getElementById("cedula_censo").classList.remove("is-invalid", "is-valid");
    document.getElementById("nombres_censo").classList.remove("is-invalid", "is-valid");
    document.getElementById("apellidos_censo").classList.remove("is-invalid", "is-valid");
    document.getElementById("sexo_censo").classList.remove("is-invalid", "is-valid");
    document.getElementById("telefono_censo").classList.remove("is-invalid", "is-valid");
    document.getElementById("fecha_nacimiento_censo").classList.remove("is-invalid", "is-valid");
    document.getElementById("fecha_ingreso_censo").classList.remove("is-invalid", "is-valid");
    document.getElementById("select_division_censo").classList.remove("is-invalid", "is-valid");
    /* document.getElementById("area").classList.remove("is-invalid", "is-valid"); */
}

function valida_registrar_censo() {
    var error = false;
    cedula = validarkeyup(
        keyup_cedula,
        document.getElementById("cedula_censo"),
        document.getElementById("scedula_censo"),
        "* El formato debe ser 99999999."
    );
    nombres = validarkeyup(
        keyup_nombre,
        document.getElementById("nombres_censo"),
        document.getElementById("snombres_censo"),
        "* Solo letras de 3 a 30 caracteres, comenzando cada palabra con la primera letra en mayúscula."
    );
    apellidos = validarkeyup(
        keyup_nombre,
        document.getElementById("apellidos_censo"),
        document.getElementById("sapellidos_censo"),
        "* Solo letras de 3 a 30 caracteres, comenzando cada palabra con la primera letra en mayúscula."
    );
    if (document.getElementById("sexo_censo").value == 0) {
        document.getElementById("ssexo_censo").innerHTML = "* Seleccione un genero";
        document.getElementById("ssexo_censo").style.color = "red";
        document.getElementById("sexo_censo").classList.add("is-invalid");
    } else {
        document.getElementById("ssexo_censo").innerHTML = "";
        document.getElementById("sexo_censo").classList.remove("is-invalid");
        document.getElementById("sexo_censo").classList.add("is-valid");
    }
    telefono = validarkeyup(
        keyup_telefono,
        document.getElementById("telefono_censo"),
        document.getElementById("stelefono_censo"),
        "* El formato debe ser 0426-1234567"
    );
    fecha_nacimiento = validarkeyup(
        keyup_fecha,
        document.getElementById("fecha_nacimiento_censo"),
        document.getElementById("sfecha_nacimiento_censo"),
        "* Fecha inválida."
    );
    fecha_ingreso = validarkeyup(
        keyup_fecha,
        document.getElementById("fecha_ingreso_censo"),
        document.getElementById("sfecha_ingreso_censo"),
        "* Fecha inválida."
    );

    if (document.getElementById("select_division_censo").value == 0) {
        document.getElementById("sselect_division_censo").innerHTML = "* Seleccione un división";
        document.getElementById("sselect_division_censo").style.color = "red";
        document.getElementById("select_division_censo").classList.add("is-invalid");
    } else {
        if (document.getElementById("area").value == 0) {
            document.getElementById("sarea").innerHTML = "* Seleccione un área";
            document.getElementById("sarea").style.color = "red";
            document.getElementById("area").classList.add("is-invalid");
        } else {
            document.getElementById("sarea").innerHTML = "";
            document.getElementById("area").classList.remove("is-invalid");
            document.getElementById("area").classList.add("is-valid");
        }
        document.getElementById("sselect_division_censo").innerHTML = "";
        document.getElementById("select_division_censo").classList.remove("is-invalid");
        document.getElementById("select_division_censo").classList.add("is-valid");
    }

    if (
        cedula == 0 ||
        nombres == 0 ||
        apellidos == 0 ||
        document.getElementById("sexo_censo").value == 0 ||
        telefono == 0 ||
        fecha_nacimiento == 0 ||
        fecha_ingreso == 0 ||
        document.getElementById("select_division_censo").value == 0 ||
        document.getElementById("area").value == 0
    ) {
        error = true;
    }
    return error;
}

document.getElementById("select_division_censo").onchange = function () {
    r = validarselect(
        this,
        document.getElementById("sselect_division_censo"),
        "* Seleccione una división"
    );
    var datos = new FormData();
    datos.append("accion", "buscar_area");
    datos.append("id_division", document.getElementById("select_division_censo").value);
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
            document.getElementById("selec_area_censo").innerHTML = response;
        },
        error: (err) => {
            Toast.fire({
                icon: res.error,
            });
        },
    });
}

/*--------------------FUNCIONES CON AJAX----------------------*/

function enviaAjaxCenso(datos) {
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

                limpiar_censo();
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
