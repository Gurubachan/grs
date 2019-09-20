 <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-6">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title" id="heading">Create Tickets </h4>

                </div>
                <div class="card-body">
                  <form name="frmGrievence" id="frmGrievence" method="post"
						action="<?= base_url('Grievance/insertGrievence')?>"
						enctype="multipart/form-data">
                    <div class="row">
                      <div class="col-md-6 ">
                        <div class="form-group">
							<select name="cboType" id="cboType" class="form-control" data-width="100%"  data-live-search="true" onchange="callGrievanceGeneraetForm(this)">
								<option value="">Category</option>
								<option value="na">Not in list</option>
							</select>
                        </div>
                      </div>
						<div class="col-md-6 ">
							<div class="form-group">
								<select name="cboSubCategory" id="cboSubCategory" class="form-control" data-width="100%"  data-live-search="true" onchange="callSubGrievanceGeneraetForm(this)">
									<option value="">Sub Category</option>
									<option value="na">Not in list</option>
								</select>
							</div>
						</div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Sender</label>
							<select name="cboFrom" id="cboFrom" class="form-control" onchange="callSenderReceiverForm(this,1)">
								<option value="">Select Sender</option>
								<option value="na">Other</option>
							</select>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Receiver</label>
							<select name="cboTo" id="cboTo" class="form-control" onchange="callSenderReceiverForm(this,2)">
								<option value="">Select Receiver</option>
								<option value="na">Other</option>
							</select>
                        </div>
                      </div>
                    </div>

						<div class="row" id="divMessageType">
							<div class="col-md-6">
								<div class="form-group">
									<label class="bmd-label-floating">Message Type</label>
									<select name="cboMessageType" id="cboMessageType" class="form-control"
											onchange="callMessageType(this)">
										<option value="">Select</option>
										<option value="na">Other</option>
									</select>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="bmd-label-floating">Seviourity</label>
									<select name="cboSeviourity" id="cboSeviourity" class="form-control"
											onchange="callSeviourity(this)">
										<option value="">Select</option>
										<option value="na">Other</option>
									</select>
								</div>
							</div>
						</div>
					  <div class="row">

						  <div class="col-md-6">
							  <div class="form-group">
								  <label class="bmd-label-floating">Source</label>
								  <select name="cboSource" id="cboSource" class="form-control" onchange="callSourceForm(this)">
									  <option value="">Select</option>
									  <option value="na">Other</option>
								  </select>
							  </div>
						  </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Referance</label>
							<select name="cboReferances" id="cboReferances" class="form-control"
									onchange="callReferances(this)">
								<option value="">Select</option>
								<option value="na">Other</option>
							</select>
                        </div>
                      </div>

                    </div>
					  <div class="row">
						  <div class="col-md-12">
							  <div class="form-group">
								  <label class="bmd-label-floating">Subject</label>
								  <input type="text" class="form-control" name="txtSubject">
							  </div>
						  </div>
					  </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label>Body</label>
                          <div class="form-group">
                            <label class="bmd-label-floating"> Content of the message for detail remarcation.</label>
                            <textarea class="form-control" rows="5" name="txtMessage"></textarea>
                          </div>
                        </div>
                      </div>
                    </div>
					  <div class="row">
						  <div class="col-md-3">
							  <div class="form-group">
								  <label>PC</label>
								  <select name="cboPc" id="cboPc" required class="form-control">
									  <option value="">Select</option>
								  </select>
							  </div>
						  </div>
							  <div class="col-md-3">
								  <div class="form-group">
									  <label>AC</label>
									  <select name="cboAc" id="cboAc" required class="form-control">
										  <option value="">Select</option>
									  </select>
								  </div>
							  </div>
						  <div class="col-md-3">
							  <div class="form-group">
								  <label>District</label>
								  <select name="cboDist" id="cboDist" required class="form-control">
									  <option value="">Select</option>
								  </select>
							  </div>
						  </div>
						  <div class="col-md-3">
							  <div class="form-group">
								  <label>Block/NAC/Munc.</label>
								  <select name="cboBlock" id="cboBlock" required class="form-control">
									  <option value="">Select</option>
								  </select>
							  </div>
						  </div>


					  </div>
                    <button type="reset" class="btn btn-danger pull-left">Reset</button>
                    <button type="submit" class="btn btn-primary pull-right" onclick="submitToServer('frmGrievence',event)">Register</button>
                    <div class="clearfix"></div>
                  </form>
                </div>
              </div>
            </div>
			  <div class="col-md-6" id="loadReport"></div>
		  </div>

		</div>
 </div>

<script>
	var pc="";
	var ac="";
	var dcode="";
	$("#cboPc").change(function () {
		pc=$(this).val();
		load_ac("cboAc");
		//load_district("cboDist");
	});
	$("#cboAc").change(function () {
		ac=$(this).val();
		//load_ac("cboAc");
		load_district("cboDist");
	});
	/*$("#cboBlock").change(function () {
		block=$(this).val();
		load_village("cboVillage");
	});*/

	$(document).ready(function () {
		load_pc('cboPc');
	});
	function load_pc(divid) {
		$.ajax({
			url:"<?= base_url('ServerPostResponse/load_pc')?>",
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
			url:"<?= base_url('ServerPostResponse/load_ac')?>",
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
			url:"<?= base_url('ServerPostResponse/get_distcode_on_ac')?>",
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
							html += "<option value=\"data[i]['dcode']\">" + data[i]['dname'] + "</option>";
						}
						dcode=data[i]['dcode'];
					}
					$("#"+divid).html(html).prop("disabled",true);
					load_municipality("cboBlock");
				}else{
					console.log(response);
				}

			}
		});
	}

	function load_municipality(divid) {
		$.ajax({
			url:"<?= base_url('ServerPostResponse/load_block')?>",
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

</script>
