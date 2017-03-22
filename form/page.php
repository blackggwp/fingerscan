<?php

include '../script/conn.php';

$q=$_GET;
/*print_r($q);*/

/*$sql = " SELECT TOP 100 *
FROM 
(
	SELECT [tb_reportslist].nUserID,[tb_reportslist].nDeviceID,[tb_reportslist].dtDateTime,[DeviceID],[DeviceName],[strUserName],
    ROW_NUMBER() OVER (ORDER BY [tb_reportslist].nUserID,[tb_reportslist].nDeviceID,[tb_reportslist].dtDateTime) AS RowNumber
    FROM [hr_scan].[dbo].[tb_reportslist]
    INNER JOIN [hr_scan].[dbo].[imp_emp] ON tb_reportslist.nUserID = imp_emp.[nUserID]
	INNER JOIN [hr_scan].[dbo].[Device_sukishi] ON tb_reportslist.nDeviceID = Device_sukishi.[DeviceID]
    WHERE (CAST(tb_reportslist.dtDateTime AS date)) BETWEEN  '2014-12-12' AND '2014-12-12'
) EmployeePage
WHERE RowNumber > '1' AND RowNumber <= '50'
ORDER BY [nUserID],[nDeviceID],[dtDateTime],[strUserName],[DeviceID],[DeviceName] ";*/

$sql=" SELECT TOP 100 [tb_reportslist].nUserID , 
[tb_reportslist].nDeviceID , 
[tb_reportslist].dtDateTime , 
[imp_emp].strUserName , 
[imp_emp].[nUserID],
[Device_sukishi].[DeviceID] ,
[Device_sukishi].[DeviceName]
FROM [hr_scan].[dbo].[tb_reportslist]
INNER JOIN [hr_scan].[dbo].[imp_emp] ON tb_reportslist.nUserID = imp_emp.[nUserID]
INNER JOIN [hr_scan].[dbo].[Device_sukishi] ON tb_reportslist.nDeviceID = Device_sukishi.[DeviceID]
WHERE (CAST(tb_reportslist.dtDateTime AS date)) BETWEEN  '".$datestart."' AND '".$dateend."' ";

$query = mssql_query($sql);
$totalrow = mssql_num_rows($query);

$limit=10;

echo '<h4>Totalrow = '.$totalrow.'</h4>';
//echo "Limit = $limit<br>";

$page=ceil($totalrow/$limit);

for($i=1; $i<=$page; $i++){
if($i==1){
 echo '<ul class="pagination">
 			<li class="callpage init0" data-n="',$i,'"><a href="#">',$i,'</a>
		</ul>';
}else {
 echo '<ul class="pagination">
 			<li class="callpage btn-group"  data-n="',$i,'"><a href="#">',$i,'</a>
		</ul>';
}
}

mssql_close($connmssql);
?>