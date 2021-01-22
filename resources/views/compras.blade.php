@extends('welcome')
@section('contenido')
<div id="respuesta">
@isset($carro)
@php
$total=0;
@endphp
<br>
<div id="container" class="container">
<table id="tabla-articulos" style="margin-top: 10px;" class="table  table-responsive-sm table-striped">
  <thead>
    <tr>
      <th scope="col">Imagen</th>
      <th scope="col">Descripcion</th>
      <th scope="col">Cantidad</th>
      <th scope="col">Precio</th>
      <th scope="col">Subtotal</th>
      <th scope="col">Opcion</th>
    </tr>
  </thead>
  <tbody>
    <tr>
    	@foreach($carro as $compra)
      <td><img src="img/{{ $compra->img}} " width="100"></td>
      <td>{{ $compra->descripcion}}</td>
      <td>{{ $compra->cantidad}}</td>
      <td>{{ $compra->precio}}</td>
      <td>{{ $subtotal=$compra->precio*$compra->cantidad}}</td>

      @php
       $total=$total+$subtotal;
      @endphp
      
      <td><button articulo="{{ $compra->id_productos }}" class="btn-sm btn btn-danger quitar">Quitar</button></td>

    </tr>
    @endforeach
    <form method="post" url="">
      @csrf
       {{ "TOTAL:  " }}
      <input type="text" name="total" disabled="" value="$ {{ $total }}">
      <button style="" onclick="return confirm('Esta seguro que desea comprar estos articulos')" class="btn-sm btn btn-success">Comprar</button>
    </form>
    
  </tbody>
</table>
</div>
  
</div>


@endisset
@empty($carro)
<center><h2>No tienen ningun articulo agregado a lista de compras</h2></center>
@endempty
@endsection

@section('script')
<script type="text/javascript">
$(document).ready(function()
{
       $("#titulo").hide();
     	$("a").removeClass("focus");
       $("#compras").addClass("focus");  
       $(".quitar").click(function () {
         var id=$(this).attr('articulo');
        
         //alert(id);
         $.ajax({
          url:'quitar_carro',
          type:'post',
          data:{id:id,_token:$('input[name="_token"]').val()},

         }).done(function(res){
          alert (res);
          window.location.reload();
          
          
          
         })
       })
});

</script>       

@endsection