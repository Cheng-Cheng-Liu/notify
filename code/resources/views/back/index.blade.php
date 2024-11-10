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
        <div style="width:20%;font-size: 187.5%;">試做作品</div>
        <button class="container-row custom-button" style="width:50%">
            <a href="/back/notifies" style="font-size: 187.5%;">文章管理</a>
        </button>
        <a href="/back/myNotifications" class="container-row custom-button" style="width:20%;text-decoration: none;">
            <p style="font-size: 187.5%;">通知</p>
            <div id="unreadCountBackground" class="circle" style="display: none;">
                <div id="unreadCount" style="font-size: 110%;margin-left:20%;">0</div>
            </div>
        </a>

    </div>
    </div>
    <script>
        async function submitNotification() {
            const token = localStorage.getItem('token'); // 从 localStorage 获取 token
            if (!token) {
                alert("You are not logged in. Please log in first.");
                window.location.href = "/login"; // 如果没有 token，重定向到登录页面
                return;
            }

            try {
                // 使用 AJAX 通过 fetch 发送 POST 请求到后端
                const response = await fetch("/api/back/countUnread", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "Accept": "application/json",
                        "Authorization": `Bearer ${token}` // 将 token 添加到请求头部
                    }
                });

                const data = await response.json();

                if (response.ok) {
                    if (data.message > 0) {
                        // 显示未读通知数量
                        const unreadCountDiv = document.getElementById("unreadCount");
                        unreadCountDiv.innerText = data.message; // 设置未读通知数量
                        const unreadCountBackground = document.getElementById("unreadCountBackground");
                        unreadCountBackground.style.display = "block"; // 显示数字区域
                    }

                } else {
                    // 处理错误
                    const errorsDiv = document.getElementById('errors');
                    errorsDiv.innerHTML = ''; // 清空之前的错误信息
                    if (data.errors) {
                        // 显示验证错误
                        Object.keys(data.errors).forEach(key => {
                            const error = document.createElement('div');
                            error.innerText = `${key}: ${data.errors[key].join(', ')}`;
                            errorsDiv.appendChild(error);
                        });
                    } else {
                        errorsDiv.innerText = "An error occurred. Please try again.";
                    }
                }
            } catch (error) {
                console.error("An error occurred:", error);
            }
        }
        submitNotification()
        // 每5秒执行一次
        setInterval(submitNotification, 5000);
    </script>
</body>

</html>