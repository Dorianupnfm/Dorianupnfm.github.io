<form class="form-horizontal form-label-left input_mask" id="add_user" name="add_user">   
   <div id="add_users" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <div class="modal-content modal-lg">
                        <div class="modal-header">
                            <h4 class="modal-title">Agregar Usuario</h4>
                        </div>
                         <div id="result_user"></div>
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
                                                <label>Apellido <span class="text-danger">*</span></label>
                                                <input class="form-control" type="text" name="lastname" required>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Correo electónico <span class="text-danger">*</span></label>
                                                <input class="form-control" type="text" name="email" required>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Status <span class="text-danger">*</span></label>
                                                <select class="select" name="status" required>
                                                    <option value="" selected>-- Selecciona estado --</option>
                                                     <option value="1" >Activo</option>
                                                     <option value="0" >Inactivo</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Contraseña <span class="text-danger">*</span></label>
                                                <input class="form-control" type="password" name="password" required>
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








   

