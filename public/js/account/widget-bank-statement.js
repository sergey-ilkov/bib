console.log('bank statement js');



const bibberApp = document.querySelector('.bibber-app[data-bibber-app]');
console.log(bibberApp);

const form = bibberApp.querySelector('form');
form.addEventListener('submit', function (event) {
    event.preventDefault();
    // console.log('Форма не отправлена');
});

let flagAnalizeFile = false;

let userChecked = false;
const checkboxWrap = bibberApp.querySelector('.bibber-app-custom-checkbox');
const inputCheckbox = bibberApp.querySelector('.bibber-app-checkbox-input');
// checkboxWrap.addEventListener('click', () => {
//     checkboxBtn.classList.remove('error');
//     checkboxBtn.classList.toggle('checked');

//     console.log(checkboxBtn.closest('.checked'));
//     userChecked = checkboxBtn.closest('.checked') ? true : false;

// })
inputCheckbox.addEventListener('change', () => {
    checkboxWrap.classList.remove('error');
    userChecked = inputCheckbox.checked;


});

let fileUpload = null;
const inputFile = bibberApp.querySelector('.bibber-app-file-input');

inputFile.addEventListener('click', (e) => {

    if (flagAnalizeFile) {
        e.preventDefault();
        return;
    }


    if (userChecked == false) {
        e.preventDefault();
        checkboxWrap.classList.add('error');
        console.log('user Error Checked');
        return;
    }

    clearData();
    messageHidden();
    dropzone.classList.remove('error');

})

function clearData() {
    fileUpload = null;
    inputFile.value = '';
    fileDataHidden();
    // messageHidden();
}


// ?
/* Проверка: только один файл и тип pdf (по MIME и расширению как запас) */
function validatePdfFile(file) {
    if (!file) return { ok: false, reason: 'Файл отсутствует' };

    // Проверка MIME
    const isPdfByType = file.type === 'application/pdf';

    // Проверка расширения (на всякий случай)
    const name = file.name || '';
    const isPdfByExt = /\.pdf$/i.test(name);

    if (!isPdfByType && !isPdfByExt) {
        return { ok: false, reason: 'Только PDF-файлы разрешены (.pdf)' };
    }
    return { ok: true };
}



/* Когда пользователь выбрал файл через диалог */
inputFile.addEventListener('change', (e) => {

    if (flagAnalizeFile) return;



    const files = e.target.files;
    if (!files || files.length === 0) {
        console.log('Файл не выбран');
        // showMessage('Файл не выбран.', true);
        return;
    }
    if (files.length > 1) {
        // console.log('Допущен только один файл — выбран первый из списка.');
        // handleFileSelection(files[0]);
        // showMessage('Допущен только один файл — выбран первый из списка.', true);
        return;
    }

    console.log(files);


    console.log(files[0].name);
    fileUpload = files[0];

    console.log('fileUpload');
    console.log(fileUpload);

    fileDataShow(files[0].name);
    btnSend.setAttribute('disabled', true);
    analizeFile(fileUpload);


    // handleFileSelection(files[0]);
});

const dropzone = document.querySelector('.bibber-app-dropzone');
/* На drop — обрабатываем файлы */
dropzone.addEventListener('drop', (e) => {

    if (flagAnalizeFile) return;

    console.log('drop');
    if (userChecked == false) {
        console.log('Error userChecked: ', userChecked);
        return;
    }
    const files = e.dataTransfer.files;

    if (!files) {
        return;
    }

    fileUpload = files[0];
    console.log('fileUpload');
    console.log(fileUpload);

    messageHidden();
    fileDataShow(fileUpload.name);

    btnSend.setAttribute('disabled', true);

    analizeFile(fileUpload);
    // console.log(e.dataTransfer.files);

    // if (!allowCheckbox.checked) {
    //     showMessage('Отметьте чекбокс, чтобы добавить файл.', true);
    //     return;
    // }

    // const dtFiles = e.dataTransfer.files;
    // if (!dtFiles || dtFiles.length === 0) {
    //     showMessage('Файл не обнаружен при перетаскивании.', true);
    //     return;
    // }

    // if (dtFiles.length > 1) {
    //     // Только один файл разрешён — берем первый, но показываем ошибку
    //     handleFileSelection(dtFiles[0]);
    //     showMessage('Допущен только один файл — выбран первый из списка.', true);
    //     return;
    // }

    // handleFileSelection(dtFiles[0]);
});

/* Drag-and-drop события */
['dragenter', 'dragover'].forEach(evt =>
    dropzone.addEventListener(evt, (e) => {
        e.preventDefault();
        e.stopPropagation();

        if (flagAnalizeFile) return;

        // if (!userChecked) {
        //     console.log('Error userChecked: ', userChecked);
        // }
        // if (!allowCheckbox.checked) return;
        if (userChecked == false) {
            console.log('Error userChecked: ', userChecked);
            checkboxWrap.classList.add('error');
            return;
        }
        dropzone.classList.remove('error');
        dropzone.classList.add('bibber-app-dragover');

        console.log('Event: ', evt);
    })
);

['dragleave', 'drop'].forEach(evt =>
    dropzone.addEventListener(evt, (e) => {
        e.preventDefault();
        e.stopPropagation();
        dropzone.classList.remove('bibber-app-dragover');
        console.log('Event: ', evt);
    })
);


let flagSend = false;

let timerId = null;
const btnSend = bibberApp.querySelector('.bibber-app-btn-send');
btnSend.addEventListener('click', () => {

    message.style.display = 'none';
    message.classList.remove('rerror');
    message.classList.remove('success');

    if (!userChecked) {
        console.log('Error userChecked: ', userChecked);
        checkboxBtn.classList.add('error');
        return;
    }

    if (!fileUpload) {
        console.log('Error fileUpload: ', fileUpload);
        dropzone.classList.add('error');
        return;
    }

    if (flagSend) return;

    flagSend = true;

    form.classList.add('send');

    console.log('Analize file');
    console.log('Show block analize');


    timerId = setTimeout(() => {

        clearTimeout(timerId);

        const randomNum = getRandomNum();
        if (randomNum == 1) {
            clearData();
            messageShow('The file has been sent successfully.', 'success');
            btnSend.setAttribute('disabled', true);
        }
        else {
            messageShow('Error sending file.', 'error');
        }

        flagSend = false;
        form.classList.remove('send');
    }, 2000);
})

function getRandomNum(max = 3, min = 1) {
    return Math.floor(Math.random() * (max - min) + min);
}

const fileData = bibberApp.querySelector('.bibber-app-file-data');
function fileDataShow(v) {
    if (!fileData) return;

    const fileName = fileData.querySelector('.bibber-app-file-value');
    fileName.textContent = v;
    fileData.style.display = 'block';
}
function fileDataHidden() {
    if (!fileData) return;

    const fileName = fileData.querySelector('.bibber-app-file-value');
    fileName.textContent = '';
    fileData.style.display = 'none';
}

const message = bibberApp.querySelector('.bibber-app-message');
function messageShow(text, className = '') {
    if (!message) return;
    message.classList.remove('rerror');
    message.classList.remove('success');
    message.textContent = text;
    message.classList.add(className);
    message.style.display = 'flex';

}
function messageHidden() {
    if (!message) return;
    message.style.display = 'none';
    message.textContent = '';
    message.classList.remove('rerror');
    message.classList.remove('success');
}


const divAnalizeFile = bibberApp.querySelector('.bibber-app-analize-file');


let timerInterval = null;
const analizeCurrentPage = bibberApp.querySelector('.bibber-app-analize-current-page');
const analizeTotalPages = bibberApp.querySelector('.bibber-app-analize-total-pages');
const timeAnimation = 3000;

function analizeFile(file) {
    flagAnalizeFile = true;
    divAnalizeFile.style.display = 'flex';

    const total = getRandomNum(20, 10);
    let startNum = 1;

    analizeCurrentPage.textContent = startNum;
    analizeTotalPages.textContent = total;

    const startTime = performance.now();

    timerInterval = setInterval(() => {


        startNum++;
        analizeCurrentPage.textContent = startNum;


        if (startNum == total) {
            clearInterval(timerInterval);
            const duration = performance.now() - startTime;

            if (duration < timeAnimation) {
                const anim = Math.ceil(timeAnimation - duration);
                analizeFileResult(anim);
            } else {
                analizeFileResult(0);
            }

        }

    }, 100);




}

function analizeFileResult(time = 2000) {
    timerId = setTimeout(() => {
        clearTimeout(timerId);


        const randomNum = getRandomNum();
        if (randomNum == 1) {

            messageShow('The file can be sent.', 'success');
            btnSend.removeAttribute('disabled');
        }
        else {
            clearData()
            messageShow('The file is not a bank statement.', 'error');
        }

        divAnalizeFile.style.display = 'none';
        flagAnalizeFile = false;

    }, time);
}



