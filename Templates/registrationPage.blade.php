<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cooking - Registration</title>
    <link rel="icon" type="image/png" href="/Static/image/logo.png">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="/Static/css/form.css">
</head>
<body>
<div class="topnav">
    <a class="active" href="/">Home</a>
    <div class="topnav" id="login_signin">
        <a class="active" href="/login">Login</a>
        <a href="/registration">Registration</a>
    </div>
</div>
<div class="container">
    <h1>Registration</h1>
    <form action="/registration" method="post" enctype=multipart/form-data>
        <div class="row">
            <div class="col-25">
                <label for="email">E-mail:</label><br>
            </div>
            <div class="col-75">
                <input type="email" name="email" oninvalid="setCustomValidity('Required format: example@user.com')" placeholder="magicname@email.com">
            </div>
        </div>
        <div class="row">
            <div class="col-25">
                <label for="password">Password:</label><br>
            </div>
            <div class="col-75">
                <input type="password" id="password" name="password" required placeholder="Enter your password">
            </div>
        </div>
        <div class="row">
            <div class="col-25">
                <label for="confirm">Confirmation:</label><br>
            </div>
            <div class="col-75">
                <input type="password" id="password" name="confirm" required placeholder="Confirm your password">
            </div>
        </div>
        <div class="row">
            <input type="submit" value="SUBMIT">
        </div>
    </form>
    <p style="font-weight: bold">{{ $errorMessage or ''}}</p>
</div>
</body>
</html>