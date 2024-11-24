<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login and Registration</title>
</head>
<body>
    <h1>Welcome</h1>

    <h2>Login</h2>
    <form action="login.php" method="POST">
        <label for="loginEmail">Email:</label>
        <input type="email" id="loginEmail" name="email" required>
        <br>
        <label for="loginPassword">Password:</label>
        <input type="password" id="loginPassword" name="password" required>
        <br>
        <button type="submit">Login</button>
    </form>

   
</body>
</html>