<?php
/*
UserSpice 4
An Open Source PHP User Management System
by Curtis Parham and Dan Hoover at http://UserSpice.com

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/
?><?php require_once("includes/userspice/us_header.php"); ?>

<?php require_once("includes/userspice/us_navigation.php"); ?>

<?php if (!securePage($_SERVER['PHP_SELF'])){die();} ?>
<?php
//PHP Goes Here!
$userID = Input::get('id');

$userQ = $db->query("SELECT * FROM users WHERE id = ?",array($userID));
$thisUser = $userQ->first();

$grav = get_gravatar(strtolower(trim($thisUser->email)));

$profileQ = $db->query("SELECT * FROM profiles WHERE user_id = ?",array($userID));

$thisProfile = $profileQ->first();
//Uncomment out the 2 lines below to see what's available to you.
// dump($thisUser);
// dump($thisProfile);
?>


<html>
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>Diamondback</title>
	<link rel="shortcut icon" type="image/png" href="/media/images/favicon.png">
	<link rel="stylesheet" type="text/css" href="bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="dataTables.bootstrap.min.css">
<link rel="stylesheet" href="jquery-ui.css">
    <link rel="stylesheet" href="jquery.dataTables.min.css">

    
	<style type="text/css" class="init">
		#tabs { 
    padding: 0px; 
    background: none; 
    border-width: 0px; 
} 
#tabs .ui-tabs-nav { 
    padding-left: 0px; 
    background: transparent; 
    border-width: 0px 0px 1px 0px; 
    -moz-border-radius: 0px; 
    -webkit-border-radius: 0px; 
    border-radius: 0px; 
} 
#tabs .ui-tabs-panel { 
  
  
    border-width: 0px 1px 1px 1px; 
}
        
        .ui-widget-content{
          background:white !important;
        }
        
        form { display: block; margin: 20px auto; background: #eee; border-radius: 10px; padding: 15px }

.progress { position:relative; width:400px; border: 1px solid #ddd; padding: 1px; border-radius: 3px; }
.bar { background-color: #B4F5B4; width:0%; height:20px; border-radius: 3px; }
.percent { position:absolute; display:inline-block; top:3px; left:48%; }
        

/* Start by setting display:none to make this hidden.
   Then we position it in relation to the viewport window
   with position:fixed. Width, height, top and left speak
   for themselves. Background we set to 80% white with
   our animation centered, and no-repeating */
.modal {
    display:    none;
    position:   fixed;
    z-index:    1000;
    top:        0;
    left:       0;
    height:     100%;
    width:      100%;
    background: rgba( 255, 255, 255, .8 ) 
                url('http://i.stack.imgur.com/FhHRx.gif') 
                50% 50% 
                no-repeat;
}

/* When the body has the loading class, we turn
   the scrollbar off with overflow:hidden */
body.loading {
    overflow: hidden;   
}

/* Anytime the body has the loading class, our
   modal element will be visible */
body.loading .modal {
    display: block;
}
     
#fade {
    display: none;
    position:absolute;
    top: 0%;
    left: 0%;
    width: 100%;
    height: 100%;
    background-color: #ababab;
    z-index: 1001;
    -moz-opacity: 0.8;
    opacity: .70;
    filter: alpha(opacity=80);
}

#modal {
    display: none;
    position: absolute;
    top: 45%;
    left: 45%;
    width: 100px;
    height: 100px;
    padding:30px 15px 0px;
    border: 3px solid #ababab;
    box-shadow:1px 1px 10px #ababab;
    border-radius:20px;
    background-color: white;
    z-index: 1002;
    text-align:center;
    overflow: auto;
}
        
        table.dataTable span.highlight {
  background-color: #FFFF88;
}

select {
            color: black !important
        }
        
        
                
        table.dataTable tbody th, table.dataTable tbody td{
        
        font-family: 	Arial, Verdana, sans-serif;
	color:		#0000FF;
	font-size:	10px;
        }

.btn{
 widtch:20px !important;
}

        
	</style>
        

 <link href="jquery-ui.css" rel="stylesheet">
      <script src="jquery-1.11.3.min.js"></script>
     
      
	
	
	<script type="text/javascript" language="javascript" src="jquery.dataTables.min.js">
	</script>
	<script type="text/javascript" language="javascript" src="dataTables.bootstrap.min.js">
	</script>
<script src="jquery-ui.js"></script>

<script src="aws-sdk-2.2.21.min.js"></script>
    <script src="jquery.form.js"></script>
    	<script type="text/javascript" language="javascript" src="jquery.highlight.js"></script>
    <script type="text/javascript" language="javascript" src="dataTables.searchHighlight.min.js"></script>
    
    
	<script type="text/javascript" class="init">
var dialog;



$( document ).ready(function() {
	 $body = $("body");

    $(document).on({
        ajaxStart: function() { $body.addClass("loading");    },
         ajaxStop: function() { $body.removeClass("loading"); }    
    });
    
    
    $( "#fromdate" ).datepicker({changeMonth: true, changeYear: true, defaultDate: new Date()}).attr('readonly', 'true').
keypress(function(event){
  if(event.keyCode == 8){
    event.preventDefault();
  }
});
    $( "#todate" ).datepicker({changeMonth: true, changeYear: true, defaultDate: new Date()}).attr('readonly', 'true').
keypress(function(event){
  if(event.keyCode == 8){
    event.preventDefault();
  }
});
    document.getElementById("uploader").innerHTML='<object type="text/html" height="100%" width="100%" data="upload.html" ></object>';
    
});
        
        
    $(document)
  .ajaxStart(function () {
   openModal();
  })
  .ajaxStop(function () {
    closeModal();
  });    


$(function() {


    $( "#myTabs" ).tabs();
    populateSchedule();
    populateCron();
    
     $('#ui-id-3').click(function(){loadTable(true);});
    
});
        
   
       
        
        
        
        
        
    var dialog;    
$(function() {
    var form,
 
      // From http://www.whatwg.org/specs/web-apps/current-work/multipage/states-of-the-type-attribute.html#e-mail-state-%28type=email%29
      emailRegex = /^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/,
      name = $( "#name" ),
      email = $( "#email" ),
      password = $( "#password" ),
      allFields = $( [] ).add( name ).add( email ).add( password ),
      tips = $( ".validateTips" );
 
    function updateTips( t ) {
      tips
        .text( t )
        .addClass( "ui-state-highlight" );
      setTimeout(function() {
        tips.removeClass( "ui-state-highlight", 1500 );
      }, 500 );
    }
 
    
 
    function checkRegexp( o, regexp, n ) {
      if ( !( regexp.test( o.val() ) ) ) {
        o.addClass( "ui-state-error" );
        updateTips( n );
        return false;
      } else {
        return true;
      }
    }
 
    
 
    dialog = $( "#dialog-form" ).dialog({
      autoOpen: false,
      height: 500,
      width: 600,
      modal: true,    
      
    });
 
    
 
    $( "#create-user" ).button().on( "click", function() {
      dialog.dialog( "open" );
    });
  });        
        
        

var processSearch = function(){
    
    
    
    var data = "{\"hospital\":\""+$("#hospital").val() + "\",\"workstation\":\"" + $("#workstation").val()+"\",\"procedureId\":\""+$("#procid").val()+"\",\"sfprocedureId\":\""+$("#sfprocid").val()+"\",\"fromDate\":\""+$("#fromdate").val()+"\",\"toDate\":\""+$("#todate").val()+"\"}";
    
  
   $.ajax({
        type: "POST",
        url: "/diamondback/app/search",
        data: data,
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        success: function(fdata){processTable(fdata);}, 
        failure: function(errMsg) {
            alert(errMsg);
        }
  });
}
var table;
var table4script;
var selectedProcedure;        
var selected = [];  
function processTable(fdata){
    selected = [];
    if(fdata.data.length==0){
        alert("No data found for your query");
        
    }
    if(table){
        table.destroy();
    }
 
 table = $('#example').DataTable( {
  			aaData: fdata.data,
            "scrollX": true,
            searchHighlight: true,
            "columnDefs": [ {
            "targets": -3,
            "data": null,
            "defaultContent": "<button id='download'>Download!</button>"
        },
            {
            "targets": -2,
            "data": null,
            "defaultContent": ""
            },
            {
            "targets": -1,
            "data": null,
            "defaultContent": ""
            }]
      
            
		} );
    
   
    
    $('#example tbody').on('click', 'tr', function () {
        
        var data = table.row( $(this) ).data();
        
        var index = $.inArray(data[5], selected);
 
        if ( index === -1 ) {
            selected.push( data[5] );
        } else {
            selected.splice( data[5], 1 );
        }
       
 
        $(this).toggleClass('selected');
    } );
    
     $('#example tbody').on( 'click', '#download', function () {
        var data = table.row( $(this).parents('tr') ).data();
        //alert(data[4]);
        location.href = "/diamondback/app/download/"+data[5]; 
    } );
    
  

}
        
function executeScript(){

        if(selected.length == 0){
            alert("Please execute the query and select a row");
            return;
        }
        loadTable(false);
         dialog.dialog( "open" );

}

function loadTable(standalone){
    

$.ajax({
        type: "GET",
        url: "/diamondback/app/list/script",
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        success: function(fdata){porcessScriptTable(fdata.data,standalone);}, 
        failure: function(errMsg) {
            alert(errMsg);
        }
      });


}
var scheduleTable;
        
function porcessScriptTable(data,standalone){
   
		if(table4script){
               table4script.destroy();
            }
         if(standalone){
             
         table4script = $('#scriptTable_standalone').DataTable( {
  			aaData: data,
             searchHighlight: true,
            "columnDefs": [ {
            "targets": -3,
            "data": null,
            "defaultContent": "<button id='scriptDownload_standalone'>Download!</button>"
            },
            {
            "targets": -2,
            "data": null,
            "defaultContent": ""
            },
            {
            "targets": -1,
            "data": null,
            "defaultContent": ""
            }
            
           ]
         });
             
              $('#scriptTable_standalone tbody').on( 'click', '#scriptDownload_standalone', function () {
        var data1 = table4script.row( $(this).parents('tr') ).data();
                 
        //alert(data[4]);
        location.href = "/diamondback/app/download/python/"+data1[0]+"/bucket/analysis-rnd-scripts"; 
         } );
         
         } else {
             
         table4script = $('#scriptTable').DataTable( {
  			aaData: data,
             searchHighlight: true,
            "columnDefs": [ {
            "targets": -4,
            "data": null,
            "defaultContent": "<button id='sExecute'>Execute!</button>"
            },{
            "targets": -3,
            "data": null,
            "defaultContent": "<button id='scriptDownload'>Download!</button>"
            },
            {
            "targets": -2,
            "data": null,
            "defaultContent": ""
            },
            {
            "targets": -1,
            "data": null,
            "defaultContent": ""
            }
           ]
         });
         
    
    $('#scriptTable tbody').on( 'click', '#sExecute', function () {
		        var data = table4script.row( $(this).parents('tr') ).data();
		        
		        saveSchedule(data,selected);
                 dialog.dialog( "close" );
        
                
                 $('#ui-id-4').click();
                 
                 setTimeout(
			            'populateSchedule();',
			            500
			        );
		} );
    
     $('#scriptTable tbody').on( 'click', '#scriptDownload', function () {
        var data = table4script.row( $(this).parents('tr') ).data();
        //alert(data[4]);
        location.href = "/diamondback/app/download/python/"+data[0]+"/bucket/analysis-rnd-scripts"; 
         } );
         }


}
        
       

function saveSchedule(scriptName,fileName){
    
var scheduleData = "{\"scriptName\":\""+scriptName + "\",\"fileName\":\"" + fileName+"\"}";
    
 $.ajax({
        type: "POST",
        url: "/diamondback/app/save/schedule",
        async: false,
        data: scheduleData,
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        success: function(){ alert("Schedule saved successfully");}, 
        failure: function(errMsg) {
            alert(errMsg);
        }
      });


}


 function populateCron(){
        
            
		            $.ajax({
		        type: "GET",
		        url: "/diamondback/app/list/cron",
		        contentType: "application/json; charset=utf-8",
		        dataType: "json",
		        success: function(fdata){processCronTable(fdata.data);}, 
		        failure: function(errMsg) {
		            alert(errMsg);
		        }
		      });  
		         
		    //setInterval(populateCron(),50000);    
		}
		var cronTable;
        
        function processCronTable(sdata){
         if(cronTable){
            cronTable.destroy();
        }
         cronTable = $('#cronTable').DataTable( {
  			aaData: sdata
            
         });
        
        }



        
        function populateSchedule(){
        
            
		            $.ajax({
		        type: "GET",
		        url: "/diamondback/app/show/schedule",
		        contentType: "application/json; charset=utf-8",
		        dataType: "json",
		        success: function(fdata){processScheduleTable(fdata.data);}, 
		        failure: function(errMsg) {
		            alert(errMsg);
		        }
		      });     
		        
		}
        
        function processScheduleTable(sdata){
         if(scheduleTable){
            scheduleTable.destroy();
        }
         scheduleTable = $('#scheduleTable').DataTable( {
  			aaData: sdata,
             searchHighlight: true,
            
              "fnRowCallback": function( nRow, aData, iDisplayIndex ) {
                  
                    /* Append the grade to the default row class name */
                    if ( aData[2] == "SCHEDULED" )
                    {
                        $('td:eq(2)', nRow).html( '<b>SCHEDULED</b>' );
               
                    }else if ( aData[2] == "ERROR" ){
                        $('td:eq(2)', nRow).html( '<b>'+aData[3]+'</b>' );
                    }
                    else {
                        $('td:eq(2)', nRow).html( "<button id='sDownload'>Download!</button>" );
                    }
   

             },"columnDefs": [ {
            "targets": -1,
            "data": null,
            "defaultContent": ""
            },
            {
            "targets": -2,
            "data": null,
            "defaultContent": ""
            }
           ]
           
         });
            
             $('#scheduleTable tbody').on( 'click', '#sDownload', function () {
        var data = scheduleTable.row( $(this).parents('tr') ).data();
        //alert(data[4]);
        location.href = "/diamondback/app/download/"+data[1]+"-"+data[0]+"/bucket/analysis-output-bucket"; 
         } );
        
        }
        
        
        
        function fnclear(){
            //alert("clear");
            
          $("#hospital").val("");
        $("#workstation").val("");    
           $("#procid").val(""); 
            $("#fromdate").val("");
            $("#todate").val("");
            $("#sfprocid").val("");
            table.clear().draw();
            $('#example tbody').unbind();
            
            
        }
        
     function uploadFile(standalone){
    
      var bar = $('.bar');
var percent = $('.percent');
var status = $('#status');
   
$('form').ajaxForm({
    beforeSend: function() {
        status.empty();
        var percentVal = '0%';
        bar.width(percentVal)
        percent.html(percentVal);
    },
    uploadProgress: function(event, position, total, percentComplete) {
        var percentVal = percentComplete + '%';
        bar.width(percentVal)
        percent.html(percentVal);
		//console.log(percentVal, position, total);
    },
    success: function() {
        var percentVal = '100%';
        bar.width(percentVal)
        percent.html(percentVal);
    },
	complete: function(xhr) {
	
	loadTable(standalone);
	
	
	
	}
}); 
  }         
  
    function openModal() {
        document.getElementById('modal').style.display = 'block';
        document.getElementById('fade').style.display = 'block';
}

function closeModal() {
    document.getElementById('modal').style.display = 'none';
    document.getElementById('fade').style.display = 'none';
}   
        
	</script>

</head>
<body>

 <div id="fade"></div>
        <div id="modal">
            <img id="loader" src="loading.gif"/>
        </div>

<div id="myTabs" class="container" style="top:100px;height:800px;width:100%">
  <ul>
    <li><a href="#tabs-0">Upload zip</a></li>
    <li><a href="#tabs-1">Web Query</a></li>
       <li><a href="#tabs-4">Python scripts</a></li>
    <li><a href="#tabs-2">Python Analysis Report</a></li> 
      <li><a href="#tabs-3">Unzip Batch Report</a></li>
    
  </ul>
  <div id="tabs-0" style="height:100%;">
  		 <div id="uploader" class="container" style="height:100%">
  		 </div>
  </div>
  
  <div id="tabs-4">
  		  <div title="Execute Script" style="height:100%">
       
        <form action="/diamondback/app/upload" method="post" enctype="multipart/form-data">
        <input type="file" name="myfile[]" multiple><br>
        <input type="submit" value="Upload File to Server" onclick = "uploadFile(true)">
        </form>

        <div class="progress">
            <div class="bar"></div >
            <div class="percent">0%</div >
        </div>

        <div id="status"></div>
 
  <table id="scriptTable_standalone" class="table table-striped table-bordered" cellspacing="0">
					<thead>
						<tr>
						   
							<th>Scripts</th>
							<th>Command</th>
                            <th>Created By</th>
                            <th>Created Date</th>
                            
                            
						</tr>
					</thead>
					<tfoot>
						<tr>
						   
							<th>Scripts</th>
							<th>Command</th>
                            <th>Created By</th>
                            <th>Created Date</th>
                            
                            
							
						</tr>
					</tfoot>
		</table>
</div>
  </div>
  
  
  <div id="tabs-1">
    <div class="container" style="height:100%">
  <div style="white-space: nowrap;overflow: hidden">
    <div style="width:20%;display: inline-block;">
      <label for="email">Hospital:</label>
      <input type="text" class="form-control" id="hospital" placeholder="Hospital">
    </div>
    <div style="width:20%;display: inline-block;">
      <label for="workstation">Workstation:</label>
      <input type="text" class="form-control" id="workstation"  placeholder="Workstation">
    </div>
      
        <div style="width:20%;display: inline-block;">

	      <label for="procedure_id">Procedure ID:</label>
	      <input type="text" class="form-control" id="procid" placeholder="Procedure ID">
    </div>
        
        </div>
        
        <div class="form-group">
        <div style="width:20%;display: inline-block;">

	      <label for="procedure_id">Salesforce Procedure ID:</label>
	      <input type="text" class="form-control" id="sfprocid" placeholder="Salesforce Procedure ID">
    </div>
            <div style="width:20%;display: inline-block;">

	      <label for="datetime">From Date:</label>
	      <input type="workstation" class="form-control" id="fromdate" placeholder="From Date">
    </div>
     <div style="width:20%;display: inline-block;">
	      <label for="datetime">To Date:</label>
	      <input type="workstation" class="form-control" id="todate"  placeholder="To Date">
    </div>
        </div>
    <div class="form-group">
		<button type="submit" class="btn btn-default" style="width:auto;" onclick="processSearch()">Submit</button>
        <button type="submit" class="btn btn-default" style="width:auto;" onclick="fnclear()">Clear</button>
        <button type="submit" class="btn btn-default" style="width:auto;"  onclick="executeScript()">Execute Algorithm</button>

        </div>    
      
      
<div style="width:80%">
     <table id="example" class="table table-striped table-bordered" cellspacing="0">
					<thead>
						<tr>
						   
							<th>Hospital</th>
							<th>Workstation</th>
							<th>Procedure ID</th>
							<th>Salesforce ProcId</th>
							<th>Date</th>
                            <th>File Name</th>
							<th>Command</th>
                            <th>Created By</th>
                            <th>Created Date</th>
                           
							
						</tr>
					</thead>
					<tfoot>
						<tr>
						   
							<th>Hospital</th>
							<th>Workstation</th>
							<th>Procedure ID</th>
							<th>Salesforce ProcId</th>
							<th>Date</th>
							<th>File Name</th>
                            <th>Command</th>
                            <th>Created By</th>
                            <th>Created Date</th>
                           
							
						</tr>
					</tfoot>
		</table>
    </div>

     </div>
    
    
  </div>
  <div id="tabs-2">
     <div id="searchcontainer" style="height:100%">
      <button type="submit" class="btn btn-default" style="width:auto;"  onclick="populateSchedule()">Refresh</button>
         
       <table id="scheduleTable" class="table table-striped table-bordered" cellspacing="0">
					<thead>
						<tr>
						   
							<th>Scripts</th>
							<th>File</th>
                            <th>Status</th>
                            <th>Created By</th>
                            <th>Created Date</th>
						</tr>
					</thead>
					<tfoot>
						<tr>
						   
							<th>Scripts</th>
							<th>File</th>
                            <th>Status</th>
                            <th>Created By</th>
                            <th>Created Date</th>
							
						</tr>
					</tfoot>
		</table>
      
      
      </div>
  </div>
  
  
  <div id="tabs-3">
     <div id="searchcontainer" style="height:100%">
         <button type="submit" class="btn btn-default" style="width:auto;" onclick="populateCron()">Refresh</button>
      <div width="80%">
       <table id="cronTable" class="table table-striped table-bordered"  cellspacing="0">
					<thead>
						<tr>
						   
							<th>File Name</th>
                            <th>Status</th>
                            
						</tr>
					</thead>
					<tfoot>
						<tr>
						   
					
							<th>File Name</th>
                            <th>Status</th>
                           
							
						</tr>
					</tfoot>
		</table>
      
      </div>
      </div>
  </div>
 
  
</div>



 
</body>
    
    <div id="dialog-form" title="Execute Script">
       
        <form action="/diamondback/app/upload" method="post" enctype="multipart/form-data">
        <input type="file" name="myfile[]" multiple><br>
        <input type="submit" value="Upload File to Server" onclick = "uploadFile(false)">
        </form>

        <div class="progress">
            <div class="bar"></div >
            <div class="percent">0%</div >
        </div>

        <div id="status"></div>
 
  <table id="scriptTable" class="table table-striped table-bordered" cellspacing="0">
					<thead>
						<tr>
						   
							<th>Scripts</th>
							<th>Command</th>
                            <th>Command</th>
                            <th>Created By</th>
                            <th>Created Date</th>
						</tr>
					</thead>
					<tfoot>
						<tr>
						   
							<th>Scripts</th>
							<th>Command</th>
                            <th>Command</th>
                            <th>Created By</th>
                            <th>Created Date</th>
							
						</tr>
					</tfoot>
		</table>
</div>

</html>
