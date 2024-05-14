<?php

    include "../config/config.php";//Contiene funcion que conecta a la base de datos
    
    $action = (isset($_REQUEST['action']) && $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
    if (isset($_GET['id'])){
        $account_id=intval($_GET['id']);


        $query_validate=mysqli_query($con,"select account_id from transactions_all where account_id='".$account_id."'");
         $count=mysqli_num_rows($query_validate);
        if ($count==0){

            $query=mysqli_query($con, "SELECT * from accounts where id='".$account_id."'");
            $count=mysqli_num_rows($query);
            if ($delete1=mysqli_query($con,"DELETE FROM accounts WHERE id='".$account_id."'")){
            ?>
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Aviso!</strong> Datos eliminados exitosamente.
                </div>
            <?php 
            }else {
            ?>
                 <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Error!</strong> Lo siento algo ha salido mal intenta nuevamente.
                </div>
            <?php
            } //end else
        }else{
            ?>
            <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Error!</strong> Error al eliminar los datos. La cuenta se encuentra vinculada a una transacción
            </div>
          <?php   
        }    
    } //end if
?>

<?php
    if($action == 'ajax'){
 
        $q = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q'], ENT_QUOTES)));
        $aColumns = array('name');//Columnas de busqueda
        $sTable = "accounts";
        $sWhere = "";
        if ( $_GET['q'] != "" )
        {
            $sWhere = "WHERE (";
            for ( $i=0 ; $i<count($aColumns) ; $i++ )
            {
                $sWhere .= $aColumns[$i]." LIKE '%".$q."%' OR ";
            }
            $sWhere = substr_replace( $sWhere, "", -3 );
            $sWhere .= ')';
        }
        $sWhere.=" order by created_at desc";
        include 'pagination.php'; //include pagination file
        $page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
        $per_page = 10; 
        $adjacents  = 4; 
        $offset = ($page - 1) * $per_page;
        //Numero total de filas en las columnas de la tabla*/
        $count_query   = mysqli_query($con, "SELECT count(*) AS numrows FROM $sTable  $sWhere");
        $row= mysqli_fetch_array($count_query);
        $numrows = $row['numrows'];
        $total_pages = ceil($numrows/$per_page);
        $reload = './accounts.php';
        
        $sql="SELECT * FROM  $sTable $sWhere LIMIT $offset,$per_page";
        $query = mysqli_query($con, $sql);

        if ($numrows>0){
            
            ?>
            <table class="table table-striped custom-table">
                <thead>
                    <tr class="headings">
                        <th class="column-title">Nombre </th>
                        <th class="column-title">Balance  Inicial</th>                       
                        <th class="column-title">Agregado </th>
                        <th class="column-title no-link last"><span class="nobr"></span></th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                        while ($r=mysqli_fetch_array($query)) {
                            $id=$r['id'];                            
                            $name=$r['name'];
                            $balance=$r['balance'];
                            $created_at=date('d/m/Y', strtotime($r['created_at']));

                             $coin_name = "coin";
                            $querycoin = mysqli_query($con,"select * from configuration where name=\"$coin_name\" ");
                            if ($r = mysqli_fetch_array($querycoin)) {
                                $coin=$r['val'];
                            }
                ?>
                    <input type="hidden" value="<?php echo $name;?>" id="name<?php echo $id;?>">
                    <input type="hidden" value="<?php echo $balance;?>" id="balance<?php echo $id;?>">
					

                    <tr class="even pointer">
                        <td><?php echo $name;?></td>
                       <td><?php echo $coin; ?> <?php echo number_format($balance,2);?></td>       
                        <td><?php echo $created_at;?></td>
                        <td class="text-right">
                            <div class="dropdown dropdown-action">
                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="#" onclick="obtener_datos('<?php echo $id;?>');" data-toggle="modal" data-target="#upd_accounts"><i class="fa fa-pencil m-r-5"></i> Editar</a>
                                    <a class="dropdown-item" href="#" onclick="eliminar('<?php echo $id; ?>')"><i class="fa fa-trash-o m-r-5"></i> Eliminar</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                <?php
                    } //end while
                ?>
                <tr>
                    <td colspan=6><span class="pull-right">
                        <?php echo paginate($reload, $page, $total_pages, $adjacents);?>
                    </span></td>
                </tr>
              </table>
            </div>
            <?php
        }else{
           ?> 
            <div class="alert alert-warning alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <strong>Aviso!</strong> No hay datos para mostrar
            </div>
        <?php    
        }
    }
?>