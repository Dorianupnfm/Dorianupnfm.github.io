<?php
    $title ="Configuracion | ";
    include "head.php";
	$active8="active";
    include "sidebar.php";

   $configuration = mysqli_query($con, "select * from configuration");

?>
        
      <div class="page-wrapper">
            <div class="content container-fluid">
                 <div class="row">
                    <div class="col-sm-4 col-5">
                        <h4 class="page-title">Configuraciones Generales</h4>
                    </div>                    
                </div>
                <div class="row">                    
                     <div class="col-lg-8">                     
                        <div class="card-box">
                            <div class="card-block">
                            	<?php 
							if (isset($_GET['succes'])){
								?>
							<div class="alert alert-success" role="alert">
								<button type="button" class="close" data-dismiss="alert">&times;</button>
								<strong>¡Bien hecho!</strong> Datos actualizados correctamente.	
							</div>		
								<?php
							}
						?>
                                
                        <form action="action/upd_settings.php" method="post" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                            <?php if(mysqli_num_rows($configuration)>0){?>
                                <?php foreach($configuration as $cat){
										
									if($cat['name']=="logo"){
										$logo_img=$cat['val'];
									} else {
							?>
                              <div class="form-group row">
                                    <label class="col-md-2 col-form-label"><?php echo $cat['label']?></label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control  id="first-name" name="<?php echo $cat['name']; ?>" value="<?php echo $cat['val'];?>">
                                    </div>
                                </div>

                                <?php 
									}	
									} //end foreach?>
                                <?php } //end if ?>
                               
                                <div class="text-center">
                                    <button type="submit" name="token1" class="btn btn-primary">Actualizar datos</button>
                                </div>
                        </form>                       
                               
                            </div>
                        </div>
                    </div>




                    <div class="col-lg-4">                     
                        <div class="card-box">
                            <div class="card-block">
                            <div class="row">
								<div class='col-md-12'>
									<label>Logo</label>	<br>
								 <div id="load_img"> 	
									<img src="images/<?php echo $logo_img; ?>" alt="Logotipo" width="300px">
								</div>	
								</div>
								<div class="form-group row">
                                    <!-- <label class="col-form-label col-md-2">File input</label> -->
                                    <div class="col-md-12">
                                        <input class="form-control" type="file"  name="imagefile" id="imagefile" onchange="upload_image();">
                                    </div>
                                </div>
								<!-- <div class='col-md-12'>
									<br>
										<span class="btn btn-my-button ">
                                            Selecionar una imagen <input type="file" name="imagefile" id="imagefile" onchange="upload_image();">
                                        </span>
								</div> -->
							</div>
                               
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>           
        </div>
</div>  
 <?php 
include "footer.php"
 ?>
<script>
		function upload_image(){
				
				var inputFileImage = document.getElementById("imagefile");
				var file = inputFileImage.files[0];
				if( (typeof file === "object") && (file !== null) )
				{
					$("#load_img").text('Cargando...');	
					var data = new FormData();
					data.append('imagefile',file);
					
					
					$.ajax({
						url: "ajax/imagen_ajax.php",      
						type: "POST",            
						data: data, 			 
						contentType: false,      
						cache: false,             
						processData:false,       
						success: function(data)   
						{
							$("#load_img").html(data);
							
						}
					});	
				}
				
				
			}
    </script>