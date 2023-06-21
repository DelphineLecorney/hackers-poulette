function validateForm(event) {
    let nameInput = document.getElementById('name');
    let firstnameInput = document.getElementById('firstname');
    let addressEmailInput = document.getElementById('addressEmail');
    let confirmAddressEmailInput = document.getElementById('confirmAddressEmail');
    let concernsInput = document.getElementById('concerns');
    let descriptionInput = document.getElementById('description');
    let filesInput = document.getElementById('files');

    let nameError = document.getElementById('nameError');
    let firstnameError = document.getElementById('firstnameError');
    let addressEmailError = document.getElementById('addressEmailError');
    let confirmAddressEmailError = document.getElementById('confirmAddressEmailError');
    let concernsError = document.getElementById('concernsError');
    let descriptionError = document.getElementById('descriptionError');
    let filesError = document.getElementById('filesError');

    nameError.textContent = '';
    firstnameError.textContent = '';
    addressEmailError.textContent = '';
    confirmAddressEmailError.textContent = '';
    concernsError.textContent = '';
    descriptionError.textContent = '';
    filesError.textContent = '';

    let isValid = true;

    if (nameInput.value.trim() === '') {
        nameError.textContent = 'Please enter your name';
        isValid = false;
    }

    if (firstnameInput.value.trim() === '') {
        firstnameError.textContent = 'Please enter your firstname';
        isValid = false;
    }

    if (addressEmailInput.value.trim() === '') {
        addressEmailError.textContent = 'Please enter your email';
        isValid = false;
    }

    if (confirmAddressEmailInput.value.trim() === '') {
        confirmAddressEmailError.textContent = 'Please confirm your email';
        isValid = false;
    }

    if (concernsInput.value.trim() === '') {
        concernsError.textContent = 'Please select a concern';
        isValid = false;
    }

    if (descriptionInput.value.trim() === '') {
        descriptionError.textContent = 'Please enter a description';
        isValid = false;
    }

    if (filesInput.value !== '' && !/\.(jpg|png|gif)$/i.test(filesInput.value)) {
        filesError.textContent = "Your file isn't valid, only JPG, PNG or GIF files are allowed";
        isValid = false;
    }

    if (!isValid) {
        event.preventDefault();
    }
}

document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('AddData').addEventListener('submit', validateForm);
});

