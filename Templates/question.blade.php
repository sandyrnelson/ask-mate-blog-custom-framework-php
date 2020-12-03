<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cooking - Question</title>
    <link rel="icon" type="image/png" href="/Static/image/logo.png">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="/Static/css/question.css">
</head>
<body>

<div class="topnav" id="login_signin">
    @if(!isset($_SESSION['userName']))
        <a class="active" href="/login">Login</a>
        <a href="/registration">Registration</a>
    @else
        <a href="/user/{{ $question['id_registered_user']}}"> Your User Page</a>
        <a class="active" href="/logout">Logout</a>
    @endif
</div>

<div class="topnav">
    <a class="active" href="/">Home</a>
    <a href="/users">Users</a>
    <a href="/tags">Tags</a>
    @if(isset($_SESSION['userName']))
        @if($_SESSION['userName'] == $questionOwner['email'])
            <a href="/ask-question">New Question</a><a href="/question/{{ $question['id']}}/edit">Edit the Question</a>
        @endif
    @endif
    <div class="search-container">
        <form action="/search" method="post">
            <input type="text" placeholder="Search.." name="search">
            <button type="submit"><i class="fa fa-search"></i></button>
        </form>
    </div>
</div>

<div class="main">
    <h1>Cooking Tips</h1>

    <table class="tbl">
        <tr>
            <th class="views">Date</th>
            <th colspan="3"><h2>{{ $question['title'] }}</h2></th>
            <th colspan="2" class="votes"><h3>Votes</h3></th>
        </tr>

        <tr>
            <td > {{ $question['submission_time'] }} </td>
            <td colspan="3" id="question_message" style="width: 80%">{{ $question['message'] }} </td>
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



        <tr>
            <td>
                @if(isset($_SESSION['userName']))
                    @if($_SESSION['userName'] == $questionOwner['email'])

                <a href="/question/{{ $question['id'] }}/delete"><img
                                src="https://www.pngfind.com/pngs/m/641-6416950_search-delete-svg-png-icon-free-download-png.png"
                                width="15" height="20" alt="Delete question"></a>

                    @endif
                @endif
            </td>
            <td colspan="3">
                @if($tags != null)
                    @foreach($tags as $tag)
                        <div class="tag">{{ $tag['name'] }}
                           <span class="tag-deletion">
                               <a href="/delete_tag/{{$question['id']}}/{{ $tag['name'] }}">[X]</a>
                           </span>
                        </div>
                    @endforeach
                @endif
            </td>
            <td colspan="2">
                @if(isset($_SESSION['userName']))
                    <a href="/question/{{ $question['id'] }}/new-tag">Add Tag</a>
                @endif
            </td>
        </tr>



        <tr>
            <td> </td>

            <td colspan="3" style="text-align:center">
                @if($imageName)
                    <img class="small" src="/Static/image/{{ $imageName }}"  width="350px" alt="question_image">
                @endif
            </td>
            <td colspan="2"></td>
        </tr>


        <tr>
            <th ></th>
            <th colspan="3"><h2>Answers</h2></th>
            <th colspan="2"><strong>Votes</strong></th>
        </tr>

    @foreach($answers as $answer)
        <tr>
            <td>

                @if (isset($_SESSION['userName']))
                    <a href="/check-answer">
                        <span style="color:green">&#10003;</span>
                    </a>
                @else
                    @if($answer['id'] == 1)
                        <span style="color:green">&#10003;</span>
                    @endif
                @endif
            </td>
            <td class="answer-message">{{ $answer['message'] }}</td>
            <td>
                @if ($_SESSION['userName'] == $answer['answerOwner'])
                    <a href="/question/{{$question['id']}}/edit-answer/{{ $answer['id']}}"/>Edit</a>
                @endif
            </td>
            <td>
                @if ($_SESSION['userName'] == $questionOwner['email'] or $_SESSION['userName'] == $answer['answerOwner'] )
                    <a href="/question/{{ $question['id'] }}/delete-answer/{{ $answer['id']}}">
                        <img src="https://www.pngfind.com/pngs/m/641-6416950_search-delete-svg-png-icon-free-download-png.png"
                             width="15" height="20" alt="Delete question"></a>
                @endif
            </td>
            <td style="text-align: center">{{ $answer['vote_number'] }}</td>
            <td>
                <a href="/question/{{ $question['id'] }}/vote-answer/{{ $answer['id']}}/up">
                    <img src="https://cdn0.iconfinder.com/data/icons/flat-round-arrow-arrow-head/512/Green_Arrow_Top-512.png"
                         width="15" height="15"></a>
                <br>
                <a href="/question/{{ $question['id'] }}/vote-answer/{{ $answer['id']}}/down">
                    <img src="https://cdn0.iconfinder.com/data/icons/flat-round-arrow-arrow-head/512/Red_Arrow_Down-512.png"
                         width="15" height="15">
                </a>
            </td>
        </tr>

    @endforeach

        <tr>
            <td class="bottom-left-corner"></td>
            <td colspan="3">
                @if(isset($_SESSION['userName']))
                  <a href="/question/{{ $question['id'] }}/add-answer">Add New Answer</a>
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