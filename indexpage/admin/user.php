<?php require_once('../Connections/cn.php'); ?>
<?php
if(!isset($_SESSION['MM_Username']))
{
header('login.php');
}
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = (!get_magic_quotes_gpc()) ? addslashes($theValue) : $theValue;

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "adduser")) {

		$path=$_FILES["pic"]["name"];
		move_uploaded_file($_FILES["pic"]["tmp_name"],'userpic/'.$path);
		
  $insertSQL = sprintf("INSERT INTO user (fullname, gender, birthdate, address, city, contact, email, img , type) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['fullname'], "text"),
                       GetSQLValueString($_POST['gender'], "text"),
                       GetSQLValueString($_POST['birthdate'], "text"),
                       GetSQLValueString($_POST['address'], "text"),
                       GetSQLValueString($_POST['city'], "text"),
                       GetSQLValueString($_POST['contact'], "text"),
                       GetSQLValueString($_POST['email'], "text"),
					   
					   GetSQLValueString($path, "text"),
					   
					   GetSQLValueString($_POST['type'], "text"));

  mysql_select_db($database_cn, $cn);
  $Result1 = mysql_query($insertSQL, $cn) or die(mysql_error());

  $insertGoTo = "userlist.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_cn, $cn);
$query_select_usercat_list_rs = "SELECT * FROM usercategory";
$select_usercat_list_rs = mysql_query($query_select_usercat_list_rs, $cn) or die(mysql_error());
$row_select_usercat_list_rs = mysql_fetch_assoc($select_usercat_list_rs);
$totalRows_select_usercat_list_rs = mysql_num_rows($select_usercat_list_rs);
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
               <h1>Add New Employee </h1>
               <ol class="breadcrumb">
                 <li><i class="fa fa-dashboard"></i> <a href="index.php">Home</a> </li>
                 <li class="active">User</li>
               </ol>
             </div>
           </div>
           <!-- /.col-lg-12 --> 
         </div>
         <div class="row"> 
           <!-- begin LEFT COLUMN -->
           <div class="col-lg-12">
             <div class="row"> 
               <!-- Basic Form Example -->
               <div class="col-lg-12">
                 <div class="portlet portlet-default">
                   <div class="portlet-heading">
                     <div class="portlet-title">
                       <h4>Add Employee</h4>
                     </div>
                     <div class="portlet-widgets"> <a data-toggle="collapse" data-parent="#accordion" href="#basicFormExample"><i class="fa fa-chevron-down"></i></a> </div>
                     <div class="clearfix"></div>
                   </div>
                   <div id="basicFormExample" class="panel-collapse collapse in">
                     <div class="portlet-body">
                       <form method="POST" action="<?php echo $editFormAction; ?>" role="form" name="adduser" enctype="multipart/form-data" >
                         <table align="center" class="table-responsive table-condensed table-bordered table ">
                         <tr valign="baseline">
                           <td nowrap align="left"><strong>Full Name:</strong></td>
                           <td><input type="text" class="form-control" name="fullname" onblur="makeupper(this.id);" id="exampleInputEmail1" placeholder="Enter Full Name"></td>
                           <td nowrap align="left"><strong>Gender:</strong></td>
                           <td><input type="radio" name="gender" value="Male"  />
                             Male
                             <input type="radio" name="gender" Value="Female" />
                             Female </td>
                         </tr>
                         <tr valign="baseline">
                           <td nowrap align="left"><strong> Birth Date:</strong></td>
                           <td><input type="date" name="birthdate" class="form-control" onblur="makeupper(this.id);" id="exampleInputEmail1" placeholder="Bith Date"></td>
                           <td nowrap align="left"><strong> Address:</strong></td>
                           <td><textarea name="address" onblur="makeupper(this.id);" id="add" class="form-control" placeholder="Enter Address" cols="10" rows="3" ></textarea></td>
                         </tr>
                         <tr valign="baseline">
                           <td nowrap align="left"><strong> City:</strong></td>
                           <td><input type="text"  name="city" onblur="makeupper(this.id);" id="city" class="form-control" id="exampleInputEmail1" placeholder="Enter City"></td>
                           <td nowrap align="left"><strong> Contact:</strong></td>
                           <td><input type="number"  name="contact" class="form-control" onblur="makeupper(this.id);" id="contact" id="exampleInputEmail1" placeholder="Enter Contact Number"></td>
                         </tr>
                         <tr valign="baseline">
                           <td nowrap align="left"><strong> Email Id:</strong></td>
                           <td><input type="email" name="email"  class="form-control" onblur="makeupper(this.id);" id="email"  id="exampleInputEmail1" placeholder="Enter Email Id"></td>
                           <td nowrap align="left"><strong> Image:</strong></td>
                           <td><input type="file" name="pic" class="form-control" ></td>
                         </tr>
                         <tr valign="baseline">
                           <td nowrap align="left" ><strong> Select Employee Type:</strong></td>
                           <td><select class="form-control" name="type">
                               <option>----Select----</option>
                               <?php
do {  
?>
                               <option value="<?php echo $row_select_usercat_list_rs['name']?>"><?php echo $row_select_usercat_list_rs['name']?></option>
                               <?php
} while ($row_select_usercat_list_rs = mysql_fetch_assoc($select_usercat_list_rs));
  $rows = mysql_num_rows($select_usercat_list_rs);
  if($rows > 0) {
      mysql_data_seek($select_usercat_list_rs, 0);
	  $row_select_usercat_list_rs = mysql_fetch_assoc($select_usercat_list_rs);
  }
?>
                             </select></td>
                         </tr>
                         <tr>
                           <td colspan="4" align="center" ><button type="submit" class="btn btn-default">Submit</button></td>
                         </tr>
                         <input type="hidden" name="MM_insert" value="adduser">
                       </form>
                     </div>
                   </div>
                 </div>
                 <!-- /.portlet --> 
               </div>
             </div>
             <!-- /.row (nested) --> 
           </div>
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
mysql_free_result($select_usercat_list_rs);
?>
