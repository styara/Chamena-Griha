<?php 
	session_start();
	include_once('db_conn.php');
	include_once('../basic_functions.php');
	if(isset($_GET['food_id'])){
		$food_id=$_GET['food_id'];
		$u_id= $_SESSION['u_id'];
		$query0="select sum(status) as value from cart where u_id=$u_id";
		$result0 = mysqli_query($conn, $query0);
		//$nums0=mysqli_num_rows($result0);
		$row0=mysqli_fetch_array($result0);
		if ($row0['value']>0) {
			redirect_to("../customer/customer_cart.php?msg=remove_after_order");
		}

		else{
			$query="delete from `cart` where u_id=$u_id and food_id=$food_id";
			$result = mysqli_query($conn, $query);
			if ($result) {
				//echo "$nums";
				redirect_to("../customer/customer_cart.php");	
			}
			else
				redirect_to("../customer/customer_cart.php?msg=remove_not_success");
		}
	}
?>