<?php 
function sum_incomes_month($month){
	global $con;
	$year=date('Y');
	$sql=mysqli_query($con,"select SUM(amount) as total from income where year(created_at) = '$year' and month(created_at)= '$month' ");
	$rw=mysqli_fetch_array($sql);
	echo $total=number_format($rw['total'],2,'.','');
	}
function sum_expenses_month($month){
	global $con;
	$year=date('Y');
	$sql=mysqli_query($con,"select SUM(amount) as total from expenses where year(created_at) = '$year' and month(created_at)= '$month' ");
	$rw=mysqli_fetch_array($sql);
	echo $total=number_format($rw['total'],2,'.','');
	}
?>