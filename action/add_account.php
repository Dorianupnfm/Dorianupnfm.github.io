<?php	
	session_start();
	/*Inicia validacion del lado del servidor*/
	if (empty($_POST['name'])) {
           $errors[] = "Nombre vacío";
        } else if (empty($_POST['balance'])){
			$errors[] = "balance vacío";
		} else if (
			!empty($_POST['name']) &&
			!empty($_POST['balance'])
		){

		include "../config/config.php";
		$name=mysqli_real_escape_string($con,(strip_tags($_POST["name"],ENT_QUOTES)));
		$balance=floatval($_POST['balance']);		
		$created_at=date("Y-m-d H:i:s");
		$user_id=$_SESSION['user_id'];		

			$sql="INSERT INTO accounts (name, balance, user_id, created_at) VALUES ('$name',$balance,'$user_id', '$created_at')";
			$query_new_insert = mysqli_query($con,$sql);
				if ($query_new_insert){
					$messages[] = "La cuenta ha sido ingresada satisfactoriamente.";
				} else{
					$errors []= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error($con);
				}
			
		}else{
			$errors []= "Error desconocido.";
		}
		
		if (isset($errors)){
			
			?>
			<div class="alert alert-danger" role="alert">
				<button type="button" class="close2" data-dismiss="alert">&times;</button>
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