document.addEventListener('DOMContentLoaded', function() {

    document.getElementById('inschrijfformulier').addEventListener('submit', function(event) {
        event.preventDefault(); 
        
        const lettersHere = /[a-zA-Z]/;
        const specialCharsRegex = /[!@#$%^&*(),.?":{}|<>]/;

        let isValid = true;

        // Validatie voor BurgerServiceNummer
        const service = document.getElementById('service');
        const serviceError = document.getElementById('service-error');
        if (service.value.trim() === '') {
            serviceError.textContent = 'Vul alstublieft uw BurgerServiceNummer in.';
            isValid = false;
        }else if(service.value.length > 9){
            serviceError.textContent = 'Vul niet meer dan 9 cijfers in';
            isValid = false;
        }else if(lettersHere.test(service.value) || !/^\d+$/.test(service.value)){
            console.log(service.value);
            serviceError.textContent = 'Vul alstublieft alleen cijfers in.';
            isValid = false;
        } else {
            serviceError.textContent = '';
        }

        // Validatie voor Voornaam
        const fname = document.getElementById('fname');
        const fnameError = document.getElementById('fname-error');
        if (fname.value.trim() === '') {
            fnameError.textContent = 'Vul alstublieft uw voornaam in.';
            isValid = false;
        } else {
            fnameError.textContent = '';
        }

        // Validatie voor Achternaam
        const lname = document.getElementById('lname');
        const lnameError = document.getElementById('lname-error');
        if (lname.value.trim() === '') {
            lnameError.textContent = 'Vul alstublieft uw achternaam in.';
            isValid = false;
        } else {
            lnameError.textContent = '';
        }

        // Validatie voor Geboortedatum
        const birth = document.getElementById('birth');
                const birthError = document.getElementById('birth-error');
                if (birth.value.trim() === '') {
                    birthError.textContent = 'Vul alstublieft uw geboortedatum in.';
                    isValid = false;
                } else {
                    const birthDate = new Date(birth.value);
                    const today = new Date();
                    const age = today.getFullYear() - birthDate.getFullYear();
                    const monthDiff = today.getMonth() - birthDate.getMonth();
                    const dayDiff = today.getDate() - birthDate.getDate();

                    if (age < 16 || (age === 16 && (monthDiff < 0 || (monthDiff === 0 && dayDiff < 0)))|| age > 60) {
                        birthError.textContent = 'U moet tussen de 16 en 60 jaar oud zijn om hier naar school te gaan.';
                        isValid = false;
                    } else {
                        birthError.textContent = '';
                    }
                }

        // Validatie voor Gender
        const genderError = document.getElementById('gender-error');
        const genderInputs = document.querySelectorAll('input[name="gender"]');
        let genderSelected = false;
        genderInputs.forEach(input => {
            if (input.checked) {
                genderSelected = true;
            }
        });
        if (!genderSelected) {
            genderError.textContent = 'Selecteer alstublieft uw gender.';
            isValid = false;
        } else {
            genderError.textContent = '';
        }

        // Validatie voor Adres
        const adres = document.getElementById('adres');
        const adresError = document.getElementById('adres-error');
        if (adres.value.trim() === '') {
            adresError.textContent = 'Vul alstublieft uw adres in.';
            isValid = false;
        } else {
            adresError.textContent = '';
        }

        // Validatie voor Postcode
        const postcode = document.getElementById('Postcode');
        const postcodeError = document.getElementById('Postcode-error');
        if (postcode.value.trim() === '') {
            postcodeError.textContent = 'Vul alstublieft uw postcode in.';
            isValid = false;
        } else if (specialCharsRegex.test(postcode.value)) {
            postcodeError.textContent = 'Speciale tekens zijn niet toegestaan in de postcode.';
            isValid = false;
        } else {
            postcodeError.textContent = '';
        }

        // Validatie voor E-mail
        const email = document.getElementById('email');
        const emailError = document.getElementById('email-error');
        if (email.value.trim() === '') {
            emailError.textContent = 'Vul alstublieft uw e-mail in.';
            isValid = false;
        } else if (!email.validity.valid) {
            emailError.textContent = 'Vul een geldig e-mailadres in nu.';
            isValid = false;
        } else if (!isValidEmailDomain(email.value, ['.nl', '.com', '.cn', '.de', '.net', '.uk', '.org', '.ru', 'br', '.xyz'])) {
            emailError.textContent = 'Het e-mailadres moet eindigen op een geldige domeinnaam';
            isValid = false;
        } else {
            emailError.textContent = '';
        }

        // Validatie voor Telefoonnummer
        const phone = document.getElementById('phone');
        const phoneError = document.getElementById('phone-error');
        if (phone.value.trim() === '') {
            phoneError.textContent = 'Vul alstublieft uw telefoonnummer in.';
            isValid = false;
        } else if (!isValidPhoneNumber(phone.value)) {
            phoneError.textContent = 'Vul alstublieft een geldig telefoonnummer in.';
            isValid = false;
        } else {
            phoneError.textContent = '';
        }

        // Als alles geldig is, verzend het formulier handmatig
        if (isValid) {
            this.submit();
        }
    });
});


function isValidEmailDomain(email, allowedDomains) {
    const domain = email.substring(email.lastIndexOf('@') + 1); // Haal het domein op na '@'
    
    for (let allowedDomain of allowedDomains) {
        if (domain.endsWith(allowedDomain)) {
            return true;
        }
    }
    return false;
}

function isValidPhoneNumber(phoneNumber) {
    // Verwijder spaties, streepjes en haakjes uit het telefoonnummer
    const cleanedPhoneNumber = phoneNumber.replace(/[\s-()]/g, '');

    // Controleer of het telefoonnummer alleen cijfers bevat en minimaal 7 cijfers heeft
    return /^\d{7,}$/.test(cleanedPhoneNumber);
}
