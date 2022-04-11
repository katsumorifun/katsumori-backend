<!doctype html>
<html lang="ru" class="h-100">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="/assets/css/auth.css">
    <title>Регистрация</title>

    <link rel="icon" href="/assets/images/favicon.svg" type="image/svg">
</head>
<body class="d-flex flex-column h-100">
<div class="bg-container" id="bg-container">
    <img src="/assets/images/bag.svg" alt="Landscape">
</div>
<div class="auth-form">
    <h3 class="text-center">Регистрация</h3>
    <div class="text-center">
        <img src="/assets/images/logo.png" alt="img-fluid" width="40%">
    </div>

    <form class="row g-3 needs-validation" action="{{route('auth.registration.callback')}}" method="post" novalidate>
        @csrf

        <div class="col-12 position-relative">
            <label for="name" class="form-label">Имя пользователя</label>
            <div class="input-group has-validation">
                <input type="text" class="form-control" pattern="^[a-zA-Z0-9]+$" minlength="4" maxlength="255" name="name" id="name" aria-describedby="namePrepend" required>
                <div class="invalid-tooltip" id="name-invalid">
                    Минимальная длинна: 4 символа <br>
                    Максимальная длинна: 255 символов <br>
                    Только латиница
                </div>
            </div>
        </div>

        <div class="col-12 position-relative">
            <label for="email" class="form-label">Email</label>
            <div class="input-group has-validation">
                <input type="email" class="form-control" name="email" pattern="[a-zA-Z0-9!#$%&'*+\/=?^_`{|}~.-]+@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*" id="email" aria-describedby="namePrepend" required>
                <div class="invalid-tooltip" id="email-invalid">
                    Введенные данные не похожи на email
                </div>
            </div>
        </div>

        <div class="col-12 position-relative">
            <label for="password" class="form-label">Пароль</label>
            <div class="input-group has-validation">
                <input type="password" class="form-control" minlength="8" maxlength="255" name="password" id="password" aria-describedby="namePrepend" required>
                <div class="invalid-tooltip">
                    Минимальная длинна: 8 символов <br>
                    Максимальная длинна: 255 символов
                </div>
            </div>
        </div>

        <div class="col-12 position-relative">
            <label for="password_confirmation" class="form-label">Подтверждение пароля</label>
            <div class="input-group has-validation">
                <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" aria-describedby="namePrepend" required>
                <div class="invalid-tooltip">
                    Пароли не совпадают
                </div>
            </div>
        </div>

        <input type="hidden" name="_token" value="{{ csrf_token() }}" />

        <div class="alert alert-danger d-none" role="alert" id="errorMessage"></div>

        <div class="d-grid gap-2">
            <button class="yuki-btn" type="submit">Зарегистрироваться</button>
        </div>

        <div class="text-center">
            <p>У вас уже есть аккаунут? Тогда вы можете <a href="{{route('auth.login')}}">авторизоваться</a></p>
        </div>
    </form>
</div>

@extends('auth.footer')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/46f170b3e0.js" crossorigin="anonymous"></script>

<script>
    (function () {
        'use strict'

        let forms = document.querySelectorAll('.needs-validation')
        let name = document.getElementById('name');
        let email = document.getElementById('email');
        let InvalidMessage = document.getElementById('errorMessage');

        let emailVerify = false;
        let nameVerify = false;

        email.addEventListener('change', async function () {
            let isEmail = await chekEmail(email.value);
            if (email.value && isEmail) {
                InvalidMessage.textContent = "Email уже занят"
                InvalidMessage.classList.remove('d-none');
                emailVerify = false;
            }
            else{
                emailVerify = true;
                InvalidMessage.classList.add('d-none');
            }
        }, false);

        name.addEventListener('change', async function (event) {
            let isName = await chekUserName(name.value);
            if (name.value && isName) {
                InvalidMessage.textContent = "Имя пользователя уже занято"
                InvalidMessage.classList.remove('d-none');
                nameVerify = false;
            }
            else{
                nameVerify = true;
                InvalidMessage.classList.add('d-none');
            }
        }, false);

        Array.prototype.slice.call(forms)
            .forEach(function (form) {
                form.addEventListener('submit', async function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }
                    if(!nameVerify || !emailVerify){
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
            })
    })()

    async function chekEmail(email) {
        let url = location.origin + '/auth/chek/email/' + email;
        let response = await fetch(url);
        let data = await response.json();

        return Boolean(data.data.status)
    }

    async function chekUserName(name) {
        let url = location.origin + '/auth/chek/username/' + name;
        let response = await fetch(url);
        let data = await response.json();

        return Boolean(data.data.status)
    }


</script>

</body>
</html>
