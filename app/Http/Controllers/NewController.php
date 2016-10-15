<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\New;
use Illuminate\Http\Request;

class NewController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$news = New::orderBy('id', 'desc')->paginate(10);

		return view('news.index', compact('news'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('news.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(Request $request)
	{
		$new = new New();

		$new->body = $request->input("body");
        $new->image = $request->input("image");

		$new->save();

		return redirect()->route('news.index')->with('message', 'Item created successfully.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$new = New::findOrFail($id);

		return view('news.show', compact('new'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$new = New::findOrFail($id);

		return view('news.edit', compact('new'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @param Request $request
	 * @return Response
	 */
	public function update(Request $request, $id)
	{
		$new = New::findOrFail($id);

		$new->body = $request->input("body");
        $new->image = $request->input("image");

		$new->save();

		return redirect()->route('news.index')->with('message', 'Item updated successfully.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$new = New::findOrFail($id);
		$new->delete();

		return redirect()->route('news.index')->with('message', 'Item deleted successfully.');
	}

}
