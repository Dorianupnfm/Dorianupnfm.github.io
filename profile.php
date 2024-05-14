<?php 
    $title ="Mi cuenta - "; 
    include "head.php";
    include "sidebar.php";
?>

      <div class="page-wrapper">
            <div class="content container-fluid">
                 <div class="row">
                    <div class="col-sm-4 col-5">
                       
                    </div>                    
                </div>
                <div class="row">                    
                     <div class="col-md-4">
                        <div class="image view view-first">
                        <div id="respuesta">
                            <img class="thumb-image" style="width: 100%; display: block;" src="images/profiles/<?php echo $profile_pic; ?>" alt="image" />
                        </div>  
                      </div>
                        <div class="form-group row">                                    
                            <div class="col-md-12">
                                <input class="form-control" type="file"  name="file" id="file" >
                            </div>              
                        </div>
                </div>        


                    <div class="col-md-8 col-xs-12 col-sm-12">                     
                        <div class="card-box">
                           
                            <div class="card-block">
                            <!-- <div class="row"> -->
                                 <?php include "lib/alerts.php";
                            profile(); //llamada a la funcion de alertas
                             ?> 
                                <h4 class="card-title">Información personal</h4>
                            <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="action/upd_profile.php" method="post">
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Nombre</label>
                                    <div class="col-md-8">
                                        <input type="text" name="name" id="first-name" value="<?php echo $name; ?>" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Correo Electrónico</label>
                                    <div class="col-md-8">
                                        <input type="text"  name="email" value="<?php echo $email; ?>" class="form-control">
                                    </div>
                                </div>
                                <br>
                                <br>

                                <h4 class="card-title">Cambiar Contraseña</h4>
                                
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Contraseña Antigua</label>
                                    <div class="col-md-8">
                                        <input placeholder="**********" type="text"  name="password" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Nueva Contraseña</label>
                                    <div class="col-md-8">
                                        <input type="text" name="new_password" class="form-control" >
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Confirmar nueva contraseña</label>
                                    <div class="col-md-8">
                                        <input type="text" name="confirm_new_password" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                   <!-- <div class="form-group"> -->
                                        <label class="control-label offset-md-3 col-md-2 col-sm-5 col-xs-12">   
                                            <input type="checkbox" class="flat" name="status" <?php if($status){ echo "checked";}?>> Activo 
                                        </label>
                                        <div class="col-md-6">
                                            <p class="text-danger">
                                                Si desactivas tu cuenta, no podras tener acceso
                                            </p>

                                        </div>
                                    <!-- </div> -->
                                </div>
                                <hr>

                                <div class="text-center">
                                    <button type="submit" name="token" class="btn btn-primary">Actualizar Datos</button>
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

<script>
    $(function(){
		$("input[name='file']").on("change", function(){
        var fileInputElement= document.getElementById('file');
		var formData = new FormData();
		formData.append("file", fileInputElement.files[0]);
		
        var ruta = "action/upload-profile.php";
        $.ajax({
            url: ruta,
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function(datos)
            {
                $("#respuesta").html(datos);
            }
        });
    });
    });
</script>