@extends('app')

@section('content')
    {!! Form::open(['action'=>'ContainerController@store'])  !!}

    @include('container._form',['submitvariable'=>'Save'])

    {!! Form::close() !!}

@endsection

