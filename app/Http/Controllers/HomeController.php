<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\zona;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $articulo= zona::where('id_zona','>',0)->simplePaginate(15);
        return view('welcome',['zona' => $articulo]);
        //return View('welcome');
    }


    

   
}
