<head>
	<meta charset="UTF-8">
	<title>Ask Mate</title>
	<link rel="stylesheet"
		  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="/Static/css/search_question.css">

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
	<h1>Cooking Tips</h1>

	<table class="tbl">
		<tr>
			<th style="text-align:center" colspan="2"><h3>Questions<br></h3></th>
		</tr>

		@foreach($questions as $question)
		<tr>
			<td>
				<a id="title" href="/question/{{ $question['id'] }}">{!! $question['title'] !!}</a><br>
			</td>
			<td style="text-align:center">
				<div id="message">{!! $question['message']  !!}</div>
				@if($question['answers'])
					<div>Related Answers</div>
					@foreach($question['answers'] as $answer)
						<br>
						<div id="message">{!!  $answer['answerMessage'] !!}</div>
					@endforeach
				@endif
			</td>
		</tr>
		@endforeach
	</table>
</div>
</body>