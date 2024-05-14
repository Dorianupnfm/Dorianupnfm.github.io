<?php
    $title ="Gastos | ";
    include "head.php";
	$active2="active";
    include "sidebar.php";
?>
 <?php
    include("modal/new_expences.php");
    include("modal/upd_expences.php");
?>


        <div class="page-wrapper">
            <div class="content container-fluid">
                 <div class="row">
                    <div class="col-sm-4 col-5">
                        <h4 class="page-title">Gastos</h4>
                    </div>
                    <div class="col-sm-8 col-7 text-right m-b-30">
                        <a href="#" class="btn btn-primary btn-rounded pull-right" data-toggle="modal" data-target="#add_expences"><i class="fa fa-plus"></i> Agregar Gasto</a>
                    </div>
                </div>
                <div class="row">                    
                     <div class="col-lg-12">                     
                        <div class="card-box">
                            <div class="card-block">
                                <!-- <h4 class="card-title">Gastos</h4> -->
                                <!-- form print -->
                        <form class="form-horizontal" role="form" id="data_expence">
                             <div class="form-group row">
                                <input type="hidden" class="form-control" id="name_user" value="<?php echo $name; ?>">
                                    <div class="col-md-3">
                                        <input type="text" class="form-control" id="daterange" name="daterange" value="<?php echo "01/".date("m/Y")." - ".date("d/m/Y");?>" readonly onchange="load(1);">
                                    </div>
                                    <div class="col-md-3 form-group">
                                        <select class="form-control" id="category" name="category" onchange="load(1);">
                                            <option selected="" value="0">-- Buscar por Categoria --</option>
                                            <?php
                                            $categories = mysqli_query($con,"select * from category_expence");
                                            while ($cat=mysqli_fetch_array($categories)) { ?>
                                            <option value="<?php echo $cat['id']; ?>"><?php echo $cat['name']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>   
                                    <div class="col-md-3">
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

<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
 
<!-- Include Date Range Picker -->
<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />
<script type="text/javascript" src="js/expences.js"></script>

<script type="text/javascript" src="js/VentanaCentrada.js"></script>
<script>
$( "#add_expence" ).submit(function( event ) {
  $('#save_data').attr("disabled", true);
  
 var parametros = $(this).serialize();
     $.ajax({
            type: "POST",
            url: "action/add_expences.php",
            data: parametros,
             beforeSend: function(objeto){
                $("#resultados").html("Mensaje: Cargando...");
              },
            success: function(datos){
            $("#resultados").html(datos);
            $('#save_data').attr("disabled", false);
            $('#add_expences').modal('hide');
            load(1);
          }
    });
  event.preventDefault();
})


$( "#upd_expence" ).submit(function( event ) {
  $('#upd_data').attr("disabled", true);
  
 var parametros = $(this).serialize();
     $.ajax({
            type: "POST",
            url: "action/upd_expences.php",
            data: parametros,
             beforeSend: function(objeto){
                $("#resultados").html("Mensaje: Cargando...");
              },
            success: function(datos){
            $("#resultados").html(datos);
            $('#upd_data').attr("disabled", false);
             $('#update_expences').modal('hide');
            load(1);
          }
    });
  event.preventDefault();
})

    function obtener_datos(id){
            var description = $("#description"+id).val();
            var amount = $("#amount"+id).val();
			var category_id = $("#category_id"+id).val();
            $("#mod_id").val(id);
            $("#mod_description").val(description);
            $("#mod_amount").val(amount);
			$("#mod_category").val(category_id);
        }


        // function print
        $("#data_expence").submit(function(e){
        	e.preventDefault();
          var daterange= $("#daterange").val();
          var category = $("#category").val();
         VentanaCentrada('./pdf/documentos/expence_pdf.php?daterange='+daterange+'&category='+category,'Gasto','','1024','768','true');
        });

</script>

<script type="text/javascript">
$(function() {
    $('input[name="daterange"]').daterangepicker({
		 locale: {
      format: 'DD/MM/YYYY',
	  "applyLabel": "Aplicar",
	  "cancelLabel": "Cancelar",
	  "daysOfWeek": [
            "Do",
            "Lu",
            "Ma",
            "Mi",
            "Ju",
            "Vi",
            "Sa"
        ],
       "monthNames": [
            "Enero",
            "Febrero",
            "Marzo",
            "Abril",
            "Mayo",
            "Junio",
            "Julio",
            "Agosto",
            "Septiembre",
            "Octubre",
            "Noviembre",
            "Diciembre"
        ],		
    }
	});
});
</script>


<script type="text/javascript">

$(document).ready(function() {
    $( ".select2" ).select2({        
    ajax: {
        url: "ajax/accounts_select2.php",
        dataType: 'json',
        delay: 250,
        data: function (params) {
            // console.log(params.term);
            return {
                q: params.term // search term
            };
        },
        processResults: function (data) {
            
            
            return {
                results: data
            };


        },
        cache: true
        
        
        
    },
    minimumInputLength: 2,
    width:'100%'
    
})

});

</script>