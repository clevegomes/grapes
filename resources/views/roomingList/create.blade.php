@extends('app')

@section('content')
<h2>Create Rooming List </h2>
<hr/>

{!! Form::open(['action'=>'RoomingListController@store']) !!}
@include('roomingList._form',['submitbuttontext'=>'Submit'])

{!! Form::close() !!}


@endsection

