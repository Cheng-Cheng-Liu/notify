<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script src="./js/app.js"></script>
    <title>Document</title>
    <style>
        .container-row-around {
            display: flex;
            flex-direction: row;
            justify-content: space-around;
        }

        .container-row {
            display: flex;
            flex-direction: row;
        }

        .bg-p {
            background-color: #CB9DF0;
        }

        .bg-y {
            background-color: yellow;
        }
    </style>

</head>

<body>
    <div class="container-row-around ">
        <div style="width:20%;font-size: 40px;">試做作品</div>
        <button class="container-row custom-button" style="width:50%">
            <a href="/back/articles" style="font-size: 30px;">文章管理</a>
        </button>
        <button class="container-row custom-button" style="width:20%">
            <p style="font-size: 30px;">通知</p>
            <div class="circle"></div>
        </button>
    </div>
    </div>

</body>

</html>