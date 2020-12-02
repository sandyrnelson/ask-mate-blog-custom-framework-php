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


{{--My own just examples - Virág--}}
{{--<div>--}}
{{--    @foreach(array_keys($question) as $key)--}}
{{--        <br>--}}
{{--            @if ($key == 'message')--}}
{{--                <p> {{ $question[$key] }}</p>--}}
{{--            @endif--}}
{{--    @endforeach--}}

{{--    @foreach($answers as $answer)--}}
{{--            @foreach(array_keys($answer) as $key)--}}
{{--                <br>--}}
{{--                @if ($key == 'message')--}}
{{--                    <p> {{ $answer[$key] }}</p>--}}
{{--                @endif--}}
{{--            @endforeach--}}
{{--            @endforeach--}}
{{--</div>--}}



{{--<div class="topnav" id="login_signin">--}}
{{--    {% if not session['username'] %}--}}
{{--        <a class="active" href="/login">Login</a>--}}
{{--        <a href="/registration">Sign in</a>--}}
{{--    {% else %}--}}
{{--        <a href="{{ url_for("user_page", user_id=session.user) }}">{{ login_status }}</a>--}}
{{--<a class="active" href="/logout">Logout</a>--}}
{{--{% endif %}--}}
{{--</div>--}}

<div class="topnav">
    <a class="active" href="/">Home</a>
    <a href="/list">Questions</a>
    <a href="/tags">Tags</a>
{{--    {% if session['username'] %}--}}
    <a href="/ask-question">New Question</a>
    <a href="/question/{{ $question['id']}}/edit">Edit the Question</a>
    <a href="/question/{{ $question['id']}}/delete">Delete Question</a>
{{--    {% endif %}--}}
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
            <th class="views"><h3>Views</h3></th>
            <th><h2>{{ $question['title'] }}</h2></th>
            <th colspan="2" class="votes"><h3>Votes</h3></th>
        </tr>

        <tr>
{{--            <td>{{ question.view_number }}</td>--}}
{{--            TODO --}}
            <td>43</td>
            <td id="question_message">{{ $question['message'] }} </td>
            <td colspan="2"> {{ $question['vote_number'] }}</td>

        </tr>



        @if($session['user'])
        <tr>
            <td><a href="/question/{{ $question['id'] }}/delete"><img
                            src="https://www.pngfind.com/pngs/m/641-6416950_search-delete-svg-png-icon-free-download-png.png"
                            width="15" height="20" alt="Delete question"></a>
            </td>
            <td>
                @if($tags !== None)
                    @foreach($tags as $tag)
                        <div class="tag">{{ $tag['name'] }}
                            <a href="{{ 'delete_tag' .'/'. $tag['id'] }}">x</a>
                        </div>
                    @endforeach
                @endif
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


{{--        {% for comment in q_comments %}--}}
{{--        <tr>--}}
{{--            <td style="text-align:center;font-size:small">--}}
{{--                {% if comment.user_id == session["user"] and comment.user_id != None %}--}}
{{--                <a href="{{ url_for('edit_comment',comment_id=comment.id, question_id=$question['id']) }}">{{ comment.edited_count }}</a>--}}
{{--                {% else %}--}}
{{--                {{ comment.edited_count }}--}}
{{--                {% endif %}--}}
{{--            </td>--}}
{{--            <td style="text-align:center;font-size:small">{{ comment.message }}</td>--}}
{{--            <td colspan="2" style="text-align:center;font-size:small;color: #9C1A1C">--}}
{{--                {% if comment.user_id == session["user"] and comment.user_id != None %}--}}
{{--                <a href="{{ url_for('delete_comment', question_id=$question['id'], comment_id=comment.id) }}">X</a>--}}
{{--                {% endif %}--}}
{{--            </td>--}}
{{--        </tr>--}}
{{--        {% endfor %}--}}
{{--        <tr>--}}
{{--            <form action="{{ url_for('add_comment_question', question_id=$question['id']) }}" method="post">--}}
{{--                <td>Add Comment:</td>--}}
{{--                <td><input type="text" id="add-comment" name="comment" required minlength="2" size="50"></td>--}}
{{--                <td colspan="2">--}}
{{--                    <button id="add-comment" type="submit">Add</button>--}}
{{--                </td>--}}
{{--            </form>--}}

{{--        </tr>--}}
{{--        --}}
{{--        --}}


        <tr>
            <th></th>
            <th><h2>Answers</h2></th>
            <th colspan="2"><strong>Votes</strong></th>
        </tr>

{{--        {% for answer in answers if answer.question_id == question.id %}--}}
        @foreach($answers as $answer)
        <tr>
            <td>

                @if ($question['id'] == $session['id'])
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
{{--                @if($answer['id'] == $session["user"])--}}
                <a href="/answer/{{ $answer['id']}}/delete"><img
                            src="https://www.pngfind.com/pngs/m/641-6416950_search-delete-svg-png-icon-free-download-png.png"
                            width="15" height="20" alt="Delete question"></a>
{{--                @endif--}}
            </td>
            <td style="text-align:center">
              @if (answer["image"] != '')
                <img src="/Static/image/Blumen.gif" width="250px" alt="answer_image">
                @endif
                  <p>Picture of Answer</p>
            </td>
            <td colspan="2">
                @if(answer['id_registered_user']== session["user"])
                     <a href="{{ 'edit-answer' }}">Edit</a>
                @else
                    Edit
                @endif
            </td>
        </tr>
{{--            {% for list_comments in a_comments %}--}}
{{--                {% for comment in list_comments if comment.answer_id == answer.id %}--}}
{{--                <tr>--}}
{{--                    <td style="text-align:center;font-size:small">--}}
{{--                        {% if comment.user_id == session["user"] and comment.user_id != None %}--}}
{{--                        <a href="{{ url_for('edit_comment',comment_id=comment.id, question_id=question.id) }}">{{ comment.edited_count }}</a>--}}
{{--                        {% else %}--}}
{{--                        {{ comment.edited_count }}--}}
{{--                        {% endif %}--}}
{{--                    </td>--}}
{{--                    <td style="text-align:center;font-size:small">{{ comment.message }}</td>--}}
{{--                    <td colspan="2" style="text-align:center;font-size:small;color: #9C1A1C">--}}
{{--                        {% if comment.user_id == session["user"] and comment.user_id != None %}--}}
{{--                        <a href="{{ url_for('delete_comment', question_id=question.id, comment_id=comment.id) }}">X</a>--}}
{{--                        {% endif %}--}}
{{--                    </td>--}}
{{--                </tr>--}}
{{--                {% endfor %}--}}
{{--            {% endfor %}--}}
{{--                <tr>--}}
{{--                    <form action="{{ url_for('add_comment_answer', question_id=question['id'], answer_id=$answer['id']) }}"--}}
{{--                          method="post">--}}
{{--                        <td>Add Comment:</td>--}}
{{--                        <td><input type="text" id="add-comment" name="comment" required minlength="2" size="50"></td>--}}
{{--                        <td colspan="2">--}}
{{--                            <button id="add-comment" type="submit">Add</button>--}}
{{--                        </td>--}}
{{--                    </form>--}}
{{--                </tr>--}}
{{--        {% endfor %}--}}
        @endforeach
        <tr>
            <td class="bottom-left-corner"></td>
            <td>
                @if(session['username'])
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