<div class="row" >
    <div class="col-sm-3">
        <!--<div class='form-group'>
            {!! Form::label('select_group','Select Group:') !!}
            {!! Form::select('select_group',['1'=>'Group1','2'=>'Group2'],null,['class'=>'form-control'])  !!}
        </div>-->
        <div class='form-group'>
            {!! Form::label('select_hotel','Select hotel:') !!}
            {!! Form::select('select_hotel',$hotels,$selected_hotel,['class'=>'form-control' ,'readonly'=>'readonly'])  !!}
        </div>
    </div>

    <div class="col-sm-2">
        <div class='form-group'>
            {!! Form::label('agent_name','Agent name:') !!}
            {!! Form::text('agent_name',$group->firstname.' '.$group->lastname,['class'=>'form-control'])  !!}
        </div>
    </div>
    <div class="col-sm-2">
        <div class='form-group'>
            {!! Form::label('group_name','Group name:') !!}
            {!! Form::text('group_name',$group->username,['class'=>'form-control'])  !!}
        </div>
    </div>
    <div class="col-sm-2">
        <div class='form-group'>
            {!! Form::label('check_in','Select Check-in:') !!}
            {!! Form::text('check_in',$grouphotel->checkin_date,['class'=>'form-control ddatepicker'])  !!}
        </div>
    </div>
    <div class="col-sm-2">
        <div class='form-group'>
            {!! Form::label('check_out','Select Check-out:') !!}
            {!! Form::text('check_out',$grouphotel->checkout_date,['class'=>'form-control ddatepicker'])  !!}
        </div>
    </div>
</div>


<div class="row" >
    <div class="col-sm-12">
        <hr/> <h4>Room Allocation</h4>
    </div>
</div>

    @if(count($room_types) > 0)

        <div class="row" >
            <div class="col-sm-3">
                <div class='form-group'>
                    {!! Form::label('room_type','Room Type:',['class'=> 'label label-info']) !!}
                </div>
            </div>

            <div class="col-sm-1">
                <div class='form-group'>
                    {!! Form::label('room_allocate','Allocate:',['class'=> 'label label-info']) !!}
                </div>
            </div>
            <div class="col-sm-1">
                <div class='form-group'>
                    {!! Form::label('room_avail','Available:',['class'=> 'label label-info']) !!}
                </div>
            </div>
        </div>
<hr/>
        @foreach ($room_types as $key => $room_type)


        <div class="row" >
            <div class="col-sm-3">
                <div class='form-group'>
                    {!! Form::label('room_type'.$selected_hotel.'_'.$key,$room_type['name'])  !!}
                </div>

            </div>




            <div class="col-sm-1">

                <div class='form-group'>
                    {!! Form::text('room_allocate['.$selected_hotel.'_'.$key.']',$room_type['no_rooms'],['class'=>'form-control'])  !!}
                </div>

            </div>

            <div class="col-sm-1">

                <div class='form-group'>
                    {!! Form::text('room_avail['.$selected_hotel.'_'.$key.']',$room_type['available'],['class'=>'form-control','readonly'=>'readonly'])  !!}
                </div>

            </div>
        </div>

    @endforeach
<div class="row" >
    <div class="col-sm-2">
        <div class='form-group'>
           &nbsp;
        </div>
        <div class='form-group'>
            {!! Form::submit($submitbuttontext,['class'=>'btn btn-primary form-control']) !!}
        </div>
    </div>
    <div class="col-sm-2">
        <div class='form-group'>
           &nbsp;
        </div>
        <div class='form-group'>
            <a class="btn btn-default" type="button" href="{{ url("alloc/{$group->id}/view")}}"><< Back</a>

        </div>
    </div>
    </div>
@endif




