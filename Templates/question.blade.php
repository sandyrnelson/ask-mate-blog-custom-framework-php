<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cooking Tips</title>
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="/Static/css/question.css">
</head>
<body>

<div class="topnav" id="login_signin">
    @if(!isset($_SESSION['userName']))
        <a class="active" href="/login">Login</a>
        <a href="/registration">Sign in</a>
    @else
{{--            <a href="#">What was this link? question blade 39.line</a>--}}
        <a href="/user/{{ $question['id_registered_user']}}"> Your User Page</a>
        <a class="active" href="/logout">Logout</a>
    @endif
</div>

<div class="topnav">
    <a class="active" href="/">Home</a>
    <a href="/list">Questions</a>
    <a href="/tags">Tags</a>
    @if(isset($_SESSION['userName']))
        <a href="/ask-question">New Question</a>
        <a href="/question/{{ $question['id']}}/edit">Edit the Question</a>
        <a href="/question/{{ $question['id']}}/delete">Delete Question</a>
    @endif
    <div class="search-container">
        <form action="/search">
            <input type="text" placeholder="Search.." name="q">
            <button type="submit"><i class="fa fa-search"></i></button>
        </form>
    </div>
</div>

<div class="main">
    <h1>Cooking Tips</h1>

    <table class="tbl">
        <tr>
            <th class="views"></th>
            <th><h2>{{ $question['title'] }}</h2></th>
            <th colspan="2" class="votes"><h3>Votes</h3></th>
        </tr>

        <tr>
            <td > {{ $question['submission_time'] }} </td>
            <td id="question_message" style="width: 80%">{{ $question['message'] }} </td>
            <td> {{ $question['vote_number'] }}</td>
            <td>
                <a href="/question/{{ $question['id']}}/vote/up">
                    <img src="https://cdn0.iconfinder.com/data/icons/flat-round-arrow-arrow-head/512/Green_Arrow_Top-512.png" width="15" height="15"></a>
                <br>
                <a href="/question/{{ $question['id']}}/vote/down">
                    <img src="https://cdn0.iconfinder.com/data/icons/flat-round-arrow-arrow-head/512/Red_Arrow_Down-512.png" width="15" height="15">
                </a>
            </td>
        </tr>



        @if(isset($_SESSION['userName']))
        <tr>
            <td><a href="/question/{{ $question['id'] }}/delete"><img
                            src="https://www.pngfind.com/pngs/m/641-6416950_search-delete-svg-png-icon-free-download-png.png"
                            width="15" height="20" alt="Delete question"></a>
            </td>
            <td>
{{--                @if($tags !== 'null')--}}
{{--                    @foreach($tags as $tag)--}}
{{--                        <div class="tag">{{ $tag['name'] }}--}}
{{--                            <a href="{{ 'delete_tag' .'/'. $tag['id'] }}">x</a>--}}
{{--                        </div>--}}
{{--                    @endforeach--}}
{{--                @endif--}}
            </td>
            <td colspan="2"><a href="/question/{{ $question['id'] }}/new-tag">Add Tag</a></td>
        </tr>
        @endif


        <tr>
            <td> </td>

            <td style="text-align:center">
                @if($question["id_image"] != '')
                    <img class="small" src="/Static/image/{{ $question['id_image'] }}.jpg"  width="350px" alt="question_image">
                @endif
            </td>
            <td colspan="2"></td>
        </tr>


        <tr>
            <th></th>
            <th><h2>Answers</h2></th>
            <th colspan="2"><strong>Votes</strong></th>
        </tr>

        @foreach($answers as $answer)
        <tr>
            <td>

                @if ($_SESSION['userName'] == $questionOwner['email'])
                    <a href="/check-answer">
                    @if ($answer['id_question'] == 0)
                        <span style="color:gray;opacity:0.5">&#10003;</span>
                    @else
                        <span style="color:green">&#10003;</span>
                    @endif
                    </a>
                @else
                    @if($answer['id'] == 1)
                        <span style="color:green">&#10003;</span>
                    @endif
                @endif
            </td>

            <td>{{ $answer['message'] }}</td>
            <td style="text-align: center">55</td>
            <td>
                <a href="/answer/{{$answer['id'] }}/vote_up">
                    <img src="https://cdn0.iconfinder.com/data/icons/flat-round-arrow-arrow-head/512/Green_Arrow_Top-512.png"
                         width="15" height="15"></a>
                <br>
                <a href="/answer/{{$answer['id'] }}/vote_down">
                    <img src="https://cdn0.iconfinder.com/data/icons/flat-round-arrow-arrow-head/512/Red_Arrow_Down-512.png"
                         width="15" height="15">
                </a>
            </td>
        </tr>
        <tr>
            <td>
                @if ($_SESSION['userName'] == $questionOwner['email'])
                    <a href="/answer/{{ $answer['id']}}/delete">
                        <img src="https://www.pngfind.com/pngs/m/641-6416950_search-delete-svg-png-icon-free-download-png.png"
                            width="15" height="20" alt="Delete question"></a>
                @endif
            </td>
            <td colspan="2">
                @if ($_SESSION['userName'] == $questionOwner['email'])
                    <a href="/answer/{{ $answer['id']}}/edit-answer">Edit</a>
                @endif
            </td>
        </tr>

        @endforeach
        <tr>
            <td class="bottom-left-corner"></td>
            <td>
                @if(isset($_SESSION['userName']))
                  <a href="/question/{{ $question['id'] }}/add-answer">Add New Answer...</a>
                @else
                    <p>Log in or Sign in to add new answer, please!</p>
                @endif
            </td>
            <td class="bottom-right-corner" colspan="2"></td>
        </tr>
    </table>
</div>

</body>
</html>