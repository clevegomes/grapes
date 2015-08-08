@extends('app')

@section('content')

<h2>Edit Page</h2>
{!! Form::model($page,['method'=>'PATCH','action'=>['PagesController@update',$page->id]]) !!}
@include('page._form',['submitbuttontext'=>'Save Changes'])
{!! Form::close() !!}

{!! delete_form(['page.destroy',$page->id]) !!}

@endsection