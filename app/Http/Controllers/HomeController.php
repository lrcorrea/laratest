<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
	public function index()
	{
        // Debugbar::enable();
        Asset::addVersioning();
        Asset::add('jquery', 'js/app.js');
		$title = 'Welcome';
		return view('pages.home', compact('title'));
	}
}
