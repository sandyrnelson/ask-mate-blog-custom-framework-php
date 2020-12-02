<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tags</title>
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="/Static/css/list.css">
</head>
<body>
<div class="topnav" id="login_signin">
    @if (!isset($_SESSION['userName']))
        <a class="active" href="/login">Login</a>
        <a href="/registration">Sign in</a>
    @else
        <a href=/userPage?id={{ $_SESSION['userId'] }}>Logged in as {{$_SESSION['userName']}}</a>
        <a class="active" href="/logout">Logout</a>
    @endif
</div>
<div class="topnav">
    <a class="active" href="/">Home</a>
    <a href="/list">Questions</a>
    <div class="search-container">
        <form action="/search">
            <input type="text" placeholder="Search.." name="q">
            <button type="submit"><i class="fa fa-search"></i></button>
        </form>
    </div>
</div>
<div class="main">
    <h1>List of Tags</h1>
    <table class="tbl">
        <tr>
            <th><h3>Tag Name</h3></th>
            <th><h3>Used in questions</h3></th>
        </tr>
        @foreach ($tags as $tag)
            <tr>
                <td>{{ $tag['name'] }}</td>
                <td>{{ $tag['count_questions'] }}</td>
            </tr>
        @endforeach
    </table>
</div>
</body>
</html>