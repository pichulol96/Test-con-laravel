<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <script src="{{ asset('js/app.js') }}" defer></script>
        <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
        @yield('script')
        <script src="{{ asset('js/total_carrito.js') }}"></script>

        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="{{ asset('/css/estilos.css') }}">

        <title>Test con laravel</title>

        
    </head>
    <body class="antialiased">
        
            


    <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <button class="navbar-toggler menu-navegacion" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <img src="{{ asset('/archivos/logo2.jpg') }}" width="80" height="80"></a>



  <div class="collapse navbar-collapse " id="navbarTogglerDemo03">
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
      
      @isset( Auth::user()->name)
      @if( Auth::user()->rol==1)
      

      <li class="nav-item">
        <input type="text"id="logeado" hidden="" class="logeado" value="{{ Auth::user()->rol }}" name="">
        <a class="nav-link" id="compras" href="{{ url('compras') }}"><img src="icons2/cart-fill.svg"><label id="carrito_total"></label></a>
      </li>
      
       @if( Auth::user()->rol==1)
       <li class="nav-item dropdown " >
                                <a id="navbarDropdown" class="nav-link dropdown-toggle " href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{"Zona de distribucion"}}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                  <center><label>Acapulco</label></center>
                                  @isset($zona)
                                  @foreach ($zona as $zonas)
                      
                    
                                    <a zonaValor="{{$zonas['id_zona'] }}" class=" zona dropdown-item" href="#">
                                      {{$zonas['nombre_zona']}}
                                        
                                    </a>
                                    @endforeach
                                    @endisset
                                    

                                    <form name="formulario_zona"  action="{{ route('productos_zona') }}" method="POST" class="form d-none">
                                      <input class="zona1" type="text" name="zona" value="


                                      ">
                                        @csrf
                                    </form>

                                    


                                </div>
                            </li>
       @endif                     


      @endif
      @if( Auth::user()->rol==2)
      <li class="nav-item">
        <a class="nav-link" id="compras" href="{{ url('compras') }}">Ventas </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="articulos" href="{{ url('mis_articulos') }}" >Mis productos</a>
      </li>

      <li class="nav-item dropdown " >
                                <a id="navbarDropdown" class="nav-link dropdown-toggle " href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{"Zona de distribucion"}}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                  <center><label>Acapulco</label></center>
                                  @isset($zona)
                                  @foreach ($zona as $zonas)
                      
                    
                                    <a zonaValor="{{$zonas['id_zona'] }}" class=" zona dropdown-item" href="#">
                                      {{$zonas['nombre_zona']}}
                                        
                                    </a>
                                    @endforeach
                                    @endisset
                                    

                                    <form name="formulario_zona"  action="{{ route('productos_zona') }}" method="POST" class="form d-none">
                                      <input class="zona1" type="text" name="zona" value="


                                      ">
                                        @csrf
                                    </form>

                                    


                                </div>
                            </li>

      @endif
      @endisset

      @empty(Auth::user()->name)
      <li class="nav-item">
        <a class="nav-link" id="articulos" href="{{ url('productos') }}" >Productos</a>
      </li>
      @endempty

      <li class="nav-item">
                   @if (Route::has('login'))
                
                     @auth
                        <!--<a href="{{ url('/home')  }}" class="text-sm text-gray-700 ">Home</a>-->
                      <li class="nav-item dropdown " >
                                <a id="navbarDropdown" class="nav-link dropdown-toggle " href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a  class="  dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Cerrar sesion') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>


                                </div>
                            </li>


                              <img style="border-radius: 25px;" src="{{ asset('/archivos/sin_foto.jpg') }}" width="40" height="40">
                                

                      @else
                        <a href="{{ route('login') }}"  class="nav-link ">Iniciar sesion</a>

        </li>

        <li class="nav-item">
            
                      @if (Route::has('register'))
                      <a href="{{ route('register') }}" class="nav-link ">Registrar</a>
                      @endif

                       
                    @endif
                  @endif
        </li>    
    </ul>
    @if( Auth::user()->rol==1)
    <form class="form-inline my-2 my-lg-0" action="{{ url('/consulta2') }}" method="POST">
       @csrf
      <input class="form-control mr-sm-2 " style="border-radius: 40px;" required="" type="search" placeholder="Buscar" aria-label="Search" name="nombre">
      <button class="btn btn-dark my-2 my-sm-0 " style="border-radius: 40px;float: left; display: inline;" type="submit">Buscar <img src="icons2/search.svg"></button>
    </form>
    @endif
  </div>
</nav>

      @yield('contenido')
      <div id="titulo">

        <center>
          <h1>Supermarket</h1>
          <img src="{{ asset('/archivos/productos.jpg') }}" class="img-fluid" alt="300">
        </center>
      </div>
    </body>
</html>


    <script >
      
       $(document).ready(function(){
               $('.zona').click(function(e){
                
                console.log(e);
                let zonaSolicitada=e.target.innerText;
                    
                    $(".zona1").attr("value",zonaSolicitada);
                    //alert(e.target.innerText);
                    document.formulario_zona.submit()

                    
                    
                    
                    preventDefault();
                 })
         });
    </script>

