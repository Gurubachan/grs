
function show_dependency_control(clickControl, effectControl){
	//alert($(clickControl).prop('id'));
	if($(clickControl).prop('checked')){
		$("#"+effectControl).show();
		loadDataAsPerRequest(effectControl);
		if($(clickControl).prop('id') =='chkLocation'){
			load_ac('cboAc');
		}
	}else{
		$("#"+effectControl).hide();
	}
}
$(document).on('change',"#cboRptType", function () {
	var rptcbotype = $("#cboRptType").val();
	if(rptcbotype == 3){
		$("#txtCalender").show();
		datePicker();
	}else{
		$("#txtCalender").hide();
	}
	$("#parameter_selector").show();
});
$(document).on("change","#cboCategory", function () {
	grievanceformtype=$(this).val();
	loadDataAsPerRequest('cboType');
});
$(document).on("change","#cboAc", function () {
	ac=$(this).val();
	load_district('cboDist');
});
function datePicker(){
	var dateFormat = "dd-mm-yy",
		from = $( "#txtFrom" ).datepicker({
			//defaultDate: "+1w",
			dateFormat:'dd-mm-yy',
			changeMonth: true,
			changeYear:true,
			numberOfMonths: 1,
			showAnim: "slideDown"
		}).on( "change", function() {
			to.datepicker( "option", "minDate", getDate( this ) );
		}),
		to = $( "#txtTo" ).datepicker({
			//defaultDate: "+1w",
			dateFormat:'dd-mm-yy',
			changeMonth: true,
			changeYear:true,
			numberOfMonths: 1,
			showAnim: "slideDown"
		}).on( "change", function() {
			from.datepicker( "option", "maxDate", getDate( this ) );
		});

	function getDate( element ) {
		var date;
		try {
			date = $.datepicker.parseDate( dateFormat, element.value );
		} catch( error ) {
			date = null;
		}
		return date;
	}
}

    $('#report_table').dataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy',
            'csv',
            'excel',
            'pdf',
        ],
        select: true
    });

function loadSearchReport(divid,responsedata) {
	if(responsedata){
		$("#"+divid).html(responsedata);
	}
}
