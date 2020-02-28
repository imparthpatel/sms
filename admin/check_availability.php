<?php 
//session_start();
require_once("../config.php");
// code for empid availablity
$from='';
$to='';
$place=$_POST['place'];
								
if(!empty($_POST['starttime']) && !empty($_POST['endtime'])) {
		$fd=date_format(date_create($_POST['starttime']),"Y-m-d H:i:s");


		$sql ="SELECT fullName,contactNo,mem_id,start_time,end_time,place FROM booking b,users u WHERE b.mem_id=u.id and start_time<=:fd AND end_time>=:fd";
		$query= $dbh->prepare($sql);
		$query-> bindParam(':fd',$fd, PDO::PARAM_STR);
		$query-> execute();
		$results = $query -> fetchALL(PDO::FETCH_OBJ);
		if($query->rowCount() > 0)
		{
			 foreach ($results as $key) 
       		{
       			$pla=$key->place;
       			$cno=$key->contactNo;
       			$uname=$key->fullName;

       		}
   //     			if($place==$pla)
   //     			{
			
					$from="<span style='color:red'>Slot already booked by $uname Please Contact  $uname on  $cno</span>";
					echo "<script>$('#apply').prop('disabled',true);</script>";
				// }
				// {
						
				//}
		
		}
		else
		{
			
			$from="<span style='color:green'>From avail.</span>";
			echo "<script>$('#apply').prop('disabled',false);</script>";
			if(!empty($_POST['endtime'])) {
				$td=date_format(date_create($_POST['endtime']),"Y-m-d H:i:s");

			
				$sql ="SELECT fullName,contactNo,mem_id,start_time,end_time,place FROM booking b,users u WHERE b.mem_id=u.id and start_time<=:td AND end_time>=:td";
				$query= $dbh->prepare($sql);
				$query-> bindParam(':td',$td, PDO::PARAM_STR);
				$query-> execute();
				$results = $query -> fetchAll(PDO::FETCH_OBJ);

				if($query->rowCount() > 0)
				{
					$to="<span style='color:red'></br>To </span>";
					echo "<script>$('#apply').prop('disabled',true);</script>";
				}
				else
				{
					$sql ="SELECT fullName,contactNo,mem_id,start_time,end_time,place FROM booking b,users u WHERE b.mem_id=u.id and :fd<=start_time AND :td>=end_time";
					$query= $dbh->prepare($sql);
					$query-> bindParam(':fd',$fd, PDO::PARAM_STR);
					$query-> bindParam(':td',$td, PDO::PARAM_STR);
					$query-> execute();
					$results = $query -> fetchAll(PDO::FETCH_OBJ);

					if($query->rowCount() > 0)
					{
						$from="<span style='color:red'>From Date: On Leave.</span>";
						$to="<span style='color:red'></br>To Date: On Leave.</span>";
						echo "<script>$('#apply').prop('disabled',true);</script>";
					}
					else
					{
						$to="<span style='color:green'></br>To Date: Date available for Leave.</span>";
						echo "<script>$('#apply').prop('disabled',false);</script>";
						if(!empty($_POST['fromdate'])&!empty($_POST['todate'])) {
							$fdate=$_POST['fromdate'];
							$tdate=$_POST['todate'];
							if(strtotime($fdate) <= strtotime($tdate)) {
								//echo "<span style='color:green'></br>perfect</span>";
								echo "<script>$('#apply').prop('disabled',false);</script>";
							}
							else{
								$from="<span style='color:red'></br>From Date is bigger than to date</span>";
								$to='';
								echo "<script>$('#apply').prop('disabled',true);</script>";
							}
						}
					} 
				}		
			}
		} 
	echo $from;
	echo $to;
}

?>
