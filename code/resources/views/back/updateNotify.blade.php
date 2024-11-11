<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Notification</title>
</head>

<body>
    <h2>Update Notification</h2>
    <div id="notificationsContainer"></div>

    <script>
        // 获取当前页面的路径
        const pathname = window.location.pathname;

        // 按 "/" 分割路径
        const parts = pathname.split("/");

        // 获取最后一个部分，即 id
        const id = parts[parts.length - 1];



        async function fetchNotifications() {
            const token = localStorage.getItem('token'); // 从 localStorage 获取 token
            if (!token) {
                alert("You are not logged in. Please log in first.");
                window.location.href = "/login"; // 如果没有 token，重定向到登录页面
                return;
            }

            try {
                const response = await fetch(`/api/back/notification/${id}`, {
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

                const notificationDiv = document.createElement("div");
                notificationDiv.innerHTML = `
            
           <form id="notificationForm">
        <input type="hidden" id="notificationId" name="notificationId" value="${data.message.id}"> 
        <div>
            <label for="type">Type:</label>
            <select id="type" name="type" required>
                <option value="system" ${data.message.type === 'system' ? 'selected' : ''}>System</option>
                <option value="continuePay" ${data.message.type === 'continuePay' ? 'selected' : ''}>ContinuePay</option>
            </select>
        </div>

        <div>
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" value="${data.message.title}" required>
        </div>
        <div>
            <label for="content">Content:</label>
            <textarea id="content" name="content" required>${data.message.content}</textarea>
        </div>
        <button type="button" onclick="updateNotification()">Update Notification</button>
    </form>
        `;
                container.appendChild(notificationDiv);


            } catch (error) {
                console.error("An error occurred:", error);
                alert(`Failed to load notifications. Error: ${error.message || error}`);
            }
        }

        // 页面加载完成后自动调用 fetchNotifications 函数
        window.onload = fetchNotifications;


        //送出表單
        async function updateNotification() {
            const token = localStorage.getItem('token'); // 从localStorage获取token
            if (!token) {
                alert("You are not logged in. Please log in first.");
                window.location.href = "/login"; // 如果没有token，重定向到登录页面
                return;
            }

            // 获取表单数据，包括通知的 ID
            const formData = {
                id: document.getElementById('notificationId').value, // 获取通知ID
                type: document.getElementById('type').value,
                title: document.getElementById('title').value,
                content: document.getElementById('content').value,
                status: false // 默认未阅读状态
            };

            // 使用AJAX通过fetch发送PUT请求到后端
            const response = await fetch("/api/back/notify", {
                method: "PUT",
                headers: {
                    "Content-Type": "application/json",
                    "Accept": "application/json",
                    "Authorization": `Bearer ${token}` // 将token添加到请求头部
                },
                body: JSON.stringify(formData)
            });

            const data = await response.json();

            if (response.ok) {
                alert(data.message);
                // 清空表单
                document.getElementById('notificationForm').reset();
            } else {
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
        }
    </script>
</body>

</html>