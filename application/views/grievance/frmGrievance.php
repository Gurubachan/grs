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
						enctype="multipart/form-data"
				  >
					  <fieldset >
						  <legend>Ticket Type</legend>
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
					  </fieldset>
					  <fieldset>
						  <legend>Sender and Receiver</legend>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Sender</label>
								<select name="cboFrom" id="cboFrom" style="width: 90%" class="form-control" onchange="callSenderReceiverForm(this,1)">
									<option value="">Select Sender</option>
									<option value="na">Not In List</option>
								</select>
							<a href="#" onclick="addSenderReceiver('cboFrom')"><i class="material-icons float-right" >add_circle</i></a>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label >Receiver</label>

							<select name="cboTo" id="cboTo" style="width: 90%" class="form-control" onchange="callSenderReceiverForm(this,2)">
								<option value="">Select Receiver</option>
								<option value="na">Not In List</option>
							</select>
							<a href="#" onclick="addSenderReceiver('cboTo')"> <i class="material-icons float-right" >add_circle</i></a>

                        </div>
                      </div>
                    </div>
					  </fieldset>
					  <fieldset id="divMessageType">
						  <legend>Message Status</legend>

						<div class="row" >
							<div class="col-md-4">
								<div class="form-group">
									<label class="bmd-label-floating">Message Type</label>
									<select name="cboMessageType" id="cboMessageType" class="form-control"
											onchange="callMessageType(this)">
										<option value="">Select</option>
										<option value="na">Other</option>
									</select>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label class="bmd-label-floating">Priority</label>
									<select name="cboSeviourity" id="cboSeviourity" class="form-control"
											onchange="callSeviourity(this)">
										<option value="">Select</option>
										<option value="na">Other</option>
									</select>
								</div>
							</div>
							<div class="col-md-4">
								<br>
								<div class="form-group">
									<label class="bmd-label-floating">Dade Line</label>
									<input type="text" class="form-control" readonly name="txtdateline" id="txtdateline">
								</div>
							</div>
						</div>
					  </fieldset>
					  <fieldset>
						  <legend>Messgae Area</legend>

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
								  <input type="text" class="form-control" name="txtSubject" id="txtSubject">
							  </div>
						  </div>
					  </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label>Body</label>
                          <div class="form-group">
                            <label class="bmd-label-floating"> Content of the message for detail remarcation.</label>
                            <textarea class="form-control" rows="5" name="txtMessage" id="txtMessage"></textarea>
                          </div>
                        </div>
                      </div>
                    </div>
					  </fieldset>
					  <fieldset>
						  <legend>Area Mapping Details</legend>
					  <div class="row">
						  <div class="col-md-3">
							  <div class="form-group">
								  <label>PC</label>
								  <select name="cboPc" id="cboPc" required class="form-control" >
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
								  <select name="cboDist" id="cboDist" required class="form-control" >
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
					  </fieldset>
					  <fieldset>
						  <legend>File Attachment</legend>
						  <div class="row">
							  <div class="col-md-6">
								  <input type="file" name="attachment" id="attachment" class="form-control" accept=".pdf,.docx,.doc,.jpg">
							  </div>
							  <div class="col-md-6">
								  <div class="form-group" >
									  <label class="bmd-label-floating">Letter Receive Date</label>
									  <input type="text" class="form-control" name="txtReceiveDate" id="txtReceiveDate" readonly>
									  <div id="uploadDiv"></div>
								  </div>
							  </div>
						  </div>
					  </fieldset>
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
	$("#cboPc").change(function () {
		//alert($(this).val());
		pc=$(this).val();
		load_ac("cboAc");
	});
	$("#cboAc").change(function () {
		ac=$(this).val();
		//load_ac("cboAc");
		load_district("cboDist");
	});
	$("#txtReceiveDate").datepicker({
		dateFormat:"dd-mm-yy",
		maxDate:"+0D"
	});
	$("#txtReceiveDate").datepicker("setDate", new Date());
	$("#cboFrom").select2();
	$("#cboTo").select2();
</script>
