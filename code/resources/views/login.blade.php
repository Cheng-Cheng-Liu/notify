<!-- resources/views/auth/login.blade.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>
    <h2>Login</h2>
    <div id="errors"></div>
    <form id="loginForm">
        <div>
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required>
        </div>
        <div>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required>
        </div>
        <button type="button" onclick="submitLogin()">Login</button>
    </form>

    <script>
        async function submitLogin() {
            const formData = {
                email: document.getElementById('email').value,
                password: document.getElementById('password').value,
            };

            const response = await fetch("{{ route('api.login') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "Accept": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify(formData)
            });

            const data = await response.json();

            if (response.ok) {
                alert(data.token);
                localStorage.setItem('token', data.token);
                window.location.href = "/back";
            } else {
                const errorsDiv = document.getElementById('errors');
                errorsDiv.innerHTML = '';

                if (data.errors) {
                    Object.keys(data.errors).forEach(key => {
                        const error = document.createElement('div');
                        error.innerText = `${key}: ${data.errors[key].join(', ')}`;
                        errorsDiv.appendChild(error);
                    });
                } else if (data.error) {
                    errorsDiv.innerText = data.error;
                } else {
                    errorsDiv.innerText = 'An unexpected error occurred.';
                }
            }
        }
    </script>
</body>

</html>