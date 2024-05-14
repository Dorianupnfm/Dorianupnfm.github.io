<?php 
    $title =" Editar Transferencias - "; 
    $active9 ="active";
    include "head.php";
    include "sidebar.php";


?>

<?php
    
    if (isset($_GET['id'])){
        $id=intval($_GET['id']);
        $sql=mysqli_query($con,"select * from accounts_transfers where  id='$id'");
        $count=mysqli_num_rows($sql);
        $r=mysqli_fetch_array($sql);
        $created_at=date('d/m/Y', strtotime($r['datetransfer']));
        $description=$r['note'];
        $amount=$r['amount']; 
        $account_from=$r['account_from_id'];
        $account_to=$r['account_to_id'];;       
    }
    
    if (!isset($_GET['id']) or $count!=1){
        header("location: transfer.php");
    }
    
    
    
    
?>
      <div class="page-wrapper">
            <div class="content container-fluid">                

                    <div class="col-md-12 col-xs-12 col-sm-12">                     
                        <div class="card-box">                           
                            <div class="card-block">
                            <div id="result_transfer"></div>
                                <h4 class="card-title">Editar Transferencia</h4>
                            <form method="post" id="add_transfer" name="add_transfer" class="form-horizontal form-label-left"> 

                            <input type="hidden" name="id" id="id" value="<?php echo $id;?>">                        
                                
                                 <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Cuenta a debitar <span class="text-danger">*</span></label>
                                    <div class="col-md-8">
                                        <select class="form-control select2" name="account_from" data-placeholder="Selecciona Cuenta a debitar" id="account_from" disabled>
                                        <?php 
                                            $sql=mysqli_query($con,"select *  from accounts order by name");
                                            while ($rw=mysqli_fetch_array($sql)){
                                                $id=$rw['id'];
                                                $name=$rw['name'];
                                                if ($account_from==$id){$selected1="selected";}else{$selected1="";}
                                            ?>
                                            <option value="<?php echo $id;?>" <?php echo
                                             $selected1;?>><?php echo $name;?></option>
                                            <?php
                                            }
                                        ?>   
                                                                               
                                        </select>
                                    </div>
                                </div> 

                               <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Cuenta Destino<span class="text-danger">*</span></label>
                                    <div class="col-md-8">
                                        <select class="form-control select2 disable " name="account_to" data-placeholder="Selecciona Cuenta destino" id="account_to" disabled > 
                                        <?php 
                                            $sql=mysqli_query($con,"select *  from accounts order by name");
                                            while ($rw=mysqli_fetch_array($sql)){
                                                $id=$rw['id'];
                                                $name=$rw['name'];
                                                if ($account_to==$id){$selected1="selected";}else{$selected1="";}
                                            ?>
                                            <option value="<?php echo $id;?>" <?php echo
                                             $selected1;?>><?php echo $name;?></option>
                                            <?php
                                            }
                                        ?>  
                                                                                               
                                        </select>
                                    </div>
                                </div>
                                
                               
                                
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Fecha<span class="text-danger">*</span></label>
                                    <div class="col-md-8">
                                        <div class="cal-icon">
                                                 <input class="form-control datetimepicker" type="text" type="date"  name="date" value="<?php echo $created_at;?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Monto<span class="text-danger">*</span></label>
                                    <div class="col-md-8">
                                       <input class="form-control" type="text" value="<?php echo $amount;?>"  name="amount" pattern="^[0-9]{1,5}(\.[0-9]{0,2})?$" title="Ingresa sólo números con 0 ó 2 decimales" maxlength="8" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Nota </label>
                                    <div class="col-md-8">
                                        <input type="text" name="note" value="<?php echo $description;?>" class="form-control">
                                    </div>
                                </div>
                                
                                <hr>

                                <div class="text-center">
                                    <button id="save_data" type="submit" class="btn btn-primary">Actualizar</button>
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
        //Initialize Select2 Elements
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
            url: "action/update_transfer.php",
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
            // console.log(params.term);


            return {
                q: params.term
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