function limpiar() {
    $("#accion").val("");
    $("#id_censo").val("");
    $("#nombre").val("");
    $("#descripcion").val("");
    $("#fecha_inicio").val("");
    $("#fecha_fin").val("");
}
document.addEventListener("DOMContentLoaded", function () {
    // Mostrar modal de registro
    document.getElementById("evento").addEventListener("click", function () {
        limpiar();
        $("#accion").val("registrar");
        $("#modalCenso").modal("show");
    });

    // Expresiones regulares
    const regexNombre = /^[a-zA-Z\s]{3,50}$/;
    const regexDescripcion = /^[a-zA-Z0-9\s,.!?]{10,200}$/;

    // Validaciones en tiempo real
    $("#nombre").on("keyup keypress", function () {
        validarCampo($(this), regexNombre, "Nombre");
    });
    
    $("#descripcion").on("keyup keypress", function () {
        validarCampo($(this), regexDescripcion, "Descripcion");
    });

    function validarCampo(input, regex, campo) {
        let mensajeError = $("#" + campo.toLowerCase() + "-error");
        
        if (!regex.test(input.val().trim())) {
            input.addClass("is-invalid");
            mensajeError.text("El " + campo + " no es válido.");
        } else {
            input.removeClass("is-invalid");
            input.addClass("is-valid");
            mensajeError.text(""); // Limpiar mensaje de error
        }
    }

    // Validaciones del formulario
    function validarFormulario() {
        let nombre = $("#nombre").val().trim();
        let descripcion = $("#descripcion").val().trim();
        let fecha_inicio = $("#fecha_inicio").val();
        let fecha_fin = $("#fecha_fin").val();

        if (!regexNombre.test(nombre) || !regexDescripcion.test(descripcion)) {
            Swal.fire("Error", "Verifica los campos del formulario", "error");
            return false;
        }

        if (!fecha_inicio || !fecha_fin) {
            Swal.fire("Error", "Todos los campos son obligatorios", "error");
            return false;
        }

        if (new Date(fecha_inicio) >= new Date(fecha_fin)) {
            Swal.fire("Error", "La fecha de inicio debe ser anterior a la fecha de fin", "error");
            return false;
        }
        return true;
    }

    $("#formCenso").on("submit", function (e) {
        e.preventDefault();
        if (!validarFormulario()) return;
        let toastMixin = Swal.mixin({
            showConfirmButton: false,
            timer: 1500,
            timerProgressBar: true,
          });
          
        let formData = {
            accion: $("#accion").val(),
            id_censo: $("#id_censo").val(),
            nombre: $("#nombre").val(),
            descripcion: $("#descripcion").val(),
            fecha_inicio: $("#fecha_inicio").val(),
            fecha_fin: $("#fecha_fin").val()
        };
    
        $.post("", formData, function (response) {
            try {
                let res = JSON.parse(response);
    
                toastMixin.fire({
                    title: res.title,
                    text: res.message,
                    icon: res.icon,
                  });
                if (res.estatus == "1") { 
                    $("#modalCenso").modal("hide");
                    setTimeout(function () {
                        window.location.reload();
                    }, 1500);
                }
    
            } catch (error) {
                Swal.fire("Error", "Ocurrió un error al procesar la respuesta.", "error");
            }
        }).fail(function () {
            Swal.fire("Error", "No se pudo conectar con el servidor.", "error");
        });
    });
    
});
function eliminar(id) {   
    let toastMixin = Swal.mixin({
        showConfirmButton: false,
        timer: 1500,
        timerProgressBar: true,
      });

    Swal.fire({
        title: "¿Está seguro de eliminar?",
        text: "Se eliminará el censo.",
        icon: "warning",
        showCloseButton: true,
        showCancelButton: true,
        confirmButtonColor: "#0C72C4",
        cancelButtonColor: "#9D2323",
        confirmButtonText: "Confirmar",
        cancelButtonText: "Cancelar",
    }).then((result) => {
        if (result.isConfirmed) {
            $.post("", { accion: "eliminar", id_censo: id }, function (response) {
                let res = JSON.parse(response);
                toastMixin.fire({
                    title: res.title,
                    text: res.message,
                    icon: res.icon,
                  });
                if (res.estatus == "1") { 
                    $("#modalCenso").modal("hide");
                    setTimeout(function () {
                        window.location.reload();
                    }, 1500);
                }
            });
        }
    });
}

function cargar_datos(id) {
    limpiar();
    $("#accion").val("modificar");
    $.ajax({
        url: "", // Asegúrate de colocar aquí la ruta correcta de tu backend
        type: "POST",
        data: { accion: "editar", id_censo: id },
        success: function (response) {
            let res = JSON.parse(response);
            $("#id_censo").val(res.id_censo);
            $("#nombre").val(res.nombre);
            $("#descripcion").val(res.descripcion);
            $("#fecha_inicio").val(res.fecha_inicio);
            $("#fecha_fin").val(res.fecha_final); // Cambia `fecha_final` por `fecha_fin` en el JSON de PHP si es necesario.
            $("#modalCenso").modal("show");
        },
        error: function () {
            Swal.fire("Error", "No se pudo cargar el censo", "error");
        },
    });
}
