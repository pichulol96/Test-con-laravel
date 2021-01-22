<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\producto;
use App\Models\zona;
use App\Models\compras;
use App\Models\detalles_compras;

use DB;

class gerenteProductos extends Controller
{
    public function articulos_gerente(Request $request)

    {                    
        //$articulo= producto::all()->paginate(100);
        $zona= zona::where('id_zona','>',0)->simplePaginate(15);
        $articulo= producto::where('id_productos','>',0)->simplePaginate(15);
        $user=session("login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d");
        
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
        $user = session('login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d');
        //return $stock;
        if ($user>2) {
          return view('productos_por_sucursar',['stock' => $stock],['zona' => $zona_consulta]); 
        }
        else if($user==2)
        {
          return view('stock_zona',['stock' => $stock],['zona' => $zona_consulta]);
        }
        
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

      public function comprar_articulos(Request $request)
    {
          //$nombre_ar;iculo=request()->except('_token');
    
      $id=$request->get('producto');
      $cantidad=$request->get('cantidad');
      $user = session('login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d');
      //$articulo= articulo::where('id','=',"$id")->get();
      $estado= compras::where('estado','=',"pendiente",'and','id_usuario','=',"$user")->get();
      $filas=count($estado);

      $existe_articulo= detalles_compras::where('id_folio_compras','=',$filas)
      ->where('id_de_articulos','=',$id)->get();
      $resultado=count($existe_articulo);
      //return response(json_encode($resultado),200)->header('content-type','text/plain');
      if($resultado>0)
      {
       return "El articulo ya existe";
      }

      else
      {



      foreach ($estado as $key => $value) 
      {
        $rows=$value['folio_compras'];
      }
    

      if($filas==0)
      {
        $articulo= compras::all();
        $rows=count($articulo)+1;
         compras::create([
          'folio_compras' => $rows,
            'estado' => "pendiente",
            'id_usuario' => $user,
            'total' => "0",
            
         ]);
      }
      
        detalles_compras::create([
            'id_folio_compras' => $rows,
            'id_de_articulos' => $id,
            'cantidad' => $cantidad,
            
      ]);
      
      return "articulo agregado";

     
      }

                 
    }
    public function recargar_articulos()
    {
      $user = session('login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d');
      $articulos_carrito=DB::select("call carrito_compras ('pendiente',$user)");
      $rows=count($articulos_carrito);
      if($rows>0)
      {
        return $rows;
      }
    }

     public function carro_compras()
    {
      //$articulos_carrito=carrito_compras::all();
      $user = session('login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d');
      $articulos_carrito=DB::select("call carrito_compras ('pendiente',$user)");
      $rows=count($articulos_carrito);
      $zona= zona::where('id_zona','>',0)->simplePaginate(15);

         //return view('productos_clientes',['articulos' => $articulo],['zona' => $zona]); 
        
      if($rows>0)
      {
        return View( 'compras',['carro'=>$articulos_carrito],['zona' => $zona]);
      }

      return view('compras',['zona' => $zona]);
      //return $articulos_carrito;
         
    }

    public function quitar_articulo(Request $request)
    {
       $id=$request->get('id');
       $eliminar=detalles_compras::where('id_de_articulos',$id)->delete();
       return "El articulo se quito del carrito";

               
         
    }

}
