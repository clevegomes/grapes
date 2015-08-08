<div class='row' >
    <div class='col-sm-12'>
        <hr/><h3>Room Details:</h3><br/>
        <h4>Total Room Rate :{{ $totalRoomPrice }}</h4> <br/>
    </div>
    <?php if(count($spl_array)>0){ ?>
</div>
<div class='row' >
    <div class='col-sm-12'>
    <div class='form-group'>
        {!! Form::label('specialPromo','Select SpecialPromotion:') !!}
        {!! Form::select('specialPromo',$spl_array,null,['class'=>'form-control','style'=>'width:auto;'])  !!}
        <div style="display:none">
            {!! Form::hidden('room_config_id',$room_config_id,['class'=>'form-control'])  !!}
            {!! Form::hidden('group_id',$groupId,['class'=>'form-control'])  !!}
        </div>
    </div>
</div>
    <?php } ?>


<?php

for($n=1;$n<=$no_room;$n++){
?>
    <div class='row' >
        <div class='col-sm-12'>
            <hr/> <h4>{{ $room_type }} ( Adult : <span class="adultsCnt"></span>, Child: <span class="childCnt"></span>)</h4>
        </div>
    </div>
    <div class='row' >
        <div class='col-sm-12'>
            <hr/> <h4>Adult(s) : </h4>
        </div>
    </div>
    <?php for($i=1;$i<=$no_adults;$i++){?>
    <div class='row' >
        <div class='col-sm-2'>
            <div class='form-group'>
                {!! Form::label('adult_title['.$n.'_'.$i.']','Title:') !!}
            </div>
            <div class='form-group'>
                {!! Form::select('adult_title['.$n.'_'.$i.']',$adult_title,null,['class'=>'form-control'])  !!}
            </div>

        </div>

        <div class='col-sm-2'>
            <div class='form-group'>
                {!! Form::label('adult_first_name['.$n.'_'.$i.']','First Name:') !!}
            </div>
            <div class='form-group'>
                {!! Form::text('adult_first_name['.$n.'_'.$i.']',null,['class'=>'form-control'])  !!}
            </div>

        </div>


        <div class='col-sm-2'>
            <div class='form-group'>
                {!! Form::label('adult_last_name['.$n.'_'.$i.']','Last Name:') !!}
            </div>
            <div class='form-group'>
                {!! Form::text('adult_last_name['.$n.'_'.$i.']',null,['class'=>'form-control'])  !!}
            </div>

        </div>

    </div>
<?php } ?>
    <div class='row' >
        <div class= 'col-sm-12'>
        <hr/> <h4>Kid(s) : </h4>
    </div>
    </div>
<?php for($j=1;$j<=$no_child;$j++){ ?>
    <div class='row' >
        <div class='col-sm-2'>
            <div class='form-group'>
                {!! Form::label('kid_title['.$n.'_'.$j.']','Title:') !!}
            </div>
            <div class='form-group'>
                {!! Form::select('kid_title['.$n.'_'.$j.']',$kid_title,null,['class'=>'form-control'])  !!}
            </div>

        </div>

        <div class='col-sm-2'>
            <div class='form-group'>
                {!! Form::label('kid_first_name['.$n.'_'.$j.']','First Name:') !!}
            </div>
            <div class='form-group'>
                {!! Form::text('kid_first_name['.$n.'_'.$j.']',null,['class'=>'form-control'])  !!}
            </div>

        </div>


        <div class='col-sm-2'>
            <div class='form-group'>
                {!! Form::label('kid_last_name['.$n.'_'.$j.']','Last Name:') !!}
            </div>
            <div class='form-group'>
                {!! Form::text('kid_last_name['.$n.'_'.$j.']',null,['class'=>'form-control'])  !!}
            </div>

        </div>
        <div class='col-sm-2'>
            <div class='form-group'>
                {!! Form::label('dob['.$n.'_'.$j.']','Date of Birth:') !!}
            </div>
            <div class='form-group'>
                {!! Form::text('dob['.$n.'_'.$j.']',null,['class'=>'form-control','id'=>'dob_'.$n.'_'.$j])  !!}
            </div>

        </div>
    </div>
<?php } ?>
<div class="row" >
    <hr/>
    <div class="col-sm-3">
        <div class='form-group'>
            {!! Form::label('special_request['.$n.']','Special Request:') !!}
        </div>
        <div class='form-group'>
            {!! Form::textarea('special_request['.$n.']',null,['class'=>'form-control','size' => '5x5'])  !!}
        </div>

    </div>

</div>
<?php }?>