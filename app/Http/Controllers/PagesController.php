<?php namespace App\Http\Controllers;

use App\Container;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Page;
use Carbon\Carbon;
use Storage;
use Illuminate\Html\FormFacade;
use Illuminate\Html\HtmlFacade;
//use Illuminate\Http\Request;
use Request;
use Symfony\Component\Finder\Shell\Command;


class PagesController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function test2()
	{
		$disk = Storage::disk('local')->put('file.doc', "this is a test");

		$dir = "";
	}
	public function index()
	{
		$user = \Auth::user();
		if(is_null($user))
		{
			
			redirect('auth/login');
		}

		$pages = Page::where('deleted_at','=',null)->get();


		return view('page.index',compact('pages'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$pages = array();
//		$contList = \App\Container::lists('title','id');
		$contList = \App\Container::where('active',1)->where('deleted_at','=',null)->get()->lists('title','id');
		return view('page.create',compact('contList'));

	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Requests\CreatePageRequest $request)
	{

		$pages = new Page();
//		$pages->create($request->all())->container()->sync($request->input('pages'));
		$pages->create($request->all());
		if(isset($request->container_id) && $request->container_id != null)
		{
			$pages->container()->sync($request->container_id);


		}
		\Session::flash('flashmsg','Page created successfully');
		\Session::flash('flashstatus','success');
		return redirect('page');
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
	public function edit(Page $page)
	{

		$contList = Container::lists('title','id');
		return view('page.edit',compact('page','contList'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Page $page, Requests\CreatePageRequest $request)
	{

		$page->update($request->all());
		if(isset($request->container_id) && $request->container_id != null)
		{
			$page->container()->sync($request->input('container_id'));


		}

		\Session::flash('flashmsg','Page updated successfully');
		\Session::flash('flashstatus','success');
		return redirect('page');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(Page $page)
	{
		//$page->delete();
		$page->deleted_at = Carbon::now();
		$page->save();
		\Session::flash('flashmsg','Page deleted successfully');
		\Session::flash('flashstatus','success');
		return redirect('page');
	}



	public function del($page)
	{
		//$page->delete();

		$page->deleted_at = Carbon::now();
		$page->save();
		\Session::flash('flashmsg','Page deleted successfully');
		\Session::flash('flashstatus','success');
		return redirect('page');
	}

}
