<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cooking - Login</title>
    <link rel="icon" type="image/png" href="/Static/image/logo.png">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="/Static/css/form.css">
</head>
<body>
<div>
    <div class="topnav">
        <div class="col-25">
            <a class="active" href="/">Home</a>
        </div>
        <div class="topnav" id="login_signin">
            @if (!$_SESSION['userName'])
                <a href="/registration">Registration</a>
            @else
                <a class="active" href="/logout">Logout</a>
            @endif
        </div>
    </div>
    <div class="container">
        <h1>Login</h1>
        <form action="/login" method="post">
            <div class="row">
                <div class="col-25">
                    <label for="username">Email:</label>
                </div>
                <div class="col-75">
                    <input type="text" id="email" name=email>
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="password">Password:</label>
                </div>
                <div class="col-75">
                    <input type=password id="password" name=password>
                </div>
            </div>
            <div class="row">
                <input type=submit value=Login>
            </div>
            <p style="font-weight: bold"> {{ $errorMessage or '' }}</p>
        </form>
    </div>
</body>
</html>