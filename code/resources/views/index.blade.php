<!-- resources/views/auth/register.blade.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>

<body>
    <h2>Register1</h2>
    <div id="errors"></div>
    <form id="registerForm">
        <div>
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" required>
        </div>
        <div>
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required>
        </div>
        <div>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required>
        </div>
        <button type="button" onclick="submitForm()">Register</button>
    </form>
    <a href="{{ route('login') }}">已有帳號</a>

    <script>
        async function submitForm() {
            const formData = {
                name: document.getElementById('name').value,
                email: document.getElementById('email').value,
                password: document.getElementById('password').value,
            };

            const response = await fetch("{{ route('api.register') }}", {
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
                alert('Registration successful! Please login.');
                window.location.href = "{{ route('login') }}";
            } else {
                alert('Registration ! Please login.');
                document.getElementById('errors').innerText = JSON.stringify(data.errors);
            }
        }
    </script>
</body>

</html>