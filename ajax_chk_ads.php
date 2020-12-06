<?php include ("Include/mysql_open.php");
	$Id=$_GET["Id"];
	//echo $Id;
	$sql_ads_no="update `yg_address` set `ismoren`='0' ";
	$sql_ads_is="update `yg_address` set `ismoren`='1' where `Id`=".$Id;
	$sql_is="select * from `yg_address` where `Id`=".$Id;
	$result_t=mysql_query($sql_ads_no);
	$result_st=mysql_query($sql_ads_is);
	$result_set=mysql_query($sql_is);	
	//echo $sql_is;
	$result_arr_is=mysql_fetch_array($result_set);
	echo "<span>配送至：&nbsp;&nbsp;".$result_arr_is["address_info"]."&nbsp;&nbsp;收货人：</span><strong>".$result_arr_is["name"]."</strong>";
?>