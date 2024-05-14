<?php

	if (empty($_POST['mod_id'])) {
           $errors[] = "ID vacío";
        }else if (empty($_POST['mod_description'])){
			$errors[] = "Descripción vacío";
		} else if ($_POST['mod_category']==""){
			$errors[] = "Selecciona una categoria";
		} else if (empty($_POST['mod_amount'])){
			$errors[] = "Cantidad Vacio";
		} else if (
			!empty($_POST['mod_description']) &&
			!empty($_POST['mod_amount']) &&
			$_POST['mod_category']!=""
		){

		include "../config/config.php";//Contiene funcion que conecta a la base de datos
	    include "../config/funciones.php";//Contiene funciones para gastos, ingresos, trasnferencias y trnasacciones


		$description=mysqli_real_escape_string($con,(strip_tags($_POST["mod_description"],ENT_QUOTES)));
		$mod_amount=floatval($_POST['mod_amount']);
		$category=intval($_POST['mod_category']);
		
		$id_mod=$_POST['mod_id'];

		$query=mysqli_query($con, "SELECT * from income where id='".$id_mod."'");

        $r=mysqli_fetch_array($query);
        $id=$r['id'];
        $amount=$r['amount'];
        $id_account=$r['account_id'];
		$id_transaction=$r['id_transaction'];
	
		updateTransactions($id_transaction,$id,2,$mod_amount);
		
		updateAccount($id_account,2,$amount,$mod_amount);
		
    


		$sql="UPDATE income SET  description=\"$description\", amount=$mod_amount, category_id=$category WHERE id=$id_mod ";
		$query_update = mysqli_query($con,$sql);
			if ($query_update){
				$messages[] = "EL ingreso ha sido actualizado satisfactoriamente.";
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