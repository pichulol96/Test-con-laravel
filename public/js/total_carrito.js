$(document).ready(function(){
  
  if(document.getElementById('logeado'))
  {
    
    setInterval(total_carrito,1000);
  }
  else
  {
    return false;
  }

	function total_carrito()
	{
		$.ajax({
          url:'recargar_articulos',
          type:'get',
          

         }).done(function(res){
          //alert (res);
          if(res>0)
          {
          	//alert (res);
           document.getElementById("carrito_total").innerHTML=
           "<label class='carro'>"+res+"</label>";
          }
          
          
          
         })
       
	}

	//setInterval(total_carrito,1000);
});