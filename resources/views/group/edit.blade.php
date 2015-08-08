@extends('app')

@section('content')
    <div class="box box-solid box-primary">
        <div class="box-header">
            <h3 class="box-title">Room allocation chart</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
{!! Form::model($group,['method'=>'PATCH','action'=>['GroupController@update',$group->id]]) !!}
@include('group._form',['submitbuttontext'=>'Update Changes'])
{!! Form::close() !!}

{!! delete_form(['group.destroy',$group->id]) !!}
        </div><!-- /.box-body -->
    </div><!-- /.box -->
@endsection