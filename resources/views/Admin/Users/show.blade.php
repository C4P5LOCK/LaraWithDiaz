@extends('layouts.admin')


@section('content')
<h1>User Profile</h1>

<div class="row">
        <div class="col-sm-3">
            <img src="{{$user->photo ? $user->photo->file : '/images/placeholder.jpg'}}" class="img-responsive img-rounded">
        </div>

        <div class="col-sm-9">
            <h4>Name:{{$user->name}}</h4>
            <h4>E-mail:{{$user->email}}</h4>
            <h4>Role:{{$user->role->name}}</h4>
        </div>
</div>

<div class="row">
<div class="col-sm-6">
    <a href="{{route('admin.users.edit', $user->id)}}" class="btn btn-primary">Edit User</a>
</div>
    <div class="col-md-6">
    {!! Form::open(['method'=>'DELETE', 'action' => ['AdminUsersController@destroy', $user->id]]) !!} <!--An array defining the Methhod and action | Well tis is the Illuminate form collective working-->
            <div class="form-group">
                {!!Form::submit('Delete User',['class'=>'btn btn-danger'])!!}
            </div>
     {!!Form::close()!!}
    </div>
</div>

@include('Includes.formerror')

@endsection