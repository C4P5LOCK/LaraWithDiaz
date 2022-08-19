@extends('layouts.admin')

@section('styles')
<link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
@stop

@section('content')
<h2>Upload Media</h2>

    {!! Form::open(['method'=>'POST', 'action' => 'AdminMediaController@store','class' =>'dropzone']) !!} <!--Drop Zone Library-->
    {{csrf_field()}}

    {{!! Form::close()}}



@endsection

@section('scripts')
<script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
@stop