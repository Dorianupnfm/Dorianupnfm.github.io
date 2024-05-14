<?php	
	session_start();
	/*Inicia validacion del lado del servidor*/
	if (empty($_POST['account_from'])) {
           $errors[] = "cuenta a debitar vacía";
        } else if (empty($_POST['account_to'])){
			$errors[] = "cuenta destino vacía";
		} else if (empty($_POST['date'])){
			$errors[] = "fecha vacía";
		} 
		 else if (empty($_POST['amount'])){
			$errors[] = "monto vacío";
		} 		  
		 else if (			
			!empty($_POST['account_from'])&&
			!empty($_POST['account_to']) &&
			!empty($_POST['date']) &&
			!empty($_POST['amount'])
		){

		include "../config/config.php";//Contiene funcion que conecta a la base de datos
		include "../config/funciones.php";//Contiene funciones para gastos, ingresos, trasnferencias y trnasacciones

		
		$account_from=intval($_POST['account_from']);
		$account_to=intval($_POST['account_to']);		
		$amount=floatval($_POST['amount']);
		$created_at=date("Y-m-d H:i:s");
		$user_id=$_SESSION['user_id'];	
		$note=mysqli_real_escape_string($con,(strip_tags($_POST["note"],ENT_QUOTES)));	
		$date = str_replace('/', '-', $_POST['date']);
		$date_added = date('Y-m-d', strtotime($date));


			
			if($account_to== $account_from){
				$errors[]= " la cuenta a debitar no puede se la misma que la cuenta destino".mysqli_error($con);

				
			}
			else{
				$reference=time()."-3";
				$sql="INSERT INTO accounts_transfers (account_from_id, account_to_id, datetransfer, amount, note, user_id, created_at, reference) VALUES ('$account_from',$account_to, '$date_added', '$amount','$note' ,'$user_id', '$created_at','$reference')";
				


				$query_new_insert = mysqli_query($con,$sql);

					if ($query_new_insert){
						$id_transfer_from = getNumberIdTranfer();

						update_transfer_account_expences($account_from, $amount, $date_added, $reference);

						$id_transfer_to = getNumberIdTranfer();

						update_income_account_incomes($account_to, $amount, $date_added,  $reference);
						
						$messages[] = "Transferencia realizada satisfactoriamente.";
					} else{
						$errors []= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error($con);
					}
			
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
				<div class="alert alert-success alert-dismissible fade show" role="alert">
						<strong>¡Bien hecho!</strong>
						<?php
						foreach ($messages as $message) {
							echo $message;
						}
						?>
						<span class="close2" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</span>
				</div>
				<?php
			}

?>