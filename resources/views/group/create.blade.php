@extends('app')

@section('content')
    <div class="box box-solid box-primary">
        <div class="box-header">
            <h3 class="box-title">Create Group </h3>
        </div><!-- /.box-header -->
        <div class="box-body">

    {!! Form::open(['action'=>'GroupController@store']) !!}
    @include('group._form',['submitbuttontext'=>'Create Group'])

    {!! Form::close() !!}

        </div><!-- /.box-body -->
    </div><!-- /.box -->
@endsection

