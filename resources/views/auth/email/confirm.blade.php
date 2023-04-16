<html lang="ru" class="h-100">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/auth.css">
    <title>@lang('confirm_page.title')</title>

    <link rel="icon" href="/assets/images/favicon.svg" type="image/svg">
</head>
<body class="d-flex flex-column h-100">

<div class="container">
        @if($status)
            <div class="alert alert-primary text-center" role="alert">
                @lang('confirm_page.confirmed')
            </div>
        @else
            <div class="alert alert-danger text-center" role="alert">
                @lang('confirm_page.exception')
            </div>
        @endif
</div>

@extends('auth.footer')

<script>
    setTimeout(function(){
        window.location.href = '/';
    }, 10 * 1000);
</script>

</body>
</html>
