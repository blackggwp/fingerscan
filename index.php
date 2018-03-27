<?php date_default_timezone_set('Asia/Bangkok'); ?>
  <html>
    <head>
    	<title>Fingerscan</title>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
  <link rel="stylesheet" href="css/restable.css?<?php echo 'ver=' . filemtime('css/restable.css'); ?>" type="text/css" media="screen, projection" />
  <link rel="stylesheet" href="css/bootstrap.css?<?php echo 'ver=' . filemtime('css/bootstrap.css'); ?>" type="text/css" media="screen, projection" />
  <link rel="stylesheet" href="css/fingerscan.css?<?php echo 'ver=' . filemtime('css/fingerscan.css'); ?>" type="text/css" media="screen, projection" />
  
  <!-- <script type="text/javascript" src="js/jquery.js"></script> -->
  <script type="text/javascript" src="js/jquery3.3.1.js"></script>

  <script type="text/javascript" src="js/fn.js"></script>
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
      
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
  	<div class="headerImg"><a href="../landing.php"><img src="img/logo.png"  width="200" height="110"/></a></div>
  	</div>
  </div>

  <div class="btnExport"><button id="btnExport">นำข้อมูลออก excel</button></div>

<div class="container" id="home_panel">

    <div class="row">
        <div class="col-sm-4">
        <label for="selectall">เลือกทั้งหมด</label>
                <input type="checkbox" class="selectall" name="selectall">
            <div id="outlet_panel">
                    <form id="fpost" name="fpost">
                        <div id="chkoutlet">
        <?php include 'script/conn.php';
  				$sql = " SELECT [DeviceID],[DeviceName],[Outletcode]
    						 FROM [hr_scan].[dbo].[Device_sukishi] ORDER BY [Outletcode]";
    
    				$res = $conn->query($sql);
            $res->execute();
    		echo '<table class="tboutlet" style="border-collapse: inherit;">
    				<thead>
    					<th>Outlet</th>
    				</thead>'; 
            foreach ($conn->query($sql) as $row) {
              echo
            '<tr class="tdoutlet">
               <td>
               <div class="outletRow">
               <input type="checkbox" 
               name="outlet[]" class="ischeckbox" 
               value="'.$row[DeviceID].'" id="'.$row[Outletcode].'">
               <strong>'.$row[Outletcode].' </strong>'.$row[DeviceName].'
               </div>
               </td>
             </tr>';
            }
            echo '</table>';
        ?>
            </div>
        </div>
        <hr>
        <div class="dateAndEmpCode_panel">
            <label for="datestart">จากวันที่</label>
            <br>
            <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" 
            readonly="readonly" class="cstart userInput" id="datestart" value="<?php echo date('d-m-Y'); ?>" />
            <br>
            <label for="dateend">ถึงวันที่</label>
            <br>
            
            <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" 
            readonly="readonly" class="cend userInput" id="dateend" value="<?php echo date('d-m-Y'); ?>" />
            <br>
            <label for="empCode" class="empCode error">รหัสพนักงาน</label>
            <br>
            <input type="number" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" 
            name="empCode" class="userInput" id="empCode" placeholder="ใส่รหัสพนักงาน.." required>
          <!-- <input type="number" name="empCode" class="userInput" id="empCode" placeholder="ใส่รหัสพนักงาน.." required> -->
          <br>
          </div>

        <div class="search">
            <a class="loadfile btn btn-primary btn-lg btn-block" id="searchbtn"
      	data-f="form/grid.php"
      	data-p="#datagrid"
          data-form="#fpost">ค้นหา</a>
        </div>

        </div>
        <div class="col-lg-8">
            <div class="content">
                <div id="datagrid">
                    <!-- form/grid.php -->
                </div>
            </div>
        </div>        
</form>
    </div>

</div>
</body>
</html>