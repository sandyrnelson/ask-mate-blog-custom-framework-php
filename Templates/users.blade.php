<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cooking - Users</title>
    <link rel="icon" type="image/png" href="/Static/image/logo.png">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="/Static/css/users.css">
</head>
<body>
<div class="topnav" id="login_signin">
    @if (!isset($_SESSION['userName']))
        <a class="active" href="/login">Login</a>
        <a href="/registration">Registration</a>
    @else
        <a href=/userPage?id={{ $_SESSION['userId'] }}>Logged in as {{$_SESSION['userName']}}</a>
        <a class="active" href="/logout">Logout</a>
    @endif
</div>
<div class="topnav">
    <a class="active" href="/">Home</a>
    <a href="/tags">Tags</a>
    @if (isset($_SESSION['userName']))
        <a href="/ask-question">New Question</a>
    @endif
    <div class="search-container">
        <form action="/search" method="post">
            <input type="text" placeholder="Search.." name="search">
            <button type="submit"><i class="fa fa-search"></i></button>
        </form>
    </div>
</div>
<div class="main">
    <h1>Registered Users</h1>
    <table class="tbl">
        <tr>
            <th class="top-left-corner">User ID</th>
            <th >User Email</th>
            <th >Registration Date</th>
            <th >Questions Asked</th>
            <th class="top-right-corner">Answers</th>
        </tr>
        <tbody>
        @foreach ($users as $user)
            <tr>
                <td>{{ $user['id'] }} </td>
                <td style="text-align: left">{{ $user['email'] }} </td>
                <td>{{ $user['registration_time'] }} </td>
                <td>{{ $user['numberOfQuestions'] }}
{{--                    <a href="/question/{{ $question['id'] }}"> {{ $question['title'] }} </a>--}}
                </td>
                <td>{{ $user['numberOfAnswers'] }} </td>
            </tr>
        @endforeach
        </tbody>
    </table>
{{--        <img src="https://cdn0.iconfinder.com/data/icons/social-messaging-productivity-5/128/questions-answers-512.png">--}}
</div>
</body>
</html>
