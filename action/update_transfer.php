<?php	
	session_start();
	/*Inicia validacion del lado del servidor*/
	if (empty($_POST['date'])){
			$errors[] = "fecha vacía";
		} 
		 else if (empty($_POST['amount'])){
			$errors[] = "monto vacío";
		} 		  
		 else if (			
			!empty($_POST['date']) &&
			!empty($_POST['amount'])
		){

		include "../config/config.php";//Contiene funcion que conecta a la base de datos
		include "../config/funciones.php";//Contiene funciones para gastos, ingresos, trasnferencias y trnasacciones

	
		$id=intval($_POST['id']);				
		$amount=floatval($_POST['amount']);
		$created_at=date("Y-m-d H:i:s");
		$user_id=$_SESSION['user_id'];	
		$note=mysqli_real_escape_string($con,(strip_tags($_POST["note"],ENT_QUOTES)));	
		$date = str_replace('/', '-', $_POST['date']);
		$date_added = date('Y-m-d', strtotime($date));
		
		
		$query=mysqli_query($con, "SELECT * from accounts_transfers where id='".$id."'");

        $r=mysqli_fetch_array($query);
        $id=$r['id'];
        $amount_actual=$r['amount'];
        $account_from_id=$r['account_from_id'];
		$account_to_id=$r['account_to_id'];
		$reference=$r['reference'];
		
		$sql1=mysqli_query($con,"select * from  transactions_all where account_id='$account_from_id' and reference_delete='$reference'");
		$rw1=mysqli_fetch_array($sql1);
		$id_transaction=$rw1['id_transaction'];
		updateTransactions($id_transaction,$id,1,$amount);
		updateAccount($account_from_id,1,$amount_actual,$amount);
		
		$sql2=mysqli_query($con,"select * from  transactions_all where account_id='$account_to_id' and reference_delete='$reference'");
		$rw2=mysqli_fetch_array($sql2);
	    $id_transaction=$rw2['id_transaction'];
		
		updateTransactions($id_transaction,$id,2,$amount);
		updateAccount($account_to_id,2,$amount_actual,$amount);
		


			
				$sql="UPDATE  accounts_transfers SET  datetransfer=\"$date_added\",  amount=$amount,  note=\"$note\"
				    WHERE  id=$id";

			


				$query_new_insert = mysqli_query($con,$sql);

					if ($query_new_insert){
						$messages[] = "Transferencia modificada satisfactoriamente.";
					} else{
						$errors []= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error($con);
					}
			
			
	} else {
			$errors []= "Error desconocido.";
		}
		if (isset($errors)){
			
			?>
			<div class="alert alert-danger" role="alert">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>Error!</strong> 
					<?php
						foreach ($errors as $error) {
								echo $error;
							}
						?>
			</div>
			<?php
			}
			if (isset($messages)){
				
				?>
				<div class="alert alert-success" role="alert">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<strong>¡Bien hecho!</strong>
						<?php
							foreach ($messages as $message) {
									echo $message;
								}
							?>
				</div>
				<?php
			}

?>