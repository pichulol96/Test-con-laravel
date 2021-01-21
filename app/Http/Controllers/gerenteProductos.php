<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\producto;

class gerenteProductos extends Controller
{
    public function articulos_gerente(Request $request)

    {                    
        //$articulo= producto::all()->paginate(100);
        $articulo= producto::where('id_productos','>',0)->get();
        return view('productos_gerente',['articulos' => $articulo]);
        //return $data;
    }

    public function buscar_productos(Request $request)
    {
    	$categoria=$request->get('categoria');
    	$articulo = producto::where('id_categoria','=',$categoria)->get();
    	return view('productos_gerente',['articulos' => $articulo]);
    	 //$descripcion=$request->get('descripcion');
    	//return $articulos;
    }
}
