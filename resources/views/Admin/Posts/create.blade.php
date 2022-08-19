@extends('layouts.admin')



@section('content')
    <h2>Create Post</h2>
    {!! Form::open(['method'=>'POST', 'action' => 'AdminPostsController@store','files' =>true]) !!} <!--An array defining the Methhod and action | Well tis is the Illuminate form collective working-->
    {{csrf_field()}}
    <div class="form-group">
        {!!Form::label('title','Title')!!}
        {!!Form::text('title',null,['class'=>'form-control'])!!}
    </div>
    
    <div class="form-group">
        {!!Form::label('body','Description')!!}
        {!!Form::textarea('body',null,['class'=>'form-control'])!!}
    </div>
    
    <div class="form-group">
        {!!Form::label('category_id','Category')!!}
        {!!Form::select('category_id',[''=>'Select Category']+ $categories,null,['class'=>'form-control'])!!}
    </div>
    
    
    <div class="form-group">
        {!!Form::label('photo_id','Photo')!!}
        {!!Form::file('photo_id',null,['class'=>'form-control'])!!}
    </div>
    
    
    <div class="form-group">
        {!!Form::submit('Create Post',['class'=>'btn btn-primary'])!!}
    </div>
    
    {!!Form::close()!!}

@include('Includes.formerror')
@endsection()