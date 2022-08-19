@extends('layouts.admin')



@section('content')
    <h2>Categories</h2>
    <p></p>         

    <div class="col-sm-4">
        {!! Form::open(['method'=>'POST', 'action' => 'AdminCategoriesController@store']) !!} <!--An array defining the Methhod and action | Well tis is the Illuminate form collective working-->
        {{csrf_field()}}
        <div class="form-group">
            {!!Form::label('name','Name')!!}
            {!!Form::text('name',null,['class'=>'form-control'])!!}
        </div>
   
        <div class="form-group">
            {!!Form::submit('Create Category',['class'=>'btn btn-primary'])!!}
        </div>
        
        {!!Form::close()!!}
    </div>

   <div class="col-sm-8">
        <table class="table table-striped">
        <thead>
            <tr>
            <th>#ID</th>
            <th>Name</th>
            
            </tr>
        </thead>
        <tbody>
            @if($categories){
                @foreach($categories as $category){
                    <tr>
                        <td>{{$category->id}}</td>
                        <td>{{$category->name}}</td>
                        <td><a href="{{route('admin.categories.edit',$category->id)}}">Edit</a></td>
                        <td> 
                            {!! Form::open(['method'=>'DELETE', 'action' => ['AdminCategoriesController@destroy', $category->id]]) !!} <!--An array defining the Methhod and action | Well tis is the Illuminate form collective working-->
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
   </div>
   @include('Includes.formerror')
@endsection