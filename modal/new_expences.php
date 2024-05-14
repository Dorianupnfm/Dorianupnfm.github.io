<form class="form-horizontal form-label-left input_mask" method="post" id="add_expence" name="add_expence">    

    <div id="add_expences" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <div class="modal-content modal-lg">
                        <div class="modal-header">
                            <h4 class="modal-title">Nuevo Gasto</h4>
                        </div>
                        <div id="result_expence"></div>
                        
                        <div class="modal-body">
                            <div class="m-b-20">
                                <form>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Cuenta a debitar <span class="text-danger">*</span></label>                                                
                                                <div class="">
                                                    <select class="select2 form-control" name="account" required>                                                  
                                                </select>
                                                </div>
                                            </div>
                                        </div> 
                                        <!-- <input type="hidden" id="account_id" name="account_id"> -->
                                    <div class="col-md-12">   
                                        <div class="form-group">
                                            <label>Fecha <span class="text-danger">*</span></label>
                                            <div class="cal-icon">
                                                 <input class="form-control datetimepicker" type="text" type="date"  name="date" value="<?php echo date("d/m/Y");?>">
                                             </div>
                                        </div>
                                    </div>    
                                        
                                       
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Descripción <span class="text-danger">*</span></label>
                                                <input class="form-control" type="text" name="description" required>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Monto <span class="text-danger">*</span></label>
                                                <input class="form-control" type="text"  name="amount" pattern="^[0-9]{1,5}(\.[0-9]{0,2})?$" title="Ingresa sólo números con 0 ó 2 decimales" maxlength="8" required>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Categoría <span class="text-danger">*</span></label>
                                                <select class="form-control" name="category" required>
                                                    <option selected="" value="">-- Selecciona Categoria --</option>
                                                         <?php
                                                            $categories = mysqli_query($con,"select * from category_expence");
                                                            while ($cat=mysqli_fetch_array($categories)) { ?>
                                                                    <option value="<?php echo $cat['id']; ?>"><?php echo $cat['name']; ?></option>
                                                        <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        
                                    </div>
                                   
                                    <div class="text-right m-t-20">
                                        <button type="button" data-dismiss="modal" class="btn btn-default">Cerrar</button>
                                        <button id="save_data" type="submit" class="btn btn-primary">Guardar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
    </div>

</form> 