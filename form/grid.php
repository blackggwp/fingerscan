<?php
include '..\script\conn.php';

$q=$_GET;

// echo '<pre>';
// print_r($q);
// echo '</pre>';

$empno=$q['empno'];
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
/*echo "DeviceID = " . $in;
echo "<br><br>" . "UserID =  " .$empno . "<br>" . "<br>". "Date =  " . $date . "<br><br>";*/
$limit=10;
$pg=((int)$q['page'])*$limit;

/*$sql=" SELECT TOP 100 [nUserID],[nDeviceID],[dtDateTime],[strUserName],[DeviceID],[DeviceName] FROM ( SELECT [tb_reportslist].nUserID,[tb_reportslist].nDeviceID,[tb_reportslist].dtDateTime,[DeviceID],[DeviceName],[strUserName], ROW_NUMBER() OVER (ORDER BY [tb_reportslist].nUserID,[tb_reportslist].nDeviceID,[tb_reportslist].dtDateTime) AS RowNumber FROM [hr_scan].[dbo].[tb_reportslist] INNER JOIN [hr_scan].[dbo].[imp_emp] ON tb_reportslist.nUserID = imp_emp.[nUserID] INNER JOIN [hr_scan].[dbo].[Device_sukishi] ON tb_reportslist.nDeviceID = Device_sukishi.[DeviceID] WHERE (CAST(tb_reportslist.dtDateTime AS date)) BETWEEN '".$datestart."' AND '".$dateend."' ) EmployeePage 
WHERE RowNumber BETWEEN ((".$pg." - 1) * ".$limit." + 1) AND (".$pg." * ".$limit.")  ";*/

/*$sql = " SELECT TOP 100 [nUserID],[nDeviceID],[dtDateTime],[strUserName],[DeviceID],[DeviceName]
FROM 
(
	SELECT [tb_reportslist].nUserID,[tb_reportslist].nDeviceID,[tb_reportslist].dtDateTime,[DeviceID],[DeviceName],[strUserName],
    ROW_NUMBER() OVER (ORDER BY [tb_reportslist].nUserID,[tb_reportslist].nDeviceID,[tb_reportslist].dtDateTime) AS RowNumber
    FROM [hr_scan].[dbo].[tb_reportslist]
    INNER JOIN [hr_scan].[dbo].[imp_emp] ON tb_reportslist.nUserID = imp_emp.[nUserID]
	INNER JOIN [hr_scan].[dbo].[Device_sukishi] ON tb_reportslist.nDeviceID = Device_sukishi.[DeviceID]
    WHERE (CAST(tb_reportslist.dtDateTime AS date)) BETWEEN '2015-01-20' AND '2015-01-20'
) EmployeePage
WHERE where r >10 and r < 15 RowNumber BETWEEN ".$pg." AND (".$pg." * ".$limit.")
ORDER BY [nUserID],[nDeviceID],[dtDateTime],[strUserName],[DeviceID],[DeviceName] ";*/

$sql = " SELECT TOP 300 [tb_reportslist].nUserID , 
[tb_reportslist].nDeviceID , 
(CONVERT(NVARCHAR(24),[tb_reportslist].dtDateTime,120))as dtDateTime , 
[imp_emp].strUserName , 
[Device_sukishi].[DeviceName]
FROM [hr_scan].[dbo].[tb_reportslist] 
INNER JOIN [hr_scan].[dbo].[imp_emp] ON tb_reportslist.nUserID = imp_emp.[nUserID]
INNER JOIN [hr_scan].[dbo].[Device_sukishi] ON tb_reportslist.nDeviceID = Device_sukishi.[DeviceID]
WHERE (CONVERT(date, tb_reportslist.dtDateTime)) BETWEEN  '".$q['datestart']."' AND '".$q['dateend']."' ";

 if (!empty($empno)){
	$sql .= " AND tb_reportslist.nUserID = '".$empno."' ";	 
 }
 if (!empty($in)){
	$sql .= " AND tb_reportslist.nDeviceID in (".$in.")";	 
 }
$sql .= " AND (nEvent NOT IN ('23')) order by dtDateTime ";
/*echo $sql . "<hr>";*/
/*echo 'pg= '.$pg.':   limit= '.$limit ;*/

echo "<table class='table table-striped table-hover' id='tblExport'>
		<thead>
			<tr class='rowheader'>
				<th>วันเวลา</th>
				<th>รหัสเครื่องสแกน</th>
				<th>ชื่อสาขา</th>
				<th>รหัสพนักงาน</th>
				<th>ชื่อพนักงาน</th>
			</tr>
		</thead>";
echo "<tbody>";
// while($row = mssql_fetch_assoc($query))
// {
//     echo "<tr class='rowcontent'>";
// 		echo "<td>".date_format(new DateTime($row[dtDateTime]),'d/m/Y - H:i:s')."</td>";
//   		echo "<td>".$row[nDeviceID]."</td>";
// 		echo "<td>".$deviceName = iconv('tis-620','utf-8',$row[DeviceName])."</td>";
// 		echo "<td>".$row[nUserID]."</td>";
// 		echo "<td>".$userName = iconv('tis-620','utf-8',$row[strUserName])."</td>";
//  	echo "</tr>";
// }
foreach ($conn->query($sql) as $row) {
        echo "<tr class='rowcontent'>";
		echo "<td>".date_format(new DateTime($row[dtDateTime]),'d/m/Y - H:i:s')."</td>";
  		echo "<td>".$row[nDeviceID]."</td>";
		echo "<td>".$row[DeviceName]."</td>";
		echo "<td>".$row[nUserID]."</td>";
		echo "<td>".$row[strUserName]."</td>";
 	echo "</tr>";
    }
echo "</tbody>";
echo "</table>";
// mssql_close($connmssql);
?>