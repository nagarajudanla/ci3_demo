function onlyAlphabetKey(evt) {
    let charCode = (evt.which) ? evt.which : evt.keyCode;

    // Allow control keys like backspace, tab, space
    if (charCode == 8 || charCode == 9 || charCode == 32) {
        return true;
    }

    // A-Z (65–90) and a-z (97–122)
    if ((charCode >= 65 && charCode <= 90) || (charCode >= 97 && charCode <= 122)) {
        return true;
    }

    return false;
}


function onlyNumberKey(evt) {
    let charCode = (evt.which) ? evt.which : evt.keyCode;

    // Allow control keys (Backspace, Tab)
    if (charCode === 8 || charCode === 9) {
        return true;
    }

    // Allow only digits (0-9)
    if (charCode < 48 || charCode > 57) {
        return false;
    }
    return true;
}

function validatePhoneLength(input) {
    if (input.value.length > 10) {
        input.value = input.value.slice(0, 10);
    }
}

document.querySelector('form').addEventListener('submit', function(e) {
    var phoneInput = document.querySelector('input[name="phone"]');
    if (phoneInput.value.length !== 10) {
        e.preventDefault();
        alert("Phone number must be exactly 10 digits.");
    }
});