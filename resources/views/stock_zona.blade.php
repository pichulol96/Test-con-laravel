@extends('welcome')

@section('contenido')
 @isset($stock)
<div class="container">
<table id="tabla-articulos" style="margin-top: 10px;" class="table  table-responsive-sm table-striped">
  <thead>
    <tr>
      <th scope="col">Imagen</th>
      <th scope="col">Nombre</th>
      <th scope="col">Descripcion</th>
      <th scope="col">Precio</th>
      <th scope="col">Stock</th>
    </tr>
  </thead>
  <tbody>
    <tr>
    	@foreach($stock as $stocks)
      <td><img src="img/{{ $stocks->img }}" width="100"></td>
      <td>{{$stocks->nombre_producto}}</td>
      <td>{{ $stocks->descripcion}}</td>
      <td>{{ $stocks->precio}}</td>
      <td>{{ $stocks->stock}}</td>
    
      

    </tr>
    @endforeach
    
      <br>
      <div style="display: flex; margin-left: 10px; padding: 20px;">
      	<center>
         <h5>{{"Stock de frutas y verduras " ." Del ".$stocks->nombre_zona}} </h5>
      
        </center>
          
      </div>


    
    
  </tbody>

</table>

</div>
@endisset
@endsection

@section('script')
<script type="text/javascript">
   $(document).ready(function(){

    $("a").removeClass("focus");
       $("#articulos").addClass("focus");

      $("#titulo").hide();


     

       

          });
 

  </script>
@endsection