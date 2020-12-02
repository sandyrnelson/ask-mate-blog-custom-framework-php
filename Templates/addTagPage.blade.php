<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tags</title>
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="/Static/css/form.css">
</head>
<body>
<div class="topnav" id="login_signin">

    @if(!isset($_SESSION['userName']))
        <a class="active" href="/login">Login</a>
        <a href="/registration">Sign in</a>
    @else
        <a href=/userPage?id={{ $_SESSION['userId'] }}>Logged in as {{ $_SESSION['userName'] }}</a>
        <a class="active" href="/logout">Logout</a>
    @endif
</div>
<div class="topnav">
    <a class="active" href="/">Home</a>
{{--    <a href="/list">Questions</a>--}}
    <a href="/add-question">New Question</a>
    <div class="search-container">
        <form action="/search" method="post">
            <input type="text" placeholder="Search.." name="search">
            <button type="submit"><i class="fa fa-search"></i></button>
        </form>
    </div>
</div>
<div class="container">
    <div class="title">
        <h1>Add Tag</h1>
    </div>
    <form action="/question/{{ $questionId }}/new-tag" method="post">
        <label for="tag_name">Choose tag:</label>
        <select name="tag_name">
            <option value="None"></option>
            @foreach($tags as $tag)
                <option value="{{ $tag->get('name') }}" @if ($tag->get('name') === $tags[0]) selected @else @endif>{{ $tag->get('name') }}</option>
            @endforeach
        </select>
        <button type="submit">Add Tag</button>
    </form>
    <br><br>
    <form action="/question/{{ $questionId }}/new-tag" method="post">
        <div class="row">
            <div class="col-25">
                <label for="add-tag">Add New Tag</label>
            </div>
            <div class="col-75">
                <input type="text" id="add-tag" name="tag_name" required minlength="2" size="20">
            </div>
        </div>
        <div class="row">
            <button id="add-comment" type="submit">Add</button>
        </div>
    </form>
</div>
</body>
</html>