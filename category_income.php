<?php
    $title ="Ingresos Categorias | ";
    include "head.php";
	$active6="active";
    include "sidebar.php";
?>
<?php
    include("modal/new_category_income.php");
    include("modal/upd_category_income.php");
?>
 

          <div class="page-wrapper">
            <div class="content container-fluid">
                 <div class="row">
                    <div class="col-sm-4 col-5">
                        <h4 class="page-title">Categorías de Ingresos</h4>
                    </div>
                    <div class="col-sm-8 col-7 text-right m-b-30">
                        <a href="#" class="btn btn-primary btn-rounded pull-right" data-toggle="modal" data-target="#add_c_incomess"><i class="fa fa-plus"></i> Agregar Categoría</a>
                    </div>
                </div>
                <div class="row">                    
                     <div class="col-lg-12">                     
                        <div class="card-box">
                            <div class="card-block">
                            
                        <form class="form-horizontal" role="form" id="category_income">
                            <div class="form-group row">
                                 <input type="hidden" class="form-control" id="name_user" value="<?php echo $name; ?>"> 
                                    
                                    <div class="col-md-4">
                                        <input type="text" class="form-control" id="q" placeholder="Fecha o Nombre de la categoría" onkeyup='load(1);'>
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






























<script type="text/javascript" src="js/category_income.js"></script>

<script>
$( "#add_category_income" ).submit(function( event ) {
  $('#save_data').attr("disabled", true);
  
 var parametros = $(this).serialize();
     $.ajax({
            type: "POST",
            url: "action/add_category_income.php",
            data: parametros,
             beforeSend: function(objeto){
                $("#resultados").html("Mensaje: Cargando...");
              },
            success: function(datos){
            $("#resultados").html(datos);
            $('#save_data').attr("disabled", false);
            $('#add_c_incomess').modal("hide");
            load(1);
          }
    });
  event.preventDefault();
})


$( "#upd_c_income" ).submit(function( event ) {
  $('#upd_data').attr("disabled", true);
  
 var parametros = $(this).serialize();
     $.ajax({
            type: "POST",
            url: "action/upd_category_income.php",
            data: parametros,
             beforeSend: function(objeto){
                $("#resultados").html("Mensaje: Cargando...");
              },
            success: function(datos){
            $("#resultados").html(datos);
            $('#upd_data').attr("disabled", false);
             $('#update_c_incomess').modal("hide");
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