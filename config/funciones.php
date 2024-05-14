<?php


function update_income_account($id_account, $credit, $date, $reference){
	global $con;//Variable de conexion
	$sql=mysqli_query($con,"select * from accounts where id='".$id_account."'");
		$rw=mysqli_fetch_array($sql);
		$old_qty=$rw['balance'];//Cantidad encontrada en la cuenta
		$new_qty=$old_qty+$credit;//Nueva cantidad en la cuenta
		$update=mysqli_query($con,"UPDATE accounts SET balance='".$new_qty."' WHERE id='".$id_account."'");

		//Actualizo la nueva cantidad en la cuenta


	//inserto en la tabla de transacciones, asi guardar el movimiento realizado en la cuenta, sea ingreso, egreso y/o transferencias
	$sql2=mysqli_query($con,"insert into  transactions_all (date_transaction, description, account_id, reference_delete, type_transaction, credit, balance) VALUES ('$date', 'INGRESOS REALIZADOS',  $id_account, '$reference', 2, $credit, $new_qty)");	
	return $id_transaction=mysqli_insert_id($con);	
	
}

function update_expences_account($id_account, $debit, $date, $reference){
	global $con;//Variable de conexion
	$sql=mysqli_query($con,"select * from accounts where id='".$id_account."'");
		$rw=mysqli_fetch_array($sql);
		$old_qty=$rw['balance'];//Cantidad encontrada en la cuenta
		$new_qty=$old_qty-$debit;//Nueva cantidad en la cuenta
		$update=mysqli_query($con,"UPDATE accounts SET balance='".$new_qty."' WHERE id='".$id_account."'");//Actualizo la nueva cantidad en la cuenta




	//inserto en la tabla de transacciones, asi guardar el movimiento realizado en la cuenta, sea ingreso, egreso y/o transferencias
	$sql2=mysqli_query($con,"insert into  transactions_all (date_transaction, description, account_id, reference_delete, type_transaction, debit, balance) VALUES ('$date', 'EGRESOS REALIZADOS',  $id_account, $reference, 1, $debit, $new_qty)");	
	return $id_transaction=mysqli_insert_id($con);	
}

// actualizar el balance despues de realizar transferencias a la cuenta a debitar
function update_transfer_account_expences($id_account, $debit, $date, $reference){
	global $con;//Variable de conexion
	$sql=mysqli_query($con,"select * from accounts where id='".$id_account."'");
		$rw=mysqli_fetch_array($sql);
		$old_qty=$rw['balance'];//Cantidad encontrada en la cuenta
		$new_qty=$old_qty-$debit;//Nueva cantidad en la cuenta
		$update=mysqli_query($con,"UPDATE accounts SET balance='".$new_qty."' WHERE id='".$id_account."'");//Actualizo la nueva cantidad en la cuenta


		// $id_transfer = getNumberIdTranfer();


	$sql2=mysqli_query($con,"insert into  transactions_all (date_transaction, description, account_id, reference_delete, type_transaction, debit, balance) VALUES ('$date', 'TRANSFERENCIAS REALIZADAS',  $id_account, '$reference', 1, $debit, $new_qty)");	
		
}



// actualizar el balance despues de realizar transferencias a la cuenta a acreditar
function update_income_account_incomes($id_account, $credit, $date, $reference){
	global $con;//Variable de conexion
	$sql=mysqli_query($con,"select * from accounts where id='".$id_account."'");
		$rw=mysqli_fetch_array($sql);
		$old_qty=$rw['balance'];//Cantidad encontrada en la cuenta
		$new_qty=$old_qty+$credit;//Nueva cantidad en la cuenta
		$update=mysqli_query($con,"UPDATE accounts SET balance='".$new_qty."' WHERE id='".$id_account."'");//Actualizo la nueva cantidad en la cuenta


		// $id_transfer = getNumberIdTranfer();


	$sql2=mysqli_query($con,"insert into  transactions_all (date_transaction, description, account_id, reference_delete, type_transaction, credit, balance) VALUES ('$date', 'TRANSFERENCIAS RECIBIDAS',  $id_account, '$reference', 2, $credit, $new_qty)");	
}


function updateAccountAfterDeleteIncome($id_account, $amount, $id_reference){
	global $con;//Variable de conexion
	$sql=mysqli_query($con,"select * from accounts where id='".$id_account."'");
		$rw=mysqli_fetch_array($sql);
		$old_qty=$rw['balance'];//Cantidad encontrada en la cuenta
		$new_qty=$old_qty-$amount;//Nueva cantidad en la cuenta
		$update=mysqli_query($con,"UPDATE accounts SET balance='".$new_qty."' WHERE id='".$id_account."'");//Actualizo la nueva cantidad en la cuenta


	//elimino de la tabla de transacciones el ingreso
	$sql2=mysqli_query($con," DELETE FROM transactions_all WHERE account_id='$id_account' and  reference_delete= '$id_reference'");
		
}


function updateAccountAfterDeleteEpence($id_account, $amount, $id_reference){
	global $con;//Variable de conexion
	$sql=mysqli_query($con,"select * from accounts where id='".$id_account."'");
		$rw=mysqli_fetch_array($sql);
		$old_qty=$rw['balance'];//Cantidad encontrada en la cuenta
		$new_qty=$old_qty+$amount;//Nueva cantidad en la cuenta
		$update=mysqli_query($con,"UPDATE accounts SET balance='".$new_qty."' WHERE id='".$id_account."'");//Actualizo la nueva cantidad en la cuenta


	//elimino de la tabla de transacciones el egreso
	$sql2=mysqli_query($con," DELETE FROM transactions_all WHERE account_id='$id_account' and  reference_delete= '$id_reference'");
		
}

function updateAccountAfterDeleteTransfer($amount, $id_reference, $from, $to){

	global $con;//Variable de conexion
	$sql=mysqli_query($con,"select * from accounts where id='".$from."'");
		$rw=mysqli_fetch_array($sql);
		$old_qty=$rw['balance'];//Cantidad encontrada en la cuenta
		$new_qty=$old_qty+$amount;//Nueva cantidad en la cuenta
		$update=mysqli_query($con,"UPDATE accounts SET balance='".$new_qty."' WHERE id='".$from."'");//Actualizo la nueva cantidad en la cuenta


	//elimino de la tabla de transacciones el ingreso
	$sql2=mysqli_query($con," DELETE FROM transactions_all WHERE account_id='$from' and  reference_delete= '$id_reference'");




	$sql3=mysqli_query($con,"select * from accounts where id='".$to."'");
		$rw=mysqli_fetch_array($sql3);
		$old_qty=$rw['balance'];//Cantidad encontrada en la cuenta
		$new_qty=$old_qty-$amount;//Nueva cantidad en la cuenta
		$update=mysqli_query($con,"UPDATE accounts SET balance='".$new_qty."' WHERE id='".$to."'");//Actualizo la nueva cantidad en la cuenta


	//elimino de la tabla de transacciones el ingreso
	$sql4=mysqli_query($con," DELETE FROM transactions_all WHERE account_id='$to' and  reference_delete= '$id_reference'");


}




function getNumberIdIncome(){
	global $con;
	$sql=mysqli_query($con,"select id from income order by id desc limit 1");
	$rw=mysqli_fetch_array($sql); 
	$id = (isset($rw['id']) && $rw['id'] !=NULL)?$rw['id']:0;

	
	return $id+1;
		
}

function getNumberIdExpence(){
	global $con;
	$sql=mysqli_query($con,"select id from expenses order by id desc limit 1");	
		$rw=mysqli_fetch_array($sql); 
		//$id=$rw['id'];
		$id = (isset($rw['id']) && $rw['id'] !=NULL)?$rw['id']:0;
	
	return $id+1;
		
}

function getNumberIdTranfer(){
	global $con;
	$sql=mysqli_query($con,"select id from accounts_transfers order by id desc limit 1");	
	$rw=mysqli_fetch_array($sql); 
	$id=$rw['id'];	
	
	return $id;
}

// function getPreviousBalanceTransaction($amount,$account_id,$id_reference){

// 	global $con;


// 	$sql001 = mysqli_query($con, "SELECT * FROM transactions_all where account_id='$account_id' and reference_delete = '$id_reference'");


// 	$r0001 = mysqli_fetch_array($sql001);
// 	$arrayid= $r0001['id_transaction'];	
// 	$credit =$r0001['credit'];


	
// 	print($arrayid . '\n');

		
// 	$sql=mysqli_query($con," UPDATE transactions_all SET credit='$amount' where account_id='$account_id' and id_transaction = '$arrayid'");


// 	$sql002 = mysqli_query($con, "SELECT * FROM transactions_all where account_id = '$account_id' and id_transaction >='$arrayid'");

// 	$prev = $amount - $credit;

	

// 	while ($trans = mysqli_fetch_array($sql002, MYSQLI_ASSOC)) {
// 		$id = $trans["id_transaction"];
// 		$balanceFinal=$trans['credit'] + $prev;
// 		$sql5=mysqli_query($con," UPDATE transactions_all SET balance=$balanceFinal WHERE account_id='$account_id' and id_transaction= $id");
// 		$prev = $balanceFinal;
// 	}


	

// }//cierre de la funcion

function getPreviousBalanceTransaction($amount,$account_id,$id_reference){

	global $con;

	$sql001 = mysqli_query($con, "SELECT * FROM transactions_all where account_id='$account_id' and reference_delete = '$id_reference'");


	$r0001 = mysqli_fetch_array($sql001);
	$arrayid= $r0001['id_transaction'];	
	$credit =$r0001['credit'];
	$balance =$r0001['balance'];

	print_r($balance);

	$sql003 = mysqli_query($con, "SELECT * FROM transactions_all where account_id='$account_id' and id_transaction < '$arrayid' limit 1");

	$r03 = mysqli_fetch_array($sql003);
	$arrayid2= $r03['id_transaction'];	
	$balance2 =$r03['balance'];

	$result = $balance2 + $amount;	
		
	$sql=mysqli_query($con," UPDATE transactions_all SET credit='$amount', balance='$result' where account_id='$account_id' and id_transaction = '$arrayid'");

	$sql001 = mysqli_query($con, "SELECT * FROM transactions_all where account_id='$account_id' and reference_delete = '$id_reference'");


	$r0001 = mysqli_fetch_array($sql001);	
	$balance3 =$r0001['balance'];
	print_r($balance3);

	$sql002 = mysqli_query($con, "SELECT * FROM transactions_all where account_id = '$account_id'and id_transaction>'$arrayid'");

	$prev = $balance3;
	

	while ($trans = mysqli_fetch_array($sql002)) {
		$id = $trans["id_transaction"];
		$creditRow=$trans['credit'];
		$debit=$trans['debit'];

		$balanceFinal = ($creditRow-$debit)+$prev;
		// print_r($id);
		$sql5=mysqli_query($con," UPDATE transactions_all SET balance=$balanceFinal WHERE account_id='$account_id' and id_transaction= $id");
		$prev = $balanceFinal;
			
	}


	updateAccountStatement($account_id);

}//cierre de la funcion


function updateAccountStatement($account_id){

	global $con;//Variable de conexion

	$query = mysqli_query($con, "SELECT * FROM  transactions_all WHERE account_id='$account_id'  ORDER by id_transaction DESC LIMIT 1");

	$result = mysqli_fetch_array($query);
	$balance =$result['balance'];

	$query2 = mysqli_query($con, "UPDATE  accounts SET balance='$balance' WHERE id='$account_id'");


}


//Actualizar datos de la cuenta

function updateAccount($account_id,$type,$actual,$new){
	global $con;//Variable de conexion
	
	if ($type==1){
		$balance=getRow('accounts','balance','id',$account_id);
		$balance_new=($balance+$actual) - $new;
		$update=mysqli_query($con,"update accounts set balance='$balance_new' where id='$account_id'");
	}elseif ($type==2){
		$balance=getRow('accounts','balance','id',$account_id);
		$balance_new=($balance-$actual) + $new;
		$update=mysqli_query($con,"update accounts set balance='$balance_new' where id='$account_id'");
	}
}


function getRow($table,$row,$id,$equal){
	global $con;
	$query=mysqli_query($con,"select $row from $table where $id='$equal'");
	$rw=mysqli_fetch_array($query);
	return $rw[$row];
}

function updateTransactions($id_transaction,$id,$type,$new){
	global $con;
	$sql="select * from transactions_all where id_transaction='$id_transaction'";
	$query=mysqli_query($con,$sql);
	if ($type==1){
		$sql="select * from transactions_all where id_transaction='$id_transaction'";
		$rw=mysqli_fetch_array($query);
		$balance= $rw['balance'];
		$debit= $rw['debit'];
		
		
		$balance_new=($balance+$debit) - $new;
		$update=mysqli_query($con,"update transactions_all set balance='$balance_new', debit='$new' where id_transaction='$id_transaction'");
		
		
		$balance_anterior=$balance_new;
	}elseif ($type==2){
		$sql="select * from transactions_all where id_transaction='$id_transaction'";
		$rw=mysqli_fetch_array($query);
		
		 $balance= $rw['balance'];
		  $credit= $rw['credit'];
		 $new;
		
		$balance_new=($balance-$credit) + $new;
		 
		$update=mysqli_query($con,"update transactions_all set balance='$balance_new', credit='$new' where id_transaction='$id_transaction'");
		
		
		$balance_anterior=$balance_new;
	}
		$account_id= $rw['account_id'];
		$sql2=mysqli_query($con,"select * from transactions_all where id_transaction>'$id_transaction' and account_id='$account_id'");
		while ($r=mysqli_fetch_array($sql2)){
			if ($r['type_transaction']==1){
				
				$debit=$r['debit'];
				$id_transaction= $r['id_transaction'];
				$balance_anterior=$balance_anterior-$debit;
				$update=mysqli_query($con,"update transactions_all set balance='$balance_anterior' where id_transaction='$id_transaction'");
			} else if ($r['type_transaction']==2){
				$credit= $r['credit'];
				$id_transaction= $r['id_transaction'];
				$balance_anterior=$balance_anterior+$credit;
				$update=mysqli_query($con,"update transactions_all set balance='$balance_anterior' where id_transaction='$id_transaction'");
			}
			
		}
	
}

function deleteTransactions($id_transaction){
	global $con;
	$sql=mysqli_query($con,"delete from transactions_all where id_transaction='$id_transaction'");
}

?>