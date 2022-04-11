<!doctype html>
<html lang="ru" class="h-100">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/auth.css">
    <title>Авторизация</title>

    <link rel="icon" href="/assets/images/favicon.svg" type="image/svg">
</head>
<body class="d-flex flex-column h-100">
<div class="bg-container" id="bg-container">
    <img src="/assets/images/bag.svg" alt="Landscape" class="bg-landscape">
</div>
<div class="auth-form">
    <h3 class="text-center">Авторизация</h3>
    <div class="text-center">
        <img src="/assets/images/logo.png" alt="img-fluid" width="40%">
    </div>

    <form action="{{"/auth/login"}}" method="post" class="row g-3 needs-validation @if($error) was-validated @endif" novalidate>
        @csrf

        <div class="col-12 position-relative">
            <label for="name" class="form-label">Email</label>
            <div class="input-group has-validation">
                <input type="text" class="form-control" minlength="1" maxlength="255" name="name" id="name" aria-describedby="namePrepend" required>
                <div class="invalid-tooltip">
                    Вы ввели не верный логин либо пароль
                </div>
            </div>
        </div>

        <div class="col-12 position-relative">
            <label for="password" class="form-label">Пароль</label>
            <input type="password" class="form-control" minlength="1" maxlength="255" name="password" id="password" aria-describedby="namePrepend" required>
        </div>

        <div class="text-center">
            <p>Войти через социальные сети</p>
            <a href="{{route('social.login', ['provider'=>'vkontakte'])}}" ><i class="fa fa-vk" aria-hidden="true"></i></a></i>
            <a href="{{route('social.login', ['provider'=>'google'])}}" ><i class="fa fa-google" aria-hidden="true"></i></a></i>
            <a href="{{route('social.login', ['provider'=>'shikimori'])}}"> <img src="/assets/images/shikimori.svg" class="img-fluid" alt="" width="32"></a>
            <a href="{{route('social.login', ['provider'=>'myanimelist'])}}"> <img src="/assets/images/mal.svg" class="img-fluid" alt="" width="32"></a>
        </div>
        <div class="d-grid gap-2">
            <button class="yuki-btn mb-3" type="submit">Войти</button>
        </div>

        <div class="text-center">
            <p>У вас ещё нет аккаунута? Тогда вы можете <a href="{{route('auth.register.form')}}">зарегистрироваться</a></p>
        </div>

    </form>
</div>

@extends('Auth.footer')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/46f170b3e0.js" crossorigin="anonymous"></script>

<script>
    (function () {
        'use strict'

        let forms = document.querySelectorAll('.needs-validation')

        Array.prototype.slice.call(forms)
            .forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')

                    window.postMessage('auth',
                        "http://192.168.1.94")
                }, false)
            })
    })()
</script>

</body>
</html>