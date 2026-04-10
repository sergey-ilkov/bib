
(function () {
    // Код выполняется сразу
    console.log("IIFE сработала!");
})();

// ? general
function setVh() {
    const vh = window.visualViewport ? window.visualViewport.height : window.innerHeight;
    document.documentElement.style.setProperty('--vh', `${vh * 0.01}px`);

}
setVh();
window.addEventListener('resize', setVh);
if (window.visualViewport) {
    window.visualViewport.addEventListener('resize', setVh);
}


document.addEventListener("DOMContentLoaded", (event) => {

    console.log('js app');


    initPageAccount();

    // initPageApps();

});

const userBox = document.querySelector('#user-box');
if (userBox) {
    const userBtn = userBox.querySelector('#user-box-btn');

    userBtn.addEventListener('click', () => {
        userPanelToggle()
    })
}

function userPanelToggle() {
    userBox.classList.toggle('open');
}

document.addEventListener('click', (e) => {
    // ? закрытие панели пользователя
    if (userBox && !userBox.contains(e.target) && userBox.classList.contains('open')) {
        userPanelToggle();
    }

});


// ? burger-menu
const wrapper = document.querySelector('.wrapper');
const body = document.querySelector('body');


const mobileMenu = document.querySelector('#header-menu-mobile');
const burgerMenu = document.querySelector('#burger-menu');

function toggleFixedBody() {
    let width1 = wrapper.offsetWidth;

    body.classList.toggle('fixed');

    burgerMenu.classList.toggle('active');

    let width2 = wrapper.offsetWidth;

    let margin = width2 - width1;
    if (body.classList.contains('fixed')) {
        correctionWrapper(margin);
    } else {
        correctionWrapper();
    }
}

function correctionWrapper(margin = 0) {
    wrapper.style.marginRight = margin + 'px';
    // header.style.right = margin + 'px';

}


if (burgerMenu && mobileMenu) {
    burgerMenu.addEventListener('click', () => {
        mobileMenu.classList.toggle('open');
        toggleFixedBody();

    })
}

const userPanelLinks = document.querySelectorAll('.user-panel-link');
if (userPanelLinks.length) {

    userPanelLinks.forEach(link => {
        link.addEventListener('click', () => {
            mobileMenu.classList.remove('open');
            userBox.classList.remove('open');
            toggleFixedBody();
        })
    })
}









const modalLoader = document.querySelector('#modal-loader');
const modalAlert = document.querySelector('#alert');
const modalAlertMessage = modalAlert.querySelector('.alert-message');
const alertBtnClose = modalAlert.querySelector('.alert-btn-close');


function loaderToggle(v) {
    modalLoader.classList.toggle('show', v);
}
let timerAlert = null;
function modalAlertShow() {

    modalAlert.classList.add('show');

    timerAlert = setTimeout(() => {
        modalAlertHidden();
    }, 3500);

}
function modalAlertHidden() {

    clearTimeout(timerAlert);
    modalAlert.classList.remove('show');
    modalAlertclear();
}

function modalAlertclear() {
    modalAlertMessage.innerHTML = '';
    modalAlertMessage.classList.remove('success');
    modalAlertMessage.classList.remove('error');
}

alertBtnClose.addEventListener('click', () => {
    modalAlertHidden();
})




// ? Account Page
class AccountSettingsForm {
    constructor(modal, modalBtn) {
        this.modal = modal;
        this.modalBtn = modalBtn;
        this.modalBody = this.modal.querySelector('.modal-body');
        this.form = this.modal.querySelector('form');
        this.url = this.form.getAttribute('action');
        this.action = this.form.getAttribute('data-action');
        this.btnCancel = this.form.querySelector('[data-action="cancel"]');
        this.btnConfirm = this.form.querySelector('[data-action="confirm"]');

        this.token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        this.input = this.form.querySelector('input');

        this.userName = document.querySelector('#account-user-name');

        this.flagSend = true;
        this.objSendData = {};
        this.objData = {};

        this.init();
    }
    init() {

        this.events();
    }
    events() {
        this.modalBtn.addEventListener('click', () => {
            this.modalToggle(true);
            this.input.focus();
        })

        this.btnCancel.addEventListener('click', () => {
            this.modalToggle(false);
        })
        this.modal.addEventListener('mousedown', e => {
            if (!this.modalBody.contains(e.target)) {
                this.modalToggle(false);
            }
        })

        this.btnConfirm.addEventListener('click', () => {
            if (this.flagSend && this.isValid()) {
                this.getFormData();
                this.send();
            }
        })

        this.input.addEventListener('input', () => {
            const parent = this.input.parentNode;
            if (this.input.name == 'name' && this.input.value.length >= 3) {
                parent.classList.remove('error');
            }
            if (this.input.name == 'password' && this.input.value.length >= 12) {

                parent.classList.remove('error');
            }
        })

        this.modal.addEventListener('keydown', (e) => {
            if (e.key === 'Enter') {
                e.preventDefault();
                if (this.flagSend && this.isValid()) {
                    this.getFormData();
                    this.send();
                }
            }
            if (e.key === 'Escape') {
                this.modalToggle(false);
            }
        });
    }
    modalToggle(v) {
        this.modal.classList.toggle('show', v);
    }

    isValid() {
        let res = true;

        const parent = this.input.parentNode;
        if (this.input.name == 'name' && this.input.value.length < 3) {
            parent.classList.add('error');
            res = false;
        }
        if (this.input.name == 'password' && this.input.value.length < 12) {
            parent.classList.add('error');
            res = false;
        }

        return res;
    }

    getFormData() {
        this.objSendData = {};
        this.objSendData[this.input.name] = this.input.value;
        this.objSendData['_token'] = this.token;
        this.objSendData['action'] = this.action;
    }

    clearForm() {
        this.input.value = '';
    }
    resSuccess() {

        modalAlertMessage.classList.add('success');
        if (this.objData.messages) {
            let html = '';
            for (const [field, messages] of Object.entries(this.objData.messages)) {
                messages.forEach(message => {
                    html += `<span>${message}</span>`;
                })
            }
            modalAlertMessage.innerHTML = html;
        }
        if (this.objData.message) {
            modalAlertMessage.innerHTML = `<span>${this.objData.message}</span>`;
        }

        if (this.input.name == 'name') {
            this.userName.textContent = this.objData.name;
        }
        modalAlertShow();
        this.clearForm();
    }
    resError() {
        console.log('');
        console.log(' Error');
        modalAlertMessage.classList.add('error');
        if (this.objData.errors) {

            let html = '';
            for (const [field, messages] of Object.entries(this.objData.errors)) {
                messages.forEach(message => {
                    html += `<span>${message}</span>`;
                })
            }
            modalAlertMessage.innerHTML = html;
        }
        else if (this.objData.message) {
            modalAlertMessage.innerHTML = this.objData.message;
        }
        modalAlertShow();
    }


    async send() {

        if (this.flagSend) {

            this.flagSend = false;
            this.objData = {};

            this.modal.classList.add('send');

            try {
                const options = {
                    method: 'PUT',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json;charset=utf-8',
                        // 'X-CSRF-TOKEN': this.token,
                    },
                    body: JSON.stringify(this.objSendData),
                };

                const res = await fetch(this.url, options);

                this.objData = await res.json().catch(() => ({}));

                if (!res.ok) {
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
                this.modalToggle(false);
                this.modal.classList.remove('send');
                this.flagSend = true;
            }
        }
    }
}
function initPageAccount() {
    const pageAccount = document.querySelector('.page-account');
    if (!pageAccount) return;

    const accountSettingsBtns = document.querySelectorAll('.account-settings-btn');
    if (accountSettingsBtns.length > 0) {
        accountSettingsBtns.forEach(btn => {
            const target = btn.getAttribute('data-target');
            const modal = document.getElementById(target);
            if (modal) {
                new AccountSettingsForm(modal, btn);

            }
        })
    }
}


