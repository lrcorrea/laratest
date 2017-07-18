<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Asset;

class HomeController extends Controller
{
	public function index()
	{
        // Debugbar::enable();
        // Asset::addVersioning();
        Asset::add('jquery', 'js/plugins/selecti.js');
        Asset::add('css', 'css/selecti.css');
		$title = 'Welcome';
		return view('pages.home', compact('title'));
	}
}
