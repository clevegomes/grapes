<div class="row">
    <div class="col-sm-6" >
<div class='form-group'>
    {!! Form::label('group_name','Group Name:') !!}
    {!! Form::text('group_name',$group->username,['class'=>'form-control'])  !!}
</div>

<div class='form-group'>
    {!! Form::label('group_code','Group Code:') !!}
    {!! Form::text('group_code',$group->username,['class'=>'form-control'])  !!}
</div>

<div class='form-group'>
    {!! Form::label('company_name','Company Name:') !!}
    {!! Form::text('company_name',$group->company_name,['class'=>'form-control'])  !!}
</div>

<div class='form-group'>
            {!! Form::label('agent_fname','Agent First Name:') !!}
            {!! Form::text('agent_fname',$group->firstname,['class'=>'form-control'])  !!}
</div>
        <div class='form-group'>
            {!! Form::label('agent_lname','Agent Last Name:') !!}
            {!! Form::text('agent_lname',$group->lastname,['class'=>'form-control'])  !!}
</div>

        <div class='form-group'>
            {!! Form::label('agent_address','Agent Address:') !!}
            {!! Form::textarea('agent_address',$group->address,['class'=>'form-control'])  !!}
</div>

        <div class='form-group'>
            {!! Form::label('agent_city','Agent City:') !!}
            {!! Form::text('agent_city',$group->city,['class'=>'form-control'])  !!}
        </div>

        <div class='form-group'>
            {!! Form::label('country','Agent Country:') !!}
            {!! Form::select('country',$country,$group->country,['class'=>'form-control'])  !!}
        </div>


        <div class='form-group'>
            {!! Form::label('contact_no','Contact No:') !!}
            {!! Form::text('contact_no',$group->phone,['class'=>'form-control'])  !!}
        </div>



    </div>
    <div class="col-sm-6" >


        <div class='form-group'>
            {!! Form::label('email_id','Email Id:') !!}
            {!! Form::text('email_id',$group->email,['class'=>'form-control'])  !!}
        </div>

        <div class='form-group'>
            {!! Form::label('region','Region') !!}
            {!! Form::select('region',$region,$group->region, ['class'=>'form-control'])  !!}
        </div>

        <div class='form-group'>
            {!! Form::label('hotels','Hotels') !!}
            {!! Form::select('hotels[]',$hotel,$gp_hotel, ['class'=>'form-control','multiple'=>'multiple','style'=>'height:200px;'])  !!}
        </div>


<div class='form-group'>
    {!! Form::label('date_start','Date start:') !!}
    {!! Form::text('date_start',$group->gp_start_date,['class'=>'form-control ddatepicker  '])  !!}

</div>
        <div class='form-group'>
    {!! Form::label('date_end','Date end:') !!}
    {!! Form::text('date_end',$group->gp_end_date,['class'=>'form-control ddatepicker  ' ])  !!}
</div>
        <div class='form-group'>
    {!! Form::label('date_cutout','Date Cutout:') !!}
    {!! Form::text('date_cutout',$group->expire_date,['class'=>'form-control ddatepicker  ' ])  !!}
</div>




<div class='form-group'>
    {!! Form::label('no_rooms','No Rooms:') !!}
    {!! Form::text('no_rooms',$group->no_rooms,['class'=>'form-control'])  !!}
 </div>

        <div class='form-group'>
    {!! Form::label('active','Active:') !!}
    {!! Form::select('active',[1=>'Active',0=>'InActive'],$group->status,['class'=>'form-control'])  !!}
 </div>




</div>



</div>


<div class="row">

    <div class="col-sm-12">
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

