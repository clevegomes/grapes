@extends('app')

@section('content')
<h2>Create Room Allocation </h2>
<hr/>
<div class="box box-solid box-default">
{!! Form::open(['action'=>'AllocationController@store']) !!}
@include('alloc._form',['submitbuttontext'=>'Create Allocation'])


{!! Form::close() !!}
</div>
<hr/>

@endsection

