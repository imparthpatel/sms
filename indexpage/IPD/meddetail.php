<?php require_once('../Connections/cn.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}
mysql_select_db($database_cn, $cn);
$query_Recordset1 = "SELECT * FROM `p_medicine` join `patient` on `patient`.`pid`=`p_medicine`.`pid` WHERE (`created_time` > DATE_SUB(date(now()), INTERVAL 1 DAY)) and `patient`.`gender`='Female' ORDER BY id desc";
$Recordset1 = mysql_query($query_Recordset1, $cn) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Doct Connect</title>
<link href="css/plugins/pace/pace.css" rel="stylesheet">
<link href="css/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">

<link href="icons/font-awesome/css/font-awesome.min.css" rel="stylesheet">
<!-- PAGE LEVEL PLUGIN STYLES -->
<link href="css/plugins/messenger/messenger.css" rel="stylesheet">
<link href="css/plugins/messenger/messenger-theme-flat.css" rel="stylesheet">
<link href="css/plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet">
<link href="css/plugins/morris/morris.css" rel="stylesheet">
<link href="css/plugins/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet">
<link href="css/plugins/datatables/datatables.css" rel="stylesheet">
<!-- THEME STYLES - Include these on every page. -->
<link href="css/style.css" rel="stylesheet">
<link href="css/plugins.css" rel="stylesheet">
<link href="css/demo.css" rel="stylesheet">
<script src="js/jquery-2.1.1.min.js"></script>
<script src="js/plugins/bootstrap/bootstrap.min.js"></script>
<script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script src="js/plugins/popupoverlay/jquery.popupoverlay.js"></script>
<script src="js/plugins/popupoverlay/defaults.js"></script>
<!-- PAGE LEVEL PLUGIN SCRIPTS -->
<script src="js/plugins/datatables/jquery.dataTables.js"></script>
<script src="js/plugins/datatables/datatables-bs3.js"></script>
<!-- THEME SCRIPTS -->
<script src="js/flex.js"></script>
<script src="js/demo/advanced-tables-demo.js"></script>
<script language="javascript">
$(document).on("click", ".open-AddBookDialog1", function (e) {

	e.preventDefault();

	var _self = $(this);

	var myBookId = _self.data('id');
	/*$("#bookId").val(myBookId);*/
	var g=_self.data('id');/*
$("#themeid").val(_self.data('kb'));
*/
   $.get("detailcertificate.php", {recordID:eval(g)}, function (data) {
                    $("#dta1").html(data);
                });
	$(_self.attr('href')).modal('show');
});
</script>
</head>
<body>
<?php include("header.php")?>
<?php include("sidebar.php")?>
<div id="page-wrapper">
  <div class="page-content">
    <div class="row">
      <div class="col-lg-12">
        <div class="page-title">
          <h1> All Patients </h1>
          <ol class="breadcrumb">
            <li><i class="fa fa-dashboard"></i> <a href="index.php">Dashboard</a> </li>
            <li class="active"> Manage Patients </li>
          </ol>
        </div>
      </div>
      <!-- /.col-lg-12 --> 
    </div>
    <!-- /.row --> 
    <!-- end PAGE TITLE ROW --> 
    <!-- begin MAIN PAGE ROW -->
    <div class="row"> 
      <!-- begin LEFT COLUMN -->
      <div class="col-lg-12">
        <div class="row"> 
          <!-- Basic Form Example -->
          <div class="col-lg-12">
            <div class="portlet portlet-default">
              <div class="portlet-heading">
                <div class="portlet-title">
                  <h4 style="float:left"> Patient Details </h4>
                </div>
                <div class="clearfix"></div>
              </div>
              <div id="basicFormExample" class="panel-collapse collapse in">
                <div class="portlet-body">
                  <?php if($totalRows_Recordset1>0) {  ?>
                  <table id="example-table" class="table table-striped table-bordered table-hover table-green">
                    <thead>
                      <tr>
                        <td>Patient</td>
                        <td>Medicine</td>
                        
                        <td>Action</td>
                      </tr>
                    </thead>
                    <tbody>
                      <?php do { ?>
                        <tr>
                          <td><?php $hj=$row_Recordset1['pid'];
						  mysql_select_db($database_cn, $cn);
$query_Recordset1a = "SELECT * FROM patient where pid='$hj'";
$Recordset1a = mysql_query($query_Recordset1a, $cn) or die(mysql_error());
$row_Recordset1a = mysql_fetch_assoc($Recordset1a);
$totalRows_Recordset1a = mysql_num_rows($Recordset1a);
echo $row_Recordset1a['fname'].' '.$row_Recordset1a['mname'].' '.$row_Recordset1a['lname'];
						  
						   ?>&nbsp; </td>
                          <td><?php 
						  $tt=$row_Recordset1['mid'];
						  mysql_select_db($database_cn, $cn);
$query_Recordset2 = "SELECT name FROM medicine where mid='$tt'";
$Recordset2 = mysql_query($query_Recordset2, $cn) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);
				echo $row_Recordset2['name'];	  
						  ?>&nbsp; </td>
                          
                          <?php 

/*date_default_timezone_set('Asia/Calcutta');
if (!function_exists('findage'))
{
function findage($dob)
{
    $localtime = getdate();
    $today = $localtime['mday']."-".$localtime['mon']."-".$localtime['year'];
    $dob_a = explode("-", $dob);
    $today_a = explode("-", $today);
    $dob_d = $dob_a[0];$dob_m = $dob_a[1];$dob_y = $dob_a[2];
    $today_d = $today_a[0];$today_m = $today_a[1];$today_y = $today_a[2];
    $years = $today_y - $dob_y;
    $months = $today_m - $dob_m;
    if ($today_m.$today_d < $dob_m.$dob_d) 
    {
        $years--;
        $months = 12 + $today_m - $dob_m;
    }

    if ($today_d < $dob_d) 
    {
        $months--;
    }

    $firstMonths=array(1,3,5,7,8,10,12);
    $secondMonths=array(4,6,9,11);
    $thirdMonths=array(2);

    if($today_m - $dob_m == 1) 
    {
        if(in_array($dob_m, $firstMonths)) 
        {
            array_push($firstMonths, 0);
        }
        elseif(in_array($dob_m, $secondMonths)) 
        {
            array_push($secondMonths, 0);
        }elseif(in_array($dob_m, $thirdMonths)) 
        {
            array_push($thirdMonths, 0);
        }
    }


    echo " $years ";


}
}
findage($row_Recordset1['bdate']);*/ //put date in the dd-mm-yyyy format
?>
                          
                          <td><a   class="btn btn-success" href="detailpatients.php?mid=<?php echo $row_Recordset1['mid']; ?>&amp;pid=<?php echo $row_Recordset1['pid']; ?>&amp;id=<?php echo $row_Recordset1['id']; ?>" style="height:auto;width:auto"><i class="fa fa-paperclip"> Details</i></a> 
                          
                          
                                      
                          
                          
                          
                           
                         
                        
						
						  
                         
						      
                          </td>
                        </tr>
                        <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
                    </tbody>
                  </table>
                  <?php } else {  ?>
                  <label class="alert-danger"> NO DATA FOUND </label>
                  <?php } ?>
                </div>
              </div>
            </div>
            <!-- /.portlet --> 
          </div>
        </div>
        <!-- /.row (nested) --> 
        
        <!-- Modal -->
        
        <div id="myModal1" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
          <div class="modal-body" id="dta1"> </div>
        </div>
        
        
      </div>
    </div>
  </div>
</div>
<!-- Button to trigger modal --> 

<script src="js/plugins/bootstrap/bootstrap.min.js"></script> 
<script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script> 
<script src="js/plugins/popupoverlay/jquery.popupoverlay.js"></script> 
<script src="js/plugins/popupoverlay/defaults.js"></script> 
<script src="js/plugins/popupoverlay/logout.js"></script> 
<!-- HISRC Retina Images --> 
<script src="js/plugins/hisrc/hisrc.js"></script> 
<!-- PAGE LEVEL PLUGIN SCRIPTS --> 
<!-- HubSpot Messenger --> 
<script src="js/plugins/messenger/messenger.min.js"></script> 
<script src="js/plugins/messenger/messenger-theme-flat.js"></script> 
<!-- Date Range Picker --> 
<script src="js/plugins/daterangepicker/moment.js"></script> 
<script src="js/plugins/daterangepicker/daterangepicker.js"></script> 
<!-- Morris Charts --> 
<script src="js/plugins/morris/raphael-2.1.0.min.js"></script> 
<script src="js/plugins/morris/morris.js"></script> 
<!-- Flot Charts --> 
<script src="js/plugins/flot/jquery.flot.js"></script> 
<script src="js/plugins/flot/jquery.flot.resize.js"></script> 
<!-- Sparkline Charts --> 
<script src="js/plugins/sparkline/jquery.sparkline.min.js"></script> 
<!-- Moment.js --> 
<script src="js/plugins/moment/moment.min.js"></script> 
<!-- jQuery Vector Map --> 
<script src="js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script> 
<script src="js/plugins/jvectormap/maps/jquery-jvectormap-world-mill-en.js"></script> 
<script src="js/demo/map-demo-data.js"></script> 
<!-- Easy Pie Chart --> 
<script src="js/plugins/easypiechart/jquery.easypiechart.min.js"></script> 
<!-- DataTables --> 
<script src="js/plugins/datatables/jquery.dataTables.js"></script> 
<script src="js/plugins/datatables/datatables-bs3.js"></script> 
<!-- THEME SCRIPTS --> 
<script src="js/flex.js"></script> 
<script src="js/demo/dashboard-demo.js"></script>
</body>
</html>
<?php
mysql_free_result($Recordset1);

mysql_free_result($Recordset2);
?>
