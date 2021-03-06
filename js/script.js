// Object con las expresiones regulares para validar los formularios
var regex = {
    register : {
        name: /^([a-z]|\.|\ ){3,}$/i,
        pic: /\.(jpg|jpeg|png)$/,
        password: /^([a-z | 0-9]|\.){6,}$/i,
        email: /[a-z|0-9]{3,8}@{1}[a-z|0-9]{1,8}\.(com|ar)$/i
    },
    login : {
        name: /^([a-z]|\.|\ ){3,}$/i,
        password: /^([a-z | 0-9]|\.){6,}$/i,
    },
    comment: {
        content: /^([a-z | 0-9]|\.){3,}$/i
    }
}

$(document).ready(function() {
    // Se agrega las validaciones a los formularios
    var formRegister = document.getElementById('form_register');
    if (formRegister) {
        formRegister.onsubmit = validateFormRegister;
    }
    var formLogin = document.getElementById('form_login'); 
    if (formLogin) {
        formLogin.onsubmit = validateFormLogin;
    }
    var formReservation =  document.getElementById('form_reservation');
    if (formReservation) {
        formReservation.onsubmit = submitFormReservation;
    }
    var formComment = document.getElementById('form_send_comment');
    if (formComment) {
     formComment.onsubmit = validateFormComment;
    }
    var formSearch = document.getElementById('form_search');
    if (formSearch) {
        formSearch.onsubmit = submitSearchForm;
    }
    var formMyAccount = document.getElementById('form-my-account');
    if (formMyAccount) {
        formMyAccount.onsubmit = validateFormMyAccount;
    }
    // Se inicializa el datepicker
    var datepicker = $('#datepicker');
    if (datepicker) {
        $('#datepicker').datepicker({ format: 'dd/mm/yyyy' });
    }
    // Se agrega el evento click, para confirmar la reserva
    $(document).on('click', '.confirmReservation', function () {
        var hour = $(this).data('hour');
        var date = $(this).data('date');
        $('#date_reservation').val(date);
        $('#hour_reservation').val(hour);
   });
});

/***
 * Permite validar los campos del formulario de registro
 * @return {Boolean}
 */
function validateFormRegister() {
    var sendRegister = true;
    var inputs = getInputsFormRegister();
    var errorMsg = '';
    if (!validateInput(inputs.name.value, regex.register.name)) {
        sendRegister = false;
        errorMsg += 'El nombre mínimo 3 carácteres <br/>';
    } 
    if (inputs.pic.files.length > 0) {
        var name = inputs.pic.files[0].name;
        if (!validateInput(name, regex.register.pic)) {
            sendRegister = false;
            errorMsg += 'La foto no cumple el formato permitido jpg, jpeg, png <br/>';
        }
    }
    if (!validateInput(inputs.password.value, regex.register.password)) {
        sendRegister = false;
        errorMsg += 'La contraseña mínimo 6 caracteres <br/>';
    } 
    if (!validateInput(inputs.email.value, regex.register.email)) {
        sendRegister = false;
        errorMsg += 'El email ingresado no es válido <br/>';
    } 
    if (!sendRegister) {
        $('#errFormRegister').html(errorMsg);
    }
    return sendRegister;
}

/***
 * Permite validar los campos del formulario de login
 * @return {Boolean}
 */
function validateFormLogin() {
    var sendLogin = true;
    var inputs = getInputsLogin();
    var errorMsg = '';
    if (!validateInput(inputs.email.value, regex.login.email)) {
        sendLogin = false;
        errorMsg += 'El email ingresado no es válido <br/>';
    } 
    if (!validateInput(inputs.password.value, regex.login.password)) {
        sendLogin = false;
        errorMsg += 'La contraseña mínimo 6 caracteres <br/>';
    } 
    if (!sendLogin) {
        $('#errFormLogin').html(errorMsg);
    }
    return sendLogin;
}

/***
 * Permite validar los campos del formulario de comentario al dejar...
 * @return {Boolean}
 */
function validateFormComment() {
    var sendLogin = true;
    var comment = document.getElementById('comment');
    var errorMsg = '';
    if (!validateInput(comment.value, regex.comment.content)) {
        sendLogin = false;
        errorMsg += 'El comentario debe poseer un mínimo de 3 caracteres <br/>';
    } 
    if(!sendLogin) {
        $('#errFormComment').html(errorMsg);
    }
    return sendLogin;
}

/***
 * Permite setear en el campo hidden el valor del input, lo hago asi porque no podemos usar ajax...
 * @return void
 */
function submitFormReservation() {
    var dateSelected = $('#datepicker').datepicker().value();
    $('#date').val(dateSelected);
    return true;
}

/**
 * Permite realizar el href si se escribió algo en el input
 * @param {Event} e 
 */
function submitSearchForm(e) {
    e.preventDefault(); 
    var input = document.getElementById('search').value;
    var url = 'index.php?section=news';
    if (input.length > 0) {
        location.href = `${url}&search=${input}`;
    } else {
        location.href = url;
    }
}

/**
 * Permite validar el formulario para cambiar la contraseña
 * @param {Event} e 
 */
function validateFormMyAccount(e) {
    var sendFormMyAccount = true;
    var old_password = document.getElementById('old_password');
    var new_password = document.getElementById('new_password');
    var errorMsg = '';
    if (!validateInput(old_password.value, regex.register.password)) {
        sendFormMyAccount = false;
        errorMsg += 'La contraseña actual debe poseer mínimo 6 caracteres <br/>';
    } 
    if (!validateInput(new_password.value, regex.register.password)) {
        sendFormMyAccount = false;
        errorMsg += 'La contraseña nueva debe poseer mínimo 6 caracteres <br/>';
    } 
    if(!sendFormMyAccount) {
        $('#errFormComment').html(errorMsg);
    }
    return sendFormMyAccount;
}

/***
 * Permite obtener los inputs del login
 * @return {Object}
 */
function getInputsLogin() {
    return {
        email: document.getElementById('email'),
        password: document.getElementById('password')
    }
}

/***
 * Permite obtener los inputs del registro
 * @return {Object}
 */
function getInputsFormRegister() {
    return {
        email: document.getElementById('email'),
        password: document.getElementById('password'),
        name: document.getElementById('name'),
        pic: document.getElementById('pic')
    };
}

/***
 * Permite obtener los inputs del login
 * @param {String} val
 * @param {String} regex
 * @return {Object}
 */
function validateInput(val, regex) {
    if (val && val.trim() !== '') {
        return regex.test(val);
    }
    return false;
}

