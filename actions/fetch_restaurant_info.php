<?php
session_start();

if(isset($_GET['r_index']) && (int)$_GET['r_index']>=0)
{
	print_r($_SESSION['retrieved_restaurants'][$_GET['r_index']]);
}
?>