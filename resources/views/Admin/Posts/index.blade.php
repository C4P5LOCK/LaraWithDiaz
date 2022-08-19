@extends('layouts.admin')



@section('content')
    <h2>Posts</h2>
    <p></p>         
    @if(Session::has('deleted'))
    <p class="bg-danger">{{session('deleted')}}
  @endif   
    <table class="table table-striped">
      <thead>
        <tr>
          <th>#ID</th>
          <th>Author</th>
          <th>Category</th>
          <th>Photo</th>
          <th>Title</th>
          <th>Body</th>
          {{-- <th>Date Created</th>
          <th>Date Modified</th> --}}
        </tr>
      </thead>
      <tbody>

        @if($posts){
            @foreach ($posts as $post){
                <tr>
                    <td>{{$post->id}}</td>
                    <td>{{$post->user->name}}</td>
                    <td>{{$post->category ? $post->category->name : 'Uncategorized'}}</td>
                    <td>{{$post->photo_id}}</td>
                    <td>{{$post->title}}</td>
                    <td>{{$post->body}}</td>
                    {{-- <td>{{$post->created_at}}</td>
                    <td>{{$post->updated_at}}</td> --}}
                    <td><a href="{{route('admin.posts.show',$post->id)}}">View</td>
                      <td><a href="{{route('admin.comments.show',$post->id)}}">Comments</td>
                      <td><a href="{{route('home.post',$post->id)}}">View on Blog</td>
                    <td><a href="{{route('admin.posts.edit', $post->id)}}">Edit</td>

                  </tr>
            }
            @endforeach
        }@endif
        

    </tbody>
    </table>
    <div class="row">
        <div class="col-sm-6 col-sm-offset-5">
            {{$posts->render()}}
        </div>
    </div>
@endsection()