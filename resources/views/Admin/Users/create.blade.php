@extends('layouts.admin')


@section('content')
<h1> Create Users</h1>

{!! Form::open(['method'=>'POST', 'action' => 'AdminUsersController@store','files' =>true]) !!} <!--An array defining the Methhod and action | Well tis is the Illuminate form collective working-->
{{csrf_field()}}
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
    {!!Form::select('status',array(1 =>'Active', 0 =>'Not Active'),0,['class'=>'form-control'])!!}
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
    {!!Form::submit('Create User',['class'=>'btn btn-primary'])!!}
</div>

{!!Form::close()!!}

@include('Includes.formerror')

@endsection