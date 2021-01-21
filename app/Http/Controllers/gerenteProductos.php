<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\producto;
use App\Models\zona;
use DB;

class gerenteProductos extends Controller
{
    public function articulos_gerente(Request $request)

    {                    
        //$articulo= producto::all()->paginate(100);
        $zona= zona::where('id_zona','>',0)->simplePaginate(15);
        $articulo= producto::where('id_productos','>',0)->simplePaginate(15);
        return view('productos_gerente',['articulos' => $articulo],['zona' => $zona]);
        //return $data;
    }

    public function buscar_productos(Request $request)
    {
    	$categoria=$request->get('categoria');
    	$articulo = producto::where('id_categoria','=',$categoria)->simplePaginate(15);
        $zona= zona::where('id_zona','>',0)->simplePaginate(15);
    	return view('productos_gerente',['articulos' => $articulo],['zona' => $zona]);
    	 //$descripcion=$request->get('descripcion');
    	//return $articulos;
    }

    public function productos_zona(Request $request)
    {
        //$zona=request()->except('_token');

        $articulo= zona::where('id_zona','>',0);
        $zona=$request->get("zona");
        $zona_consulta= zona::where('id_zona','>',0)->simplePaginate(15);
        $stock=DB::select("call stock_zona ('$zona')");
        //return $stock;
        return view('stock_zona',['stock' => $stock],['zona' => $zona_consulta]);
    }

    
    public function registro_productos(Request $request)
    {
    	$nombre=$request->get('nombre');
    	$descripcion=$request->get('descripcion');
    	$precio=$request->get('precio');
    	$categoria=$request->get('categoria2');

          $imagen= $request->file('img');
	      $nombre_imagen= time().'.'.$imagen->getClientOriginalExtension();
	      $destino= public_path('img');
	      $request->img->move($destino,$nombre_imagen);

       /*producto::create([
       	    'nombre_producto' => $nombre,
            'descripcion' => $descripcion,
            'precio' => $precio,
            'img' => $nombre_imagen,
            'id_categoria' =>$categoria,
        ]);*/


       $stock=DB::select("call agregar_pro('$nombre','$descripcion',$precio,$categoria,'$nombre_imagen')");

         return  redirect()->route('mostrar_datos');
    }


    public function actualizar_productos(Request $request)
    {
        $nombre=$request->get('nombre');
        $descripcion=$request->get('descripcion');
        $precio=$request->get('precio');
        $id_productos=$request->get('id');
        /*$project->update([
            'nombre_producto' => $nombre,
            'descripcion'=>$descripcion,
            'precio'=>$precio,
        ]);*/

        $lol=producto::where("id_productos",$id_productos)
      ->update(['nombre_producto'=>$nombre,'descripcion'=>$descripcion,'precio'=>$precio]);
        
        return  redirect()->route('mostrar_datos');
        //return $zona;
    }
}
