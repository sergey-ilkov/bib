document.addEventListener('alpine:init', () => {
    console.log('Alpina', Alpine);

    Alpine.store('widget', {
        uid: null,
        name: null,
        url: null,


        update(obj) {
            Object.assign(this, obj);
            // ? Test Objeact.assign()
            console.log('this ', this);
        }

    });


    Alpine.store('modals', {
        openIds: {},
        open(id) {
            // console.log('click open');

            this.openIds[id] = true;
            window.dispatchEvent(new CustomEvent('modal-opened', { detail: { id } }));
        },
        close(id) {
            delete this.openIds[id];

            const modal = document.querySelector(`#${id}`);
            if (!modal) return;

            const inputs = modal.querySelectorAll('input');
            inputs.forEach(input => {
                const parent = input.parentNode;
                parent.classList.remove('error');
                input.value = '';
            });

        },
        isOpen(id) { return !!this.openIds[id] },
        closeAll() { this.openIds = {} },
    });



    window.combined = (id) => {
        const a = modalWithAutofocus(id);
        const b = ajaxForm();

        return {
            // объединяем поля/методы (позже свойства перезапишут ранние при совпадении)
            ...a,
            ...b,

            init() {
                // вызвать init из a, если есть
                if (typeof a.init === 'function') a.init.call(this);
                // вызвать init из b, если есть
                if (typeof b.init === 'function') b.init.call(this);
            }
        };
    };


    const configuratorLoader = document.querySelector('.configurator-loader');
    setTimeout(() => {
        configuratorLoader.classList.add('hidden');
    }, 1000)

})


function modalWithAutofocus(id) {
    return {
        id,

        init() {

            window.addEventListener('modal-opened', (e) => {

                if (e.detail?.id === this.id) {
                    this.$nextTick(() => this.focusFirst());
                }
            });

        },
        focusFirst() {

            this.$refs.firstInput?.focus?.();
        }
    }
}



function ajaxForm() {
    return {
        widget: null,
        modal: null,
        form: null,
        inputs: null,
        action: null,
        method: null,
        url: null,
        uid: null,
        token: null,

        flagSend: true,

        modalAlert: null,
        modalAlertMessage: null,
        timerId: null,

        widget: null,

        objSendData: {},
        objData: {},

        init() {
            const meta = document.querySelector('meta[name="csrf-token"]');
            this.token = meta ? meta.content : null;

            this.modal = this.$el;
            this.form = this.modal.querySelector('form');
            this.inputs = this.form.querySelectorAll('input');
            this.action = this.form.getAttribute('data-action');
            this.method = this.form.getAttribute('method');


            this.modalAlert = document.querySelector('#alert');
            this.modalAlertMessage = this.modalAlert.querySelector('.alert-message');


            this.widget = Alpine.store('widget');



            this.events();
        },


        events() {
            this.form.addEventListener('submit', (e) => {
                e.preventDefault();
            })
            this.inputs.forEach(input => {
                input.addEventListener('input', () => {
                    if (this.validate()) {
                        const parent = input.parentNode;
                        parent.classList.remove('error');
                    }
                })
            })

        },

        async sendData() {

            if (!this.validate()) {
                return;
            }


            this.getFormData();

            if (this.flagSend) {
                this.flagSend = false;
                // this.widget = Alpine.store('widget');
                this.url = this.widget.url;

                this.objData = {};

                this.modal.classList.add('send');

                try {
                    const options = {
                        method: this.method,
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
                    // this.modalToggle(false);
                    this.form.reset();
                    Alpine.store('modals').closeAll();
                    this.modal.classList.remove('send');
                    this.flagSend = true;
                }

            }

        },

        validate() {
            let res = true;
            if (this.action === 'widget-rename' && this.form.name.value.length == 0) {
                // console.log('Error');
                // console.log(this.form.name);
                const parent = this.form.name.parentNode;
                parent.classList.add('error');
                // console.log(parent);
                res = false;
            }
            return res;
        },

        getFormData() {
            this.objSendData = {};

            this.inputs.forEach(input => {
                this.objSendData[input.name] = input.value;
            })

            this.objSendData['_token'] = this.token;
            this.objSendData['action'] = this.action;
        },

        resSuccess() {
            // console.log('this.resSucces()');
            this.modalAlertMessage.classList.add('success');

            if (this.objData.messages) {
                let html = '';
                for (const [field, messages] of Object.entries(this.objData.messages)) {
                    messages.forEach(message => {
                        html += `<span>${message}</span>`;
                    })
                }
                this.modalAlertMessage.innerHTML = html;
            }
            if (this.objData.message) {
                this.modalAlertMessage.innerHTML = `<span>${this.objData.message}</span>`;
            }

            if (this.action == 'widget-rename') {

                if (this.widget.name) {
                    // const widgetItem = document.querySelector(`[widget-uid="${this.widget.uid}"]`);
                    // if (widgetItem && this.objData.name) {
                    //     const widgetName = widgetItem.querySelector('.app-widget-link');
                    //     widgetName.textContent = this.objData.name;
                    // }
                    this.widget.name = this.objData.name;

                    const title = document.querySelector('title');
                    const titleArr = title.innerText.split('|');
                    title.innerText = `${this.objData.name} | ${titleArr[1]}`;



                }
            }
            // console.log(this.action);



            this.modalAlertShow();

        },
        resError() {
            // console.log('this.resError()');
            this.modalAlertMessage.classList.add('error');

            if (this.objData.errors) {

                let html = '';
                for (const [field, messages] of Object.entries(this.objData.errors)) {
                    messages.forEach(message => {
                        html += `<span>${message}</span>`;
                    })
                }
                this.modalAlertMessage.innerHTML = html;
            }
            else if (this.objData.message) {
                this.modalAlertMessage.innerHTML = this.objData.message;
            }

            this.modalAlertShow();
        },

        modalAlertShow() {
            this.modalAlert.classList.add('show');

            this.timerId = setTimeout(() => {
                clearTimeout(this.timerId);
                this.modalAlert.classList.remove('show');
                this.modalAlertclear();
            }, 3000);

        },
        modalAlertclear() {
            this.modalAlertMessage.innerHTML = '';
            this.modalAlertMessage.classList.remove('success');
            this.modalAlertMessage.classList.remove('error');
        }



    }
}



