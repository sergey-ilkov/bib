(function () {
    // Код выполняется сразу
    console.log("IIFE сработала!");
})();



document.addEventListener("DOMContentLoaded", (event) => {
    console.log('js auth');

    // initAuthLogin();
});


























function initAuthLogin() {
    const loginFormWrap = document.querySelector('.login-form-wrap');
    const form = document.querySelector('#auth-login-form');
    if (!loginFormWrap && !form) return;

    const formError = loginFormWrap.querySelector('.login-form-error');
    const forminputs = form.querySelectorAll('input');

    const inputs = form.querySelectorAll('.login-form-input');
    const btnSignIn = form.querySelector('.btn-sign-in');

    const url = form.getAttribute('action');

    inputs.forEach(input => {
        input.addEventListener('input', () => {
            if (input.value.length > 4) {
                const parent = input.parentNode;
                parent.classList.remove('error');

            }
        })
    });

    let flagSend = true;
    let objData = null;

    btnSignIn.addEventListener('click', () => {

        if (isValid()) {
            const data = getFormData();
            send(data);
        }


    })

    function isValid() {
        let res = true;
        inputs.forEach(input => {
            if (input.value.length == 0) {
                res = false;
                const parent = input.parentNode;
                parent.classList.add('error');
            }
        });
        return res;
    }


    function getFormData() {
        const data = {};
        forminputs.forEach(input => {
            data[input.name] = input.value;
        })

        return data;

    }


    function resSuccess() {
        if (objData['auth']) {

            console.log('redirect account');
            // window.location.assign(data.redirect)

            // location.reload();
        }
    }
    function resError() {
        console.log(objData);

        if (objData['status'] == 429 || this.objData['status'] == 419) {
            // 429 Too Many Requests 419  CSRF-токен недействителен
            formError.innerHTML = this.objData.message;
            formError.style.display = 'flex';
            return;
        }
        if (objData['status'] == 422) {

            const errors = this.objData['errors'];

            let html = '';
            for (const key in errors) {

                errors[key].forEach(error => {
                    html += `<span>${error}</span>`;
                })
            }

            formError.innerHTML = html;

            formError.style.display = 'flex';





            return;
        }

    }

    function send(data) {


        console.log('send ', url);
        console.log('data ', data);
        formError.innerHTML = '';
        formError.style.display = 'none';

        if (flagSend) {

            flagSend = false;

            objData = null;


            const options = {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json;charset=utf-8'
                },
                body: JSON.stringify(data)

            };

            fetch(url, options)
                .then(async response => {
                    if (!response.ok) {
                        if (response.status === 422) {
                            const errorData = await response.json();
                            throw { status: 422, errors: errorData };
                        } else {
                            if (response.status === 419) {
                                const errorData = await response.json();
                                throw { status: 419, errors: errorData };
                            }
                            if (response.status === 429) {
                                const errorData = await response.json();
                                throw { status: 429, errors: errorData };
                            }
                            throw new Error(`HTTP error, status = ${response.status}`);
                        }
                    }

                    return response.json();
                })
                .then(result => {

                    objData = result;

                    if (result.status == 'ok') {
                        resSuccess();
                    } else {
                        resError();

                    }

                    flagSend = true;

                })
                .catch(error => {


                    if (error.status === 419 || error.status === 429 || error.status === 422) {

                        objData = error.errors;
                        objData['status'] = error.status;

                        resError();
                    }

                    console.error('Fetch error:', error);

                    flagSend = true;
                });

        }

    }

}






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