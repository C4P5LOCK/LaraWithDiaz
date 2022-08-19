@extends('layouts.admin')


@section('content')
<h1> Edit User</h1>
<div class="col-sm-3">
    <img src="{{$user->photo ? $user->photo->file : '/images/placeholder.jpg'}}" class="img-responsive img-rounded">
</div>

<div class="col-sm-9">
        {!! Form::model($user, ['method'=>'PATCH', 'action' => ['AdminUsersController@update',$user->id],'files' =>true]) !!} <!--//This!!-->
        <div class="form-group">
            {!!Form::label('name','Name')!!}
            {!!Form::text('name',null,['class'=>'form-control'])!!}
        </div>

        <div class="form-group">
            {!!Form::label('email','E-mail')!!}
            {!!Form::email('email',null,['class'=>'form-control'])!!}
        </div>

        <div class="form-group">
            {!!Form::label('role_id','Role')!!}
            {!!Form::select('role_id',[''=>'Select Role']+ $roles,null,['class'=>'form-control'])!!}
        </div>

        <div class="form-group">
            {!!Form::label('status','Status')!!}
            {!!Form::select('status',array(1 =>'Active', 0 =>'Not Active'),null,['class'=>'form-control'])!!}
        </div>

        <div class="form-group">
            {!!Form::label('password','Password')!!}
            {!!Form::password('password',['class'=>'form-control'])!!}
        </div>

        <div class="form-group">
            {!!Form::label('photo_id','Photo')!!}
            {!!Form::file('photo_id',null,['class'=>'form-control'])!!}
        </div>


        <div class="form-group">
            {!!Form::submit('Update User',['class'=>'btn btn-primary'])!!}
        </div>

        {!!Form::close()!!}
</div>

@include('Includes.formerror')

@endsection