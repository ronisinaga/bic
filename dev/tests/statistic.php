<?php require_once('Connections/conn_score.php'); ?>
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

mysql_select_db($database_conn_score, $conn_score);
$query_rs_t_title_list = "SELECT t_dictionary_short, t_dictionary_desc, Jumlah FROM t_dictionary LEFT JOIN  (SELECT t_title_status, COUNT(*) AS Jumlah FROM t_title GROUP BY t_title_status) AS title ON t_dictionary_short = t_title_status WHERE t_dictionary_type = 'TTL' GROUP BY t_dictionary_short ORDER BY t_dictionary_sort";
$rs_t_title_list = mysql_query($query_rs_t_title_list, $conn_score) or die(mysql_error());
$row_rs_t_title_list = mysql_fetch_assoc($rs_t_title_list);
$totalRows_rs_t_title_list = mysql_num_rows($rs_t_title_list);

mysql_select_db($database_conn_score, $conn_score);
$query_rs_t_user_list = "SELECT COUNT(*) AS jmluser FROM t_user WHERE t_user_group < 20";
$rs_t_user_list = mysql_query($query_rs_t_user_list, $conn_score) or die(mysql_error());
$row_rs_t_user_list = mysql_fetch_assoc($rs_t_user_list);
$totalRows_rs_t_user_list = mysql_num_rows($rs_t_user_list);

mysql_select_db($database_conn_score, $conn_score);
$query_Recordset1 = "SELECT * FROM t_dictionary WHERE t_dictionary_type = 'TTL' ORDER BY t_dictionary_sort ASC";
$Recordset1 = mysql_query($query_Recordset1, $conn_score) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Statistic</title>
<link href="mm_health_nutr.css" rel="stylesheet" type="text/css" />
</head>

<body>
<table border="0" align="center" cellpadding="2" cellspacing="0">
<tr>
<td colspan="2"><h2>
<!--<a href="/i2/9000.php" onclick="window.open(this.href,'targetWindow','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,');return false;"><span>LOGIN</span></a> | 
<a href="/i2/9001.php" onclick="window.open(this.href,'targetWindow','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,');return false;"><span>REGISTRASI</span></a>-->
<a href="/users" onClick="window.open(this.href,'targetWindow');return false;"><span>LOGIN</span></a> | 
<a href="/users/general/registrasi" onclick="window.open(this.href,'targetWindow');return false;"><span>REGISTRASI</span></a>
</h2></td>
</tr>
  <tr>
    <td>USER</td>
    <td align="right"><?php echo $row_rs_t_user_list['jmluser']; ?></td>
  </tr>
  <tr>
    <td width="100" align="center"><strong> STATUS </strong></td>
    <td width="25" align="center"><strong> JUMLAH </strong></td>
  </tr>
  <!--<?php $jumlah = 0;?>
  <?php do { ?>
  <?php $jumlah = $jumlah + $row_rs_t_title_list['Jumlah'];?>
    <tr>
      <td title="<?php echo $row_rs_t_title_list['t_dictionary_desc']; ?>"><?php echo $row_rs_t_title_list['t_dictionary_short']; ?></td>
      <td align="right"><?php echo $row_rs_t_title_list['Jumlah']; ?></td>
    </tr>
    <?php } while ($row_rs_t_title_list = mysql_fetch_assoc($rs_t_title_list)); ?>
    <tr>
    <td></td>
    <td align="right"><?php echo $jumlah;?></td>
  </tr>-->
</table>
</body>
</html>
<?php
mysql_free_result($rs_t_title_list);

mysql_free_result($rs_t_user_list);

mysql_free_result($Recordset1);
?>
