<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post</title>
</head>
<body>
    <img src="{{$post->image_url}}"/>
    <h1>{{$post->title}}</h1>
    <p><b>Minutes to Read:</b> {{$post->minutes_to_read}}</p>
    <p><b>Excerpt:</b> {{$post->excerpt}}</p>
    <hr/>
    <h3>Post Content</h3>
    <p>{{$post->body}}</p>
    <hr/>
</body>
</html>