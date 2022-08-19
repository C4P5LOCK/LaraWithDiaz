@extends('layouts.admin')


@section('content')

    <div class="container">

      @if(Session::has('deleted'))
        <p class="bg-danger">{{session('deleted')}}
      @endif

        <h2>Users</h2>
        <p></p>            
        <table class="table table-striped">
          <thead>
            <tr>
              <th>#ID</th>
              <th>Photo</th>
              <th>Name</th>
              <th>Email</th>
              
              <th>Role</th>
              <th>Status</th>
              <!--<th>Created at</th>
              <th>Updated at </th>-->
              <th></th>
              <th></th>
            </tr>
          </thead>
          <tbody>

            @if($users){
                @foreach ($users as $user){
                    <tr>
                        <td>{{$user->id}}</td>
                        <td><img height="100" src="{{$user->photo ? $user->photo->file : '/images/placeholder.jpg'}}" alt=""></td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        
                        <td>{{$user->role->name}}</td>
                        <td>{{$user->is_active ==1 ? 'Active' : 'Not Active'}}
                        <!--<td>//$user->created_at->diffForHumans()}}</td>
                        <td>//$user->updated_at->diffForHumans()}}</td>-->
                        <td><a href="{{route('admin.users.show',$user->id)}}">View</td>
                        <td><a href="{{route('admin.users.edit', $user->id)}}">Edit</td>
                      </tr>
                }
                @endforeach
            }
            @endif
            
          </tbody>
        </table>
      </div>


@endsection