<?php require_once('../Connections/cn.php'); ?>
<?php 
if(isset($_GET['id']))
{
	$tt=$_GET['id'];
	$mid=$_GET['mid'];
	$pid=$_GET['pid'];
 	$rr="UPDATE afternoon SET status='Done' where mid='$tt' ";
	mysql_query($rr);
	header('location:detailpatients.php?mid='.$mid.'&pid='.$pid.'&id='.$tt.'');
	
}
?>