<?php
include '..\script\conn.php';
date_default_timezone_set('Asia/Bangkok');
$q=$_GET;
// echo '<pre>';
// print_r($q);
// echo '</pre>';

$empCode=$q['empCode'];
$date=$q['date'];

$outlet=$q['outlet'];

$in='';
if(!empty($outlet)) {
foreach($outlet as $o){
 $in.="'".$o."',";
}
}
if($in!=''){
$in=substr($in,0,-1);
}
$limit=10;
$pg=((int)$q['page'])*$limit;

$sql = " SELECT [tb_reportslist].nUserID , 
[tb_reportslist].nDeviceID , 
(CONVERT(NVARCHAR(24),[tb_reportslist].dtDateTime,120))as dtDateTime , 
[imp_emp].strUserName , 
[Device_sukishi].[DeviceName]
FROM tb_reportslist INNER JOIN
    Device_sukishi ON tb_reportslist.nDeviceID = Device_sukishi.DeviceID LEFT OUTER JOIN
	imp_emp ON tb_reportslist.nUserID = imp_emp.nUserID
WHERE (CONVERT(date, tb_reportslist.dtDateTime)) BETWEEN  '".$q['datestart']."' AND '".$q['dateend']."' ";

 if (!empty($empCode)){
	$sql .= " AND tb_reportslist.nUserID = '".$empCode."' ";	 
 }
 if (!empty($in)){
	$sql .= " AND tb_reportslist.nDeviceID in (".$in.")";	 
 }
$sql .= " AND (nEvent NOT IN ('23')) order by dtDateTime ";
// echo $sql . "<hr>";
/*echo 'pg= '.$pg.':   limit= '.$limit ;*/
if ($numRows != 0) {
	# code...
}


						
$table = "<div class='table-responsive'>
		<table class='resp_table table table-striped table-hover' id='tblExport'>
		<thead>
			<tr class='rowheader'>
				<th>วันเวลา</th>
				<th>รหัสเครื่องสแกน</th>
				<th>ชื่อสาขา</th>
				<th>รหัสพนักงาน</th>
				<th>ชื่อพนักงาน</th>
			</tr>
		</thead>";
$table .= "<tbody>";

$numRows = 0;
foreach ($conn->query($sql) as $row) {
	$numRows++;
		$table .= "<tr class='rowcontent'>";
		$table .= "<td data-th=\"DateTime\">".date_format(new DateTime($row[dtDateTime]),'d/m/Y - H:i:s')."</td>";
  		$table .= "<td data-th=\"Device\">".$row[nDeviceID]."</td>";
		$table .= "<td data-th=\"DeviceName\">".$row[DeviceName]."</td>";
		$table .= "<td data-th=\"UserID\">".$row[nUserID]."</td>";
		$table .= "<td data-th=\"UserName\">".$row[strUserName]."</td>";
 	$table .= "</tr>";
    }
$table .= "</tbody>";
$table .= "</table>";
$rows = "<div style='float:right;'><h3>จำนวนแถว: ".$numRows."</h3></div>";
echo $rows;
echo $table;
?>