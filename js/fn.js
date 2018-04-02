$( document ).ready(function() {
	
// function 
function cstr(oj){
try {
if(oj==null||typeof oj=='undefined'|| oj=='null'){
	 oj='';
 }
 return String(oj);
}catch(err){
}
return '';
}
function url2arr(s) {
try {	
try {
if(s.contains('?')){
   s=cstr(s.split('?')[1])
}
if(s.substr(0,1)!='&'){
s='&'+s;
}
}catch(e){}

    s=cstr(s);
    var vars = {};
    var parts = s.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
        vars[key] = value;
    });
    return vars;
}catch(e){alert('f:url2arr error'+e);};
}	
// 
function cpr($t,c){
  try{
	  
  c=c.replace('.','');
  
  var cprloop=cint($t.data('cprloop'))+1;	
  
  $t=$t.parent();
  $t.data('cprloop',cprloop);
  if(!isfound($t) ){
    return null;
  }
  if($t.hasClass(c)){
	  return $t;
  }else{
	  return cpr($t,c);
  }
  
  
  }catch(err){onerror('cpr > click',err);}
}	
	
	
function initevent($fm){
	

$(".postcmd",$fm).unbind("click").bind("click", function() {
var $t=$(this);
var dpr=$t.data('dpr');
var d=url2arr(dpr);
var f=d['f']
var $frm=$(d['formid']);
var data = $frm.serialize();
 $.ajax({
		type: 'POST',
		url: f,
		data:data,
		error:function (xhr, ajaxOptions, thrownError){
        },
		success: function(r){
				alert('success'+r);   
        }
       });
});

$(".callpage",$fm).unbind("click").bind("click", function() {
var $t=$(this);
var pg=$t.data('n');
var $db=$('.dbquery');
    $db.data('page',pg);
	$db.click();								  
});


$(".selectall",$fm).unbind("click").bind("click", function() {
	$t=$(this);
	var b=$t.prop('checked');
	$(".ischeckbox").prop('checked', b );

});	

$(".loadfile",$fm).unbind("click").bind("click", function() {
	var empCode = $('#empCode').val();
	// check empCode
// if ((empCode != '') && (empCode.length == 6) ) {
if ((empCode == '') || (empCode.length == 6) ) {
 var $t=$(this);
 var f=$t.data('f');
 var p=$t.data('p');
 var form=$t.data('form');
 var $p=$(p);
 var datestart=$('#datestart').val();
 var dateend=$('#dateend').val();
 var $frm=$(form);
 
/////Convert date format
 var a=datestart.split('-');
 var b=dateend.split('-');
 datestart=a[1]+'-'+a[0]+'-'+a[2];
 dateend=b[1]+'-'+b[0]+'-'+b[2];
 
 var dpr = $frm.serialize()+"&empCode="+empCode+"&datestart="+datestart+"&dateend="+dateend+"&page="+$t.data('page');
 
////////Preloader
  	var h='<div class="loading"><img src="img/load.gif"></div>';
	$p.html(h);
	
   $p.load(f,dpr,function(){
	$("#btnExport").show();
	  initevent($p);
	});

}else{
	alert('กรุณาระบุรหัสพนักงานให้ถูกต้อง');
	return;
}
});

var outlet = $(':checkbox.chkoutlet').val();

$('.init0',$fm).each(function(){
 var $t=$(this);
     $t.removeClass('init0');
	 $t.click();
});


}

//Key press
$(document).keydown(function(e){
	var empCode = $('#empCode').val();
	// if ((empCode != '') && (empCode.length == 6) ) {
	if ((empCode == '') || (empCode.length == 6) ) {
	var key = event.which || event.charCode || event.keyCode || 0;
	//enter key
	if(key == 13)
	{
		$('#searchbtn').click();
		event.preventDefault();
		
	}
	var h='<div class="loading"><img src="img/preloader.gif"></div>';
	$p.html(h);
	}
});


////Thaicreate Disabled date
	var startDateTextBox = $("#datestart");
	var endDateTextBox = $("#dateend");

	startDateTextBox.datepicker({ 
		dateFormat: 'dd-mm-yy',
		onClose: function(dateText, inst) {
			if (endDateTextBox.val() != '') {
				var testStartDate = startDateTextBox.datetimepicker('getDate');
				var testEndDate = endDateTextBox.datetimepicker('getDate');
				if (testStartDate > testEndDate)
					endDateTextBox.datetimepicker('setDate', testStartDate);
			}
			else {
				endDateTextBox.val(dateText);
			}
		},
		onSelect: function (selectedDateTime){
			endDateTextBox.datetimepicker('option', 'minDate', startDateTextBox.datetimepicker('getDate') );
		}
	});
	endDateTextBox.datepicker({ 
		dateFormat: 'dd-mm-yy',
		onClose: function(dateText, inst) {
			if (startDateTextBox.val() != '') {
				var testStartDate = startDateTextBox.datetimepicker('getDate');
				var testEndDate = endDateTextBox.datetimepicker('getDate');
				if (testStartDate > testEndDate)
					startDateTextBox.datetimepicker('setDate', testEndDate);
			}
			else {
				startDateTextBox.val(dateText);
			}
		},
		onSelect: function (selectedDateTime){
			startDateTextBox.datetimepicker('option', 'maxDate', endDateTextBox.datetimepicker('getDate') );
		}
	});


//Export button
$("#btnExport").hide();


 $("#btnExport").click(function(){
  $("#tblExport").table2excel({
    // exclude CSS class
    exclude: ".noExl",
    name: "Excel Document Name"
  }); 
});

// step 1 bind event 
initevent($('body'));

});