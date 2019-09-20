var grievancetype="";
var appendcontrol="";
var psuid=null;
var sendto=null;
var ministryid=null;
var departmentid=null;
var url="";

$("document").ready(function () {
	loadGrievences('allGrievence');
	getTodayGrievences('tbl_status_count');
	loadReferances('cboReferances');
});

function getGrievance(t=null) {

	if(t!=null){
		grievancetype=t;

	}else {
		grievancetype="";
	}
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
			if(grievancetype=="" ){
				loadSendto('cboSendto');
				$("#divMessageType").remove();
			}else {
				$("#divGrivance").remove();
				loadMessageType('cboMessageType');
				loadSeveourity('cboSeviourity');
			}


			//loadMinistry('cboMinistry');
			loadGrievences('allGrievence');
			$("#loadContaint").show();

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
		}
	});
}



function submitToServer(formid,e) {
	e.preventDefault();
	var frm=$("#"+formid);
	//alert(frm.attr('action'));
	$.ajax({
		type: frm.attr('method'),
		url: frm.attr('action'),
		data: frm.serialize(),
		success: function (d) {
			var responsedata=JSON.parse(d);
			if(responsedata.response == true){
				var successresponse=responsedata.message;
				//alert(frmid);
				if(formid=="frmGrievence"){
					appendcontrol="allGrievence";
				}
				loadDataAsPerRequest(appendcontrol,successresponse);
				$(frm).trigger('reset');
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
	$.ajax({
		type: "GET",
		url: "./Grievance/loadGrievenceType",
		data: null,
		success: function (d) {
			var responsedate=JSON.parse(d);
			if(responsedate.response == true){
				var html="<option value=\"\">Select Category</option>\n" +
					"\t\t\t\t\t\t\t\t<option value=\"na\">Not In List</option>";
				var data=responsedate.message;
				for (var i=0; i<data.length;i++){
					if(grievancetype!=null && data[i].tname == grievancetype ){
							html="<option value="+data[i].id+" selected >"+data[i].tname+"</option>";
							$("#"+dataloadingid).addClass('disabled');
						break;
					}else {
						if(data[i].tname!="Invitation" && data[i].tname!="Message" && data[i].tname!="Transfer"){
							html+="<option value="+data[i].id+">"+data[i].tname+"</option>";
						}
					}
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
				console.log(data);
				for (var i = 0; i < data.length; i++) {
					html+="<tr>\n" +
						"\t\t\t\t\t<td>"+ j +"</td>\n" +
						"\t\t\t\t\t<td>"+ data[i].name +"</td>\n" +
						"\t\t\t\t\t<td>"+ data[i].subject +"</td>\n" +
						"\t\t\t\t\t<td>"+ data[i].status +"</td>\n" +
						"\t\t\t\t</tr>";
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
		data: null,
		success: function (d) {
			var responsedate=JSON.parse(d);
			if(responsedate.response==true){
				var html="";
				var data=responsedate.message;

				for (var i=0; i<data.length;i++){
					html+="<tr>\n" +
						"\t\t\t\t\t\t\t\t<td>\n" +
						"\t\t\t\t\t\t\t\t\t<div class=\"form-check\">\n" +
						"\t\t\t\t\t\t\t\t\t\t<label class=\"form-check-label\">\n" +
						"\t\t\t\t\t\t\t\t\t\t\t<input class=\"form-check-input\" type=\"checkbox\" value=\"\" checked>\n" +
						"\t\t\t\t\t\t\t\t\t\t\t<span class=\"form-check-sign\">\n" +
						"                                    <span class=\"check\"></span>\n" +
						"                                  </span>\n" +
						"\t\t\t\t\t\t\t\t\t\t</label>\n" +
						"\t\t\t\t\t\t\t\t\t</div>\n" +
						"\t\t\t\t\t\t\t\t</td>\n" +
						"\t\t\t\t\t\t\t\t<td>Referance :"+data[i].referanceno +'<br> Subject :'+ data[i].subject+'<br> Body :'+ data[i].body +"</td>\n" +
						"\t\t\t\t\t\t\t\t<td class=\"td-actions text-right\">\n" +
						"\t\t\t\t\t\t\t\t\t<button type=\"button\" rel=\"tooltip\" title=\"Edit Task\" class=\"btn btn-primary btn-link btn-sm\">\n" +
						"\t\t\t\t\t\t\t\t\t\t<i class=\"material-icons\">edit</i>\n" +
						"\t\t\t\t\t\t\t\t\t</button>\n" +
						"\t\t\t\t\t\t\t\t\t<button type=\"button\" rel=\"tooltip\" title=\"Remove\" class=\"btn btn-danger btn-link btn-sm\">\n" +
						"\t\t\t\t\t\t\t\t\t\t<i class=\"material-icons\">close</i>\n" +
						"\t\t\t\t\t\t\t\t\t</button>\n" +
						"\t\t\t\t\t\t\t\t</td>\n" +
						"\t\t\t\t\t\t\t</tr>";
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

function loadSendto(dataloadingid=null, responsevalue=null){
	$.ajax({
		type: "GET",
		url: "./SendTo/select",
		data: null,
		success: function (d) {
			var responsedate=JSON.parse(d);
			if(responsedate.response==true){
				var html="<option value=\"\">Select Send To</option>\n" +
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
				$("#"+appendcontrol).val(stype);
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
