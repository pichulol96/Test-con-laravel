@extends('welcome')

@section('contenido')
@if($articulos)
<div class="container">
<table id="tabla-articulos" style="margin-top: 10px;" class="table  table-responsive-sm table-striped">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Imagen</th>
      <th scope="col">Nombre</th>
      <th scope="col">Descripcion</th>
      <th scope="col">Precio</th>
      <th scope="col">Opcion</th>
    </tr>
  </thead>
  <tbody>
    <tr>
    	@foreach($articulos as $articulo)
      <th scope="row">{{ $articulo['id_productos']}}</th>
      <td><img src="img/{{ $articulo['img'] }}" width="100"></td>
      <td>{{ $articulo['nombre_producto']}}</td>
      <td>{{ $articulo['descripcion']}}</td>
      <td>{{ $articulo['precio']}}</td>
    
      

      
      <td>
      
      
      <button  class="btn-sm btn btn-primary quitar"id="modal"  data-toggle="modal" data-target="#miModal1{{$articulo['id_productos']}}"><img src="icons2/pencil.svg"></button>
      
      
      <form method="POST" style="display: unset;" action="{{ url('/mis_articulos/'.$articulo['id']) }}">
      	@csrf
      	@method('delete')
      	<button type="submit" onclick="return confirm('Eliminar?');"  class="btn-sm btn btn-danger quitar"><img src="icons2/trash.svg"></button>
      </form>

      </td>

    </tr>
    @endforeach
    
      <br>
      <div style="display: flex; padding: 20px;">
          <button style="width: 250px; margin-right:10px; " class="btn-sm btn btn-success btn-block" id="modal"  data-toggle="modal" data-target="#miModal">Nuevo articulo</button>
          <form action="{{ url('/consulta') }}" onsubmit="return buscar();" method="POST">
            @csrf
                <select id="categoria" name="categoria" class="form-control">
                <option selected disabled value="">Seleccione categoria</option>
                <option value="1">Frutas</option>
                <option value="2">Verduras</option>
              </select>
              <button class="btn btn-info " type="submit">Consultar</button>
          </form>

          
      </div>


    
    
  </tbody>

</table>
<center> {{ $articulos->links() }}</center><br>
</div>



@endif
@foreach($articulos as $articulo)
<div class="modal fade" id="miModal1{{$articulo['id_productos']}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog " >
            <div class="modal-content">
                <div class="modal-header">
                     <center><h4 class="modal-title" id="myModalLabel">Registrar articulo nuevo</h4></center>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
        <div class="container-fluid">
              <form action="{{ url('/actualizar_productos') }}" method="post" enctype="multipart/form-data">
                @csrf @method('PATCH')
              <label>Nombre</label> 
              <input type="text" required="" value="{{ $articulo['nombre_producto'] }}" class="form-control" name="nombre">
              <label>Descripcion</label>
              <input type="text" required="" value="{{ $articulo['descripcion']}} "class="form-control" name="descripcion">
              <label>Precio</label>
              <input type="text" required="" value="{{ $articulo['precio'] }}"  class="form-control" name="precio">
              <input type="text" hidden="" required="" value="{{ $articulo['id_productos'] }}"  class="form-control" name="id">
             

              
          
        </div>
                <div class="modal-footer">
                
                     <button type="submit" class=" btn-sm btn btn-primary btn-lg" ><span class="glyphicon glyphicon-remove"></span>Actualizar</button>
                     

                     <button type="button" class=" btn-sm btn btn-light" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span>Salir</button>

                  </div>
                  </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach
<!-- /.modal editar -->


<div class="modal fade" id="miModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog " >
            <div class="modal-content">
                <div class="modal-header">
                     <center><h4 class="modal-title" id="myModalLabel">Registrar articulo nuevo</h4></center>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
        <div class="container-fluid">
              <form onsubmit="return validar()" action="{{ url('/registro_productos') }}" method="post" enctype="multipart/form-data">
              	@csrf
              <label>Nombre</label> 
              <input type="text" required="" class="form-control" name="nombre">
            	<label>Descripcion</label>
            	<input type="text"  required="" class="form-control" name="descripcion">
            	<label>Precio</label>
            	<input type="text" id="cantidad" required="" class="form-control" name="precio">
              <label>Categoria</label>

              <select name="categoria2" class="form-control">
                <option selected disabled value="">Seleccione categoria</option>
                <option value="1">Frutas</option>
                <option value="2">Verduras</option>
              </select>

            	<label>Imagen del producto</label>
            	<input type="file" required="" name="img">
        	
        </div>
                <div class="modal-footer">
                
                     <button type="submit" class=" btn-sm btn btn-primary btn-lg" ><span class="glyphicon glyphicon-remove"></span>Registrar</button>
                     

                     <button type="button" class=" btn-sm btn btn-light" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span>Salir</button>

                  </div>
                  </form>
                </div>
            </div>
        </div>
    </div>
<!-- /.modal registrar -->

@endsection


@section('script')
<script type="text/javascript">
   $(document).ready(function(){

    $("a").removeClass("focus");
       $("#articulos").addClass("focus");

      $("#titulo").hide();


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
                  beforeSend:function(){
                           document.getElementById('ajax').style.display='block';
                           document.getElementById('ajax').innerHTML="<h2>Cargando....</h2>";
                          }
              })
              .done(function(res) {
                //console.log("success");
                //alert(res);
                document.getElementById('ajax').style.display='none';
                if(res=="0")
                {
                  var x='<h3 class="img">No tiene mas imagenes de este articulo para mostrarle a los clientes, porfavor suba mas imagenes para que tenga mas presentacion el artiulo</h3>';
                  $('#imagenes').append(x);

                }
                var arreglo = JSON.parse(res);
                //console.log(arreglo);
                for(var i=0;i<arreglo.length;i++)
                {   var contenido='<div class="img  articulos2"+>'

                     var button='<br class="img"><button type="button" id="'+arreglo[i].id+'" id2="'+arreglo[i].img+'" class="remover img btn-sm btn btn-danger"><img src="icons2/x-circle-fill.svg"></button><br class="img">'

                    var todo='<img class="img "id="'+arreglo[i].img+'" height="200" width="200" src="img/'+arreglo[i].img+'">'

                    
                    '</div>'  ;
                    //console.log(button);
                   $('#imagenes').append(contenido+button+todo);
                   //$('#eliminar-galeria').append(button);
                }

                 $(".remover").click(function(e)
                  {   var t=confirm("Esta seguro que quiere quitar esta imagen de la geleria ?");
                      if(t==true)
                      {
                      	var id_imagen= $(this).attr('id');
                        var imagen= $(this).attr('id2');
        	             // alert(id_imagen);
                        //alert(imagen);
        	            $.ajax({
        	            	url:'galeria_eliminar',
        	            	type:'delete',
        	            	data:{id_imagen:id_imagen,imagen:imagen,
        	            		_token:$('input[name="_token"]').val()},
                          

                        
        	            })


        	            .done(function(res){
                            //console.log("success");
                            alert(res);
                            $('#gale').modal("hide");
                            $('#gale').modal("show");

        	            })
                      }
                      
        	          
                  })
                

              })
              /*.fail(function() {
                console.log("error");
              })
              .always(function() {
                console.log("complete");
              });*/
             

           $("#gale").modal("show");
    
   
     
        })

       

          });
 

	
 function validar()
 {
        var cantidad=document.getElementById('cantidad').value;
        if(isNaN(cantidad))
        {
          alert("EL precio debe ser numerico");
          return false;
        }
        else
        {
          return true;
        }
  
 }

  </script>
@endsection