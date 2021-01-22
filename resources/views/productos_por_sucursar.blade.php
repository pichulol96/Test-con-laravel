@extends('welcome')

@section('contenido')

@if($stock)

@foreach($stock as $stocks)

<div class="articulos">
  <center>
	<form  action="{{ url('/compras') }}" onsubmit="return comprando();" method="POST" enctype="">
		@csrf
		<img src="img/{{ $stocks->img }}" width="80">
		<h5>{{ $stocks->descripcion }}</h5>
		<h5>${{ $stocks->precio }}</h5>
		
		
    <select class="form-control" id="{{ $stocks->id_productos }}"  class="{{ $stocks->id_productos }}"  name="{{ $stocks->id_productos }}" required="">
      <option disabled selected value>Cantidad a comprar</option>
      <option value="1">1 kg</option>
      <option value="2">2 kg</option>
      <option value="3">3 kg</option>
      <option value="4">4 kg</option>
      <option value="5">5 kg</option>
      <option value="6">6 kg</option>
      <option value="7">7 kg</option>
      <option value="8">8 kg</option>
    </select>
    <br>

		<input type="text" id="id_articulo"  class="id_articulo" name="id_articulo" hidden="" value="{{ $stocks->id_productos }}">

    <input type="text" id="{{ $stocks->descripcion }}" class="id_articulo" name="precio" hidden="" value="{{ $stocks->precio }}">

   

    <input type="text" id="{{ $stocks->id_productos }}" class="id_articulo" name="descripcion" hidden="" value="{{ $stocks->descripcion }}">

    <input type="text" id="{{ $stocks->id_productos }}" class="id_articulo" name="img" hidden="" value="{{ $stocks->img }}">

		<button type="submit"  articulo="{{ $stocks->id_productos }}" class=" btn btn-info btn-block comprando"><img src="icons2/cart.svg"></button>
		


	</form>
</center>

 <div style="width: 285px;
  height: 10px; border-bottom: solid 2px #44df1d;padding: 5px; ">
   
 </div>
 
 <h6 style="color: #2c302b;">Almacen: {{ $stocks->stock }} </h6>
</div>



 <div class="modal fade" id="miModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog " >
            <div class="modal-content">
                <div class="modal-header">
                     <center><h4 class="modal-title" id="myModalLabel">Galeria de imagenes</h4></center>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
        <div class="container-fluid">
         
           
           
           <div id="imagenes" style="text-align: center;" >
             
           </div>
                    

        
        </div>
                <div class="modal-footer">
                
               

                 <button type="button" class=" btn-sm btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span>Salir</button>

                    </div>
                 
                </div>
            </div>
        </div>
    </div>
<!-- /.modal -->
@endforeach
@else
<h2>Sin resultados</h2>
@endif


@endsection

@section('script')
<script type="text/javascript">
   $(document).ready(function(){
     $("#titulo").hide();
    $("a").removeClass("focus");
       $("#articulos").addClass("focus");

       
       //funcion para agregar al carrito

       $('.comprando').click(function(e){
        e.preventDefault();
                
                var producto= $(this).attr('articulo');
               //var cantidad= $(this).attr('cantidad');
                //var cantidad = $(this).val('cantidad');
                  var can=$('select[name='+producto+']').val();
                  //alert(can);
                  if(can==null)
                  {
                    alert("Seleccione la cantidad a comprar");
                    return false;
                  }
                  
                 $.ajax({
                url: 'compras',
                type: 'post',
                data: {producto:producto,cantidad:can,
                  _token:$('input[name="_token"]').val()},
              })
              .done(function(res) {
                //console.log("success");
                alert(res);
                //console.log(res);
              })
        })


     });
 
 /*function comprando()
 {
    var producto= $(this).attr('id_articulo');
    alert(producto);
    return false;
 }*/
  </script>
@endsection