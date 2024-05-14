<?php
    $title ="Cuentas | ";
    include "head.php";
	$active4="active";
    include "sidebar.php";
?>  
 <?php
    include("modal/new_account.php");
    include("modal/upd_account.php");
?>               
   
  <div class="page-wrapper">
            <div class="content container-fluid">
                 <div class="row">
                    <div class="col-sm-4 col-5">
                        <h4 class="page-title">Cuentas</h4>
                    </div>
                    <div class="col-sm-8 col-7 text-right m-b-30">
                        <a href="#" class="btn btn-primary btn-rounded pull-right" data-toggle="modal" data-target="#add_accounts"><i class="fa fa-plus"></i> Agregar Cuenta</a>
                    </div>
                </div>
                <div class="row">                    
                     <div class="col-lg-12">                     
                        <div class="card-box">
                            <div class="card-block">
                                <!-- <h4 class="card-title">Gastos</h4> -->
                                <!-- form print -->
                        <form class="form-horizontal" role="form" id="category_expence">
                            <div class="form-group row">
                                 <input type="hidden" class="form-control" id="name_user" value="<?php echo $name; ?>"> 
                                    
                                    <div class="col-md-4">
                                        <input type="text" class="form-control" id="q" placeholder="Buscar por nombre" onkeyup='load(1);'>
                                    </div>

                                    <div class="col-md-1">
                                    <button type="button" class="btn btn-success" onclick='load(1);'>
                                        <i class="fa fa-search"></i> Buscar</button>
                                        <span id="loader"></span>
                                    </div> 
                                </div>
                        </form>
                        <!-- end form print -->
                                <div class="table-responsive">
                                    <!-- ajax -->
                                    <div id="resultados"></div><!-- Carga los datos ajax -->
                                    <div class='outer_div'></div><!-- Carga los datos ajax -->
                                <!-- /ajax -->
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>           
        </div>
</div>        


   
<?php include "footer.php" ?>
<!-- Include Required Prerequisites -->

<script>
    
            $(document).ready(function(){
            load(1);
        });

        function load(page){
            var q= $("#q").val();
            $("#loader").fadeIn('slow');
            $.ajax({
                url:'./ajax/accounts.php?action=ajax&page='+page+'&q='+q,
                 beforeSend: function(objeto){
                 $('#loader').html('<img src="./images/ajax-loader.gif"> Cargando...');
              },
                success:function(data){
                    $(".outer_div").html(data).fadeIn('slow');
                    $('#loader').html('');
                    
                }
            })
        }

    
        
            function eliminar (id)
        {
            var q= $("#q").val();
        if (confirm("Realmente deseas eliminar la cuenta?")){  
        $.ajax({
        type: "GET",
        url: "./ajax/accounts.php",
        data: "id="+id,"q":q,
         beforeSend: function(objeto){
            $("#resultados").html("Mensaje: Cargando...");
          },
        success: function(datos){
        $("#resultados").html(datos);
        load(1);
        }
            });
        }
        }
        
        
        
        


</script>

<script>
$( "#add_account" ).submit(function( event ) {
    $('#save_data').attr("disabled", true);
  
    var parametros = $(this).serialize();
     $.ajax({
            type: "POST",
            url: "action/add_account.php",
            data: parametros,
             beforeSend: function(objeto){
                $("#resultados").html("Mensaje: Cargando...");
              },
            success: function(datos){
            $("#resultados").html(datos);
            $('#save_data').attr("disabled", false);
            $('#add_accounts').modal("hide");
            load(1);
          }
    });
  event.preventDefault();
})

// success

$( "#upd_account").submit(function( event ) {
  $('#upd_data').attr("disabled", true);
  
 var parametros = $(this).serialize();
     $.ajax({
            type: "POST",
            url: "action/upd_account.php",
            data: parametros,
             beforeSend: function(objeto){
                $("#resultados").html("Mensaje: Cargando...");
              },
            success: function(datos){
            $("#resultados").html(datos);
            $('#upd_data').attr("disabled", false);
             $('#upd_accounts').modal("hide");
            load(1);
          }
    });
  event.preventDefault();
})

    function obtener_datos(id){
            var name = $("#name"+id).val();            
            $("#mod_id").val(id);
            $("#mod_name").val(name);
            
			
        }
</script>