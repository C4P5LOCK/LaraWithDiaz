@extends('layouts.admin')


@section('content')
<h1>{{$post->title}}</h1>

<div class="row">
        <div class="col-sm-3">
            <img src="{{$post->photo ? $post->photo->file : '/images/placeholder.jpg'}}" class="img-responsive img-rounded">
        </div>

        <div class="col-sm-9">
           
            
            <h5 style="color:blue">{{$post->category->name}}</h5>
            <h4>{{$post->body}}</h4>
        </div>
</div>

<div class="row">
<div class="col-sm-6">
    <a href="{{route('admin.posts.edit', $post->id)}}" class="btn btn-primary">Edit Post</a>
</div>
    <div class="col-md-6">
    {!! Form::open(['method'=>'DELETE', 'action' => ['AdminPostsController@destroy', $post->id]]) !!} <!--An array defining the Methhod and action | Well tis is the Illuminate form collective working-->
            <div class="form-group">
                {!!Form::submit('Delete Post',['class'=>'btn btn-danger'])!!}
            </div>
     {!!Form::close()!!}
    </div>
</div>

@include('Includes.formerror')

@endsection