@extends('app')

@section('content')
<h2>Create Page </h2>
<hr/>
{!! Form::open(['action'=>'PagesController@store']) !!}
@include('page._form',['submitbuttontext'=>'Create Page'])

{!! Form::close() !!}
@endsection

