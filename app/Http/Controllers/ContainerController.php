<?php namespace App\Http\Controllers;

use App\Container;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Page;
use Request;

class ContainerController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{

		$containers = Container::where('deleted_at','=',null)->get();
		return view('container.index',compact('containers'));

	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//$pageList = Page::lists('title','id');
		$pageList = Page::where('active',1)->where('deleted_at','=',null)->get()->lists('title','id');

		return view('container.create',compact('pageList'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Requests\CreateContainerRequest $request)
	{

		$cont = new Container();
//		$cont->create($request->all())->page()->sync($request->pages);
		$cont->create($request->all());
		if(isset($request->pages) && $request->pages != null)
		{
			$cont->page()->sync($request->pages);
		}
//		$cont = Container::create($request->all());
//		$cont->page->sync($request->page);

		return redirect('cont');

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
	public function edit(Container $container)
	{

			$pageList = Page::where('active',1)->where('deleted_at','=',null)->get()->lists('title','id');
			return view('container.edit',compact('container','pageList'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Container $cont,Requests\CreateContainerRequest $request)
	{
			$cont->update($request->all());
		    $cont->page()->sync($request->pages);
			return redirect('cont');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(Container $container)
	{

		$container->delete();
		return redirect('cont');
	}


	public function del(Container $container)
	{


		$container->delete();
		return redirect('cont');
	}



}
