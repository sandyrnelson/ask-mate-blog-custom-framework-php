<head>
    <meta charset="UTF-8">
    <title>Add Question</title>
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="Static/form.css">
</head>
<body>
{{--<div class="topnav" id="login_signin">--}}
{{--    {% if not session['username'] %}--}}
{{--    <a class="active" href="/login">Login</a>--}}
{{--    <a href="/registration">Sign in</a>--}}
{{--    {% else %}--}}
{{--    <a href="{{ url_for("user_page", user_id=session.user) }}">{{ login_status }}</a>--}}
{{--    <a class="active" href="/logout">Logout</a>--}}
{{--    {% endif %}--}}
{{--</div>--}}
<div class="topnav">
    <a class="active" href="/">Home</a>
{{--    <a href="/list">Questions</a>--}}
{{--    {#      <a href="/add-question">New Question</a>#}--}}
    <div class="search-container">
        <form action="/search">
            <input type="text" placeholder="Search.." name="q">
            <button type="submit"><i class="fa fa-search"></i></button>
        </form>
    </div>
</div>
<div class="container">
    <div class="title">
        <h1>Add Question</h1>
    </div>
    <form action="/ask-question" method="post" enctype=multipart/form-data>
        <div class="row">
            <div class="col -25">
                <label for="title">Question Title:</label><br>
            </div>
            <div class="col -75">
                <input type="text" id="title" name="title" required minlength="5" size="20"><br>
            </div>
        </div>
        <div class="row">
            <div class="col -25">
                <label for="message">Question:</label><br>
            </div>
            <div class="col -75">
                <textarea id="message" name="message" required rows="10" cols="30"></textarea><br>
            </div>
        </div>
        <div class="row">
            <div class="col -25">
                <label for="file">Image file:</label><br>
            </div>
            <div class="col -75">
                <input type="file" id="file" name="file" accept=".jpg, .png">
            </div>
            <br><br>
        </div>
        <div class="row">
            <input type="submit" value="SUBMIT">
        </div>
    </form>
</div>
</body>
</html>