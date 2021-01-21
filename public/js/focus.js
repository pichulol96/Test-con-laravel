$(document).ready(function()
{
      $("#compras").click(function()
     {
     	$("a").removeClass("focus");
       $("#compras").addClass("focus");
        
          $.ajax({
                url: 'compras',
                type: 'get',
                data: {},
              }).done(function(res) {
                  $("#body").load("compras");



              })
          

       
       


		event.preventDefault();
      })

      $("#articulos").click(function()
     {
     	$("a").removeClass("focus");
       $("#articulos").addClass("focus");

       $.ajax({
                url: 'articulos',
                type: 'get',
                data: {},
              }).done(function(res) {
                  $("#body").load("articulos");
                  


              })
       


		event.preventDefault();
      })

      

     
});