// console.log('init Admin panel...');


// ?
// ?
//? add image for form


const imageGroupItems = document.querySelectorAll('.image-add-group')

if (imageGroupItems) {


    // console.log(imageGroupItems);
    imageGroupItems.forEach(imageGroup => {

        const inputFile = imageGroup.querySelector('[type="file"]');
        const divPictureBlock = imageGroup.querySelector('.picture-block');

        inputFile.addEventListener('change', (e) => {
            console.log('change input file');

            readFile(imageGroup, inputFile, divPictureBlock);

        })
    })


}




function readFile(imageGroup, input, pictureBlock) {


    let file = input.files[0];
    if (!file) {
        return;
    }
    const path = URL.createObjectURL(file);

    removeClass(pictureBlock, 'hidden');

    const img = document.createElement('img');
    img.setAttribute('src', path);

    pictureBlock.innerHTML = '';

    pictureBlock.appendChild(img);


    const label = imageGroup.querySelector('.file-input__label[data-js-label]');
    label.innerHTML = file.name;
    addClass(label, 'chosen');

}


function addClass(el, className = 'active') {

    el.classList.add(className);

}


function removeClass(el, className = 'active') {

    el.classList.remove(className);

}
//? the end add image for form
// ?
// ?

// ? poster-loaded


// ?
// ?
// ? modal delete
const body = document.querySelector('body');
const wrapper = document.querySelector('.wrapper');
const modalDelete = document.querySelector('#model-delete')
const formDelete = document.querySelector('#form-delete');


//? delete Page Settings
function setModalAttributes(btn) {

    const action = btn.getAttribute('data-action');
    const name = btn.getAttribute('data-name');

    formDelete.setAttribute('action', action);



    const divFormTitle = formDelete.querySelector('.modal__title');

    divFormTitle.innerHTML = divFormTitle.innerHTML + `<span class="modal__title-min"> ${name}</span>`;


    openModal(modalDelete);

}

// ? the end modal delete
// ?
// ?

// ?
// ?
// ? open modal
function openModal(modal, className = 'open') {
    let width1 = wrapper.offsetWidth;

    addClass(modal, className);
    addClass(body, 'fixed');

    let width2 = wrapper.offsetWidth;
    let margin = width2 - width1;
    margin = `${margin}px`;
    corrrectionMargin(margin);
}
// ? close modal
function closeModal(modal, className = 'open') {
    removeClass(modalDelete, 'open');
    removeClass(body, 'fixed');

    corrrectionMargin('0px');


    const modalTextMin = document.querySelector('.modal__title-min');
    if (modalTextMin) {
        modalTextMin.remove();
    }


}

function corrrectionMargin(margin = '0px') {
    wrapper.style.marginRight = margin;
}



// ? the end open modal
// ?
// ?





// ? Events click 


window.addEventListener('click', (e) => {

    // ? modal delete
    if (modalDelete) {
        if (modalDelete.classList.contains('open') && !e.target.closest('.modal-body')) {
            closeModal(modalDelete);
        }

        if (e.target.closest('.btn-modal-close')) {
            closeModal(modalDelete);
        }

        if (e.target.closest('.btn-modal-delete')) {
            setModalAttributes(e.target);
        }
    }
    // ? the end modal delete






})

// ? Events keyboerd
window.addEventListener('keydown', (e) => {
    // console.log(e.key);
    if (modalDelete) {
        if (e.key === 'Escape') {
            closeModal(modalDelete);
        }
    }
})








// ? burger-menu

const burgermenu = document.querySelector('#burger-menu');
const divAside = document.querySelector('.aside');
const divAdminPanelContent = document.querySelector('.admin-panel-content');
if (burgermenu && divAside && divAdminPanelContent) {
    burgermenu.addEventListener('click', () => {
        divAside.classList.toggle('hidden');
        divAdminPanelContent.classList.toggle('show-all');
    })
}




// ? copy register link

const copyLinkBtns = document.querySelectorAll('.btn-copy-link');



copyLinkBtns.forEach(btn => {
    btn.addEventListener('click', () => {

        const row = btn.closest('.table-body__row');

        const btnText = btn.getAttribute('data-copy');

        if (row) {
            const link = row.querySelector('.register-link');
            const text = link.textContent.trim();
            navigator.clipboard.writeText(text).then(() => {

                showMessage(btnText);
                // button.textContent = 'Скопировано!'; // Опционально: меняем текст кнопки
            }).catch(err => {
                console.error('Ошибка копирования: ', err);
            });
        }

    })
})


const modalMessage = document.querySelector('#modal-message');

function showMessage(text) {
    if (!modalMessage) return;
    let timerId = null;

    const messagetext = modalMessage.querySelector('.modal-message-text');

    messagetext.innerHTML = text;
    modalMessage.classList.add('show');

    timerId = setTimeout(() => {
        clearTimeout(timerId);
        modalMessage.classList.remove('show');
        messagetext.innerHTML = '';
    }, 1000);


}