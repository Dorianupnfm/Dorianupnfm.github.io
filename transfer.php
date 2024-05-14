<?php
    $title ="Transferencias | ";
    include "head.php";
	$active9="active";
    include "sidebar.php";
?>
 


        <div class="page-wrapper">
            <div class="content container-fluid">
                 <div class="row">
                    <div class="col-sm-4 col-5">
                        <h4 class="page-title">Transferencias</h4>
                    </div>
                    <div class="col-sm-8 col-7 text-right m-b-30">
                        <a href="transfer_add.php" class="btn btn-primary btn-rounded pull-right"><i class="fa fa-plus"></i> Agregar Transferencia</a>
                    </div>
                </div>
                <div class="row">                    
                     <div class="col-lg-12">                     
                        <div class="card-box">
                            <div class="card-block">
                                <!-- <h4 class="card-title">Transferencias</h4> -->
                                <!-- form print -->
                        <form class="form-horizontal" role="form" id="data_expence">
                             <div class="form-group row">
                                <input type="hidden" class="form-control" id="name_user" value="<?php echo $name; ?>">
                                    <div class="col-md-3">
                                        <input type="text" class="form-control" id="daterange" name="daterange" value="<?php echo "01/".date("m/Y")." - ".date("d/m/Y");?>" readonly onchange="load(1);">
                                    </div>
                                    <!-- <div class="col-md-3 form-group">
                                        <select class="form-control" id="category" name="category" onchange="load(1);">
                                            <option selected="" value="0">-- Imprimir por Categoria --</option>
                                            <?php
                                            $categories = mysqli_query($con,"select * from category_expence");
                                            while ($cat=mysqli_fetch_array($categories)) { ?>
                                            <option value="<?php echo $cat['id']; ?>"><?php echo $cat['name']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>    -->
                                    <div class="col-md-3">
                                    <button type="button" class="btn btn-success" onclick='load(1);'>
                                        <i class="fa fa-search"></i> Buscar</button>
                                        <span id="loader"></span>
                                    </div>  
                               <!--  <div class="col-md-3  offset-3">
                                    <button type="submit" class="btn btn-light pull-right">
                                      <span class="glyphicon glyphicon-print"></span> Imprimir
                                    </button>
                                </div>   -->
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

<script type="text/javascript" src="js/VentanaCentrada.js"></script>

<script >
    
    $(document).ready(function(){
    load(1);
});

function load(page){
    var daterange= $("#daterange").val();    
    $("#loader").fadeIn('slow');
    $.ajax({
        url:'./ajax/transfers.php?action=ajax&page='+page+'&daterange='+daterange,
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
    if (confirm("Realmente deseas eliminar la transferencia?")){    
        $.ajax({
            type: "GET",
            url: "./ajax/transfers.php",
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
    // function print
        $("#data_expence").submit(function(e){
        	e.preventDefault();
          var daterange= $("#daterange").val();          
         VentanaCentrada('./pdf/documentos/transfers.php?daterange='+daterange,'Gasto','','1024','768','true');
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

