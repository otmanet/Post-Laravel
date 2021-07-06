<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
        .user_name{
        font-size:14px;
        font-weight: bold;
        }
        .comments-list .media{
        border-bottom: 1px dotted #ccc;
        }
    </style>
    <title>post user</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="post">USER POST</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="{{route('create.Post')}}">Create Post <span class="sr-only">(current)</span></a>
                </li>
            </ul>
       <div class="dropdown" style="position:fixed;right:0;margin-right: 8px">
          <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">{{$userPostInf->name}}
          <span class="caret"></span></button>
          <ul class="dropdown-menu">
          <li><a href="logout">Setting</a></li>
          <li><a href="logout">Logout</a></li>
          </ul>
        </div>
        </div>
    </nav>
    <div class="container">
        <div class="row">
   @foreach ($posts as $post)
   <img src="files/{{$post->photos}}" alt="" style="width: 220px;height: 200px; ">
   <div class="comments-list">
     @foreach($post->comments  as $comment)
     <div class="media">
        <div class="media-body">

            <h4 class="media-heading user_name">{{$comment->description}}</h4>


            <p><small><a href="">Like</a> - <a href="">Share</a></small></p>
        </div>
    </div>
     @endforeach
     <form action="/addComment/{{$post->id}}" method="POST" >
        @csrf
     <div class="form-group">
        <textarea  class="form-control" name="description"></textarea>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary">
            Add Comment
        </button>
    </div>

    </form>
     </div>
   @endforeach
   </div>
   </div>
</body>
</html>
