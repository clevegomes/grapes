@extends('app')


@section('content')
    <div class="box box-solid box-primary">
        <div class="box-header">
            <h3 class="box-title">Room Allocation Listing</h3><hr/>
        </div><!-- /.box-header -->
        <div class="box-body">
      <table class="table">
        <thead>
        <tr>
            <th>#</th>
            <th>Group name</th>
            <th>Agent name</th>
            <th>Hotel name</th>

            <th>Checkin</th>
            <th>Checkout</th>
            <th>Updated</th>
            <th>operation</th>



        </tr>
        </thead>
        <tbody>
        @foreach($grouphotels as $grouph)

            <tr>
                <td>{{$count++}}</td>
                <td>{{$group->username}}</td>
                <td>{{$group->firstname.' '.$group->lastname}}</td>
                <td>{{$grouph->hotel_id['hotel_name']}}</td>
                <td>{{$grouph->checkin_date}}</td>
                <td>{{$grouph->checkout_date}}</td>
                <td>{{$grouph->updated_at}}</td>
                <td> <a href="{{ action('AllocationController@edit',[$grouph->id])}}"  >Edit</a></td>

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
