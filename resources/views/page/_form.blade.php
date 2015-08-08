<div class='form-group'>
{!! Form::label('title','Page Title') !!}
{!! Form::text('title',null,['class'=>'form-control'])  !!}
</div>


<div class='form-group'>
{!! Form::label('nav_title','Nav Title') !!}
{!! Form::text('nav_title',null,['class'=>'form-control'])  !!}
</div>

<div class='form-group'>
{!! Form::label('slug','Page Slug') !!}
{!! Form::text('slug',null,['class'=>'form-control'])  !!}
</div>



<div class='form-group'>
{!! Form::label('body','Page Content') !!}
{!! Form::textarea('body',null,['class'=>'form-control']) !!}
</div>

<div class='form-group'>
{!! Form::label('active','Page Status') !!}
{!! Form::select('active',[1=>'Active',0=>'Inactive'],null,['class'=>'form-control']) !!}
</div>

<div class='form-group'>
{!! Form::label('container_id','Container') !!}
{!! Form::select('container_id[]',$contList,null,['class'=>'form-control','multiple']) !!}
</div>


<div class='form-group'>
{!! Form::submit($submitbuttontext,['class'=>'btn btn-primary form-control']) !!}
</div>

@if($errors->any())

    <ul class="alert alert-danger alert-dismissable">

   @foreach($errors->all() as $error)
       <li>{{$error}}</li>

   @endforeach
    </ul>
        @endif


{!! Html::script('packages/ckeditor/ckeditor.js') !!}


<script type="text/javascript">
    var editor =CKEDITOR.replace( 'body',
            {
                filebrowserBrowseUrl : "{{asset('/packages/elfinder/elfinder.html')}}",
                filebrowserImageBrowseUrl : "{{asset('/packages/elfinder/elfinder.html')}}"
            }
    );
</script>