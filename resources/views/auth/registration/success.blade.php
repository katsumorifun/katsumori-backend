<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Авторизация</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-4">
        <h3 id="loading" class="text-center"></h3>
    </div>

    <script>
        let text = document.getElementById('loading');
        text.textContent = "Идет автризация. Пожалуйста, подождите.."
        let tokens = document.location.hash.split("#")[1].split("access_token=")[1]
        let access_token = tokens.split("&refresh_token=")[0]
        let refresh_token = tokens.split("&refresh_token=")[1]

        console.log('refresh', refresh_token)

        setTimeout(function (){
            text.textContent = "Успех! Можете закрывать окно"
            window.close()
            window.postMessage({access: access_token, refresh: refresh_token},
                "http://192.168.1.94");
        }, 20300)
    </script>
</body>
</html>