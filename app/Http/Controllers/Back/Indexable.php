<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;

trait Indexable
{
	/**
	 * The PostRepository instance.
	 *  @var \App\Repository\PostRepository
	 *
	*/
	protected $repository;

	/**
	 * The table
	 *
	 * @var string
	*/
	protected $table;

	/**
	 * Display the listing of recards
	 *
	 * @param \Illuminate\Http\Request $request
	 * @return \Illuminate\Http\Response
	*/
	public function index(Request $request){
		$parameters = $this->getParameters($request);
		// Get records and generate links for pagination
		$records = $this->repository->getAll (config ("app.nbrPages.back.$this->table"), $parameters);
		$links = $records->appends($parameters)->links('back.pagination');
		echo "<pre>"; print_r($records);die;
		if( $request->ajax() ){
			return response()->json([
				'table' => view( "back.$this->table.table", [$this->table => $records] )->render(),
				'pagination' => $links->toHtml(),
			]);
		}

		return view("back.$this->table.index", [$this->table => $records, 'links'=>$links]);
	}
	/**
     * Get parameters.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
	protected function getParameters($request){
		// Default parameters
		$parameters = config("parameters.$this->table");

		// Build parameters with request
		foreach($parameters as $parameter => &$value) {
			if(isset($request->$parameter)){
				$value = $request->$parameter;
			}
		}

		return $parameters;
	}
}