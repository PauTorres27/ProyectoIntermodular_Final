document.addEventListener("DOMContentLoaded", () => {

    const forms = document.querySelectorAll("form");

    forms.forEach(form => {
        form.addEventListener("submit", (e) => {

            let valid = true;
            let mensajes = [];

            //Validar campor obligatorios
            form.querySelectorAll("[required]").forEach(campo => {
                if (campo.value.trim() === "") {
                    valid = false;
                    mensajes.push(`El campo "${campo.name}" no puede estar vacío`);
                }
            });

            //Validar fecha (solo si existe)
            const fecha = form.querySelector("input[type='date']");
            if (fecha) {
                const hoy = new Date().toISOString().split("T")[0];
                if (fecha.value < hoy) {
                    valid = false;
                    mensajes.push("La fecha no puede ser anterior a hoy");
                }
            }

            //validar número de personas (si existe)
            const personas = form.querySelector("input[name='n_personas']");
            if (personas && personas.value <= 0) {
                valid = false;
                mensajes.push("El número de personas debe ser mayor que 0");
            }


            //Si hubiera errores, cancelar envío y muestra notificación
            if (!valid) {
                e.preventDefault();
                mostrarToast(mensajes.join("<br>"));
            }

        });
    });
});

//Notificaciones (TOAST)
function mostrarToast(mensaje) {
    const toastContainer = document.getElementById("toast-container");

    toastContainer.innerHTML = `
    <div class="toast align-items-center text-bg-danger border-0 show" role="alert">
       <div class="d-flex">
          <div class="toast-body">${mensaje}</div>
          <button type="button" class="btn-close btn-close-white me-2 m-auto"
                  data-bs-dismiss="toast"></button>
          </div>
        </div>
    `;
}