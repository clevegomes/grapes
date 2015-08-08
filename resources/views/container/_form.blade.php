<div class="form-group">
{!! Form::label('title','Title:') !!}
{!! Form::text('title',null,['class'=>'form-control']) !!}
</div>
<div class="form-group">
{!! Form::label('description','Description:') !!}
{!! Form::text('description',null,['class'=>'form-control']) !!}
</div>
<div class="form-group">
{!! Form::label('active','Active:') !!}
{!! Form::select('active',[1=>'Active',0=>'InActive'],1,['class'=>'form-control']) !!}
</div>

<div class="form-group">
{!! Form::label('pages','Pages') !!}
{!! Form::select('pages[]',$pageList,null,['class'=>'form-control','multiple']) !!}
</div>
<div class="form-group">
{!! Form::submit($submitvariable,['class'=>'btn btn-primary form-control']) !!}
</div>
@if($errors->any())
<ul class="alert alert-danger alert-dismissable">
    @foreach($errors->all() as $error)
        <li>{{$error}}</li>
    @endforeach
</ul>
@endif

