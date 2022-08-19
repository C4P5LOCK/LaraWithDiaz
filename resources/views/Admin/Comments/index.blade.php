@extends('layouts.admin')


@section('content')
    <h2>Comments</h2>

    <table class="table table-striped">
        <thead>
          <tr>
            <th>#ID</th>
            <th>Author</th>
            <th>Email</th>
            <th>Body</th>
          </tr>
        </thead>
        <tbody>
  
          @if(count($comments) > 0){
              @foreach ($comments as $comment){
                  <tr>
                      <td>{{$comment->id}}</td>
                      <td>{{$comment->author}}</td>
                      <td>{{$comment->email}}</td>
                      <td>{{$comment->body}}</td>
                      <td><a href="{{route('home.post',$comment->post->id)}}">View Post</a></td>
                      <td>
                            @if($comment->is_active == 0)
                            {!! Form::open(['method'=>'PATCH', 'action' => ['PostCommentsController@update',$comment->id]]) !!} <!--An array defining the Methhod and action | Well tis is the Illuminate form collective working-->
                            {{csrf_field()}}
                            <input type="hidden" name="is_active" value="1">
                            
                            
                            <div class="form-group">
                                {!!Form::submit('Approve',['class'=>'btn btn-primary'])!!}
                            </div>
                            
                            {!!Form::close()!!}

                            @else

                            {!! Form::open(['method'=>'PATCH', 'action' => ['PostCommentsController@update',$comment->id]]) !!} <!--An array defining the Methhod and action | Well tis is the Illuminate form collective working-->
                            {{csrf_field()}}
                            <input type="hidden" name="is_active" value="0">
                            
                            
                            <div class="form-group">
                                {!!Form::submit('Un-Approve',['class'=>'btn btn-info'])!!}
                            </div>
                            
                            {!!Form::close()!!}

                            @endif


                      </td>

                      <td>
                        {!! Form::open(['method'=>'DELETE', 'action' => ['PostCommentsController@destroy', $comment->id]]) !!} <!--An array defining the Methhod and action | Well tis is the Illuminate form collective working-->
                        <div class="form-group">
                            {!!Form::submit('Delete',['class'=>'btn btn-danger'])!!}
                        </div>
                         {!!Form::close()!!}

                      </td>

  
                    </tr>
              }
              @endforeach
          }@endif
          
  
      </tbody>
      </table>

@stop