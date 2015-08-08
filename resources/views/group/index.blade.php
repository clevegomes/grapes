@extends('app')


@section('content')


        <div class="box box-solid box-primary">
            <div class="box-header">
                <h3 class="box-title">Group Listing</h3>
            </div><!-- /.box-header -->
            <div class="box-body">










    <table class="table">
        <thead>
        <tr>
            <th>No</th>
            <th>Group name</th>
            <th>Group code</th>
            <th>Company name</th>

            <th>Agent name</th>
            <th>Active region</th>
            <th>Start date</th>
            <th>End date</th>
            <th>Cutout date</th>
            <th>Status</th>
            <th>Allocation</th>
            <th>RoomingList</th>
            <th>operation</th>


        </tr>
        </thead>
        <tbody>
        @foreach($groups as $group)

            <tr>
                <td>{{$i++}}</td>
                <td>{{$group->username}}</td>
                <td>{{$group->username}}</td>
                <td>{{$group->company_name}}</td>
                <td>{{$group->firstname.' '.$group->lastname}}</td>
                <td>{{$region[$group->region]}}</td>
                <td>{{$group->gp_start_date}}</td>
                <td>{{$group->gp_end_date}}</td>
                <td>{{$group->expire_date}}</td>
                <td>{{($group->status)?'Active':'Inactive'}}</td>
                <td><a href="{{ url("alloc/{$group->id}/view")}}"  >View</a></td>
                <td><a href="{{ url("roomingList/{$group->id}/view")}}"  >Add</a></td>
                <td>
                    <a href="{{ action('GroupController@edit',[$group->id])}}"  >Edit</a>/
                    <a data-href="{{ action('GroupController@del',[$group->id])}}" data-placement="bottom" data-toggle="confirmation" class="btn" data-original-title=""   >Del</a>
                </td>

            </tr>


        @endforeach


        </tbody>
    </table>

            </div><!-- /.box-body -->
        </div><!-- /.box -->

@endsection


@section('message')

@include('flashmsg._flash1')

@endsection
