<?php


function delete_form($routepath,$label='Del')
{
	$form = Form::open(['method'=>'DELETE','route'=>$routepath]);
	$form.=Form::submit($label,['class'=>'btn btn-danger form-control','data-placement'=>'bottom','data-toggle'=>'confirmation']);
	$form.=Form::close();
	return $form;
}












?>