<?php	
	session_start();
	/*Inicia validacion del lado del servidor*/
	if (empty($_POST['date'])) {
           $errors[] = "Fecha vacío";
        } else if (empty($_POST['description'])){
			$errors[] = "Description vacío";
		} else if ($_POST['category']==""){
			$errors[] = "Selecciona la categoria";
		} else if (empty($_POST['amount'])){
			$errors[] = "Cantidad vacío";
		} else if (empty($_POST['account'])){
			$errors[] = "Cuenta a acreditar vacia";
		} else if (
			!empty($_POST['date']) &&
			!empty($_POST['description']) &&
			$_POST['category']!="" &&
			!empty($_POST['amount']) &&
			!empty($_POST['account'])

		){

		include "../config/config.php";//Contiene funcion que conecta a la base de datos
		include "../config/funciones.php";//Contiene funciones para gastos, ingresos, trasnferencias y trnasacciones

		$description=mysqli_real_escape_string($con,(strip_tags($_POST["description"],ENT_QUOTES)));
		$amount=floatval($_POST['amount']);
		$upload_receipt="iimg.png";
		$category=intval($_POST['category']);		
		$user_id=$_SESSION['user_id'];
		$id_account=intval($_POST['account']);

		$date = str_replace('/', '-', $_POST['date']);
		$date_added = date('Y-m-d', strtotime($date));
		

		$sql="INSERT INTO income (description, amount, account_id, user_id, category_id, created_at, id_transaction) VALUES (\"$description\",$amount,$id_account, $user_id,$category,'$date_added','0')";
	
		$reference = getNumberIdIncome();
		$query_new_insert = mysqli_query($con,$sql);
		$income_id=mysqli_insert_id($con);

			if ($query_new_insert){
				$id_transaction= update_income_account($id_account, $amount, $date_added, $reference);
				$upt=mysqli_query($con,"update income set id_transaction='$id_transaction' where id='$income_id'");
				$messages[] = "Tu ingreso ha sido ingresado satisfactoriamente.";
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