<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <script>
        // 获取当前页面的路径
        const pathname = window.location.pathname;

        // 按 "/" 分割路径
        const parts = pathname.split("/");

        // 获取最后一个部分，即 id
        const id = parts[parts.length - 1];

        // 打印 id
        alert(id); // 输出: 1
    </script>
</body>

</html>