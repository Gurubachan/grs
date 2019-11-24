var grievancetype="";
var grievanceformtype="";
var appendcontrol="";
var psuid=null;
var sendto=null;
var ministryid=null;
var departmentid=null;
var url="";
updateid="";
/*Area mapping script goes here*/

var pc="";
var ac="";
var dcode="";
var active_location="dashboard";
var user_type=0;
function load_pc(divid) {
	$.ajax({
		url:"./ServerPostResponse/load_pc",
		type:"GET",
		data:null,
		success:function (response) {
			var res=JSON.parse(response);
			if(res.response==true){
				var data=res.message;
				$("#"+divid).html(data);
			}
		}
	})
}

function load_ac(divid) {
	$.ajax({
		url:"./ServerPostResponse/load_ac",
		type:"POST",
		data:{pccode:pc},
		success:function (response) {
			var res=JSON.parse(response);
			if(res.response==true){
				var data=res.message;
				$("#"+divid).html(data);
			}
		}
	})
}

function load_district(divid){
	$.ajax({
		url:"./ServerPostResponse/get_distcode_on_ac",
		type:"POST",
		data:{accode:ac},
		success:function (response) {
			var res=JSON.parse(response);
			var html="";
			if(res.response!=false){
				var data=res.message;
				//console.log(response);
				for (var i=0; i<data.length;i++){
					if(dcode!=data[i]['dcode']) {
						html += "<option value=" + data[i]['dcode']+ ">" + data[i]['dname'] + "</option>";
					}
					dcode=data[i]['dcode'];
				}
				$("#"+divid).html(html).prop("disabled",true);
				//$("#"+divid).html(html);
				load_municipality("cboBlock");
			}else{
				console.log(response);
			}

		}
	});
}

function load_municipality(divid) {
	$.ajax({
		url:"./ServerPostResponse/load_block",
		type:"POST",
		data:{distid:dcode},
		success:function (response) {
			var res=JSON.parse(response);
			if(res.response==true){
				var data=res.message;
				$("#"+divid).html(data);
			}
		}
	});
}
/*End area mapping script*/
var ht="500px";
$("document").ready(function () {
	loadGrievences('allGrievence');
	getTodayGrievences('tbl_status_count');
	$("#allGrivinaceloading").css({"height":ht,"overflow":"auto"});

});

function getGrievance(t) {
	if(t!=null){
		grievanceformtype=t;
	}else {
		alert("Invalid Form Type Request");
	}
	active_location="grivanceform";
	$.ajax({
		type: "GET",
		url: "./Grievance/frmGrievance",
		data: null,
		success: function (d) {
			//console.log(d);
			$("#loadContaint").hide();
			$("#loadContaint").html(d);
			getGrievanceReport();
			loadGrievenceType('cboType');
			loadSenderReceiver('cboFrom',null,1);
			loadSenderReceiver('cboTo',null,2);
			loadSource('cboSource');
			loadReferances('cboReferances');
			load_pc('cboPc');
			if (grievanceformtype == 1) {
				loadSendto('cboSendto');
				$("#divMessageType").remove();
				$("#heading").html("Genereate Grievence");
				$(".card-header").removeClass('card-header-primary').addClass('card-header-success');
			} else {
				$("#divGrivance").remove();
				loadMessageType('cboMessageType');
				loadSeveourity('cboSeviourity');
				$("#heading").html("Genereate Request");

				$("#txtdateline").datepicker();
			}
			loadGrievences('allGrievence');
			$("#loadContaint").show();
			$("#cboType").focus();
		}
	});
}
function getGrievanceReport() {
	$.ajax({
		type: "GET",
		url: "./Grievance/rptGrievance",
		data: null,
		success: function (d) {
			//console.log(d);
			$("#loadReport").html(d);
			 ht=$("#frmGrievence").height();
			//alert(ht);
			$("#allGrivinaceloading").css({"height":ht,"overflow":"auto"});
			$("#grivance_details").removeClass("col-lg-6");
		}
	});
}



function submitToServer(formid,e) {
	e.preventDefault();
	var frm=$("#"+formid);
	var data="";
	if(formid=="frmGrievence"){
		$('#cboDist').removeAttr("disabled", false);

	}/*else {
		data=frm.serialize();
	}*/
	data=new FormData(frm[0]);
	if(updateid!=null && updateid>0){
		alert(updateid);
		data.append('txtId',updateid);
	}
	$.ajax({
		type: frm.attr('method'),
		url: frm.attr('action'),
		enctype: 'multipart/form-data',
		data: data,
		processData: false,
		contentType: false,
		cache: false,
		timeout: 600000,
		// data: frm.serialize(),
		// data: frm.serialize(),
		success: function (d) {
			var responsedata=JSON.parse(d);
			if(responsedata.response == true){
				var successresponse=responsedata.message;
				if(formid=="frmGrievence"){
					appendcontrol="allGrievence";
					$("#cboType").focus();
				}
				loadDataAsPerRequest(appendcontrol,successresponse);
				$(frm).trigger('reset');
				$(frm).first().focus();
				$("#myModal").modal('hide');
				$("#containtLoadHere").html('');
			}
		},
		error: function (XMLHttpRequest, textStatus, errorThrown) {
			alert(XMLHttpRequest.statusText);
			$(frm).trigger('reset');
			$("#myModal").modal('hide');
			$("#containtLoadHere").html('');
		}
	});
}
function loadDataAsPerRequest(divid,responsedata) {
	//var day;
	switch (divid) {
		case "cboType":
			loadGrievenceType(divid,responsedata);
			break;
		case "cboSubCategory":
			loadGrievenceSubType(divid,responsedata);
			break;
		case "cboFrom":
			loadSenderReceiver(divid,responsedata,1);
			break;
		case "cboTo":
			loadSenderReceiver(divid,responsedata,2);
			break;
		case "cboSource":
			loadSource(divid,responsedata);
			break;
		case "allGrievence":
			loadGrievences(divid,responsedata);
			break;
		case "cboMinistry":
			loadMinistry(divid,responsedata);
			break;
		case  "cbopsu":
			loadPSU(divid,responsedata);
			break;
		case "cboDepartment" :
			loadDepartment(divid,responsedata);
			break;
		case "cboSendto" :
			loadSendto(divid,responsedata);
			break;
		case "cboDivision" :
			loadDivision(divid, responsedata);
			break;
		case "cboMessageType" :
			loadMessageType(divid, responsedata);
			break;
		case "cboSeviourity" :
			loadSeveourity(divid, responsedata);
			break;
		case "cboReferances":
			loadReferances(divid,responsedata);
			break;
	}
	//return day;
}
function loadGrievenceType(dataloadingid=null,responsevalue=null) {
	//alert(grievanceformtype);
	$.ajax({
		type: "POST",
		url: "./Grievance/loadGrievenceType",
		data: {linkid: grievanceformtype},
		success: function (d) {
			var responsedate=JSON.parse(d);
			if(responsedate.response == true){
				var html="<option value=\"\">Select Category</option>\n" +
					"\t\t\t\t\t\t\t\t<option value=\"na\">Not In List</option>";
				var data=responsedate.message;
				for (var i=0; i<data.length;i++){
					html+="<option value="+data[i].id+">"+data[i].tname+"</option>";
				}
				//console.log(html);
				$("#"+dataloadingid).html(html);
				if(responsevalue!=null){
					//alert(dataloadingid);
					$("#"+dataloadingid).val(responsevalue);
				}
			}
		}
	});
}
function loadGrievenceSubType(dataloadingid=null,responsevalue=null) {
	$.ajax({
		type: "GET",
		url: "./Grievance/loadGrievenceSubType",
		data: null,
		success: function (d) {
			var responsedate=JSON.parse(d);
			if(responsedate.response == true){
				var html="<option value=\"\">Select Sub Category</option>\n" +
					"\t\t\t\t\t\t\t\t<option value=\"na\">Not In List</option>";
				var data=responsedate.message;
				for (var i=0; i<data.length;i++){
						html+="<option value="+data[i].id+" selected >"+data[i].stname+"</option>";
						$("#"+dataloadingid).addClass('disabled');
				}
				//console.log(html);
				$("#"+dataloadingid).html(html);
				if(responsevalue!=null){
					//alert(dataloadingid);
					$("#"+dataloadingid).val(responsevalue);
				}
			}
		}
	});
}
function loadSenderReceiver(dataloadingid=null,responsevalue=null,sendertype=null) {
	var url="./SenderReceiver/selectSenderReceiver/";

	$.ajax({
		type: "POST",
		url: url,
		data: {id:responsevalue, sendertype: sendertype},
		success: function (d) {
			var responsedate=JSON.parse(d);
			if(responsedate.response == true){
				var html="<option value=\"\">Select Sender</option>\n" +
					"\t\t\t\t\t\t\t\t<option value=\"na\">Not In List</option>";
				var data=responsedate.message;
				for (var i=0; i<data.length;i++){
					html+="<option value="+data[i].id+">"+data[i].name+"</option>";
				}
				//console.log(html);
				$("#"+dataloadingid).html(html);
			}
		}
	});
}

function loadSource(dataloadingid=null,responsevalue=null) {
	$.ajax({
		type: "GET",
		url: "./Source/select",
		data: null,
		success: function (d) {
			var responsedate=JSON.parse(d);
			if(responsedate.response == true){
				var html="<option value=\"\">Select Source</option>\n" +
					"<option value=\"na\">Not In List</option>";
				var data=responsedate.message;
				for (var i=0; i<data.length;i++){
					html+="<option value="+data[i].id+">"+data[i].name+"</option>";
				}
				//console.log(html);
				$("#"+dataloadingid).html(html);
				if(responsevalue!=null){
					//alert(dataloadingid);
					$("#"+dataloadingid).val(responsevalue);
				}
			}
		}
	});
}
function getTodayGrievences(dataloadingid=null) {
	$.ajax({
		type: "POST",
		url: "./Grievance/loadGrievences",
		data: {date:'today'},
		success: function (d) {
			var responsedate=JSON.parse(d);
			if(responsedate.response==true) {
				var html = "";
				var data = responsedate.message;
				var j=1;
				//console.log(data);
				for (var i = 0; i < data.length; i++) {
					html+="<tr>\n" +
						"<td>"+ j +"</td>\n" +
						"<td>"+ data[i].name +"</td>\n" +
						"<td>"+ data[i].subject +"</td>\n" +
						"<td>"+ data[i].status +"</td>\n" +
						"</tr>";
					j++;
				}
				$("#"+dataloadingid).html(html);
				}
			}
	});
}
function loadGrievences(dataloadingid=null,responsevalue=null) {
	$.ajax({
		type: "GET",
		url: "./Grievance/loadGrievences",
		data: {linkid:grievanceformtype},
		success: function (d) {
			var responsedate=JSON.parse(d);
			console.log(responsedate);
			if(responsedate.response==true){
				var html="";
				var data=responsedate.message;

				for (var i=0; i<data.length;i++){
					html+="<tr>\n" +
						"<td>\n" +
						"<div class=\"form-check\">\n" +
						"<label class=\"form-check-label\">\n" +
						"<input class=\"form-check-input\" type=\"checkbox\" value=\"\" checked>\n" +
						"<span class=\"form-check-sign\">\n" +
						"<span class=\"check\"></span>\n" +
						"</span>\n" +
						"</label>\n" +
						"</div>\n" +
						"</td>\n" +
						"<td> Letter Type :" + data[i].type
						+'<br> Refer By :'+ data[i].referby
						+'<br> Subject :'+ data[i].subject
						+'<br> Body :'+ data[i].body
						+'<br> Date Of Receive :'+ data[i].date
						+"</td>\n" +
						"<td class=\"td-actions text-right\">\n" +
						"<button type=\"button\" rel=\"tooltip\" title=\"View Task\" onclick='load_single_grivence("+ data[i].id +")' class=\"btn btn-primary btn-link btn-sm\">\n" +
						"<i class=\"material-icons\">streetview</i>\n" +
						"</button>\n" +
						"<button type=\"button\" rel=\"tooltip\" title=\"Remove\" class=\"btn btn-danger btn-link btn-sm\">\n" +
						"<i class=\"material-icons\">close</i>\n" +
						"</button>\n" +
						"</td>\n" +
						"</tr>";
				}
				//console.log(html);
				$("#"+dataloadingid).html(html);
				//$("#table_allGrivance").dataTable();
				if(responsevalue!=null){
					//alert(dataloadingid);
					$("#"+dataloadingid).val(responsevalue);
				}

			}
		}
	});
}
function load_single_grivence(grivenceid) {

	//alert(grivenceid);
	updateid=grivenceid;
	if(active_location=="dashboard"){
		$("#myModal").modal().show();
		$.ajax({
			type: "POST",
			url: "./Grievance/loadGrievences",
			data: {gid:grivenceid},
			success: function (d) {
				var data=JSON.parse(d);
				if(data['response']!=false){
					var records=data['message'];
					var html="<div class=\"row\">\n" +
						"<div class=\"col-md-12\">\n" +
						"<div class=\"card\">\n" +
						"<div class=\"card-header card-header-primary\" style='cursor: pointer' onclick='view_tickets_header()'>\n" +
						"<h4 class=\"card-title\" id=\"heading\">View Tickets </h4>\n" +
						"</div>\n" +
						"<div class=\"card-body\" id='view_ticket_body'>";
					html+="<table class=\"table\">\n" +
						"<tr>\n" +
						"<td>From :</td>\n" +
						"<td>"+ records[0].name +"</td>\n" +
						"</tr>\n" +
						"<tr>\n" +
						"<td>Receive Date :</td>\n" +
						"<td>"+ records[0].recivedate +"</td>\n" +
						"</tr>\n" +
						"<tr>\n" +
						"<td>Subject :</td>\n" +
						"<td>"+ records[0].subject +"</td>\n" +
						"</tr>\n" +
						"<tr>\n" +
						"<td>Body :</td>\n" +
						"<td>"+ records[0].body +"</td>\n" +
						"</tr>\n" +
						"<tr>\n" +
						"<td>Attachment</td>\n" +
						"<td><a id='btnDownload' class='btn btn-success' target='_blank' href=" + records[0].file +" >View</a> </td>\n" +
						"</tr>\n" +
						"</table>";

					if(user_type != 2 && user_type!=0){
						html+= "<fieldset>" +
							"<legend>Process To</legend>" +
							"<div class='row'>" +
							"<div class='col-lg-6 col-md-6 col-sm-6'>" +
							"<button name='btnOrganisation' id='btnOrganisation' onclick='call_grivance_forward_form()' class='btn btn-dark btn-block'>Organisation</button>" +
							"</div> " +
							"<div class='col-lg-6 col-md-6 col-sm-6'>" +
							"<button name='btnIndividual' id='btnIndividual' class='btn btn-dark btn-block'>Individual</button>" +
							"</div> " +
							"</div>"+
							"</fieldset>" ;
					}


					html+="</div>\n" +
						"</div>";
					html+="<div id='processto'></div>";
					html+="<div class='card-footer'>" +
						"<button id='btnProcess' class='btn btn-success float-right' onclick=\"submitToServer('frmGrievanceProcess',event)\">Save</button> " +
						"</div>" +
						"</div>\n" +
						"</div>";
					$("#containtLoadHere").html(html);

				}
			}
		});
	}else {
		alert("Edit option comming soon");
	}


}
function view_tickets_header() {
	$("#view_ticket_body").toggle();
}
function call_grivance_forward_form() {
	$.ajax({
		type: "GET",
		url: "./Grievance/frmGrievanceForward",
		data: null,
		success: function (d) {
			$("#processto").html(d);
			$("#view_ticket_body").toggle();
			loadSendto("cboSendto");
		}

});

}

function loadSendto(dataloadingid=null, responsevalue=null){
	$.ajax({
		type: "GET",
		url: "./SendTo/select",
		data: null,
		success: function (d) {
			var responsedate=JSON.parse(d);
			if(responsedate.response==true){
				var html="<option value=\"\">Select Send To</option>\n" +
					"<option value=\"na\">Not In List</option>";
				var data=responsedate.message;
				for (var i=0; i<data.length;i++){
					html+="<option value="+data[i].id+">"+data[i].name+"</option>";
				}
				//console.log(html);
				$("#"+dataloadingid).html(html);
				if(responsevalue!=null){
					//alert(dataloadingid);
					$("#"+dataloadingid).val(responsevalue);
					sendto=responsevalue;
				}
			}
		}
	});
}

function loadMinistry(dataloadingid=null, responsevalue=null) {
	$.ajax({
		type: "post",
		url: "./Ministry/select",
		data: {'sendtoid':sendto},
		success: function (d) {
			var responsedate=JSON.parse(d);
			if(responsedate.response==true){
				var html="<option value=\"\">Select Ministry</option>\n" +
					"\t\t\t\t\t\t\t\t<option value=\"na\">Not In List</option>";
				var data=responsedate.message;
				for (var i=0; i<data.length;i++){
					html+="<option value="+data[i].id+">"+data[i].ministry+"</option>";
				}
				//console.log(html);
				$("#"+dataloadingid).html(html);
				if(responsevalue!=null){
					//alert(dataloadingid);
					$("#"+dataloadingid).val(responsevalue);
					ministryid=responsevalue;
				}
			}
		}
	});
}




function loadPSU(dataloadingid=null, responsevalue=null) {
	$.ajax({
		type: "POST",
		url: "./PSU/select",
		data: {'ministryid':ministryid},
		success: function (d) {
			var responsedate=JSON.parse(d);
			if(responsedate.response==true){
				var html="<option value=\"\">Select PSU</option>\n" +
					"\t\t\t\t\t\t\t\t<option value=\"na\">Not In List</option>";
				var data=responsedate.message;
				for (var i=0; i<data.length;i++){
					html+="<option value="+data[i].id+">"+data[i].psuname+"</option>";
				}
				//console.log(html);
				$("#"+dataloadingid).html(html);
				if(responsevalue!=null){
					//alert(dataloadingid);
					$("#"+dataloadingid).val(responsevalue);
					psuid=responsevalue;
				}
			}
		}
	});
}

function loadDepartment(dataloadingid=null, responsevalue=null) {
	$.ajax({
		type: "POST",
		url: "./Department/select",
		data: {'psuid':psuid},
		success: function (d) {
			var responsedate=JSON.parse(d);
			if(responsedate.response==true){
				var html="<option value=\"\">Select Department</option>\n" +
					"\t\t\t\t\t\t\t\t<option value=\"na\">Not In List</option>";
				var data=responsedate.message;
				for (var i=0; i<data.length;i++){
					html+="<option value="+data[i].id+">"+data[i].dname+"</option>";
				}
				//console.log(html);
				$("#"+dataloadingid).html(html);
				if(responsevalue!=null){
					//alert(dataloadingid);
					$("#"+dataloadingid).val(responsevalue);
					departmentid=responsevalue;
				}
			}
		}
	});
}
function loadDivision(dataloadingid=null, responsevalue=null) {
	$.ajax({
		type: "POST",
		url: "./Division/select",
		data: {'department':departmentid},
		success: function (d) {
			var responsedate=JSON.parse(d);
			if(responsedate.response == true){
				var html="<option value=\"\">Select Division</option>\n" +
					"\t\t\t\t\t\t\t\t<option value=\"na\">Not In List</option>";
				var data=responsedate.message;
				for (var i=0; i<data.length;i++){
					html+="<option value="+data[i].id+">"+data[i].name+"</option>";
				}
				//console.log(html);
				$("#"+dataloadingid).html(html);
				if(responsevalue!=null){
					//alert(dataloadingid);
					$("#"+dataloadingid).val(responsevalue);

				}
			}
		}
	});
}

function loadMessageType(dataloadingid=null, responsevalue=null){
	$.ajax({
		type: "POST",
		url: "./MessageType/select",
		data: null,
		success: function (d) {
			var responsedate=JSON.parse(d);
			if(responsedate.response == true){
				var html="<option value=\"\">Select Message Type</option>\n" +
					"\t\t\t\t\t\t\t\t<option value=\"na\">Other</option>";
				var data=responsedate.message;
				for (var i=0; i<data.length;i++){
					html+="<option value="+data[i].id+">"+data[i].name+"</option>";
				}
				//console.log(html);
				$("#"+dataloadingid).html(html);
				if(responsevalue!=null){
					//alert(dataloadingid);
					$("#"+dataloadingid).val(responsevalue);

				}
			}
		}
	});
}
function loadSeveourity(dataloadingid=null, responsevalue=null){
	$.ajax({
		type: "POST",
		url: "./Severity/select",
		data: null,
		success: function (d) {
			var responsedate=JSON.parse(d);
			if(responsedate.response == true){
				var html="<option value=\"\">Select Severity Type</option>\n" +
					"\t\t\t\t\t\t\t\t<option value=\"na\">Other</option>";
				var data=responsedate.message;
				for (var i=0; i<data.length;i++){
					html+="<option value="+data[i].id+">"+data[i].name+"</option>";
				}
				//console.log(html);
				$("#"+dataloadingid).html(html);
				if(responsevalue!=null){
					//alert(dataloadingid);
					$("#"+dataloadingid).val(responsevalue);
				}
			}
		}
	});
}
function loadReferances(dataloadingid=null, responsevalue=null){
	$.ajax({
		type: "POST",
		url: "./Referances/select",
		data: null,
		success: function (d) {
			var responsedate=JSON.parse(d);
			if(responsedate.response == true){
				var html="<option value=\"\">Select Referances</option>\n" +
					"\t\t\t\t\t\t\t\t<option value=\"na\">Not in list</option>";
				var data=responsedate.message;
				for (var i=0; i<data.length;i++){
					html+="<option value="+data[i].id+">"+data[i].referancename+"</option>";
				}
				//console.log(html);
				$("#"+dataloadingid).html(html);
				if(responsevalue!=null){
					//alert(dataloadingid);
					$("#"+dataloadingid).val(responsevalue);
				}
			}
		}
	});
}
function callGrievanceGeneraetForm(t) {
	if(t.value==='na'){
		$("#myModal").modal().show();
		$.ajax({
			type: "GET",
			url: "./Grievance/frmGrievanceType",
			data: null,
			success: function (d) {
				//console.log(d);
				$("#containtLoadHere").html(d);
				appendcontrol=t.id;
				$(".x").removeClass('col-md-6').addClass('col-md-12');
				$("#cboCategory").val(grievanceformtype);
			}
		});
	}else {
		grievancetype=t.value;
		if(t.value!=""){
			loadGrievenceSubType('cboSubCategory');
		}
	}
}
function callSubGrievanceGeneraetForm(t) {
	if(t.value==='na'){
		$("#myModal").modal().show();
		$.ajax({
			type: "GET",
			url: "./Grievance/frmGrievanceSubType",
			data: null,
			success: function (d) {
				//console.log(d);
				$("#containtLoadHere").html(d);
				appendcontrol=t.id;
				$(".x").removeClass('col-md-6').addClass('col-md-12');
				loadGrievenceType('cboCategoryforsubcategory',grievancetype);
			}
		});
	}
}
function callSourceForm(t) {
	if(t.value=="na"){
		$("#myModal").modal().show();
		$.ajax({
			type: "GET",
			url: "./Source/loadForm",
			data: null,
			success: function (d) {
				//console.log(d);
				$("#containtLoadHere").html(d);
				appendcontrol=t.id;
				$(".x").removeClass('col-md-6').addClass('col-md-12');
				//$("#cboSenderReceiver").attr('disabled',true);
			}
		});
	}
}


function callSenderReceiverForm(t,stype) {
	if(t.value==='na'){
		$("#myModal").modal().show();
		$.ajax({
			type: "GET",
			url: "./SenderReceiver/frmSenderReceiver",
			data: null,
			success: function (d) {
				//console.log(d);
				$("#containtLoadHere").html(d);
				$(".x").removeClass('col-md-6').addClass('col-md-12');
				appendcontrol=t.id;
				$("#cboSenderReceiver").val(stype);
				//$("#cboSenderReceiver").attr('disabled',true);
				$(".card-title").html('Sender / Receiver Address Creation');
			}
		});
	}
}
function callSendto(t) {
	if (t.value == "na") {
		$("#myModal").modal().show();
		$.ajax({
			type : "GET",
			url : "./SendTo/loadForm",
			data : null,
			success : function (d) {
				$("#containtLoadHere").html(d);
				$(".x").removeClass('col-md-6').addClass('col-md-12');
				appendcontrol = t.id;
				//$("#cboSenderReceiver").attr('disabled',true);
			}
		});
	}else {
		sendto=t.value;
		if(t.value!=""){
			loadMinistry('cboMinistry');
		}
	}
}
function callMinistryForm(t) {
	if (t.value == "na") {
		$("#myModal").modal().show();
		$.ajax({
			type: "GET",
			url: "./Ministry/loadForm",
			data: null,
			success: function (d) {
				//console.log(d);
				$("#containtLoadHere").html(d);
				$(".x").removeClass('col-md-6').addClass('col-md-12');
				appendcontrol = t.id;
				//$("#cboSenderReceiver").attr('disabled',true);
				loadSendto('cboSendtoforministry',sendto);
			}
		});
	}else {
		ministryid=t.value;
		if(t.value!=""){
			loadPSU('cbopsu');
		}
	}
}

function callPSUForm(t) {
	if (t.value == "na") {
		$("#myModal").modal().show();
		$.ajax({
			type: "GET",
			url: "./PSU/loadForm",
			data: null,
			success: function (d) {
				//console.log(d);
				$("#containtLoadHere").html(d);
				$(".x").removeClass('col-md-6').addClass('col-md-12');
				appendcontrol = t.id;
				//$("#cboSenderReceiver").attr('disabled',true);

				loadMinistry('cboMinistryforPSU',ministryid);

			}
		});
	}else {
		psuid=t.value;
		if(t.value!=""){
			loadDepartment('cboDepartment');
		}
	}
}
function callDepartment(t) {
	if (t.value == "na") {
		$("#myModal").modal().show();
		$.ajax({
			type: "GET",
			url: "./Department/loadForm",
			data: null,
			success: function (d) {
				//console.log(d);
				$("#containtLoadHere").html(d);
				$(".x").removeClass('col-md-6').addClass('col-md-12');
				appendcontrol = t.id;
				//$("#cboSenderReceiver").attr('disabled',true);
				loadPSU('cboPsuforDepartment',psuid);
			}
		});
	}else {
		departmentid=t.value;
		if(t.value!=""){
			loadDivision('cboDivision');
		}
	}
}
function callDivision(t) {
	if (t.value == "na") {
		$("#myModal").modal().show();
		$.ajax({
			type: "GET",
			url: "./Division/loadForm",
			data: null,
			success: function (d) {
				//console.log(d);
				$("#containtLoadHere").html(d);
				$(".x").removeClass('col-md-6').addClass('col-md-12');
				appendcontrol = t.id;
				//$("#cboSenderReceiver").attr('disabled',true);
				loadDepartment('cboDivisionforDepartment',departmentid);
			}
		});
	}
}

function callMessageType(t) {
	if (t.value == "na") {
		$("#myModal").modal().show();
		$.ajax({
			type: "GET",
			url: "./MessageType/loadForm",
			data: null,
			success: function (d) {
				//console.log(d);
				$("#containtLoadHere").html(d);
				$(".x").removeClass('col-md-6').addClass('col-md-12');
				appendcontrol = t.id;
				//$("#cboSenderReceiver").attr('disabled',true);
			}
		});
	}
}

function callSeviourity(t) {
	if (t.value == "na") {
		$("#myModal").modal().show();
		$.ajax({
			type: "GET",
			url: "./Severity/loadForm",
			data: null,
			success: function (d) {
				//console.log(d);
				$("#containtLoadHere").html(d);
				$(".x").removeClass('col-md-6').addClass('col-md-12');
				appendcontrol = t.id;
				//$("#cboSenderReceiver").attr('disabled',true);
			}
		});
	}
}

function callReferances(t) {
	if (t.value == "na"){
		$("#myModal").modal().show();
		$.ajax({
			type: "GET",
			url: "./Referances/loadForm",
			data: null,
			success: function (d) {
				//console.log(d);
				$("#containtLoadHere").html(d);
				$(".x").removeClass('col-md-6').addClass('col-md-12');
				appendcontrol = t.id;
				//$("#cboSenderReceiver").attr('disabled',true);
			}
		});
	}
}
function addSenderReceiver(selector){
	$("#"+selector).val("na").change().trigger();
}

