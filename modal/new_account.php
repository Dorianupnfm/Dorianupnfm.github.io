<form class="form-horizontal form-label-left input_mask" method="post" id="add_account" name="add_account">
   
 <div id="add_accounts" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <div class="modal-content modal-lg">
                        <div class="modal-header">
                            <h4 class="modal-title">Nueva Cuenta</h4>
                        </div>
                        <div id="result_account"></div>
                        <div class="modal-body">
                            <div class="m-b-20">
                                <form>
                                    <div class="row">                      
                                        
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Nombre <span class="text-danger">*</span></label>
                                                <input class="form-control" type="text" name="name" required>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Balance Inicial <span class="text-danger">*</span></label>
                                                <input class="form-control" type="text"  name="balance" pattern="^[0-9]{1,5}(\.[0-9]{0,2})?$" title="Ingresa sólo números con 0 ó 2 decimales" maxlength="8" required>
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



