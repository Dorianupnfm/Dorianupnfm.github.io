<?php
    include "../config/config.php";//Contiene funcion que conecta a la base de datos
    include "../config/funciones.php";//Contiene funciones para gastos, ingresos, trasnferencias y trnasacciones
    
    $action = (isset($_REQUEST['action']) && $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
    if (isset($_GET['id'])){
        $id_expence=intval($_GET['id']);
        $query=mysqli_query($con, "SELECT * from income where id='".$id_expence."'");

        $r=mysqli_fetch_array($query);
        $id=$r['id'];
        $amount=$r['amount'];
        $id_account=$r['account_id'];
		$id_transaction=$r['id_transaction'];
       
       
		updateTransactions($id_transaction,$id_expence,2,0);
		
		updateAccount($id_account,2,$amount,0);
		
		deleteTransactions($id_transaction);
        
            if ($delete1=mysqli_query($con,"DELETE FROM income WHERE id='".$id_expence."'")){
            ?>
            <div class="alert alert-success alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <strong>Aviso!</strong> Datos eliminados exitosamente.
            </div>
    <?php 
        }else{
    ?>
            <div class="alert alert-danger alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <strong>Error!</strong> Lo siento algo ha salido mal intenta nuevamente.
            </div>
<?php
        } //end else
    } //end if
?>
    <?php
    if($action == 'ajax'){
    
         $daterange = mysqli_real_escape_string($con,(strip_tags($_REQUEST['daterange'], ENT_QUOTES)));
		  $category=intval($_REQUEST['category']);
        
         $sTable = "income";
         $sWhere = "";
		
		list ($f_inicio,$f_final)=explode(" - ",$daterange);
			list ($dia_inicio,$mes_inicio,$anio_inicio)=explode("/",$f_inicio);//Extrae fecha inicial 
			$fecha_inicial="$anio_inicio-$mes_inicio-$dia_inicio 00:00:00";//Fecha inicial formato ingles
			list($dia_fin,$mes_fin,$anio_fin)=explode("/",$f_final);//Extrae la fecha final
			$fecha_final="$anio_fin-$mes_fin-$dia_fin 23:59:59";
		
			$sWhere = "where created_at between '$fecha_inicial' and '$fecha_final' ";
		
			if ($category>0){
				$sWhere .=" and category_id='$category'";
			}
			
			
		 
        $sWhere.=" order by created_at desc";
        include 'pagination.php';
        $page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
        $per_page = 10; 
        $adjacents  = 4; 
        $offset = ($page - 1) * $per_page;
        $count_query   = mysqli_query($con, "SELECT count(*) AS numrows FROM $sTable  $sWhere");
        $row= mysqli_fetch_array($count_query);
        $numrows = $row['numrows'];
        $total_pages = ceil($numrows/$per_page);
        $reload = './income.php';
        $sql="SELECT * FROM  $sTable $sWhere LIMIT $offset,$per_page";
        $query = mysqli_query($con, $sql);
        if ($numrows>0){
            
            ?>
            <table class="table table-striped custom-table">
                <thead>
                    <tr class="headings">
                        <th class="column-title">Fecha </th>
                        <th class="column-title">Cuenta </th>
                        <th class="column-title">Categoría </th>
                        <th class="column-title">Descripción </th>
                        <th class="column-title">Cantidad </th>                        
                        <th class="column-title no-link last"><span class="nobr"></span></th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                        while ($r=mysqli_fetch_array($query)) {
                            $id=$r['id'];
                            $created_at=date('d/m/Y', strtotime($r['created_at']));
                            $description=$r['description'];
                            $amount=$r['amount'];
                            $user_id=$r['user_id'];
                            $category_id=$r['category_id'];
                            $account_id =$r['account_id'];

                            $sql = mysqli_query($con, "select * from category_income where id=$category_id");
                            if($c=mysqli_fetch_array($sql)) {
                                $name_category=$c['name'];
                            }

                            $account=mysqli_query($con, "select * from accounts where id=$account_id");
                             $rw=mysqli_fetch_array($account);
                            $account_name=$rw['name'];

                            $coin_name = "coin";
                            $querycoin = mysqli_query($con,"select * from configuration where name=\"$coin_name\" ");
                            if ($r = mysqli_fetch_array($querycoin)) {
                                $coin=$r['val'];
                            }
                ?>
                    <!-- <input type="hidden" value="<?php echo $created_at;?>" id="created_at<?php echo $id;?>"> -->
                    <input type="hidden" value="<?php echo $description;?>" id="description<?php echo $id;?>">
                    <input type="hidden" value="<?php echo $category_id;?>" id="category_id<?php echo $id;?>">
                    <input type="hidden" value="<?php echo number_format($amount,2,'.','');?>" id="amount<?php echo $id;?>">

                    <tr class="even pointer">
                        <td><?php echo $created_at;?></td>
                        <td><?php echo $account_name ?></td>
                        <td><?php echo $name_category;?></td>
                        <td ><?php echo $description; ?></td>
                        <td><?php echo $coin; ?> <?php echo number_format($amount,2);?></td>
                        
                        <td class="text-right">
                            <div class="dropdown dropdown-action">
                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="#" onclick="obtener_datos('<?php echo $id;?>');" data-toggle="modal" data-target="#update_incomes"><i class="fa fa-pencil m-r-5"></i> Editar</a>
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