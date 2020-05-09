<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\PannelAdmin;

class AdminController extends Controller
{
    public function index(){
    	$panels = [];
    	
    	foreach( config('pannels') as $pannel ){

    		$panelAdmin = new PannelAdmin($pannel);
    		
    		if($panelAdmin->nbr){
    			$pannels[] = $panelAdmin;
    		}
    	}
    	return view('back.index', compact('pannels'));
    }
}
