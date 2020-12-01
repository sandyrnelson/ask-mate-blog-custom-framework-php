<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registration</title>
{{--    <link rel="stylesheet"--}}
{{--          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">--}}
    <link rel="stylesheet" type="text/css" href="/Static/css/form.css">
</head>
<body>
<div class="topnav">
    <a class="active" href="/">Home</a>
    <div class="topnav" id="login_signin">
        <a class="active" href="/login">Login</a>
        <a href="/registration">Sign in</a>
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
                <input type="email" name="email" placeholder="magicname@e-mail.com">
            </div>
        </div>
        <div class="row">
            <div class="col-25">
                <label for="user_name">Username:</label><br>
            </div>
            <div class="col-75">
                <input type="text" name="user_name" placeholder="Enter your name, pls">
            </div>
        </div>
        <div class="row">
            <div class="col-25">
                <label for="password">Password:</label><br>
            </div>
            <div class="col-75">
                <input type="password" id="password" name="password" placeholder="Enter your password">
            </div>
        </div>
        <div class="row">
            <div class="col-25">
                <label for="password">Upload a profile image:</label>
            </div>
            <div class="col-75">
                <input type="file" id="file" name="file" accept=".jpg, .png">
            </div>
        </div>
        <div class="row">
            <input type="submit" value="SUBMIT">
        </div>
    </form>
    <p>{{ $errorMessage }}</p>
</div>
</body>
</html>