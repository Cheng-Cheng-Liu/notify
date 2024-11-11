<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <a href="/back/addNotify" style="font-size: 30px;">新增文章</a>
    <div id="notificationsContainer"></div> <!-- 用于显示通知的容器 -->

    <script>
        async function fetchNotifications() {
            const token = localStorage.getItem('token'); // 从 localStorage 获取 token
            if (!token) {
                alert("You are not logged in. Please log in first.");
                window.location.href = "/login"; // 如果没有 token，重定向到登录页面
                return;
            }

            try {
                const response = await fetch("/api/back/allNotifications", {
                    method: "GET",
                    headers: {
                        "Content-Type": "application/json",
                        "Accept": "application/json",
                        "Authorization": `Bearer ${token}` // 将 token 添加到请求头部
                    }
                });

                if (!response.ok) {
                    throw new Error("Failed to fetch notifications");
                }

                const data = await response.json();

                // 获取要显示通知的容器
                const container = document.getElementById("notificationsContainer");
                container.innerHTML = ''; // 清空容器内容

                // 遍历每条通知数据，动态生成 HTML 结构
                data.message.forEach(notification => {
                    const notificationDiv = document.createElement("div");
                    notificationDiv.innerHTML = `
                <div style="width: 80%; height: 20%; border: 2px solid purple;pedding:5%;">
                    <div>title: ${notification.title}</div>
                    <a href="/back/updateNotify/${notification.id}">修改</a>
                    <a href="/back/deleteNotify?type=${notification.type}&id=${notification.id}">刪除</a>

                </div>
            `;
                    container.appendChild(notificationDiv);
                });

            } catch (error) {
                console.error("An error occurred:", error);
                alert(`Failed to load notifications. Error: ${error.message || error}`);
            }
        }

        // 页面加载完成后自动调用 fetchNotifications 函数
        window.onload = fetchNotifications;
    </script>

</body>

</html>