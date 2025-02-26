var keyup_nombre = /^(?!.*\s{2})[A-ZÁÉÍÓÚÑ][a-záéíóúñ]*(?:\s[A-ZÁÉÍÓÚÑ][a-záéíóúñ]*){0,49}$/;

document.addEventListener("DOMContentLoaded", () => {
  const nombreInput = document.getElementById("nombre_deporte");
  const mensajeError = document.getElementById("snombre_deporte");
  const enviarBtn = document.getElementById("enviar");

  nombreInput.maxLength = 30;

  nombreInput.addEventListener("keypress", (e) => {
    const er = /^[A-Za-z\s\b\u00f1\u00d1\u00E0-\u00FC]*$/;
    if (!er.test(e.key)) e.preventDefault();
  });

  nombreInput.addEventListener("keyup", () => {
    validarKeyUp(keyup_nombre, nombreInput, mensajeError, "* Solo letras de 3 a 30 caracteres, comenzando cada palabra con la primera letra en mayúscula.");
  });

  enviarBtn.addEventListener("click", () => {
    if (validarFormulario()) {
      let datos = new FormData();
      datos.append("accion", document.getElementById("accion").value);
      datos.append("id", document.getElementById("id_deporte").value);
      datos.append("nombre_deporte", nombreInput.value);
      enviaAjax(datos);
    }
  });

  document.getElementById("evento").addEventListener("click", () => {
    limpiar();
    $("#accion").val("registrar");
    $("#titulo").text("Registrar Funcionario");
    $("#enviar").text("Incluir");
    $("#staticBackdrop").modal("show");
  });
});

function validarKeyUp(expresion, input, mensajeElemento, mensaje) {
  if (!expresion.test(input.value)) {
    mensajeElemento.innerText = mensaje;
    mensajeElemento.style.color = "red";
    input.classList.add("is-invalid");
    return false;
  } else {
    mensajeElemento.innerText = "";
    input.classList.remove("is-invalid");
    input.classList.add("is-valid");
    return true;
  }
}

function validarFormulario() {
  if (!validarKeyUp(keyup_nombre, document.getElementById("nombre_deporte"), document.getElementById("snombre_deporte"), "* Solo letras de 3 a 30 caracteres, comenzando cada palabra con la primera letra en mayúscula.")) {
    Swal.fire({
      icon: "error",
      title: "Error",
      text: "Por favor, complete correctamente el formulario.",
    });
    return false;
  }
  return true;
}

function limpiar() {
  document.getElementById("nombre_deporte").value = "";
  document.getElementById("snombre_deporte").innerText = "";
  document.getElementById("nombre_deporte").classList.remove("is-invalid", "is-valid");
}

function enviaAjax(datos) {
  $.ajax({
    url: "",
    type: "POST",
    contentType: false,
    data: datos,
    processData: false,
    cache: false,
    success: (response) => {
      var res = JSON.parse(response);
      Swal.fire({
        title: res.title,
        text: res.message,
        icon: res.icon,
        timer: 2000,
        showConfirmButton: false,
      });
      if (res.estatus == 1) {
        limpiar();
        setTimeout(() => window.location.reload(), 1500);
      }
    },
    error: () => {
      Swal.fire({
        icon: "error",
        title: "Error",
        text: "Ocurrió un error inesperado.",
      });
    },
  });
}

function eliminar(id) {
  Swal.fire({
    title: "¿Está seguro de eliminar?",
    text: "Se eliminarán los grupos deportivos asociados a este deporte.",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#0C72C4",
    cancelButtonColor: "#9D2323",
    confirmButtonText: "Confirmar",
    cancelButtonText: "Cancelar",
  }).then((result) => {
    if (result.isConfirmed) {
      var datos = new FormData();
      datos.append("accion", "eliminar");
      datos.append("id_deporte", id);
      enviaAjax(datos);
    }
  });
}

function cargar_datos(id_persona) {
  var datos = new FormData();
  datos.append("accion", "editar");
  datos.append("id_deporte", id_persona);
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