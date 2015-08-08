@extends('app')

@section('content')
<h2>Container List </h2>



    <div class="row">
<div class="col-md-1">No</div>
<div class="col-md-1">Title</div>
<div class="col-md-1">Description</div>
<div class="col-md-1">Status</div>
<div class="col-md-2">Action</div>
</div>

@foreach($containers as $container)

<div class="row">

<div class="col-md-1">{{$container->id}}</div>
<div class="col-md-1">{{$container->title}}</div>
<div class="col-md-1">{{$container->description}}</div>
<div class="col-md-1">{{$container->active}}</div>
<div class="col-md-2">
    <a href="{{action('ContainerController@edit',$container->id)}}">Edit</a>/
    <a data-href="{{ action('ContainerController@del',[$container->id])}}" data-placement="bottom" data-toggle="confirmation" class="btn" data-original-title=""   >Del</a>

</div>

</div>


@endforeach

@endsection
