
<head>
    <meta charset="UTF-8">
    <title>Cooking - Add Answer</title>
    <link rel="icon" type="image/png" href="/Static/image/logo.png">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="/Static/css/form.css">
</head>
<body>
<div class="topnav">
    <a class="active" href="/">Home</a>
    <div class="search-container">
        <form action="/search" method="post">
            <input type="text" placeholder="Search.." name="search">
            <button type="submit"><i class="fa fa-search"></i></button>
        </form>
    </div>
</div>
<div class="container">
    <div class="title">
        <h1>Add Answer</h1>
    </div>
    <div class="title">
        <h3>{{ $question['message'] }}</h3>
    </div>
    <form action="" method="post" enctype=multipart/form-data>
        <div class="row">
            <div class="col-25">
                <label for="message">Answer:</label><br>
            </div>
            <div class="col-75">
                <textarea id="message" name="message" required rows="10" cols="30">{{ $answer['message'] }}</textarea><br>
            </div>
        </div>
        <div class="row">
            <input type="submit" value="SUBMIT">
        </div>
    </form>
</div>
</body>

