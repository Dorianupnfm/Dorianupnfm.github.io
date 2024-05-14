<?php
    include "../config/config.php";//Contiene funcion que conecta a la base de datos
    
    $action = (isset($_REQUEST['action']) && $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
    
    if($action == 'ajax' && $_REQUEST['account_id'] !=0){
    
   $daterange = mysqli_real_escape_string($con,(strip_tags($_REQUEST['daterange'], ENT_QUOTES)));
	 $account_id=intval($_REQUEST['account_id']);
         $type=intval($_REQUEST['type']);
        
         $sTable = "transactions_all";
         $sWhere = "";
		
		list ($f_inicio,$f_final)=explode(" - ",$daterange);//Extrae la fecha inicial y la fecha final en formato espa?ol
			list ($dia_inicio,$mes_inicio,$anio_inicio)=explode("/",$f_inicio);//Extrae fecha inicial 
			$fecha_inicial="$anio_inicio-$mes_inicio-$dia_inicio 00:00:00";//Fecha inicial formato ingles
			list($dia_fin,$mes_fin,$anio_fin)=explode("/",$f_final);//Extrae la fecha final
			$fecha_final="$anio_fin-$mes_fin-$dia_fin 23:59:59";
		
			$sWhere = "where date_transaction between '$fecha_inicial' and '$fecha_final' ";
            if ($account_id>0){
                $sWhere .=" and account_id='$account_id'";
            }

            if ($type>0){
                $sWhere .=" and type_transaction='$type'";
            }
		
			
			
		 
        $sWhere.=" order by id_transaction asc";
        include 'pagination.php'; //include pagination file
        //pagination variables
        $page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
        $per_page = 10; 
        $adjacents  = 4; 
        $offset = ($page - 1) * $per_page;
        //Numero total de las filas en la tabla*/
        $count_query   = mysqli_query($con, "SELECT count(*) AS numrows FROM $sTable  $sWhere");
        $row= mysqli_fetch_array($count_query);
        $numrows = $row['numrows'];
        $total_pages = ceil($numrows/$per_page);
        $reload = './account_statement_report.php';
        
        $sql="SELECT * FROM  $sTable $sWhere ";

        $query = mysqli_query($con, $sql);

        if ($numrows>0){
            
            ?>
            <table class="table table-striped custom-table">
                <thead>
                    <tr class="">
                        <th class="column-title">Fecha</th>
                        <th class="column-title">Cuenta</th>
                        <th class="column-title">Descripción</th>
                        <th class="column-title">Débito</th> 
                        <th class="column-title">Crédito</th>               
                        <th class="column-title">Balance</th>
                        
                        
                    </tr>
                </thead>
                <tbody>
                <?php 
                        $sumador_total=0;
                        $sumador_total_debit=0;
                        $sumador_total_crebit=0;
						$nums=1;
                        while ($r=mysqli_fetch_array($query)) {
                         $date=date('d/m/Y', strtotime($r['date_transaction']));      
                            $account_id=$r['account_id'];
                            $type=$r['type_transaction'];
                            $description=$r['description'];
                            $debit=$r['debit'];
                            $credit=$r['credit'];                            
                            $balance=$r['balance'];
							
                            $sql = mysqli_query($con, "select * from accounts where id=$account_id");
                            if($r=mysqli_fetch_array($sql)) {
                                $name_account=$r['name'];
                            }                           

                            $coin_name = "coin";
                            $querycoin = mysqli_query($con,"select * from configuration where name=\"$coin_name\" ");
                            if ($r = mysqli_fetch_array($querycoin)) {
                                $coin=$r['val'];
                            }

                            if ($type==1) {
                                $type_name ="DÉBITO";
                                $style= "color:#f62d51;";
                                $text="-";
                                
                            }else{
                                $type_name ="CRÉDITO";
                                $style= "";
                                $text="";
                                
                            }

                            $sql = mysqli_query($con, "select * from accounts where id=$account_id");
                            if($r=mysqli_fetch_array($sql)) {
                                $name_account=$r['name'];
                            } 
							if ($type==1){
								$balance_inicial=$balance-$debit;
							} else {
								$balance_inicial=$balance-$credit;
							}
							
                ?>
                    <!-- <input type="hidden" value="<?php echo $created_at;?>" id="created_at<?php echo $id;?>"> -->
                    <input type="hidden" value="<?php echo $description;?>" id="description<?php echo $id;?>">
                    <input type="hidden" value="<?php echo $category_id;?>" id="category_id<?php echo $id;?>">
                    <!-- <input type="hidden" value="<?php echo number_format($amount,2,'.','');?>" id="amount<?php echo $id;?>"> -->
					
                    <tr class="even pointer">
                        <td><?php echo $date;?></td>
                        <td><?php echo $name_account;?></td>
                        <td><?php echo $description;?></td>
                        <!-- <td ><?php echo $type_name;?></td> -->
                        <td style="<?php echo $style;?>"><?php echo $text; echo $coin; ?> <?php echo number_format($debit,2);?></td>
                        <td><?php echo $coin; ?> <?php echo number_format($credit,2);?></td>
                        <td ><?php  echo $coin; ?> <?php echo number_format($balance,2); ?></td>                       
                    </tr>


                    
                <?php
                $sumador_total+=$balance;
                $sumador_total_debit+=$debit;
                $sumador_total_crebit+=$credit;
				$nums++;
                    } //end while
                ?>
                    <tr>

                        <td colspan="3"> <b> <h5>Total</b> </h5></td> 
                        <td> <h5 > <b><?php echo number_format($sumador_total_debit,2);?></b></h5></td>
                        <td> <h5 > <b><?php echo number_format($sumador_total_crebit,2);?></b></h5></td>  
                        <td> <h5 > <b><?php echo number_format($balance,2);?></b></h5></td>
                    </tr>
                
                
                        <?php echo paginate($reload, $page, $total_pages, $adjacents);?>
                    </span></td>
                </tr>
            </table>
            </div>
            <?php
        }else{ ?> 
            <div class="alert alert-warning alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>Aviso!</strong> No hay datos para mostrar
            </div>
        <?php    
        }
    }
?>