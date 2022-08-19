@extends('layouts.admin')



@section('content')
<h2>Comments for "{{$post->title}}"</h2>

    <p></p>         
   
    <table class="table table-striped">
      <thead>
        <tr>
          <th>#ID</th>
          <th>Author</th>
          <th>Body</th>
          <th>Date Posted</th>
        </tr>
      </thead>
      <tbody>

        @if($comments){
            @foreach ($comments as $comment){
                <tr>
                    <td>{{$comment->id}}</td>
                    <td>{{$comment->author}}</td>
                    <td>{{$comment->body}}</td>
                    <td>{{$comment->created_at->diffForHumans()}}</td>
                    <td><a href="{{route('admin.comment.replies.show',$comment->id)}}">View Replies</a></td>

                   

                  </tr>
            }
            @endforeach
        }@endif
        

    </tbody>
    </table>


@stop