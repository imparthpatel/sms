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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "fcat")) {
  $updateSQL = sprintf("UPDATE doctor_chg SET dnm=%s, chg=%s WHERE id=%s",
                       GetSQLValueString($_POST['dnm'], "text"),
                       GetSQLValueString($_POST['chg'], "double"),
                       GetSQLValueString($_GET['id'], "int"));

  mysql_select_db($database_cn, $cn);
  $Result1 = mysql_query($updateSQL, $cn) or die(mysql_error());

  $updateGoTo = "visit_doctor.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_Recordset1 = "-1";
if (isset($_GET['id'])) {
  $colname_Recordset1 = $_GET['id'];
}
mysql_select_db($database_cn, $cn);
$query_Recordset1 = sprintf("SELECT * FROM doctor_chg WHERE id = %s", GetSQLValueString($colname_Recordset1, "int"));
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
<script src="js/jquery-2.1.1.min.js"></script>
<script src="js/flex.js"></script>
<script src="js/demo/advanced-tables-demo.js"></script>
<script src="js/plugins/datatables/jquery.dataTables.js"></script>
<script src="js/plugins/datatables/datatables-bs3.js"></script>
<script type="text/javascript" language="javascript" >
	function makeupper(obj)
	{
	
	
	var f=document.getElementById(obj).value;
	 
document.getElementById(obj).value=f.toUpperCase();
	 
	}
	function  getc(id)
	{
	
if( confirm('Are you sure you want to delete?'))
{

 window.location='medicine_type.php?did='+id;
    

}
else
{
return false;
}
}
	
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
          <h1>Doctor Visit   <small>Charges</small> </h1>
          
        </div>
      </div>
      <!-- /.col-lg-12 --> 
    </div>
    <!-- /.row --> 
    <!-- end PAGE TITLE ROW --> 
    <!-- begin MAIN PAGE ROW -->
    <div class="row"> 
      <!-- begin LEFT COLUMN -->
      <div class="col-lg-6">
        <div class="row"> 
          <!-- Basic Form Example -->
          <div class="col-lg-12">
            <div class="portlet portlet-default">
              <div class="portlet-heading">
                <div class="portlet-title">
                  <h4>Doctor Form</h4>
                </div>
				

                <div class="portlet-widgets"> <a data-toggle="collapse" data-parent="#accordion" href="#basicFormExample"><i class="fa fa-chevron-down"></i></a> </div>
                <div class="clearfix"></div>
              </div>
              <div id="basicFormExample" class="panel-collapse collapse in">
                <div class="portlet-body">
                  <form role="form" name="fcat" action="<?php echo $editFormAction; ?>" method="POST">
                    <table align="center" class="table-responsive table-condensed table-bordered table ">
                      <div class="form-group">
                        <tr valign="baseline">
                          <td nowrap align="left"><label for="exampleInputEmail1">Doctor Name</label></td>
                          <td><input name="dnm" type="text" required class="form-control" id="exampleInputEmail1" placeholder="Enter Doctor Name" onblur="makeupper(this.id);" value="<?php echo $row_Recordset1['dnm']; ?>"  /></td>
                      </div>
                      
                      
                      <div class="form-group">
                        <tr valign="baseline">
                          <td nowrap align="left"><label for="exampleInputEmail1">Amount</label></td>
                          <td><input name="chg" type="text" required class="form-control" id="exampleInputEmail1" placeholder="Enter Doctor Charges" onblur="makeupper(this.id);" value="<?php echo $row_Recordset1['chg']; ?>"  /></td>
                      </div>
                     
                      </tr>
                      
                      <tr valign="baseline">
                        <td nowrap colspan="2" align="center"><button type="submit"  class="btn btn-default">Save</button></td>
                      </tr>
                    </table>
                    <?php if(isset($_GET['msg'])){ 
					$hh=$_GET['msg'];
					?>
                    <?php if($hh=="s"){ ?>
                    <label class="alert alert-success" >Created Successfully </label>
                    <?php } ?>
                    <?php if($hh=="d"){ ?>
                    <label class="alert alert-success" >Deleted Successfully </label>
                    <?php } ?>
                    <?php if($hh=="e"){ ?>
                    <label class="alert alert-success" >Updated Successfully </label>
                    <?php } ?>
                    <?php }?>
                    <input type="hidden" name="MM_insert" value="fcat">
                    <input type="hidden" name="MM_update" value="fcat" />
                  </form>
                </div>
              </div>
            </div>
            <!-- /.portlet --> 
          </div>
        </div>
        <!-- /.row (nested) --> 
      </div>
      
      <!-- Bordered Responsive Table -->
      
      
    </div>
  </div>
</div>
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

<!-- THEME SCRIPTS --> 
<script src="js/flex.js"></script> 
<script src="js/demo/dashboard-demo.js"></script>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
