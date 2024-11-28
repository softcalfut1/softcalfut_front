 // Función para mostrar u ocultar la contraseña
 document.getElementById("togglePassword").addEventListener("click", function() {
    const passwordField = document.getElementById("password");
    const passwordType = passwordField.type === "password" ? "text" : "password";
    passwordField.type = passwordType;
});

document.getElementById("loginForm").addEventListener("submit", function(event) {
    event.preventDefault();
    
    const password = document.getElementById("password").value;
    alert("Formulario enviado con éxito.");
});


document.querySelectorAll('#cerrarModal').forEach(button => {
    button.addEventListener('click', function () {
        document.getElementById('modal').classList.add('hidden');
    });
});