const formulario = document.getElementById("formulario");
const inputs = document.querySelectorAll(
  "#formulario input, #formulario select"
);

const expresiones = {
  documento: /^\d{7,11}$/,
  contrasena: /^.{8,12}$/,
  nombre: /^[a-zA-ZÀ-ÿ\s]{15,40}$/,
  email: /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/
};

const campos = {
  documento: false,
  contrasena: false,
  nombre: false,
  email: false
};

const validarFormulario = (e) => {
  switch (e.target.name) {
    case "documento":
      validarCampo(expresiones.documento, e.target, "documento");
      break;
    case "contrasena":
      validarCampo(expresiones.contrasena, e.target, "contrasena");
      break;
    case "nombre":
      validarCampo(expresiones.nombre, e.target, "nombre");
      break;
    case "email":
      validarCampo(expresiones.email, e.target, "email");
      break;
  }
};

const validarCampo = (expresion, input, campo) => {
  if (expresion.test(input.value)) {
    document
      .getElementById(`grupo__${campo}`)
      .classList.remove("formulario__grupo-incorrecto");
    document
      .getElementById(`grupo__${campo}`)
      .classList.add("formulario__grupo-correcto");
    campos[campo] = true;
  } else {
    document
      .getElementById(`grupo__${campo}`)
      .classList.add("formulario__grupo-incorrecto");
    document
      .getElementById(`grupo__${campo}`)
      .classList.remove("formulario__grupo-correcto");
    campos[campo] = false;
  }
};

inputs.forEach((input) => {
  input.addEventListener("keyup", validarFormulario);
  input.addEventListener("blur", validarFormulario);
});

formulario.addEventListener("submit", (e) => {
  e.preventDefault();

  if (Object.values(campos).every((campo) => campo)) {
    const formData = new FormData(formulario);

    fetch("guardar_datos.php", {
      method: "POST",
      body: formData
    })
      .then((response) => response.json()) // Parsear la respuesta como JSON
      .then((data) => {
        if (data.status === "error") {
          console.error("Error en el servidor:", data.message);
          alert(data.message);
        } else {
          console.log(data.message); // Puedes mostrar un mensaje de éxito aquí
          alert("¡Registro exitoso!");
          formulario.reset();
          window.location.href = "lista_instructores.php"; // Redireccionar a lista_instructores.php
        }
      })
      .catch((error) => {
        console.error("Error:", error);
        alert(
          "Hubo un error al procesar tu solicitud. Por favor, inténtalo de nuevo más tarde."
        );
      });
  } else {
    console.log("Formulario inválido. Por favor, revisa los campos.");
  }
});
