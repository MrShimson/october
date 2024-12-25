class Form {
    formNode = document.querySelector('.lead-form');

    constructor(id) {
        this.formNode = document.querySelector(`#${id}`);
        this.inputName = this.formNode.querySelector('input[name="name"]');
        this.inputPhone = this.formNode.querySelector('input[name="phone"]');
        this.privacyCheckbox = this.formNode.querySelector('input.privacy-check');
        this.btnSubmit = this.formNode.querySelector('button[type="submit"]');
        this.alreadyValidated = false;

        this.initHandlers();
    }

    initHandlers() {
        this.formNode.addEventListener('submit', this.formSubmitHandler.bind(this));
        this.btnSubmit.addEventListener('click', this.formSubmitHandler.bind(this));
        this.inputName.addEventListener('keydown', this.inputKeydownHandler.bind(this));
        this.inputPhone.addEventListener('keydown', this.inputKeydownHandler.bind(this));
        this.inputName.addEventListener('input', this.inputChangeHandler.bind(this));
        this.inputPhone.addEventListener('input', this.inputChangeHandler.bind(this));
        this.privacyCheckbox.addEventListener('change', this.inputChangeHandler.bind(this));
    }

    formSubmitHandler(evt) {
        evt.preventDefault();

        this.submit();
    }

    inputKeydownHandler(evt) {
        if (this.isEnterKey(evt)) {
            evt.preventDefault();
        }
    }

    inputChangeHandler(evt) {
        if (this.alreadyValidated) {
            this.validate();
        }

        console.log(evt.target.value);
    }

    validate() {
        let isValid = true;

        if (!this.inputName.value) {
            isValid = false;
            this.addError(this.inputName, 'Необходимо указать имя');
        } else {
            this.removeError(this.inputName);
        }

        if (!this.inputPhone.value || !this.validatePhoneNumber(this.inputPhone.value)) {
            isValid = false;
            this.addError(this.inputPhone, 'Необходимо указать телефон');
        } else {
            this.removeError(this.inputPhone);
        }

        if (!this.privacyCheckbox.checked) {
            isValid = false;
            this.addError(this.privacyCheckbox, 'Необходимо подтвердить');
        } else {
            this.removeError(this.privacyCheckbox);
        }

        if (isValid) {
            this.btnSubmit.disabled = false;
            this.btnSubmit.classList.remove('disabled');
        } else {
            this.btnSubmit.disabled = true;
            this.btnSubmit.classList.add('disabled');
        }

        this.alreadyValidated = true;

        return isValid;
    }

    validatePhoneNumber(str) {
        const regex = /^\+7\(\d{3}\)\d{3}-\d{2}-\d{2}$/;
        return regex.test(str);
    }

    submit() {
        if (!this.validate()) {
            return;
        }

        this.formNode.submit();
    }

    isEnterKey(evt) {
        return evt.key === 'Enter';
    }

    addError(input, message) {
        if (!input) {
            return;
        }

        const inputWrapper = input.closest('.form-group');
        let currentError = inputWrapper.querySelector('.form-error');
        if (currentError) {
            currentError.innerText = message;
        } else {
            const error = document.createElement('div');
            error.className = 'form-error mt-1 fs-12 text-danger';
            error.innerText = message;
            inputWrapper.append(error);
        }

        input.classList.add('is-invalid');
    }

    removeError(input) {
        const inputWrapper = input.closest('.form-group');
        const error = inputWrapper.querySelector('.form-error');
        if (error) {
            error.remove();
        }
        input.classList.remove('is-invalid');
    }
}

new Form('lead-form');
