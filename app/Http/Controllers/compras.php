<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\compras;
use App\Models\detalles_compras;

class compra extends Controller
{
    public function comprar_articulos(Request $request)
    {
          //$nombre_ar;iculo=request()->except('_token');
    	return "hola";
      $id=$request->get('producto');
      $cantidad=$request->get('cantidad');
      $user = session('login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d');
      //$articulo= articulo::where('id','=',"$id")->get();
      $estado= compra::where('estado','=',"pendiente",'and','id_usuario','=',"$user")->get();
      $filas=count($estado);

      $existe_articulo= detalles_compras::where('folio_compras','=',$filas)
      ->where('id_articulos','=',$id)->get();
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
        $rows=$value['id'];
      }
    

      if($filas==0)
      {
        $articulo= compra::all();
        $rows=count($articulo)+1;
         compra::create([
        'id' => $rows,
            'estado' => "pendiente",
            'id_usuarios' => $user,
            'total' => "0",
            
         ]);
      }
      
        detalles_compras::create([
            'folio_compras' => $rows,
            'id_articulos' => $id,
            'cantidad' => $cantidad,
            
      ]);
      
      return "articulo agregado";

     
      }

      

      //return response(json_encode($rows),200)->header('content-type','text/plain');
      /*foreach($articulo as $arti)
      {
         $id=$arti['id'];
         //$cantidad=$arti['cantidad'];
         $precio=$arti['precio']; 
         $talla=$arti['talla']; 
         $imagen=$arti['img'];
         $descripcion=$arti['descripcion']; 
      }
      */
      
        //arglo de datos
      /*
         if(session('key'))
         {
             foreach (session('key') as $key => $value) 
             {
                  if($value['id']==$id)
                  {
                    return 'El producto ya existe';
                  }

             }
                    $carro = array('id' =>"$id" ,
                               'cantidad'=>"$cantidad",
                               'precio'=>"$precio",
                               'talla'=>"$talla",
                               'imagen'=>"$imagen",
                               'descripcion'=>"$descripcion"

                                );
                    $request->session()->push('key',$carro);
                    return "Articulo agregado al carrito"; 
                  
         }

         else
         {
                 $carro = array('id' =>"$id" ,
                               'cantidad'=>"$cantidad",
                               'precio'=>"$precio",
                               'talla'=>"$talla",
                               'imagen'=>"$imagen",
                               'descripcion'=>"$descripcion"

                                );
                     $request->session()->push('key',$carro);//inserta datos en la variable de session
                     //session()->forget(['key']); //elimina la variable de session
                      //  $carro=session('key');
                      return "Articulo agregado al carrito";    
           } 

           */  
                 
    }
}
