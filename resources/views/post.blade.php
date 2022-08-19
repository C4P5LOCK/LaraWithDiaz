@extends('layouts.blog-post')



@section('content')

<a href="#">Home <i class="fa fa-angle-right"></i></a><span class="text-light">Post</span>

<!-- Blog Post -->

<!-- Title -->
<br/>
<br/>
<br/>

<div class="container col-sm-12">
<h1>{{$post->title}}</h1>

<!-- Author -->
<p class="lead">
by {{$post->user->name}}
</p>

<hr>

<!-- Date/Time -->
<p><span class="far fa-clock-o"></span> Posted {{$post->created_at->diffForHumans()}}</p>
<hr>

<!-- Preview Image -->
<img class="img-responsive" src="{{$post->photo->file}}" alt="">

<!-- Post Content -->
<hr>
<h4>
{!! $post->body !!}
</h4>
<hr>

<!-- Blog Comments -->

@if(Auth::check()) <!--Checks if user is logged in-->

<!-- Comments Form -->
@if(Session::has('flash_message'))
{{session('flash_message')}}
@endif

<div class="well">
<h4>Leave a Comment:</h4>
    {!! Form::open(['method'=>'POST', 'action' => 'PostCommentsController@store']) !!}
        {{csrf_field()}}

        <input type="hidden" name="post_id" value="{{$post->id}}">
        <div class="form-group">
            {!!Form::label('body','')!!}
            {!!Form::textarea('body',null,['class'=>'form-control','rows'=>3])!!}
        </div>

        <div class="form-group">
            {!!Form::submit('Comment',['class'=>'btn btn-primary'])!!}
        </div>
    
    {!!Form::close()!!}
</div>
@endif

@if(count($comments) > 0)
@foreach($comments as $comment)
<!--Posted Comments-->
<div class="media">
    <a class="pull-left" href="#">
        {{-- @if($user->photo->file){
            <img height="64" class="media-object" src="" alt="">
        }@else{
            <img height="64" class="media-object" src="/images/placeholder.jpg" alt="">
        }@endif --}}
        <img height="64" class="media-object" src="/images/placeholder.jpg" alt="">
    </a>

<div class="media-body">
    <h4 class="media-heading"> {{$comment->author}}
        <small> {{$comment->created_at->diffForHumans()}}</small>
    <h4>
        <p>{{$comment->body}}</p>
        <hr>
        {!! Form::open(['method'=>'POST', 'action' => 'CommentRepliesController@CreateReply']) !!}
                {{csrf_field()}}
                <input type="hidden" name="comment_id" value="{{$comment->id}}">
                <div class="form-group">
                    {!!Form::text('body',null,['class'=>'form-control'])!!}
                </div>

                <div class="form-group">
                    {!!Form::submit('Reply',['class'=>'btn btn-primary'])!!}
                </div>
            
            {!!Form::close()!!}

        @if(count($comment->replies)> 0)
            @foreach($comment->replies as $reply)
            <!--Nested Comments-->
        <div class="media">
            <a class="pull-left" href="#">
                <img class="media-object" src="$">
            </a>
            <div class="media-body">
                <h4 class="media-heading"> {{$reply->author}}
                <small>{{$comment->created_at->diffForHumans()}}</small>
                </h4>
                <p>{{$reply->body}}
                <hr>

            
            </div>
        </div>	
            <!--eND nESTED cOMMENT-->
        @endforeach
        @endif

    </div>
</div>

    @endforeach
@endif


    </div>


<div>
@endsection()