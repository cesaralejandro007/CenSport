// Array para almacenar las disciplinas agregadas
var disciplinas = [];

// Función para agregar disciplina a la tabla y al array
document.getElementById('agregar').addEventListener('click', function() {
    var input = document.getElementById('id_diciplina');
    var id_persona = document.getElementById('id_persona').value;
    // Buscamos el option cuyo value coincida con lo escrito en el input
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
        // Llamada opcional a función extra, si aplica
        if (input.value !== "" && nombreDeporte !== ""){
            comprobar_pers_disciplinas(input.value, nombreDeporte,id_persona);
        }
        // Se agrega el valor (que en este caso es el nombre de la disciplina)
        disciplinas.push(input.value);
        var tbody = document.getElementById('tbody_disciplinas');
        var newRow = document.createElement('tr');
        newRow.innerHTML = `
            <td class="text-center">${nombreDeporte}</td>
            <td class="text-center">
                <button class="btn btn-danger btn-sm" onclick="eliminarDeporte(this)">Eliminar</button>
            </td>
        `;
        tbody.appendChild(newRow);
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
    var row = button.parentNode.parentNode;
    // Obtenemos el contenido de la primera celda (la disciplina)
    var nombreDeporte = row.firstChild.textContent;
    var index = disciplinas.indexOf(nombreDeporte);
    if (index !== -1) {
        disciplinas.splice(index, 1);
        row.parentNode.removeChild(row);
    }
}

var keyup_cedula = /^[0-9]{7,8}$/;
var keyup_nombre = /^[A-ZÁÉÍÓÚ][a-zñáéíóú]{2,29}(\s(de|De|del|Del)?\s?[A-ZÁÉÍÓÚ][a-zñáéíóú]{2,29})?$/;
var keyup_fecha = /^\d{4}-\d{2}-\d{2}$/;
var keyup_telefono = /^[0-9]{4}-\d{7,8}$/

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
            "* Solo letras de 3 a 30 caracteres, comenzando cada palabra con la primera letra en mayúscula."
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
            "* Solo letras de 3 a 30 caracteres, comenzando cada palabra con la primera letra en mayúscula."
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
            datos.append("disciplinas", disciplinas);
            enviaAjax(datos);
        }
    };

    document.getElementById("evento").onclick = function () {
        document.getElementById('tbody_disciplinas').innerHTML = '';
        disciplinas = [];
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
        "* Solo letras de 3 a 30 caracteres, comenzando cada palabra con la primera letra en mayúscula."
    );
    apellidos = validarkeyup(
        keyup_nombre,
        document.getElementById("apellidos"),
        document.getElementById("sapellidos"),
        "* Solo letras de 3 a 30 caracteres, comenzando cada palabra con la primera letra en mayúscula."
    );
    if (document.getElementById("sexo").value == 0) {
        document.getElementById("ssexo").innerHTML = "* Seleccione un genero";
        document.getElementById("ssexo").style.color = "red";
        document.getElementById("sexo").classList.add("is-invalid");
    } else {
        document.getElementById("ssexo").innerHTML = "";
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

    if (document.getElementById("select_division").value == 0) {
        document.getElementById("sselect_division").innerHTML = "* Seleccione un división";
        document.getElementById("sselect_division").style.color = "red";
        document.getElementById("select_division").classList.add("is-invalid");
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
        document.getElementById("sselect_division").innerHTML = "";
        document.getElementById("select_division").classList.remove("is-invalid");
        document.getElementById("select_division").classList.add("is-valid");
    }

    if (
        cedula == 0 ||
        nombres == 0 ||
        apellidos == 0 ||
        document.getElementById("sexo").value == 0 ||
        telefono == 0 ||
        fecha_nacimiento == 0 ||
        fecha_ingreso == 0 ||
        document.getElementById("select_division").value == 0 ||
        document.getElementById("area").value == 0
    ) {
        error = true;
    }
    return error;
}

document.getElementById("select_division").onchange = function () {
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

function comprobar_pers_disciplinas(id_diciplina, nombreDeporte,id_persona) {
    var datos = new FormData();
    datos.append("accion", "comprobar_pers_disciplinas");
    datos.append("id_diciplina", id_diciplina);
    datos.append("nombre_deporte", nombreDeporte);
    datos.append("id_persona", id_persona);
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
                var index = disciplinas.indexOf(nombreDeporte);
                if (index !== -1) {
                    disciplinas.splice(index, 1);
                }
                toastMixin.fire({
                    title: res.title,
                    text: res.message,
                    icon: res.icon,
                });

                // Eliminar la fila de la tabla
                eliminarFilaPorNombre(nombreDeporte);
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

function eliminarFilaPorNombre(nombreDeporte) {
    var tbody = document.getElementById('tbody_disciplinas');
    var rows = tbody.getElementsByTagName('tr');

    for (let i = 0; i < rows.length; i++) {
        let cell = rows[i].getElementsByTagName('td')[0];
        if (cell.textContent === nombreDeporte) {
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


function eliminarDeporteEditado(id_deporte, id_persona) {
    Swal.fire({
        title: '¿Estás seguro?',
        text: "Este deporte será eliminado de las disciplinas del funcionario.",
        icon: 'warning',
        showCloseButton: true,
        showCancelButton: true,
        confirmButtonColor: "#0C72C4",
        cancelButtonColor: "#9D2323",
        confirmButtonText: "Confirmar",
        cancelButtonText: "Cancelar",
    }).then((result) => {
        if (result.isConfirmed) {
            var datos = new FormData();
            datos.append("accion", "eliminar_deporte_funcionario");
            datos.append("id_deporte", id_deporte);
            datos.append("id_persona", id_persona);
            mostrar(datos);
        }
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
        url: "", // La URL de tu API o controlador
        type: "POST",
        contentType: false,
        data: datos,
        processData: false,
        cache: false,
        success: (response) => {
            var res = JSON.parse(response);

            if (res && typeof res.resultado === 'undefined') {
                limpiar();
                document.getElementById('tbody_disciplinas').innerHTML = '';
                disciplinas = [];
                var tableHTML = '';
                res[0].deportes.forEach(function (deporte) {
                    disciplinas.push(deporte.nombre_deporte);
                    tableHTML += '<tr>';
                    tableHTML += '<td class="text-center">' + deporte.nombre_deporte + '</td>';
                    tableHTML += '<td class="text-center"><button class="btn btn-danger btn-sm" onclick="eliminarDeporteEditado(' + deporte.id_deporte + ', ' + res[0].id_persona + ')">Eliminar</button></td>';
                    tableHTML += '</tr>';
                });

                // Usar appendChild para añadir las filas
                document.getElementById('tbody_disciplinas').innerHTML = tableHTML;

                var datos = new FormData();
                datos.append("accion", "buscar_area");
                datos.append("id_division", res[0].idDivision);
                buscar_division_area(datos);

                // Mostrar los datos del funcionario
                $("#id_persona").val(res[0].id_persona);
                $("#cedula").val(res[0].cedula);
                $("#nombres").val(res[0].nombres);
                $("#apellidos").val(res[0].apellidos);
                $("#sexo").val(res[0].sexo);
                $("#telefono").val(res[0].telefono);
                $("#fecha_nacimiento").val(res[0].fecha_nacimiento);
                $("#fecha_ingreso").val(res[0].fecha_ingreso);
                $("#select_division").val(res[0].idDivision);
                $("#enviar").text("Modificar");
                $("#staticBackdrop").modal("show");
                $("#accion").val("modificar");
                document.getElementById("accion").innerText = "modificar";
                $("#titulo").text("Modificar Funcionario");
            } else {
                toastMixin.fire({
                    title: "Funcionarios",
                    text: "Debe quedar al menos un deporte asignado.",
                    icon: "warning",
                });
            }

            // alert(disciplinas); // Descomentar si necesitas ver el array de disciplinas

            setTimeout(function () {
                $("#area").val(res[0].idArea);
            }, 100);
        },
        error: (err) => {
            toastMixin.fire({
                icon: 'error',
                title: 'Error al cargar los datos',
            });
        },
    });
}
