<div class="row" >
    <div class="col-sm-3">
      <p>Click me</p>
        <div class='form-group'>

            {!! Form::label('hotel_id',"Select hotel:") !!}
            {!! Form::select('hotel_id',$hotel,null, ['class'=>'form-control'])  !!}

        </div>

    </div>
    <div class="col-sm-3" >
        <div class='form-group'>
            {!! Form::label('room_config','Select Room Configuration:') !!}
            <div id="roomConfigDiv">
                {!! Form::select("room_config",["Grand Room@31 - 1 - 1"=> "Grand Room - Single - Bed and Breakfast","Grand Room@31 - 2 - 1"=> "Grand Room - Double - Bed and Breakfast","Creek Room@127 - 1 - 1"=> "Creek Room - Single - Bed and Breakfast","Creek Room@127 - 2 - 1"=> "Creek Room - Double - Bed and Breakfast","Club Creek@128 - 1 - 1"=> "Club Creek - Single - Bed and Breakfast","Club Creek@128 - 2 - 1"=> "Club Creek - Double - Bed and Breakfast","Grand Deluxe@129 - 1 - 1"=> "Grand Deluxe - Single - Bed and Breakfast","Grand Deluxe@129 - 2 - 1"=> "Grand Deluxe - Double - Bed and Breakfast","Grand Suite@130 - 1 - 1"=> "Grand Suite - Single - Bed and Breakfast","Grand Suite@130 - 2 - 1"=> "Grand Suite - Double - Bed and Breakfast","default@919 - 20 - 16"=> "default - - Default Meal Plan"],null,["class"=>"form-control"]) !!}
            </div>

        </div>
    </div>
    <div class="col-sm-3" >
<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <strong><span id="paxInfo"></span></strong>

    </div>

</div>
<div class="row" >
    <div class="col-sm-2">
        <!--<div class='form-group'>
            {!! Form::label('select_group','Select Group:') !!}
            {!! Form::select('select_group',['1'=>'Group1','2'=>'Group2'],null,['class'=>'form-control'])  !!}
        </div>-->
        <div class='form-group' >
            {!! Form::label('no_of_rooms','No of rooms:') !!}
            {!! Form::text('no_of_rooms',null,['class'=>'form-control','style'=>'width:60px'])  !!}
        </div>
    </div>
    <div class="col-sm-2">
        <div class='form-group' >
            {!! Form::label('no_adults','No of adults:') !!}
            {!! Form::text('no_adults',null,['class'=>'form-control','style'=>'width:60px'])  !!}
        </div>
    </div>
    <div class="col-sm-2">
        <div class='form-group' >
            {!! Form::label('no_child','No of Child:') !!}
            {!! Form::text('no_child',null,['class'=>'form-control','style'=>'width:60px'])  !!}
        </div>
    </div>
    <div class="col-sm-2">
        <div class='form-group' id="search_button">
            {!! Form::label('Search','&nbsp;') !!}
            {!! Form::button('Search',['class'=>'btn btn-primary form-control']) !!}
        </div>
    </div>
</div>

<div id="paxDetails">

</div>
<div class="row" >
    <div class="col-sm-12">
        <hr/> <h4>Flight Details</h4>
    </div>
</div>
<div class="row" >
    <div class="col-sm-2">
        <div class='form-group'>
            {!! Form::label('pickup_from','Arrival Airport:') !!}
        </div>
        <div class='form-group'>
            {!! Form::select('pickup_from',['dubai'=>'Dubai Airport','sharjah'=>'Sharjah Airport','abu dhabi'=>'Abhu Dhabi Airport'],['class'=>'form-control'])  !!}
        </div>

    </div>
    <div class="col-sm-2">
        <div class='form-group'>
            {!! Form::label('arr_flight_no','Arrival Flight No:') !!}
        </div>
        <div class='form-group'>
            {!! Form::text('arr_flight_no',null,['class'=>'form-control'])  !!}
        </div>

    </div>

    <div class="col-sm-2">
        <div class='form-group'>
            {!! Form::label('arrival_dt','Arrival Flight Date:') !!}
        </div>
        <div class='form-group'>
            {!! Form::text('arrival_dt','',array('id' => 'arr_datepicker'))  !!}
        </div>

    </div>


    <div class="col-sm-2">
        <div class='form-group'>
            {!! Form::label('arr_hr','Arrival Time (Hr):') !!}
        </div>
        <div class='form-group'>
            {!! Form::select('arr_hr',$hr,['class'=>'form-control'])  !!}
        </div>
    </div>

    <div class="col-sm-2">
        <div class='form-group'>
            {!! Form::label('arr_min','Arrival Time (Min):') !!}
        </div>
        <div class='form-group'>
            {!! Form::select('arr_min',$min,['class'=>'form-control'])  !!}
        </div>

    </div>
</div>
<div class="row" >
    <div class="col-sm-2">
        <div class='form-group'>
            {!! Form::label('dropoff_to','Departure Airport:') !!}
        </div>
        <div class='form-group'>
            {!! Form::select('dropoff_to',['dubai'=>'Dubai Airport','sharjah'=>'Sharjah Airport','abu dhabi'=>'Abhu Dhabi Airport'],['class'=>'form-control'])  !!}
        </div>

    </div>
    <div class="col-sm-2">
        <div class='form-group'>
            {!! Form::label('dept_flight_no','Departure Flight No:') !!}
        </div>
        <div class='form-group'>
            {!! Form::text('dept_flight_no',null,['class'=>'form-control'])  !!}
        </div>

    </div>

    <div class="col-sm-2">
        <div class='form-group'>
            {!! Form::label('departure_dt','Departure Flight Date:') !!}
        </div>
        <div class='form-group'>
            {!! Form::text('departure_dt','',array('id' => 'dep_datepicker'))  !!}
        </div>

    </div>


    <div class="col-sm-2">
        <div class='form-group'>
            {!! Form::label('dept_hr','Departure Time (Hr):') !!}
        </div>
        <div class='form-group'>

            {!! Form::select('dept_hr',$hr,['class'=>'form-control'])  !!}
        </div>
    </div>

    <div class="col-sm-2">
        <div class='form-group'>
            {!! Form::label('dept_min','Departure Time (Min):') !!}
        </div>
        <div class='form-group'>
            {!! Form::select('dept_min',$min,['class'=>'form-control'])  !!}
        </div>

    </div>
</div>

<div class="row" >
    <hr/>
    <div class="col-sm-3">
        <div class='form-group'>
            {!! Form::label('remarks','Remarks:') !!}
        </div>
        <div class='form-group'>
            {!! Form::textarea('remarks',null,['class'=>'form-control','size' => '5x5'])  !!}
        </div>

    </div>

</div>
<div class="row">

    <div class="col-sm-2">
        <div class='form-group'>
            {!! Form::submit($submitbuttontext,['class'=>'btn btn-primary form-control']) !!}
        </div>
    </div>
</div>
@if($errors->any())

    <ul class="alert alert-danger alert-dismissable">

        @foreach($errors->all() as $error)
            <li>{{$error}}</li>

        @endforeach
    </ul>
@endif

