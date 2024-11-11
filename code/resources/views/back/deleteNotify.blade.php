<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Notification</title>
</head>

<body>

    <script>
        // 获取当前页面的路径
        const queryString = window.location.search;
        const urlParams = new URLSearchParams(queryString);
        const type = urlParams.get('type');
        const id = urlParams.get('id');

        async function fetchNotifications() {
            const token = localStorage.getItem('token'); // 从 localStorage 获取 token
            if (!token) {
                alert("You are not logged in. Please log in first.");
                window.location.href = "/login";
                return;
            }

            try {
                const response = await fetch(`localhost:8000/api/back/notify`, {
                    method: "DELETE",
                    headers: {
                        "Content-Type": "application/json",
                        "Accept": "application/json",
                        "Authorization": `Bearer ${token}`
                    },
                    body: JSON.stringify({
                        id,
                        type
                    })
                });


                if (!response.ok) {
                    throw new Error("Failed to fetch notifications");
                }

                const data = await response.json();

            } catch (error) {
                console.error("An error occurred:", error);
                alert(`Failed to load notifications. Error: ${error.message || error}`);
            }
        }

        window.onload = fetchNotifications;
    </script>
</body>

</html>