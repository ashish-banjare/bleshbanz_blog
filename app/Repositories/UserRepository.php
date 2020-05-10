<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{

	/**
	 * Get Users Collection pagiante
	 *
     * @param  int  $nbrPages
     * @param  array  $parameters
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
	*/
	public function getAll($nbrPages, $parameters){
		return User::with('ingoing')
		->orderBy($parameters['order'], $parameters['direction'])
		->when( ($parameters['role'] != 'all'), function($query) use ($parameters) {
			$query->whereRole($parameters['role']);
		} )
		->when( $parameters['valid'], function($query){
			$query->whereValid(true);
		})
		->when( $parameters['confirmed'], function($query) {
			$query->whereConfirmed(true);
		})
		->when( $parameters['new'], function($query) {
			$query->has('ingoing');
		})
		->paginate($nbrPages);
	}
}