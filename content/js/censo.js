document.addEventListener("DOMContentLoaded", function () {

    // Mostrar modal de registro
    document.getElementById("evento").addEventListener("click", function () {
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

    // Enviar formulario con validaciones
    $("#formCenso").on("submit", function (e) {
        e.preventDefault();
        if (!validarFormulario()) return;

        let formData = {
            nombre: $("#nombre").val(),
            descripcion: $("#descripcion").val(),
            fecha_inicio: $("#fecha_inicio").val(),
            fecha_fin: $("#fecha_fin").val()
        };
        
        $.post("api/censos/registrar.php", formData, function (response) {
            Swal.fire("Éxito", "Censo registrado correctamente", "success");
            $("#modalCenso").modal("hide");
            tablaCensos.ajax.reload();
        });
    });

    // Eliminar censo
    $("#tablaCensos").on("click", ".eliminar", function () {
        let id = $(this).data("id");
        Swal.fire({
            title: "¿Estás seguro?",
            text: "Esta acción no se puede deshacer",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Sí, eliminar",
            cancelButtonText: "Cancelar"
        }).then((result) => {
            if (result.isConfirmed) {
                $.post("api/censos/eliminar.php", { id: id }, function () {
                    Swal.fire("Eliminado", "El censo ha sido eliminado", "success");
                    tablaCensos.ajax.reload();
                });
            }
        });
    });
});
