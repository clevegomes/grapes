@extends('app')

@section('content')

    <div class="box box-solid box-primary">
        <div class="box-header">
            <h3 class="box-title"> Room Allocation </h3>
        </div><!-- /.box-header -->
        <div class="box-body">

    {!! Form::open(['method'=>'PATCH','action'=>['AllocationController@update',$selected_hotel]]) !!}
    @include('alloc._form',['submitbuttontext'=>'Save'])
    {!! Form::close() !!}
    <hr/>
        </div><!-- /.box-body -->
    </div><!-- /.box -->
@endsection

@section('message')

    @if($errors->any())

        <ul class="alert alert-danger alert-dismissable">

            @foreach($errors->all() as $error)
                <li>{{$error}}</li>

            @endforeach
        </ul>
    @endif
    @endsection