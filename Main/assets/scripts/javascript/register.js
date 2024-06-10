document.addEventListener("DOMContentLoaded", function() {
    const form = document.querySelector("form");
    const username = form.querySelector("input[name='username']");
    const email = form.querySelector("input[name='email']");
    const password = form.querySelector("input[name='password']");
    const confirmPassword = form.querySelector("input[name='confirm_password']");

    const usernameError = document.createElement("div");
    usernameError.classList.add("error-message");
    username.insertAdjacentElement("afterend", usernameError);

    const emailError = document.createElement("div");
    emailError.classList.add("error-message");
    email.insertAdjacentElement("afterend", emailError);

    const passwordError = document.createElement("div");
    passwordError.classList.add("error-message");
    password.insertAdjacentElement("afterend", passwordError);

    const confirmPasswordError = document.createElement("div");
    ConfirmPasswordError.classList.add("error-message");
    confirmPassword.insertAdjacentElement("afterend", confirmPasswordError);

    form.addEventListener("submit", function(event) {
        let valid = true;

        if (username.value.trim().length < 3) {
            usernameError.textContent = "De gebruikersnaam moet minimaal 3 tekens lang zijn.";
            usernameError.style.display = "block";
            valid = false;
        } else {
            usernameError.style.display = "none";
        }

        if (!/.+@.+\.(com|nl)$/.test(email.value.trim())) {
            emailError.textContent = "E-mail moet endigen op .com of .nl";
            emailError.style.display = "block";
            valid = false;
        } else {
            emailError.style.display = "none";
        }

        if (password.value.trim().length < 8) {
            passwordError.textContent = "Het wachtwoord moet minimaal 8 tekens lang zijn.";
            passwordError.style.display = "block"
            valid = false;
        } else {
            passwordError.style.display = "none";
        }

        if (password.value.trim() !== confirmPassword.value.trim()) {
            confirmPasswordError.textContent = "Wachtwoorden komen niet overeen.";
            confirmPasswordError.style.display = "block";
            valid = false;
        } else {
            confirmPasswordError.style.display = "none";
        }

        if (!valid) {
            event.preventDefault();
        }
    });

    form.addEventListener('invalid', function(event) {
        event.preventDefault();
    }, true);
});