<?php
    $title ="Reporte de ingresos por día | ";
    include "head.php";
	$active13="active";
    include "sidebar.php"; 
?>


          <div class="page-wrapper">
            <div class="content container-fluid">
                 <div class="row">
                    <div class="col-sm-4 col-5">
                        <h4 class="page-title"> Reporte de ingresos por día</h4>
                    </div>
                    
                </div>
                <div class="row">                    
                     <div class="col-lg-12">                     
                        <div class="card-box">
                            <div class="card-block">
                                <!-- <h4 class="card-title">Gastos</h4> -->
                                <!-- form print -->
                        <form class="form-horizontal" role="form" id="data_income">
                             <div class="form-group row">
                                <input type="hidden" class="form-control" id="name_user" value="<?php echo $name; ?>">
                                    <div class="col-md-3">
                                        <input type="text" class="form-control" id="daterange" name="daterange" value="<?php echo "01/".date("m/Y")." - ".date("d/m/Y");?>" readonly>
                                    </div>
                                   
                                    
                                     
                                    <div class="col-md-1">
                                    <button type="button" class="btn btn-success" onclick='load(1);'>
                                        <i class="fa fa-search"></i> Buscar</button>
                                        <span id="loader"></span>
                                    </div>  
                                <div class="col-md-2 offset-6">
                                    <button type="submit" class="btn btn-light pull-right">
                                      <span class="glyphicon glyphicon-print"></span> Imprimir
                                    </button>
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
<!-- <script type="text/javascript" src="js/income.js"></script> -->
<script type="text/javascript" src="js/VentanaCentrada.js"></script>
<script>
    $(document).ready(function(){
    load(1);
});

function load(page){
    var daterange= $("#daterange").val();   
        $("#loader").fadeIn('slow');
    $.ajax({
        url:'./ajax/income_byday_report.php?action=ajax&page='+page+'&daterange='+daterange,
        beforeSend: function(objeto){
            $('#loader').html('<img src="./images/ajax-loader.gif"> Cargando...');
        },
        success:function(data){
            $(".outer_div").html(data).fadeIn('slow');
            $('#loader').html('');
        }
    })
}

// function print
    $("#data_income").submit(function(e){
        e.preventDefault();
      var daterange = $("#daterange").val();
      var type =$("#type").val();   
      var account=$("#account").val();   
      

     VentanaCentrada('./pdf/documentos/income_byday_report.php?daterange='+daterange,'Gasto','','1024','768','true');
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


