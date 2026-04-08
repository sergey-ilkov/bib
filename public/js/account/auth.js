(function () {
    // Код выполняется сразу
    console.log("IIFE сработала!");
})();



document.addEventListener("DOMContentLoaded", (event) => {
    console.log('js auth');

});











class AuthForm {
    constructor(section) {
        this.section = section;
        this.sectionId = this.section.getAttribute('id');
        this.form = section.querySelector('form');
        this.url = this.form.getAttribute('action');
        this.inputs = this.form.querySelectorAll('input');
        this.formMessage = section.querySelector('.form-message');
        this.formErrors = section.querySelector('.form-errors');
        this.btnSend = this.form.querySelector('.btn-send');

        this.flagSend = true;

        this.token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        this.modalLoader = document.querySelector('#modal-loader');

        this.objSendData = null;
        this.objData = null;

        this.init();
    }

    init() {
        // console.log(this.section);
        // console.log(this.url);
        // console.log(this.inputs);
        // console.log(this.btnSend);

        console.log(this.token);


        this.events();
    }

    events() {
        this.inputs.forEach(input => {
            const parent = input.parentNode;
            input.addEventListener('input', () => {
                if (input.type == 'email' && this.checkEmail(input.value)) {
                    parent.classList.remove('error');
                }
                else if (this.sectionId == 'new-password' && input.type == 'password' && input.value.length >= 12) {
                    parent.classList.remove('error');
                }

                if (input.type != 'email' && this.sectionId != 'new-password' && input.value.length > 0) {
                    parent.classList.remove('error');
                }


            })
        });

        this.btnSend.addEventListener('click', () => {
            if (this.flagSend && this.isValid()) {
                this.getFormData();
                this.send();
            }
        });


        this.section.addEventListener('keydown', (e) => {
            if (e.key === 'Enter' && this.flagSend && this.isValid()) {
                this.getFormData();
                this.send();
            }
        })
    }

    isValid() {
        let res = true;
        this.inputs.forEach(input => {
            const parent = input.parentNode;
            if (input.value.length === 0) {
                parent.classList.add('error');
                res = false;
            }
            if (input.type == 'email' && !this.checkEmail(input.value)) {
                parent.classList.add('error');
                res = false;
            }
            if (this.sectionId == 'new-password' && input.type == 'password' && input.value.length < 12) {
                parent.classList.add('error');
                res = false;
            }

            // else if (this.sectionId == 'new-password' && input.type == 'password' && input.value.length < 12) {
            //     parent.classList.add('error');
            //     res = false;
            // }
            // else if (input.value.length === 0) {
            //     parent.classList.add('error');
            //     res = false;
            // }
        });
        return res;
    }



    checkEmail(data) {
        const email_reg = /\S+@\S+\.\S+/;
        return email_reg.test(data);
    }

    getFormData() {
        this.objSendData = {};
        this.inputs.forEach(input => {
            this.objSendData[input.name] = input.value;
        });
        this.objSendData['_token'] = this.token;
    }

    loaderToggle(v) {
        this.modalLoader.classList.toggle('show', v);
    }

    resSuccess() {
        console.log('success');
        console.log('this.objData ', this.objData);

        if (this.objData.redirect) {

            if (this.objData.message) {
                this.formMessage.classList.add('success');
                this.formMessage.innerHTML = `<span>${this.objData.message}</span>`;

                if (this.sectionId == 'new-password') {
                    this.form.style.display = 'none';
                }

                setTimeout(() => {
                    window.location.href = this.objData.redirect;
                }, 1200);

            }
            else {

                window.location.href = this.objData.redirect;
            }

            return;
        }

        if (this.objData.messages) {
            let html = '';
            for (const [field, messages] of Object.entries(this.objData.messages)) {

                messages.forEach(message => {
                    html += `<span>${message}</span>`;
                })

            }
            this.formMessage.innerHTML = html;
        }
        if (this.objData.message) {
            this.formMessage.innerHTML = `<span>${this.objData.message}</span>`;
        }


        if (this.sectionId == 'password-reset') {
            this.form.style.display = 'none';
        }




    }
    resError() {
        console.log('errrrrr');
        console.log('this.objData ', this.objData);

        if (this.objData.errors) {

            let html = '';
            for (const [field, messages] of Object.entries(this.objData.errors)) {

                messages.forEach(message => {
                    html += `<span>${message}</span>`;
                })

                // const input = form.querySelector(`[name="${field}"]`);
                // if (input) {
                //     input.classList.add('is-invalid');
                //     const errorBox = form.querySelector(`#error-${field}`);
                //     if (errorBox) errorBox.innerText = messages[0];
                // }
            }

            this.formErrors.innerHTML = html;
        }
        else if (this.objData.message) {
            this.formErrors.innerHTML = this.objData.message;
        }
    }

    clearError() {
        this.formErrors.innerHTML = '';
    }

    async send() {
        console.log('send');
        console.log(this.objSendData);

        if (this.flagSend) {
            this.clearError();
            this.flagSend = false;
            this.objData = {};

            this.loaderToggle(true);




            try {
                const options = {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json;charset=utf-8',
                        // 'X-CSRF-TOKEN': this.token,
                    },
                    body: JSON.stringify(this.objSendData),
                    // credentials: 'same-origin'

                };

                const res = await fetch(this.url, options);

                this.objData = await res.json().catch(() => ({}));

                if (!res.ok) {
                    // this.loaderToggle(false);
                    this.resError();
                    return;
                }


                this.resSuccess();
            }
            catch (err) {

                this.objData['errors'] = { 'network': ['Network error. Please try again.'] };
                this.resError();

            }
            finally {

                this.loaderToggle(false);
                this.flagSend = true;
            }


        }



    }
}

const signIn = document.querySelector('#sign-in');
if (signIn) {
    new AuthForm(signIn);
}
const passwordReset = document.querySelector('#password-reset');
if (passwordReset) {
    new AuthForm(passwordReset);
}
const newPassword = document.querySelector('#new-password');
if (newPassword) {
    new AuthForm(newPassword);
}