document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector('form');

    const mensajesError = {
        dniclienteorigen: {
            valueMissing: "El DNI del cliente origen es obligatorio.",
            patternMismatch: "Debe tener 8 números seguidos de una letra (ej: 12345678Z)."
        },
        idcuentaorigen: {
            valueMissing: "La cuenta de origen es obligatoria.",
        },
        dniclientedestino: {
            valueMissing: "El DNI del cliente destino es obligatorio.",
            patternMismatch: "Debe tener 8 números seguidos de una letra (ej: 12345678Z)."
        },
        idcuentadestino: {
            valueMissing: "La cuenta de destino es obligatoria.",
        },
        cantidad: {
            valueMissing: "La cantidad es obligatoria.",
            rangeUnderflow: "La cantidad debe ser mayor que 0."
        },
        asunto: {
            valueMissing: "El asunto es obligatorio.",
            patternMismatch: "El mensaje solo puede contener letras, números y signos básicos (máx. 140 caracteres)."
        }
    };

    form.addEventListener("submit", (event) => {
        let valido = form.checkValidity();

        // Limpia mensajes previos
        form.querySelectorAll(".text-danger").forEach(div => div.textContent = "");

        // Si el formulario no es válido, evitamos el envío
        if (!valido) {
            event.preventDefault();
            event.stopImmediatePropagation();
        }
    });

    // Manejo de errores personalizados por campo
    form.querySelectorAll("input").forEach((input) => {
        const errorBox = document.getElementById(input.id + "Error");

        const mostrarMensaje = () => {
            const errores = mensajesError[input.name];
            if (!errores)
                return;

            for (const tipo in input.validity) {
                if (input.validity[tipo] && errores?.[tipo]) {
                    errorBox.textContent = errores[tipo];
                    break;
                }
            }
        };

        input.addEventListener("invalid", (event) => {
            event.preventDefault(); // Evita el mensaje nativo
            mostrarMensaje();
        });

        input.addEventListener("input", () => {
            if (input.checkValidity()) {
                errorBox.textContent = "";
            } else {
                mostrarMensaje();
            }
        });

        // Mostrar mensaje al hacer hover si es inválido
        input.addEventListener("mouseenter", () => {
            if (!input.checkValidity()) {
                mostrarMensaje();
            }
        });

        // Ocultar mensaje al salir si el campo es inválido
        input.addEventListener("mouseleave", () => {
            if (!input.checkValidity()) {
                errorBox.textContent = "";
            }
        });
    });
});
