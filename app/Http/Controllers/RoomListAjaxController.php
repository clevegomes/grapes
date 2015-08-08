<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class RoomListAjaxController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
    public function index()
    {
        return "<div class='row' >
    <div class='col-sm-12'>
        <hr/> <h4>Standard Room (Adults : <span id='adultsCnt'></span>, Child: <span id=\"childCnt\"></span>)</h4>
    </div>
</div>
<div class='row' >
    <div class='col-sm-12'>
        <hr/> <h4>Adult(s) : </h4>
    </div>
</div>

<div class='row' >
    <div class='col-sm-2'>
        <div class='form-group'>
            {!! Form::label('title','Title:') !!}
        </div>
         <div class='form-group'>
             {!! Form::select('title',[1=>'Mr',2=>'Mrs'],null,['class'=>'form-control'])  !!}
        </div>

        </div>

    <div class='col-sm-2'>
        <div class='form-group'>
            {!! Form::label('first_name','First Name:') !!}
        </div>
        <div class='form-group'>
            {!! Form::text('first_name',null,['class'=>'form-control'])  !!}
        </div>

    </div>


    <div class='col-sm-2'>
        <div class='form-group'>
            {!! Form::label('last_name','Last Name:') !!}
        </div>
        <div class='form-group'>
            {!! Form::text('last_name',null,['class'=>'form-control'])  !!}
        </div>

    </div>

</div>

<div class='row' >
    <div class= \"col-sm-12 \">
        <hr/> <h4>Kid(s) : </h4>
    </div>
</div>
<div class='row' >
    <div class='col-sm-2'>
        <div class='form-group'>
            {!! Form::label('title','Title:') !!}
        </div>
        <div class='form-group'>
            {!! Form::select('title',[1=>'Mr',2=>'Mrs'],null,['class'=>'form-control'])  !!}
        </div>

    </div>

    <div class='col-sm-2'>
        <div class='form-group'>
            {!! Form::label('first_name','First Name:') !!}
        </div>
        <div class='form-group'>
            {!! Form::text('first_name',null,['class'=>'form-control'])  !!}
        </div>

    </div>


    <div class='col-sm-2'>
        <div class='form-group'>
            {!! Form::label('last_name','Last Name:') !!}
        </div>
        <div class='form-group'>
            {!! Form::text('last_name',null,['class'=>'form-control'])  !!}
        </div>

    </div>
    <div class='col-sm-2'>
        <div class='form-group'>
            {!! Form::label('dob','Date of Birth:') !!}
        </div>
        <div class='form-group'>
            {!! Form::text('dob',null,['class'=>'form-control'])  !!}
        </div>

    </div>
</div>";


    }


    /**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
