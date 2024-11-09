<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Notification</title>
</head>

<body>
    <h2>Add Notification</h2>
    <div id="errors"></div>
    <form id="notificationForm">
        <div>
            <label for="type">Type:</label>
            <select id="type" name="type" required>
                <option value="system">System</option>
                <option value="continuePay">continuePay</option>
            </select>
        </div>

        <div>
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" required>
        </div>
        <div>
            <label for="content">Content:</label>
            <textarea id="content" name="content" required></textarea>
        </div>
        <button type="button" onclick="submitNotification()">Submit Notification</button>
    </form>

    <script>
        async function submitNotification() {
            const token = localStorage.getItem('token'); // 从localStorage获取token
            if (!token) {
                alert("You are not logged in. Please log in first.");
                window.location.href = "/login"; // 如果没有token，重定向到登录页面
                return;
            }

            // 获取表单数据
            const formData = {
                type: document.getElementById('type').value,
                title: document.getElementById('title').value,
                content: document.getElementById('content').value,
                status: false // 默认未阅读状态
            };

            // 使用AJAX通过fetch发送POST请求到后端
            const response = await fetch("/api/back/addNotify", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "Accept": "application/json",
                    "Authorization": `Bearer ${token}` // 将token添加到请求头部
                },
                body: JSON.stringify(formData)
            });

            const data = await response.json();

            if (response.ok) {
                alert("Notification added successfully!");
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