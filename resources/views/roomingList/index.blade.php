@extends('app')


@section('content')




        <div class="row"><h5>
            <div class="col-md-1">No</div>
            <div class="col-md-1">Title</div>
            <div class="col-md-1">Page Slug</div>
            <div class="col-md-2">Created Date</div>
            <div class="col-md-2">Updated Date</div>
            <div class="col-md-1">Status</div>
            <div class="col-md-2">operation</div></h5>
        </div>
@foreach($pages as $page)

            <div class="row">
                <div class="col-md-1">{{$page->id}}</div>
                <div class="col-md-1">{{$page->title}}</div>
                <div class="col-md-1">{{$page->slug}}</div>
                <div class="col-md-2">{{$page->created_at}}</div>
                <div class="col-md-2">{{$page->created_at}}</div>
                <div class="col-md-1">{{$page->active}}</div>
                <div class="col-md-2">
                    <a href="{{ action('PagesController@edit',[$page->id])}}"  >Edit</a>/
                    <a data-href="{{ action('PagesController@del',[$page->id])}}" data-placement="bottom" data-toggle="confirmation" class="btn" data-original-title=""   >Del</a>
                </div>
            </div>

        @endforeach
@endsection


@section('message')

@include('flashmsg._flash1')

@endsection
