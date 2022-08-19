@extends('layouts.admin')


@section('content')
<h2>Media Page</h2>


<table class="table table-striped">
    <thead>
        <tr>
            <th>Id</th>
            <th>Photo</th>
            <th>Date Uploaded</th>
        </tr>
    </thead>

 <tbody>
    @if($photos){
        @foreach($photos as $photo){
    
        <tr>
            <td>{{$photo->id}}</td>
            <td><img height="50" src="{{$photo->file}}"></td>
            <td>{{$photo->created_at}}
                <td> 
                    {!! Form::open(['method'=>'DELETE', 'action' => ['AdminMediaController@destroy', $photo->id]]) !!} <!--An array defining the Methhod and action | Well tis is the Illuminate form collective working-->
                        <div class="form-group">
                            {!!Form::submit('Delete',['class'=>'btn btn-danger'])!!}
                        </div>
                    {!!Form::close()!!}
                </td>
        </tr>
        }@endforeach
    }@endif
 </tbody>
</table>
@endsection