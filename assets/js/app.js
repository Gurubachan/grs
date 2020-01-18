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
var blockcode="";
var active_location="dashboard";
var user_type=0;
var grievancedata="";
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
				if(ac!="" && ac>0){
					$("#"+divid).val(ac).change();
				}
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
				if(blockcode!=null && blockcode>0){
					$("#"+divid).val(blockcode);
				}
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
				//$("#divMessageType").remove();
				$("#heading").html("Genereate Grievence");
				$(".card-header").removeClass('card-header-primary').addClass('card-header-success');
			} else {
				$("#divGrivance").remove();

				$("#heading").html("Genereate Request");


			}
			$("#txtdateline").datepicker({
				minDate:"+0D"
			});
			loadMessageType('cboMessageType');
			loadSeveourity('cboSeviourity');
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
	$('#cboDist').removeAttr("disabled", false);
	var frm=$("#"+formid);
	var data="";
	data=new FormData(frm[0]);
	if(formid=="frmGrievence" ){
		data.append('form',formid);
	}
	if(updateid!=null && updateid>0){
		//alert(updateid);
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
			console.log(d);
			var responsedata=JSON.parse(d);
			if(responsedata.response == true){
				var successresponse=responsedata.message;
				if(formid=="frmGrievence"){
					appendcontrol="allGrievence";
					$("#cboType").focus();
				}
				if(formid=="frmSearch"){
					appendcontrol="searchReportArea";
				}

				loadDataAsPerRequest(appendcontrol,successresponse);
				if(formid!="frmSearch"){
					$(frm).trigger('reset');
				}

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
	$('#cboDist').prop("disabled", true);
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
		case "searchReportArea":
			loadSearchReport(divid,responsedata);
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
					"<option value=\"na\">Not In List</option>";
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
					"<option value=\"na\">Not In List</option>";
				var data=responsedate.message;
				for (var i=0; i<data.length;i++){
						html+="<option value="+data[i].id+"  >"+data[i].stname+"</option>";
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
					"<option value=\"na\">Not In List</option>";
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
			grievancedata=JSON.parse(d);
			//console.log(grievancedata.message.grievencestatus);
			if(grievancedata.response==true){
				var html="";
				for(key in grievancedata.message.grievencestatus) {
					var data = grievancedata.message.record[key];


					for (var i = 0; i < data.length; i++) {
						html += "<tr class=" + data[i].statusname + ">\n" +
							"<td style='width: 10%'>" +
							"<div class=\"form-check\">\n" +
							"<label class=\"form-check-label\">\n" +
							"<input class=\"form-check-input\" type=\"checkbox\" value=\"\" checked>\n" +
							"<span class=\"form-check-sign\">\n" +
							"<span class=\"check\"></span>\n" +
							"</span>\n" +
							"</label>\n" +
							"</div>\n" +
							"</td>\n" +
							"<td style='width: 60%'> Letter Type :" + data[i].type
							+ '<br> Refer By : ' + data[i].referby
							+ '<br> Subject : ' + data[i].subject
							+ '<br> Body : ' + data[i].body
							+ '<br> Date Of Receive : ' + data[i].date
							+ "</td>\n" +
							"<td style='width: 10%'>" +
							data[i].statusname
							+ "<br>" + data[i].effectivedate
							+ "</td>" +
							"<td style='width: 10%'>" +
							data[i].priority
							+ "</td>" +
							"<td class='td-actions text-right' style='width: 10%'>";
						if (data[i].statuscode < 4) {
							html += "<button type=\"button\" rel=\"tooltip\" title=\"View Task\" onclick='load_single_grivence(" + data[i].id + ")' class=\"btn btn-primary btn-link btn-sm\">\n" +
								"<i class=\"material-icons\">streetview</i>\n" +
								"</button>\n";
						}

						html += "<button type=\"button\" rel=\"tooltip\" title=\"Remove\" class=\"btn btn-danger btn-link btn-sm\">\n" +
							"<i class=\"material-icons\">close</i>\n" +
							"</button>\n" +
							"</td>\n" +
							"</tr>"
						;
					}
				}
				//console.log(html);
				$("#"+dataloadingid).html(html);
				//$("#table_allGrivance").dataTable();
				grievance_count();
				var view_html="";
				$(".View").each(function () {
					view_html+="<tr>"+$(this).html()+"</tr>";
				});
				$("#allViewed").html(view_html);

				var pending_html="";
				$(".Pending").each(function () {
					pending_html+="<tr>"+$(this).html()+"</tr>";
				});
				$("#allPending").html(pending_html);

				var resolve_html="";
				$(".Resolved").each(function () {
					resolve_html+="<tr>"+$(this).html()+"</tr>";
				});
				$("#allResolved").html(resolve_html);

				if(responsevalue!=null){
					//alert(dataloadingid);
					$("#"+dataloadingid).val(responsevalue);
				}
			}
		}
	});
}
var single_grivance_data;
function load_single_grivence(grivenceid) {
	updateid=grivenceid;
	single_grivance_data=$.parseJSON($.ajax({
		type: "POST",
		url: "./Grievance/loadGrievences",
		data: {gid:grivenceid,location:active_location},
		dataType: "json",
		async: false
		/*success: function (d) {
			var data= JSON.parse(d);
		}*/
		}).responseText);
	if(active_location=="dashboard"){
		$("#myModal").modal().show();

				if(single_grivance_data['response']!=false) {
					//single_grivance_data['message']['grievencestatus'];
					for (key in single_grivance_data['message']['grievencestatus']) {
						var records = single_grivance_data['message']['record'][key];
						//console.log(records);
						var html = "<div class=\"row\">\n" +
							"<div class=\"col-md-12\">\n" +
							"<div class=\"card\">\n" +
							"<div class=\"card-header card-header-primary\" style='cursor: pointer' onclick='view_tickets_header()'>\n" +
							"<h4 class=\"card-title\" id=\"heading\">" + records[0].type + " </h4>\n" +
							"</div>\n" +
							"<div class=\"card-body\" id='view_ticket_body'>";
						html += "<table class=\"table\">\n" +
							"<tr>\n" +
							"<td>From :</td>\n" +
							"<td>" + records[0].name + "</td>\n" +
							"</tr>\n" +
							"<tr>\n" +
							"<td>Receive Date :</td>\n" +
							"<td>" + records[0].recivedate + "</td>\n" +
							"</tr>\n" +
							"<tr>\n" +
							"<td>Subject :</td>\n" +
							"<td>" + records[0].subject + "</td>\n" +
							"</tr>\n" +
							"<tr>\n" +
							"<td>Body :</td>\n" +
							"<td>" + records[0].body + "</td>\n" +
							"</tr>";
						if (records[0].filelink != "") {
							html += "<tr>" +
								"<td>Attachment</td>" +
								"<td><a id='btnDownload' class='btn btn-success' target='_blank' href=" + records[0].filelink + " >View</a> </td>" +
								"</tr>";
						}
						html += "</table>";

						if (user_type != 2 && user_type != 0) {
							html += "<fieldset>" +
								"<legend>Process To</legend>" +
								"<div class='row'>" +
								"<div class='col-lg-4 col-md-4 col-sm-4'>" +
								"<button name='btnOrganisation' id='btnOrganisation' onclick='call_grivance_forward_form()' class='btn btn-dark btn-block'>Ministry - (Center / State)</button>" +
								"</div> " +
								"<div class='col-lg-4 col-md-4 col-sm-4'>" +
								"<button name='btnIndividual' id='btnIndividual' class='btn btn-dark btn-block'>Company / Individual</button>" +
								"</div> " +
								"</div>" +
								"</fieldset>";
						}


						html += "</div>\n" +
							"</div>";
						html += "<div id='processto'></div>";
						if (user_type != 2 && user_type != 0) {
							html += "<div class='card-footer'>" +
								"<button id='btnProcess' class='btn btn-success float-right' onclick=\"submitToServer('frmGrievanceProcess',event)\">Save</button> " +
								"</div>";
						}
						html += "</div>\n" +
							"</div>";
						$("#containtLoadHere").html(html);
						if (user_type == 3 && user_type != 0) {
							changestatus();
						}
					}
				}
				else
					{
						alert("Invalid data");
					}


	}else {
		var records=single_grivance_data['message']['record'];
		//console.log(records);
		//Set data to form
		$("#cboType").val(records[0].gtype).change();
		$("#cboSubCategory").val(records[0].gsubtype).change();
		$("#cboFrom").val(records[0].senderid).change();
		$("#cboTo").val(records[0].receiverid).change();
		$("#cboMessageType").val(records[0].message_type).change();
		$("#cboSeviourity").val(records[0].seviourity).change();
		$("#cboSource").val(records[0].source).change();
		$("#cboReferances").val(records[0].referanceno).change();
		$("#txtSubject").val(records[0].subject);
		$("#txtMessage").html(records[0].body);
		$("#cboPc").val(records[0].pccode).change();
		if(records[0].receivedate!=null) {
			$("#txtReceiveDate").val(dateformat(records[0].receivedate));
		}
		if(records[0].dateline!=null){
			$("#txtdateline").val(dateformat(records[0].dateline));
		}
		if(records[0].filelink!=null){
			$("#uploadDiv").html("<a id='btnDownload' class='btn btn-sm btn-success' target='_blank' href="+records[0].filelink+">View</a>");
		}

		ac=records[0].accode;
		blockcode=records[0].blockcode;
	}
}
function pad2(number) {
	return (number < 10 ? '0' : '') + number;
}
function dateformat(dates) {
	let current_datetime = new Date(dates);
	let formatted_date = current_datetime.getDate() + "-" + pad2(current_datetime.getMonth()+1) + "-" + current_datetime.getFullYear();
	return formatted_date;
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
			load_grievance_forwarded();

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
					"<option value=\"na\">Not In List</option>";
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
					"<option value=\"na\">Not In List</option>";
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
					"<option value=\"na\">Not In List</option>";
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

function loadMessageType(dataloadingid=null, responsevalue=null){
	$.ajax({
		type: "POST",
		url: "./MessageType/select",
		data: null,
		success: function (d) {
			var responsedate=JSON.parse(d);
			if(responsedate.response == true){
				var html="<option value=\"\">Select Message Type</option>\n" +
					"<option value=\"na\">Other</option>";
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
					"<option value=\"na\">Other</option>";
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
					"<option value=\"na\">Not in list</option>";
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

function grievance_count() {
	if(grievancedata.response == true){
		//console.log(grievancedata.message);
		var grivancestatus=grievancedata.message.grievencestatus;
		//len=Object.keys(grivancetype).length;
		var html="";
		var process_html="";
		var resolve_html="";
		var pending_html="";
		var receive_html="";
		var view_html="";

		var count=0;
		var total_receive_count=0;
		var total_process_count=0;
		var total_pending_count=0;
		var total_resolve_count=0;
		var total_view_count=0;

		Object.keys(grivancestatus).forEach(function(gs) {

			//console.log(gs);

			if(gs == "Received"){
				total_receive_count = total_receive_count + grivancestatus[gs];
			}
			if(gs == "View"){
				total_view_count = total_view_count + grivancestatus[gs];
			}
			if(gs == "Process"){
				total_process_count = total_process_count + grivancestatus[gs];
			}
			if(gs == "Resolved"){
				total_resolve_count = total_resolve_count + grivancestatus[gs];
			}
			if(gs == "Pending"){
				total_pending_count = total_pending_count + grivancestatus[gs];
			}


			var grivancetype=grievancedata.message.grievencetype[gs];
			Object.keys(grivancetype).forEach(function (gt) {
				//console.log(key, record[key]);
				if(gs == "Received"){
					receive_html += "<li>"+
					"<a href='#' onclick=\"get_grivance_by_category('"+gt+"','"+gs+"')\">"
					+ gt + ' : ' + "<span class='float-right'>" + grivancetype[gt] + "</span>"
					+"</a>"
						+ "</li>";
				}
				if(gs == "View"){

					view_html += "<li>"+
						"<a href='#' onclick=\"get_grivance_by_category('"+gt+"','"+gs+"')\">"
						+ gt + ' : ' + "<span class='float-right'>" + grivancetype[gt] + "</span>"
					+"</a>"
					+ "</li>";
				}
				if(gs == "Process"){

					process_html += "<li>"+
						"<a href='#' onclick=\"get_grivance_by_category('"+gt+"','"+gs+"')\">"
						+ gt + ' : ' + "<span class='float-right'>" + grivancetype[gt] + "</span>"
					+"</a>"
					+ "</li>";
				}
				if(gs == "Resolved"){

					resolve_html += "<li>"+
						"<a href='#' onclick=\"get_grivance_by_category('"+gt+"','"+gs+"')\">"
						+ gt + ' : ' + "<span class='float-right'>" + grivancetype[gt] + "</span>"
					+"</a>"
					+ "</li>";
				}
				if(gs == "Pending"){
					pending_html += "<li>"+
						"<a href='#' onclick=\"get_grivance_by_category('"+gt+"','"+gs+"')\">"
						+ gt + ' : ' + "<span class='float-right'>" + grivancetype[gt] + "</span>"
					+"</a>"
					+ "</li>";
				}
			});
		});
		html=receive_html+view_html+process_html+pending_html+resolve_html;
		$("#total").html(html);
		$("#process").html(process_html);
		$("#resolve").html(resolve_html);
		$("#pending").html(pending_html);
		count=total_receive_count+total_process_count+total_pending_count+total_resolve_count+total_view_count;

		$("#total_count").html(count);
		$("#total_process").html(total_process_count);
		$("#total_pending").html(total_pending_count);
		$("#total_resolve").html(total_resolve_count);
	}
	/*$("#summary_box .card-title").each(function () {
		alert($(this).attr("id"));
	});*/
}

function get_grivance_by_category(category,status) {
	//console.log(grievancedata.message.record[status]);
	$('#tblCategoryWiseReport').DataTable().destroy();
	var data=grievancedata.message.record[status];
	var html="";
	for (var i = 0; i < data.length; i++){
		if(category===data[i].type){
			//console.log(data[i])
			html += "<tr>\n" +
				"<td>"+data[i].name+"</td>\n" +
				"<td>"+data[i].subject+"</td>\n" +
				"<td>"+data[i].body+"</td>\n" +
				"<td>"+data[i].recivedate+"</td>\n" +
				"</tr>"
		}
	}
	$("#divCategoryWiseReportSection").show();
	$("#headerData").html(category);
	$("#CategoryWiseReport").html(html);
	$("#tblCategoryWiseReport").dataTable();
	/*$.ajax({
		type: "GET",
		url: "./Grievance/loadGrievences",
		data: {category:category,status:status},
		success: function(data) {
			var data= JSON.parse(data);
			console.log(data.message.record[status]);
		}
	})*/
}
/*
* Report Function
* Date: 05122019*/
function load_report() {
	$.ajax({
		type: "GET",
		url: "./Reports/loadReportForm",
		data: null,
		success: function (d) {
			/*$.getScript('reportjs.js');*/
			$("#loadContaint").hide();
			$("#loadContaint").html(d);
			$("#loadContaint").show();
		}
	});

}

/*
* Grievance Forward Report
* 15-12-2019*/

function load_grievance_forwarded() {
	$.ajax({
		type: "POST",
		url : "./Grievance/actionTakenReport",
		data : {txtId:updateid},
		success:function (d) {
			var response=JSON.parse(d);
			if(response.response!=false){
				var records = response.message;
				$("#grievance_forward_report").html(records);
			}

		}
	})
}

/*Change grievence status from receive to view.*/
function changestatus() {
	//alert(1);
	$.ajax({
		type:"POST",
		url: "./Grievance/insertGrievence",
		data:{txtId: updateid,status:2},
		success: function (d) {
			var response=JSON.parse(d);
			if(response.response!=false){
				var record = response.message;
				console.log(record);
			}
		}
	})
}
