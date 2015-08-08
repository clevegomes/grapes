@extends('app')

@section('content')
    <h2>Group Name:Test (Test Code) </h2>
    <hr/>

    <p>
        Filter Block..<br/>

        1. Hotel drop down <br/>
        2. Room Config drop down<br/>
        3. Booking status<br/>

    </p>
    <hr/>
    <h3>Check In : 12/08/2015 Check Out : 13/08/2015 No Of Rooms:15 </h3>
    <hr/>
    <p>
        Room Details Block similar to emil format
        <br/>
        =================================================<br/>
        Room 1 Details             <input type="text" placeholder="Room confirm no" />

        <br/>
        =================================================<br/>
        Room 2 Details              <input type="text" placeholder="Room Confirm no" />

        <br/>
        =================================================<br/>

                    << < 1 2 3 4 5  > >>
    </p>

    <hr/>
<input type="button" name="update" value="UPDATE" style="float:left;" />
@endsection
