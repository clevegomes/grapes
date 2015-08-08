@extends('app')

@section('content')
<h2>Booking Summary </h2>
<hr/>
{!! Form::open(['action'=>'SummaryController@store']) !!}
@include('summary._form',['submitbuttontext'=>'Save'])

{!! Form::close() !!}
@endsection

