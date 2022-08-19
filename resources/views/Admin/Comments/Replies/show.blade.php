@extends('layouts.admin')



@section('content')
<h2>Replies..</h2>

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

        @if($replies){
            @foreach ($replies as $reply){
                <tr>
                    <td>{{$reply->id}}</td>
                    <td>{{$reply->author}}</td>
                    <td>{{$reply->body}}</td>
                    <td>{{$reply->created_at->diffForHumans()}}</td>
                   

                   

                  </tr>
            }
            @endforeach
        }@endif
        

    </tbody>
    </table>


@stop