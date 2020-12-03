<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Page</title>
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="/Static/css/user_page.css">
</head>
<body>

<div class="topnav" id="login_signin">
    @if(!$_SESSION['userName'])
{{--    {% if not session['username'] %}--}}
        <a class="active" href="/login">Login</a>
        <a href="/registration">Sign in</a>
    @else
        <a class="active" href="/logout">Logout</a>
    @endif
</div>

<div class="topnav">
    <a class="active" href="/">Home</a>
    <a href="/users">Users</a>
    <a href="/ask-question">New Question</a>
    <div class="search-container">
        <form action="/search">
            <input type="text" placeholder="Search.." name="q">
            <button type="submit"><i class="fa fa-search"></i></button>
        </form>
    </div>
</div>

<div class="main">
    <h1>{{ $user['email'] }}</h1>
    <br>

    <table class="tbl">
        <tr>
            <th>User id</th>
            <th>User Email</th>
            <th>Registration date</th>
{{--            <th>Questions Asked</th>--}}
{{--            <th>Answers Given</th>--}}
{{--            <th>Comments Provided</th>--}}
{{--            <th>Reputation</th>--}}
        </tr>
        <tr>
            <td>{{ $user['id'] }}</td>
            <td>{{  $user['email'] }}</td>
            <td>{{  $user['registration_time'] }}</td>
{{--            <td>{{ user_info.question_count }}</td>--}}
{{--            <td>{{ user_info.answer_count }}</td>--}}
{{--            <td>{{ user_info.comment_count }}</td>--}}
{{--            <td>{{ user_info.reputation }}</td>--}}
        </tr>
    </table>
    <h2>Questions</h2>
    <div class="center">
        <table class="tbl">
            <tr>
                <th>Question</th>
                <th>Vote Count</th>
            </tr>
            @foreach($questions as $question)
            <tr>
                <td><a href="../question/{{$question['id']}}"> {{ $question['title'] }}</a></td>
                <td class="center">{{ $question['vote_number'] }}</td>
            </tr>
            @endforeach
        </table>
    </div>
    <h2>Answers</h2>
    <table class="tbl">
        <tr>
            <th>Answer</th>
            <th class="center">Vote Count</th>
            <th class="center">Status</th>
        </tr>
        @foreach($answers as $answer)
        <tr>
            <td><a href="../question/{{$question['id']}}"> {{ $answer['message'] }}</a></td>
            <td class="center">{{ $answer['vote_number'] }}</td>
            <td class="center">
                <span style="color:green">&#10003;</span>

            </td>
        </tr>
        @endforeach
    </table>

</div>
</body>
</html>
