<form class="form-horizontal form-label-left input_mask" id="upd_user" name="upd_user">
     <div id="update_users" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <div class="modal-content modal-lg">
                        <div class="modal-header">
                            <h4 class="modal-title">Editar Usuario</h4>
                        </div>
                         <div id="result_user2"></div>
                        <input type="hidden" id="mod_id" name="mod_id">
                        <div class="modal-body">
                            <div class="m-b-20">
                                <form>
                                    <div class="row">                                        
                                        
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Nombre <span class="text-danger">*</span></label>
                                                <input class="form-control" type="text" name="mod_name" id="mod_name" required>
                                            </div>
                                        </div>                                       
                                       

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Correo electónico <span class="text-danger">*</span></label>
                                                <input class="form-control" type="text" name="mod_email" id="mod_email" required>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Status <span class="text-danger">*</span></label>
                                                <select class="form-control" required name="mod_status" id="mod_status">
                                                    <option value="" selected>-- Selecciona estado --</option>
                                                     <option value="1" >Activo</option>
                                                     <option value="0" >Inactivo</option>  
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Contraseña</label>
                                                <input class="form-control" type="password" id="password" name="password">
                                            </div>
                                            <p class="text-danger">
                                                La contraseña solo se modificara si escribes algo, en caso contrario no se modifica.
                                            </p>
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













  









   

