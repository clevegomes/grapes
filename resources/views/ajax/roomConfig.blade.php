<?php for($n=1;$n<=$no_room;$n++){?>
    <div class='row' >
        <div class='col-sm-12'>
            <hr/> <h4>{{ $room_type }} (Adults : <span class="adultsCnt"></span>, Child: <span class="childCnt"></span>)</h4>
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
                {!! Form::label('adult_title_'.$n.'_'.$i,'Title:') !!}
            </div>
            <div class='form-group'>
                {!! Form::select('adult_title_'.$n.'_'.$i,[1=>'Mr',2=>'Mrs'],null,['class'=>'form-control'])  !!}
            </div>

        </div>

        <div class='col-sm-2'>
            <div class='form-group'>
                {!! Form::label('adult_first_name_'.$n.'_'.$i,'First Name:') !!}
            </div>
            <div class='form-group'>
                {!! Form::text('adult_first_name_'.$n.'_'.$i,null,['class'=>'form-control'])  !!}
            </div>

        </div>


        <div class='col-sm-2'>
            <div class='form-group'>
                {!! Form::label('adult_last_name_'.$n.'_'.$i,'Last Name:') !!}
            </div>
            <div class='form-group'>
                {!! Form::text('adult_last_name_'.$n.'_'.$i,null,['class'=>'form-control'])  !!}
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
                {!! Form::label('kid_title_'.$n.'_'.$j,'Title:') !!}
            </div>
            <div class='form-group'>
                {!! Form::select('kid_title_'.$n.'_'.$j,[1=>'Master'],null,['class'=>'form-control'])  !!}
            </div>

        </div>

        <div class='col-sm-2'>
            <div class='form-group'>
                {!! Form::label('kid_first_name_'.$n.'_'.$j,'First Name:') !!}
            </div>
            <div class='form-group'>
                {!! Form::text('kid_first_name_'.$n.'_'.$j,null,['class'=>'form-control'])  !!}
            </div>

        </div>


        <div class='col-sm-2'>
            <div class='form-group'>
                {!! Form::label('kid_last_name_'.$n.'_'.$j,'Last Name:') !!}
            </div>
            <div class='form-group'>
                {!! Form::text('kid_last_name_'.$n.'_'.$j,null,['class'=>'form-control'])  !!}
            </div>

        </div>
        <div class='col-sm-2'>
            <div class='form-group'>
                {!! Form::label('dob_'.$n.'_'.$j,'Date of Birth:') !!}
            </div>
            <div class='form-group'>
                {!! Form::text('dob_'.$n.'_'.$j,null,['class'=>'form-control'])  !!}
            </div>

        </div>
    </div>
<?php } ?>
<div class="row" >
    <hr/>
    <div class="col-sm-3">
        <div class='form-group'>
            {!! Form::label('special_request_'.$n,'Special Request:') !!}
        </div>
        <div class='form-group'>
            {!! Form::textarea('special_request_'.$n,null,['class'=>'form-control','size' => '5x5'])  !!}
        </div>

    </div>

</div>
<?php }?>