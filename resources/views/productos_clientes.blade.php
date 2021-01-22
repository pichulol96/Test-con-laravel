@extends('welcome')

@section('contenido')

@if($articulos)

@foreach($articulos as $articulo)

<div class="articulos">
  <center>
	<form  action="{{ url('/compras') }}" onsubmit="return comprando();" method="POST" enctype="">
		@csrf
		<img src="img/{{ $articulo->img }}" width="80">
		<h5>{{ $articulo->descripcion }}</h5>
		<h5>${{ $articulo->precio }}</h5>
		<h6><a href="#" id="modal" class="galeria" articulo="{{ $articulo->id_producto }}" >{{ 'Ver galeria completa' }}</a></h6>
		
    <select class="form-control" id="{{ $articulo->id }}"  class="{{ $articulo->id }}"  name="{{ $articulo->id }}" required="">
      <option disabled selected value>Cantidad a comprar</option>
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
      <option value="5">5</option>
    </select>
    <br>
     
                      
                    
                                    
                                    
    <select class="form-control" id="{{ $articulo->id }}"  class="{{ $articulo->id }}"  name="{{ $articulo->id }}" required="">
      <option disabled selected value>Selecione zona </option>
      @isset($zona)
      @foreach ($zona as $zonas)
      
      <option value="{{ $zonas['id_zona'] }}">{{ $zonas['nombre_zona'] }}</option>
  
      @endforeach
      @endisset
    </select>
   
    <br>

		<input type="text" id="id_articulo"  class="id_articulo" name="id_articulo" hidden="" value="{{ $articulo->id }}">

    <input type="text" id="{{ $articulo->descripcion }}" class="id_articulo" name="precio" hidden="" value="{{ $articulo->precio }}">

    <input type="text" id="{{ $articulo->id }}" class="id_articulo" name="talla" hidden="" value="{{ $articulo->talla }}">

    <input type="text" id="{{ $articulo->id }}" class="id_articulo" name="descripcion" hidden="" value="{{ $articulo->descripcion }}">

    <input type="text" id="{{ $articulo->id }}" class="id_articulo" name="img" hidden="" value="{{ $articulo->img }}">

		<button type="submit"  articulo="{{ $articulo->id }}" class=" btn btn-info btn-block comprando"><img src="icons2/cart.svg"></button>
		


	</form>
</center>

 <div style="width: 285px;
  height: 10px; border-bottom: solid 2px #44df1d;padding: 5px; ">
   
 </div>

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

       $('.galeria').click(function(e){
        e.preventDefault();
         $(".img").remove(); 
       
           var producto= $(this).attr('articulo');
              //alert(producto);

              $.ajax({
                url: 'galeria',
                type: 'post',
                data: {producto:producto,
                  _token:$('input[name="_token"]').val()},
              })
              .done(function(res) {
                //console.log("success");
                var arreglo = JSON.parse(res);
                //console.log(arreglo);
                for(var i=0;i<arreglo.length;i++)
                {
                    var todo='<img class="img" width="300" src="img/'+arreglo[i].img+'">';
                    console.log(todo);
                $('#imagenes').append(todo);
                }
                

              })
              /*.fail(function() {
                console.log("error");
              })
              .always(function() {
                console.log("complete");
              });*/
             

           $("#miModal").modal("show");
    
   
     
        })
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