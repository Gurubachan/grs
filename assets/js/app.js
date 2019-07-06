
function getGrievance() {
	$.ajax({
		type: "GET",
		url: "./Grievance/frmGrievance",
		data: null,
		success: function (d) {
			//console.log(d);
			$("#loadContaint").html(d);
			getGrievanceReport();
			loadGrievenceType('cboType');
			loadSenderReceiver('cboFrom',null,1);
			loadSenderReceiver('cboTo',null,2);
			loadSource('cboSource');
			loadGrievences('allGrievence');
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
var appendcontrol="";
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
			if(responsedata.success==true){
				var successresponse=responsedata.response;
				//alert(frmid);
				if(formid=="frmGrievence"){
					appendcontrol="allGrievence";
				}
				loadDataAsPerRequest(appendcontrol,successresponse);

				$("#myModal").modal('hide');
				$("#containtLoadHere").html('');
			}
		}
	});
}
function loadDataAsPerRequest(divid,responsedata) {
	//var day;
	switch (divid) {
		case "cboType":
			loadGrievenceType(divid,responsedata);
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
		case "frmGrievence":
			loadGrievences(divid,responsedata);
			break;
		case 5:
			day = "Friday";
			break;
		case  6:
			day = "Saturday";
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
			if(responsedate.success==true){
				var html="<option value=\"\">Select Grievance</option>\n" +
					"\t\t\t\t\t\t\t\t<option value=\"na\">Not In List</option>";
				var data=responsedate.response;
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
function loadSenderReceiver(dataloadingid=null,responsevalue=null,sendertype=null) {
	var url="./SenderReceiver/selectSenderReceiver/";

	$.ajax({
		type: "POST",
		url: url,
		data: {id:responsevalue, sendertype: sendertype},
		success: function (d) {
			var responsedate=JSON.parse(d);
			if(responsedate.success==true){
				var html="<option value=\"\">Select Sender</option>\n" +
					"\t\t\t\t\t\t\t\t<option value=\"na\">Not In List</option>";
				var data=responsedate.response;
				for (var i=0; i<data.length;i++){
					html+="<option value="+data[i].id+">"+data[i].name+"</option>";
				}
				//console.log(html);
				$("#"+dataloadingid).html(html);

			}
		}
	});
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
				$(".x").removeClass('col-md-6').addClass('col-md-12');
				appendcontrol=t.id;
				//$("#cboSenderReceiver").attr('disabled',true);

			}
		});
	}
}

function loadSource(dataloadingid=null,responsevalue=null) {
	$.ajax({
		type: "GET",
		url: "./Source/select",
		data: null,
		success: function (d) {
			var responsedate=JSON.parse(d);
			if(responsedate.success==true){
				var html="<option value=\"\">Select Source</option>\n" +
					"\t\t\t\t\t\t\t\t<option value=\"na\">Not In List</option>";
				var data=responsedate.response;
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

function loadGrievences(dataloadingid=null,responsevalue=null) {
	$.ajax({
		type: "GET",
		url: "./Grievance/loadGrievences",
		data: null,
		success: function (d) {
			var responsedate=JSON.parse(d);
			if(responsedate.success==true){
				var html="";
				var data=responsedate.response;
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
