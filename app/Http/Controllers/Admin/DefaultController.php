<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Cache;

class DefaultController extends Controller
{

	public function error(){

		return view('admin.error')->with('meta_title','Error !');
	}



}
