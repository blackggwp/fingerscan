  <html>
    <head>
    	<title>Fingerscan</title>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
      <link rel="stylesheet" type="text/css" href="css/init.css"/>
  	<script type="text/javascript" src="js/jquery.js"></script>
  	<script type="text/javascript" src="js/fn.js"></script>
      
      <link rel="stylesheet" type="text/css" href="jqueryui/jquery-ui.min.css"/>
      <link rel="stylesheet" type="text/css" href="jqueryui/jquery-ui.structure.min.css"/>
      <link rel="stylesheet" type="text/css" href="jqueryui/jquery-ui.theme.min.css"/>
      
  	<script type="text/javascript" src="jqueryui/jquery-ui.min.js"></script>
      <script type="text/javascript" src="jqueryui/jquery-ui-timepicker-addon.min.js"></script>
      
      <script type="text/javascript" src="js/tableToExcel.js"></script>
  	
    </head>
  <body>

  <div id="header">
  	<div class="container">
  	<div class="headerImg"><img src="img/logo.png" width="200" height="110"/></div>
  	</div>
  </div>

  <div class="container">

  	<div class="btnExport"><button id="btnExport">Export to excel</button></div>
    	<p>&nbsp;</p>
  	
    	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <label>
    <input type="checkbox" class="selectall">
    เลือกทั้งหมด
    </label>
    
  <form id="fpost">
    
    <table id="chkoutlet">
      <tr>
        <td>
        
        <div class="chkOutlet">
        	<div id="outlet">
  			<? include 'script/conn.php';
  				$sql = " SELECT [DeviceID],[DeviceName],[Outletcode]
    						 FROM [hr_scan].[dbo].[Device_sukishi] ORDER BY [Outletcode]";
  //               $query = $conn->query($sql);

  // $query=$results2->fetchAll(PDO::FETCH_ASSOC);
    
    				$res = $conn->query($sql);
            $res->execute();
    				echo '<table class="tboutlet">
    				<tr class="tboutlet">
    					<th>&nbsp;</th>
    					<th>Outlet</th>
    				</tr>'; 
    
    			// 	while($row = $res->fetchAll(PDO::FETCH_ASSOC))
    			// 	{
  	  		// 		echo
  					// '<tr class="tdoutlet">
  	  		// 			<td><input type="checkbox" name="outlet[]" class="ischeckbox" value="'.$row[DeviceID].'" id="'.$row[Outletcode].'"></td>
  	  		// 			<td>&nbsp;&nbsp;<strong>'.$row[Outletcode].'</strong>&nbsp;&nbsp;'.$name = iconv('tis-620','utf-8',$row[DeviceName]).'</td>
  	  		// 		</tr>';
    			// 	}
            foreach ($conn->query($sql) as $row) {
              echo
            '<tr class="tdoutlet">
               <td><input type="checkbox" name="outlet[]" class="ischeckbox" value="'.$row[DeviceID].'" id="'.$row[Outletcode].'"></td>
               <td>&nbsp;&nbsp;<strong>'.$row[Outletcode].'</strong>&nbsp;&nbsp;'.$row[DeviceName].'</td>
             </tr>';
            }
    				echo '</table>';?>
           	</div>
        	</td>
         <td class="content">
         <div id="datagrid"></div>
         </td>
      </tr>

      
      <tr class="txtinput">
        <td><div class="divdatestart"><label>จากวันที่&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
        <input type="text" readonly="readonly" class="cstart" id="datestart" value="<?php echo date('d-m-Y'); ?>" /><br></div>
        		
              <div class="divdateend"><label>ถึงวันที่&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
        <input type="text" readonly="readonly" class="cend" id="dateend" value="<?php echo date('d-m-Y'); ?>" /><br></div>
        
      	<div class="empinput"><label>รหัสพนักงาน&nbsp;&nbsp;&nbsp;</label>
          <input type="text" name="empno" id="empno" placeholder="ใส่รหัสพนักงาน.."><br></div>
          
          <div class="search"><a class="loadfile btn btn-primary btn-sm" id="searchbtn"
      	data-f="form/grid.php"
      	data-p="#datagrid"
          data-form="#fpost">ค้นหา</a></div>
          
      </td>
      </tr>
    </table>
  </form>
  </div>

  </body>
  <!-- <footer height="80px">
  	Sukishi 2015&reg;
  </footer> -->
  </html>