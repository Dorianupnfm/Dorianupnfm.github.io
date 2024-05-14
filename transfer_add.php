<?php 
    $title ="Transferencias - "; 
    $active9 ="active";
    include "head.php";
    include "sidebar.php";


?>

      <div class="page-wrapper">
            <div class="content container-fluid">                

                    <div class="col-md-12 col-xs-12 col-sm-12">                     
                        <div class="card-box">                           
                            <div class="card-block">
                            <div id="result_transfer"></div>
                                <h4 class="card-title">Nueva Transferencia</h4>
                            <form method="post" id="add_transfer" name="add_transfer" class="form-horizontal form-label-left">                         
                                
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Cuenta a debitar <span class="text-danger">*</span></label>
                                    <div class="col-md-8">
                                        <select class="form-control select2" name="account_from" data-placeholder="Selecciona Cuenta a debitar" id="account_from" >   
                                                                            
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Cuenta Destino<span class="text-danger">*</span></label>
                                    <div class="col-md-8">
                                        <select class="form-control select2 disable " name="account_to" data-placeholder="Selecciona Cuenta destino" id="account_to" >   
                                                    
                                        </select>
                                    </div>
                                </div>
                                
                            
                                
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Fecha<span class="text-danger">*</span></label>
                                    <div class="col-md-8">
                                        <div class="cal-icon">
                                                <input class="form-control datetimepicker" type="text" type="date"  name="date" value="<?php echo date("d/m/Y");?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Monto<span class="text-danger">*</span></label>
                                    <div class="col-md-8">
                                       <input class="form-control" type="text"  name="amount" pattern="^[0-9]{1,5}(\.[0-9]{0,2})?$" title="Ingresa sólo números con 0 ó 2 decimales" maxlength="8" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Nota </label>
                                    <div class="col-md-8">
                                        <input type="text" name="note" class="form-control">
                                    </div>
                                </div>
                                
                                <hr>

                                <div class="text-center">
                                    <button id="save_data" type="submit" class="btn btn-primary">Guardar</button>
                                </div>
                            </form>
                                
                            </div>
                               
                            <!-- </div> -->
                        </div>
                    </div>
                    
                </div>
            </div>           
        </div>
</div>  
    
<?php include "footer.php" ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/i18n/es.js"></script>



<script >
    $(function () {
        
        $.fn.select2.defaults.set('language', 'es');
        $(".select2").select2();        
    });

</script>



<script>
    
$( "#add_transfer" ).submit(function( event ) {
  $('#save_data').attr("disabled", true);
  
 var parametros = $(this).serialize();
     $.ajax({
            type: "POST",
            url: "action/add_transfer.php",
            data: parametros,
             beforeSend: function(objeto){
                $("#result_transfer").html("Mensaje: Cargando...");
              },
            success: function(datos){
            $("#result_transfer").html(datos);
            $('#save_data').attr("disabled", false);        
            
          }
    });
  event.preventDefault();
})
</script>


<script type="text/javascript">

$(document).ready(function() {

     var id= $("#account_to").val();
    $( ".select2" ).select2({        
    ajax: {
        url: "ajax/accounts_select2.php",
        dataType: 'json',
        delay: 250,
        data: function (params) {
        


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
    minimumInputLength: 2
    
})

});

</script>