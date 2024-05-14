<form class="form-horizontal form-label-left input_mask" method="post" id="upd_income" name="upd_income">    
	  <div  id="update_incomes" class="modal custom-modal fade  bs-example-modal-lg-udp" role="dialog">
                <div class="modal-dialog">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <div class="modal-content modal-lg">
                        <div class="modal-header">
                            <h4 class="modal-title">Editar Ingreso</h4>
                        </div>
                        <div id="result_income2"></div>
                        <div class="modal-body">
                            <div class="m-b-20">
                                <form>
                                    <div class="row">                                        
                                        <div id="result_expence2"></div>
                                         <input type="hidden" name="mod_id" id="mod_id">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Descripción <span class="text-danger">*</span></label>
                                                <input class="form-control" type="text"name="mod_description" id="mod_description"  required>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Monto <span class="text-danger">*</span></label>
                                                <input class="form-control" type="text"   name="mod_amount" id="mod_amount"  pattern="^[0-9]{1,5}(\.[0-9]{0,2})?$" title="Ingresa sólo números con 0 ó 2 decimales" maxlength="8" required>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Categoría <span class="text-danger">*</span></label>
                                                <select class="form-control" id="mod_category" name="mod_category" required>
                                                    <!-- <option selected="" value="">-- Selecciona Categoria --</option> -->
                                                        <?php $categories = mysqli_query($con,"select * from category_income");
                                                        while ($cat=mysqli_fetch_array($categories)) { ?>
                                                        <option value="<?php echo $cat['id']; ?>" ><?php echo $cat['name']; ?></option>
                                                        <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        
                                    </div>
                                   
                                    <div class="text-right m-t-20">
                                        <button type="button" data-dismiss="modal" class="btn btn-default">Cerrar</button>
                                        <button id="upd_data" type="submit" class="btn btn-primary">Guardar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
    </div>
 </form>	

 

  

