<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ask Mate</title>
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="/Static/css/index.css">

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
    <a href="/tags">Tags</a>
    <p><a href="/registration">Registration</a></p>
    <p><a href="/login">Login</a></p>
    @if (isset($_SESSION['userName']))
        <a href="/ask-question">New Question</a>
        <a href="/users">Users Info</a>
    @endif
    <div class="search-container">
        <form action="/search" method="post">
            <input type="text" placeholder="Search.." name="search">
            <button type="submit"><i class="fa fa-search"></i></button>
        </form>
    </div>
</div>

<div class="main">
    <h1>Ask Mate Main Page</h1>

    <table class="tbl">
        <tr>
            <th class="views">View</th>
            <th>Latest Questions</th>
            <th class="votes">Votes</th>
        </tr>
        <tbody>

        @foreach ($questions as $question)
            <tr>
{{--                @foreach($question as $td)--}}
                    <td><a href="/question/{{ $question['id'] }}"> {{ $question['title'] }} </a></td>
                    <td>{{ $question['message'] }} </td>
                    <td>{{ $question['submission_time'] }} </td>
{{--                @endforeach--}}
            </tr>
        @endforeach
{{--        {% for question in questions %}--}}
{{--        <tr>--}}
{{--            <td class="center">{{ question.view_number }}</td>--}}
{{--            <td><a href="/question/{{ question.id }}">{{ question.title }}</a></td>--}}
{{--            <td class="center">{{ question.vote_number }}</td>--}}
{{--        </tr>--}}
{{--        {% endfor %}--}}
        </tbody>
    </table>
{{--    <img src="https://cdn0.iconfinder.com/data/icons/social-messaging-productivity-5/128/questions-answers-512.png">--}}
</div>
</body>
</html>