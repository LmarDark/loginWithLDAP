<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
</head>
<body>
    <form action="{{ route('userLogin.post') }}" method="post">
        @csrf
        <input type="text" maxlength="11" name="userLDAP_name" placeholder="User">
        <input type="password" minlength="6" name="passwordLDAP_name" placeholder="Password">
        <button type="submit">Enviar</button>
    </form>
</body>
</html>