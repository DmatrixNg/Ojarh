</div>
      <div class="app-wrapper-footer">
      	<div class="app-footer">
      		<div class="">
      			<div class="app-footer__inner">
      				<div class="app-footer-left">
      					<div class="footer-dots">
      						<div class="" style="font-size: 11px; color: #999999;">Copyright © <?php echo date('Y'); ?> OJARH.com - All rights
      						reserved. </div>
      					</div>
      				</div>
      			</div>
      		</div>
      	</div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="disputeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel"></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<label for="recipient-name" class="col-form-label">Complainant:</label>
					<input type="text" class="form-control" id="senderusername" value="" readonly>
				</div>
				<div class="form-group">
					<label for="recipient-name" class="col-form-label">Against:</label>
					<input type="text" class="form-control" id="againstusername" value="" readonly>
				</div>
				<div class="form-group">
					<label for="message-text" class="col-form-label">Message:</label>
					<textarea class="form-control" id="dispute_message" value=""></textarea>
				</div>
			</div>
			<input type="hidden" class="form-control" id="disputeid" value="">
			<input type="hidden" class="form-control" id="senderid" value="">
			<input type="hidden" class="form-control" id="againstid" value="">
			<div id="disputer_result"></div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" id="disputeResponseBtn">Send Message</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="category_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-body">
				<form action="<?= BASE_URL ?>api/controllers/category_update.php" method="post" enctype="multipart/form-data">
					<div class="main-card mb-3 card">
						<div class="card-body"><h5 class="card-title">Edit Category</h5>
							<hr>
							<div class="position-relative form-group">
								<label for="exampleEmail" class="">Category Name</label>
								<input name="e_catid" id="e_catid" type="hidden" class="form-control">
								<input name="e_catname" id="e_catname" type="text" class="form-control">
							</div>
							<div class="position-relative form-group">
								<label for="catdetail" class="">Category Description</label>
								<textarea class="form-control" rows="3" id="e_catdescription" name="e_catdescription"></textarea>
							</div>
							<div id="e_catimage"></div>
							<div class="position-relative form-group">
								<label for="catimage" class="">Upload Icon</label>
								<input name="e_catimage" id="e_catimage" type="file" class="form-control-file">
									<p class="form-text text-danger"><em>Icon image must be in png, jpg or gif, and must me 50 X 50 in dimension.</em></p>
								</div>
								<div id="result"></div>
							<button class="mt-1 btn btn-danger btn-sm" type="submit">Update Category</button>
						</div>
					</div>
				</form>
			</div>
			<div id="tty"></div>
		</div>
	</div>
</div>

<div class="modal fade" id="market_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-body">
			<form action="<?= BASE_URL ?>api/controllers/market_update.php" method="post" enctype="multipart/form-data">
				<div class="position-relative form-group">
				<label for="marketname" class="">Market Name</label>
				<input name="e_marketname" id="e_marketname" type="text" class="form-control">
				<input name="e_marketid" id="e_marketid" type="hidden" class="form-control">
				</div>
				<div class="position-relative form-group">
				<label for="state" class="">Choose State Location of the Market</label>
				<select class="form-control" name="e_marketstate" id="e_marketstate">
				<option value="" selected="selected">Select State</option>
				<?php $userClass->fetchStates(); ?>
				</select>
				</div>
				<div class="form-group row">
				<div class="col-md-12">
					<label for="exampleEmail5">Product Categories</label>
					<select multiple="multiple" class="multiselect-dropdown form-control" name="e_marketcategories[]" id="e_marketcategories[]" required="required">
					<?php $userClass->category_dropdown_list(); ?>
					</select>
				</div>
				</div>
				<div class="position-relative form-group">
				<label for="marketaddress" class="">Market Address</label>
				<textarea class="form-control" rows="2" id="e_marketaddress" name="e_marketaddress"></textarea>
				</div>
				<div class="position-relative form-group">
				<label for="marketchair" class="">Market Chairman Name</label>
				<input name="e_marketchairman" id="e_marketchairman" type="text" class="form-control">
				</div>
				<div class="position-relative form-group">
				<div id="e_marketimg"></div>
				<label for="marketfile" class="">Upload market Image</label>
				<input name="e_marketimg" id="e_marketimg" type="file" class="form-control-file">
				<p class="form-text text-danger"><em>Icon image must be in png, jpg or gif, and must me 50 X 50 in dimension.</em></p>
				</div>
				<button type="submit" class="mt-1 btn btn-primary" id="marketBtn">Update Market</button>
			</form>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="subadmin-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-body">
			<div class="main-card mb-3 card">
				<div class="card-body">
					<h5 class="card-title">View/Edit Users Details</h5>
					<hr>
					<div class="form-row">
						<div class="col-md-12">
							<div class="position-relative form-group">
								<input name="d_id" id="d_id" placeholder="id" type="text" class="form-control" readonly>
							</div>
						</div>
						<div class="col-md-12">
							<div class="position-relative form-group">
								<input name="d_username" id="d_username" placeholder="Username here..." type="text" class="form-control">
							</div>
						</div>
						<div class="col-md-12">
							<div class="position-relative form-group">
								<input name="d_password" id="d_password" placeholder="Password here..." type="password" class="form-control">
							</div>
						</div>
						<div class="col-md-12">
							<div class="position-relative form-group">
								<input name="d_email" id="d_email" placeholder="Email here..." type="email" class="form-control">
							</div>
						</div>
					</div>
					<div class="form-row">
						<div class="col-md-6">
							<div class="position-relative form-group">
								<input name="d_fname" id="d_fname" placeholder="First Name here..." type="text" class="form-control">
							</div>
						</div>
						<div class="col-md-6">
							<div class="position-relative form-group">
								<input name="d_lname" id="d_lname" placeholder="Last Name here..." type="text" class="form-control">
							</div>
						</div>
						<div class="col-md-6">
							<div class="position-relative form-group">
								<input name="d_phone" id="d_phone" placeholder="Phone Number here..." type="number" class="form-control">
							</div>
						</div>
						<div class="col-md-6" id="stat">
							<select class="form-control" name="d_statelocal" id="d_statelocal" required="required">
								<option value="" selected="selected">Select State</option>
								<?php echo $userClass->fetchStates(); ?>
							</select>
							<input name="d_countrylocal" id="d_countrylocal" value="Nigeria" type="hidden" class="form-control col-12">
						</div>
						<div class="col-md-12 mt-3">
							<div class="position-relative form-group">
								<textarea class="form-control" id="d_address" name="d_address" placeholder="Address here" rows="2"></textarea>
							</div>
						</div>
					</div>
					<div class="modal-footer d-block text-center">
						<div id="loaders2" style="display: none;">
							<div class="loader-wrapper d-flex justify-content-center align-items-center">
								<div class="loader">
									<div class="ball-clip-rotate-multiple">
										<div></div>
										<div></div>
									</div>
								</div>
							</div>
						</div>
						<div id="updateprofile"></div>
						<button class="btn-wide btn-pill btn-shadow btn-hover-shine btn btn-danger btn-sm" id="btn_subadmin">Update Details</button>
					</div>
				</div>
			</div>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="agent-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-body">
			<div class="main-card mb-3 card">
				<div class="card-body">
					<h5 class="card-title">View/Edit Agent Details</h5>
					<hr>
					<div class="form-row">
						<div class="col-md-12">
							<div class="position-relative form-group">
								<input name="a_id" id="a_id" placeholder="id" type="text" class="form-control" readonly>
							</div>
						</div>
						<div class="col-md-12">
							<div class="position-relative form-group">
                <div id="a_img"></div>
							</div>
						</div>

						<div class="col-md-12">
							<div class="position-relative form-group">
								<input name="a_email" id="a_email" placeholder="Email here..." type="email" class="form-control">
							</div>
						</div>
					</div>
					<div class="form-row">
						<div class="col-md-6">
							<div class="position-relative form-group">
								<input name="a_fname" id="a_fname" placeholder="First Name here..." type="text" class="form-control">
							</div>
						</div>
						<div class="col-md-6">
							<div class="position-relative form-group">
								<input name="a_lname" id="a_lname" placeholder="Last Name here..." type="text" class="form-control">
							</div>
						</div>
						<div class="col-md-6">
							<div class="position-relative form-group">
								<input name="a_phone" id="a_phone" placeholder="Phone Number here..." type="number" class="form-control">
							</div>

						</div>

						<div class="col-md-6" id="stat">
							<select class="form-control" name="a_statelocal" id="a_statelocal" required="required">
								<option value="" selected="selected">Select State</option>
								<?php echo $userClass->fetchStates(); ?>
							</select>
              <span><i id="a_statelocal2"></i> </span>
						</div>
            <div class="col-md-12">
            <input name="a_countrylocal" id="a_countrylocal" value="Nigeria" type="hidden" class="form-control col-12">
            </div>
            <div class="col-md-12 mt-3">
							<div class="position-relative form-group">
								<textarea class="form-control" id="a_address" name="a_address" placeholder="Address here" rows="2"></textarea>
							</div>
						</div>
					</div>
					<div class="modal-footer d-block text-center">
						<div id="loaders2" style="display: none;">
							<div class="loader-wrapper d-flex justify-content-center align-items-center">
								<div class="loader">
									<div class="ball-clip-rotate-multiple">
										<div></div>
										<div></div>
									</div>
								</div>
							</div>
						</div>
						<div id="updateprofile2"></div>
						<button class="btn-wide btn-pill btn-shadow btn-hover-shine btn btn-danger btn-sm" id="btn_agent">Update Details</button>
					</div>
				</div>
			</div>
			</div>
		</div>
	</div>
</div>

<div class="app-drawer-overlay d-none animated fadeIn"></div>
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.js"></script>
<script type="text/javascript" src="js/main.js"></script>
<script type="text/javascript">

$(".delete_category").click(function(){
	if(confirm('You are about to delete this category, continue?')){
		$.ajax({
			type: 'POST',
			url: '<?= BASE_URL ?>api/controllers/category_admin_action.php',
			data: {
				catid : this.id,
				action : 'delete_category'
			},
			cache: false,
			dataType: 'text',
			success: function (response) {
				$('#intoto').html('<span class="alert alert-danger>'+response+'</span>');
				window.location.reload(3000);
			}
		});
		event.preventDefault();
	}else{
		return false;
	}

});

$(".edit_category").click(function(){
	$.ajax({
		type: 'POST',
		url: '<?= BASE_URL ?>api/controllers/get_single_category.php',
		data : {
			catid : this.id
		},
		cache: false,
		dataType: 'text',
		success: function (response) {
			var vvv = JSON.parse(response)
			//console.log(response);
			$('#e_catname').val(vvv.catname);
			$('#e_catimage').html('<img class="img" width="180" height="auto" src="../seller/catImage/'+vvv.catid+'/'+vvv.catImage+'"/>');
			$('#e_catid').val(vvv.catid);
			$('#e_catdescription').val(vvv.catdescription);
			$('#category_edit').modal('show');
		},
		error: function (response) {
			//console.log(response);
		}
	});
	event.preventDefault();
});

$(".edit_market").click(function(){
	$.ajax({
		type: 'POST',
		url: '<?= BASE_URL ?>api/controllers/get_single_market.php',
		data : {
			marketid : this.id
		},
		cache: false,
		dataType: 'json',
		success: function (response) {
			//console.log(response)
			var mainV = response[0];
			var subV = response[1];
			$('#e_marketimg').html('<img class="img" width="180" height="auto" src="../seller/marketImage/'+mainV['marketname']+'/'+mainV['marketimg']+'"/>');
			$('#e_marketname').val(mainV['marketname']);
			$('#e_marketid').val(mainV['marketid']);
			$('#e_marketstate').val(mainV['marketstate']);
			$('#e_marketaddress').val(mainV['marketaddress']);
			$('#e_marketchairman').val(mainV['marketname']);
			$('#market_edit').modal('show');
		},
		error: function (response) {
			//console.log(response);
		}
	});
	event.preventDefault();

});

function subadmindetails(id){
	$.ajax({
		type: 'POST',
		url: '<?= BASE_URL ?>api/controllers/get_single_sub_admin.php',
		data : {
			subadminid : id
		},
		cache: false,
		dataType: 'text',
		success: function (response) {
			var vvv = JSON.parse(response)
			// //console.log(response);
			$('#d_id').val(vvv.userid);
			$('#d_username').val(vvv.username);
			// $('#d_password').val(vvv.password);
			$('#d_email').val(vvv.email);
			$('#d_fname').val(vvv.fname);
			$('#d_lname').val(vvv.lname);
			$('#d_phone').val(vvv.phone);
			$('#d_statelocal').val(vvv.state);
			$('#d_countrylocal').val(vvv.country);
			$('#d_address').val(vvv.address);
			$('#btn_subadmin').attr('onclick', 'update_subadmin('+vvv.userid+')');
			$('#subadmin-modal').modal('show');
		},
		error: function (response) {
			//console.log(response);
		}
	});
	event.preventDefault();
}
function agentdetails(id){
  //console.log(id);
	$.ajax({
		type: 'POST',
		url: '<?= BASE_URL ?>api/controllers/single_agent_details.php',
		data : {
			agentid : id
		},
		cache: false,
		dataType: 'text',
		success: function (response) {
			var vvv = JSON.parse(response)
			//console.log(vvv.agentid);
			$('#a_id').val(vvv.agentid);
			// $('#d_username').val(vvv.username);
			$('#a_img').html('<img width="100" src="/agentprofilepic/'+vvv.agentid+'/'+vvv.agentpic_name+'">');
			$('#a_email').val(vvv.agentemail);
			$('#a_fname').val(vvv.agentfname);
			$('#a_lname').val(vvv.agentlname);
			$('#a_phone').val(vvv.agentphone);
			$('#a_statelocal').val(vvv.agentstate);
			$('#a_statelocal2').html(vvv.agentstate);
			$('#a_countrylocal').val(vvv.agentcountry);
			$('#a_address').val(vvv.agentaddress);
			$('#btn_agent').attr('onclick', 'update_agent('+vvv.agentid+')');
			$('#agent-modal').modal('show');
		},
		error: function (response) {
			//console.log(response);
		}
	});
	event.preventDefault();
}

function update_agent(id){
	document.getElementById('updateprofile2').innerHTML = '';
		// $('#btn_agent').hide();
		$('#loaders2').show();

		$.ajax({
			type: 'POST',
			url: '<?= BASE_URL ?>api/controllers/register_agent.php',
			data: {
				id : $('#a_id').val(),
				agentfname : $('#a_fname').val(),
				agentlname : $('#a_lname').val(),
				agentphone : $('#a_phone').val(),
				agentemail : $('#a_email').val(),
				agentstate : $('#a_statelocal').val(),
				agentcountry : $('#a_countrylocal').val(),
				agentaddress : $('#a_address').val()
			},
			cache: false,
			dataType: 'text',
			success: function(response) {
				//console.log(response);
        if(response == "success"){
          setTimeout(function(){
  					window.location.reload(3000);
  				}, 5000);
				}else{
					document.getElementById('updateprofile').innerHTML = response;
					$('#btn_subadmin').show();
					$('#loaders2').hide();
					return;
				}

			}
		});
		event.preventDefault();
}
function update_subadmin(id){
	document.getElementById('updateprofile').innerHTML = '';
		$('#btn_subadmin').hide();
		$('#loaders2').show();

		$.ajax({
			type: 'POST',
			url: '<?= BASE_URL ?>api/controllers/create_user.php',
			data: {
				id : $('#d_id').val(),
				role : 'Sub Admin',
				username : $('#d_username').val(),
				email: $('#d_email').val(),
				password : $('#d_password').val(),
				fname : $('#d_fname').val(),
				lname : $('#d_lname').val(),
				phone : $('#d_phone').val(),
				state : $('#d_statelocal').val(),
				country : $('#d_countrylocal').val(),
				address : $('#d_address').val()
			},
			cache: false,
			dataType: 'text',
			success: function(response) {
				//console.log(response);
				if(response == "username"){
					document.getElementById('updateprofile').innerHTML = 'Username taken!';
					$('#btn_subadmin').show();
					$('#loaders2').hide();
					return;
				}else if(response == "email"){
					document.getElementById('updateprofile').innerHTML = 'Email already in use!';
					$('#btn_subadmin').show();
					$('#loaders2').hide();
					return;
				}else if(response == "success"){
					document.getElementById('btn_subadmin').innerHTML = 'Redirecting...';
					document.getElementById('updateprofile').innerHTML = 'Update successful';
					return;
				}else{
					document.getElementById('updateprofile').innerHTML = response;
					$('#btn_subadmin').show();
					$('#loaders2').hide();
					return;
				}

			}
		});
		event.preventDefault();
}

$(".delete_market").click(function(){
	if(confirm('You are about to delete this market, continue?')){
		$.ajax({
			type: 'POST',
			url: '<?= BASE_URL ?>api/controllers/market_delete.php',
			data: {
				marketid : this.id
			},
			cache: false,
			dataType: 'text',
			success: function (response) {
				$('#intoto').html('<span class="alert alert-danger>'+response+'</span>');
				setTimeout(function(){
					window.location.reload(3000);
				}, 5000);
			}
		});
		event.preventDefault();
	}else{
		return false;
	}

});


	function validate(productid) {
		if (document.getElementById('productSetting').checked) {
			$.ajax({
				type: 'POST',
				url: '<?= BASE_URL ?>api/controllers/updateProductSettings.php',
				data: {
					productid : productid,
					productsetting : 1
				},
				cache: false,
				dataType: 'text',
				success: function (response) {
					if(response == 'success'){
						document.getElementById('result').innerHTML = '<p class="alert alert-success">Product setting updated!</p>';
						setTimeout(function () {
							window.location.reload();
						}, 3000);
						return;
					}else{
						document.getElementById('result').innerHTML = '<p class="alert alert-warning">' + response + '</p>';
						setTimeout(function () {
							window.location.reload();
						}, 3000);
						return;
					}
				}
			});
			event.preventDefault();
		} else {
			$.ajax({
				type: 'POST',
				url: '<?= BASE_URL ?>api/controllers/updateProductSettings.php',
				data: {
					productid : productid,
					productsetting : 0
				},
				cache: false,
				dataType: 'text',
				success: function (response) {
					if(response == 'success'){
						document.getElementById('result').innerHTML = '<p class="alert alert-success">Product setting updated!</p>';
						setTimeout(function () {
							window.location.reload();
						}, 3000);
						return;

					}else{
						document.getElementById('result').innerHTML = '<p class="alert alert-warning">' + response + '</p>';
						setTimeout(function () {
							window.location.reload();
						}, 3000);
						return;
					}
				}
			});
			event.preventDefault();
		}
	}

	function replySender(disputeid, senderid, againstid, recipientname){
		var fields = recipientname.split('-');
		var senderusername = fields[0];
		var againstusername = fields[1];
		document.getElementById("againstusername").value = againstusername;
		document.getElementById("senderusername").value = senderusername;
		document.getElementById("disputeid").value = disputeid;
		document.getElementById("senderid").value = senderid;
		document.getElementById("againstid").value = againstid;
		document.getElementById("exampleModalLabel").innerHTML = "RE: Dispute Between " + senderusername + " &amp; " + againstusername;
		$('#disputeModal').modal('show');
	}

	function replyAgainst(disputeid, senderid, againstid, recipientname){
		var fields = recipientname.split('-');
		var senderusername = fields[0];
		var againstusername = fields[1];
		document.getElementById("againstusername").value = againstusername;
		document.getElementById("senderusername").value = senderusername;
		document.getElementById("disputeid").value = disputeid;
		document.getElementById("senderid").value = senderid;
		document.getElementById("againstid").value = againstid;
		document.getElementById("exampleModalLabel").innerHTML = "RE: Dispute Between " + senderusername + " &amp; " + againstusername;
		$('#disputeModal').modal('show');
	}

	function resolvedDispute(disputeid, senderid, againstid){
		$.ajax({
			type: 'POST',
			url: '<?= BASE_URL ?>api/controllers/dispute_resolved.php',
			data: {
				disputeid : disputeid,
				senderid : senderid,
				againstid : againstid
			},
			cache: false,
			dataType: 'text',
			success: function (response) {
            // alert(response);
            // return;
            if(response == 'success'){
            	document.getElementById('result').innerHTML = '<p class="alert alert-success">Dispute resolved!</p>';
            	setTimeout(function () {
            		window.location.reload();
            	}, 3000);
            	return;
            }else{
            	document.getElementById('result').innerHTML = '<p class="alert alert-warning">' + response + '</p>';
            	setTimeout(function () {
            		window.location.reload();
            	}, 3000);
            	return;
            }
          }
        });
		event.preventDefault();
	}
	function cancelledDispute(disputeid, senderid, againstid){
		$.ajax({
			type: 'POST',
			url: '<?= BASE_URL ?>api/controllers/dispute_cancelled.php',
			data: {
				disputeid : disputeid,
				senderid : senderid,
				againstid : againstid
			},
			cache: false,
			dataType: 'text',
			success: function (response) {
            // alert(response);
            // return;
            if(response == 'success'){
            	document.getElementById('result').innerHTML = '<p class="alert alert-success">Dispute resolved!</p>';
            	setTimeout(function () {
            		window.location.reload();
            	}, 3000);
            	return;
            }else{
            	document.getElementById('result').innerHTML = '<p class="alert alert-warning">' + response + '</p>';
            	setTimeout(function () {
            		window.location.reload();
            	}, 3000);
            	return;
            }
          }
        });
		event.preventDefault();
	}


	function MessageAction(messageid,action){
		$.ajax({
			type: 'POST',
			url: '<?= BASE_URL ?>api/controllers/message_status.php',
			data: {
				messid : messageid,
        action    : action
			},
			cache: false,
			dataType: 'text',
			success: function (response) {
            // alert(response);
            // return;
            if(response == 'success'){
            	document.getElementById('result').innerHTML = '<p class="alert alert-success">Messaged Approved!</p>';
            	setTimeout(function () {
            		window.location.reload();
            	}, 3000);
            	return;
            }else{
            	document.getElementById('result').innerHTML = '<p class="alert alert-warning">' + response + '</p>';
            	setTimeout(function () {
            		window.location.reload();
            	}, 3000);
            	return;
            }
          }
        });
		event.preventDefault();
	}

	$(".settingsUpdater").click(function(){
		var column = $(this).attr("data-column");
		var input = $(this).attr("data-input");
		var output = $(this).attr("data-output");
		var type = $(this).attr("data-type");

		$.ajax({
      		type: 'POST',
      		url: '<?= BASE_URL ?>api/controllers/updateSettings.php',
      		data: {
      			column: column,
      			value: $(input).val()
      		},
      		cache: false,
      		dataType: 'text',
      		success: function (response) {
              // return;
              document.getElementById('result').innerHTML = response;
              if(type)
              {
              	$(output).attr(type, $(input).val());
              }
            }
          });
      	event.preventDefault();
	})


	$('#finalNextBtn').on('click', function () {
		document.getElementById('mess3').innerHTML = '';
		$('#finalNextBtn').hide();
		$('#loaders2').show();

		var state = $('#statelocal').val();
		var country = $('#countrylocal').val();

		let data2 = {
			fname : $('#fname').val(),
			lname : $('#lname').val(),
			phone : $('#phone').val(),
			state : state,
			country : country,
			address : $('#address').val()
		}

		if(!validatePhone(data2.phone)){
			document.getElementById('mess3').innerHTML = 'Phone number not properly formatted.';
			$('#finalNextBtn').show();
			$('#loaders2').hide();
			return false;
		}

		if(data2.fname !== '' || data2.lname!=='' || data2.phone!=='' || data2.country !=='' || data2.state !== '' || data2.address!==''){
			$.ajax({
				type: 'POST',
				url: '<?= BASE_URL ?>api/controllers/create_user.php',
				data: {
					role : $('#role').val(),
					username : $('#username').val(),
					email: $('#email').val(),
					password : $('#password').val(),
					fname : $('#fname').val(),
					lname : $('#lname').val(),
					phone : $('#phone').val(),
					state : state,
					country : country,
					address : $('#address').val()
				},
				cache: false,
				dataType: 'text',
				success: function(response) {
					//console.log(response);
          // return;
          if(response == "username"){
          	document.getElementById('mess3').innerHTML = 'Username taken!';
          	$('#finalNextBtn').show();
          	$('#loaders2').hide();
          	return;
          }else if(response == "email"){
          	document.getElementById('mess3').innerHTML = 'Email already in use!';
          	$('#finalNextBtn').show();
          	$('#loaders2').hide();
          	return;
          }else if(response == "success"){
          	document.getElementById('finalNextBtn').innerHTML = 'Redirecting...';
          	document.getElementById('mess3').innerHTML = 'Success. Redirecting...';
          	setTimeout(function () {
          		window.location = 'administrators.php?result=Admin Account Created!';
          	}, 3000);
          	return;
          }else{
          	document.getElementById('mess3').innerHTML = response;
          	$('#finalNextBtn').show();
          	$('#loaders2').hide();
          	return;
          }

        }
      });
			event.preventDefault();
		}else{
			document.getElementById('mess3').innerHTML = 'Field(s) empty!';
			$('#finalNextBtn').show();
			$('#loaders2').hide();
		}
	});

	function validateEmail(email) {
		var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
		return re.test(email);
	}

	function validatePhone(phone) {
		var re = /^[+]*[(]{0,1}[0-9]{1,3}[)]{0,1}[-\s\./0-9]*$/g;
		return re.test(phone);
	}

	$(document).ready(function () {

		$('#logoutBtn').on('click', function(){
			window.location = '<?= BASE_URL ?>api/controllers/logout.php';
		});

		$("#disputeResponseBtn").on('click',(function(e){
			document.getElementById('disputeResponseBtn').innerHTML = "Please wait...";
			document.getElementById('disputeResponseBtn').disabled = true;
			document.getElementById('disputer_result').innerHTML = '';

			if($('#dispute_message').val() != ''){
				$.ajax({
					type: 'POST',
					url: '<?= BASE_URL ?>api/controllers/dispute_response.php',
					data: {
						senderusername : $('#senderusername').val(),
						againstusername : $('#againstusername').val(),
						dispute_message : $('#dispute_message').val(),
						disputeid : $('#disputeid').val(),
						senderid : $('#senderid').val(),
						againstid : $('#againstid').val()
					},
					cache: false,
					dataType: 'text',
					success: function (response) {
						//console.log(response);
						if(response == 'success'){
							document.getElementById('disputeResponseBtn').innerHTML = "Success";
							document.getElementById('disputeResponseBtn').disabled = true;
							document.getElementById('disputer_result').innerHTML = '<p class="alert alert-success">Dispute responded to and waiting for confirmation!</p>';
							setTimeout(function () {
								window.location.reload();
							}, 3000);
						}
						else if(response == 'exist'){
							document.getElementById('disputeResponseBtn').innerHTML = "Send Message";
							document.getElementById('disputeResponseBtn').disabled = false;
							document.getElementById('disputer_result').innerHTML = '<p class="alert alert-danger">You have submitted this request, our admin is currently investigating, please wait!</p>';
							setTimeout(function () {
								$('#disputeModal').modal('dispose');
								$('#disputer_result').fadeOut();
							}, 5000);
						}else{
							document.getElementById('disputeResponseBtn').innerHTML = "Send Message";
							document.getElementById('disputeResponseBtn').disabled = false;
							document.getElementById('disputer_result').innerHTML = '<p class="alert alert-warning">' + response + '</p>';
							setTimeout(function () {
								$('#disputeModal').modal('dispose');
								$('#disputer_result').fadeOut();
							}, 4000);
						}
					}
				});
				event.preventDefault();
			}else{
				document.getElementById('disputeResponseBtn').innerHTML = "Send Message";
				document.getElementById('disputeResponseBtn').disabled = false;
				document.getElementById('disputer_result').innerHTML = '<p class="alert alert-danger">State your response to the complaint or request.</p>';
				setTimeout(function () {
					$('#disputer_result').fadeOut();
				}, 4000);
			}
		}));


		$("#catBtn").on('click',(function(e){
			document.getElementById('catBtn').innerHTML = "Please wait...";
			document.getElementById('catBtn').disabled = true;
			var catData = {
				catname : $("#catname").val(),
				catdescription : $("#catdescription").val()
			}
			$.ajax({
				type: 'POST',
				url: '<?= BASE_URL ?>api/controllers/category_add.php',
				data: catData,
				cache: false,
				dataType: 'text',
				success: function (response) {
                // alert(response);
                // return;
                if(response == 'success'){
                	document.getElementById('catBtn').innerHTML = "Create Category";
                	document.getElementById('catBtn').disabled = false;
                	document.getElementById('result').innerHTML = '<p class="alert alert-success">Category added!</p>';
                	return true;
                }
                else if(response == 'exist'){
                	document.getElementById('catBtn').innerHTML = "Create Category";
                	document.getElementById('catBtn').disabled = false;
                	document.getElementById('result').innerHTML = '<p class="alert alert-danger">Category exist!</p>';
                	return true;
                }else{
                	document.getElementById('catBtn').innerHTML = "Create Category";
                	document.getElementById('catBtn').disabled = false;
                	document.getElementById('result').innerHTML = '<p class="alert alert-warning">' + response + '</p>';
                	return true;
                }
              }
            });
			event.preventDefault();
		}));

	});

      function activateSeller(userid, userType="Seller"){
      	$.ajax({
      		type: 'POST',
      		url: '<?= BASE_URL ?>api/controllers/activate_seller.php',
      		data: {
      			userid : userid
      		},
      		cache: false,
      		dataType: 'text',
      		success: function (response) {
              // alert(response);
              // return;
              if(response == 'success'){
              	document.getElementById('result').innerHTML = '<p class="alert alert-success"> Approved!</p>';
              	setTimeout(function () {
              		window.location.reload();
              	}, 3000);
              	return;
              }else{
              	document.getElementById('result').innerHTML = '<p class="alert alert-warning">' + response + '</p>';
              	setTimeout(function () {
              		window.location.reload();
              	}, 3000);
              	return;
              }
            }
          });
      	event.preventDefault();
      }

      function deactivateSeller(userid, userType="Seller"){
      	$.ajax({
      		type: 'POST',
      		url: '<?= BASE_URL ?>api/controllers/deactivate_seller.php',
      		data: {
      			userid : userid
      		},
      		cache: false,
      		dataType: 'text',
      		success: function (response) {
              // alert(response);
              // return;
              if(response == 'success'){
              	document.getElementById('result').innerHTML = '<p class="alert alert-danger"> Disapproved!</p>';
              	setTimeout(function () {
              		window.location.reload();
              	}, 3000);
              	return;
              }else{
              	document.getElementById('result').innerHTML = '<p class="alert alert-warning">' + response + '</p>';
              	setTimeout(function () {
              		window.location.reload();
              	}, 3000);
              	return;
              }
            }
          });
      	event.preventDefault();
      }

      function activateProduct(productid, sellerid){
      	$.ajax({
      		type: 'POST',
      		url: '<?= BASE_URL ?>api/controllers/activate_product.php',
      		data: {
      			productid : productid,
      			sellerid : sellerid
      		},
      		cache: false,
      		dataType: 'text',
      		success: function (response) {
      			//console.log(response);
              // return;
              if(response == 'success'){
              	document.getElementById('result').innerHTML = '<p class="alert alert-success">Product Approved!</p>';
              	setTimeout(function () {
              		window.location.reload();
              	}, 3000);
              	return;
              }else{
              	document.getElementById('result').innerHTML = '<p class="alert alert-warning">' + response + '</p>';
              	setTimeout(function () {
              		window.location.reload();
              	}, 3000);
              	return;
              }
            }
          });
      	event.preventDefault();
      }

    function deactivateProduct(productid, sellerid){
		// alert(sellerid);
		// return;
		$.ajax({
			type: 'POST',
			url: '<?= BASE_URL ?>api/controllers/deactivate_product.php',
			data: {
				productid : productid,
				sellerid : sellerid
			},
			cache: false,
			dataType: 'text',
			success: function (response) {
				// alert(response);
				// return;
				if(response == 'success'){
					document.getElementById('result').innerHTML = '<p class="alert alert-danger">Product Disapproved!</p>';
					setTimeout(function () {
						window.location.reload();
					}, 3000);
					return;
				}else{
					document.getElementById('result').innerHTML = '<p class="alert alert-warning">' + response + '</p>';
					setTimeout(function () {
						window.location.reload();
					}, 3000);
					return;
				}
				}
			});
      event.preventDefault();
    }
      function PayoutStatus(id, status){
      	$.ajax({
      		type: 'POST',
      		url: '<?= BASE_URL ?>api/controllers/payout_status.php',
      		data: {
      			id : id,
      			status : status
      		},
      		cache: false,
      		dataType: 'text',
      		success: function (response) {

            console.log(response);
              if(response == 'success'){
              	document.getElementById('result').innerHTML = '<p class="alert alert-success">Review Approved!</p>';
              	setTimeout(function () {
              		window.location.reload();
              	}, 3000);
              	return;
              }else{
              	document.getElementById('result').innerHTML = '<p class="alert alert-warning">' + response + '</p>';
              	setTimeout(function () {
              		window.location.reload();
              	}, 3000);
              	return;
              }
            }
          });
      	event.preventDefault();
      }
      function approveReview(reviewid, sellerid){
      	$.ajax({
      		type: 'POST',
      		url: '<?= BASE_URL ?>api/controllers/approve_review.php',
      		data: {
      			reviewid : reviewid,
      			sellerid : sellerid
      		},
      		cache: false,
      		dataType: 'text',
      		success: function (response) {
      			//console.log(response);
              // return;
              if(response == 'success'){
              	document.getElementById('result').innerHTML = '<p class="alert alert-success">Review Approved!</p>';
              	setTimeout(function () {
              		window.location.reload();
              	}, 3000);
              	return;
              }else{
              	document.getElementById('result').innerHTML = '<p class="alert alert-warning">' + response + '</p>';
              	setTimeout(function () {
              		window.location.reload();
              	}, 3000);
              	return;
              }
            }
          });
      	event.preventDefault();
      }

    function disapprovedReview(reviewid, sellerid){
      // alert(sellerid);
      // return;
      $.ajax({
      	type: 'POST',
      	url: '<?= BASE_URL ?>api/controllers/disapprove_review.php',
      	data: {
      		reviewid : reviewid,
      		sellerid : sellerid
      	},
      	cache: false,
      	dataType: 'text',
      	success: function (response) {
              // alert(response);
              // return;
              if(response == 'success'){
              	document.getElementById('result').innerHTML = '<p class="alert alert-danger">Product Disapproved!</p>';
              	setTimeout(function () {
              		window.location.reload();
              	}, 3000);
              	return;
              }else{
              	document.getElementById('result').innerHTML = '<p class="alert alert-warning">' + response + '</p>';
              	setTimeout(function () {
              		window.location.reload();
              	}, 3000);
              	return;
              }
            }
          });
      event.preventDefault();
    }

    function activateAgent(agentid){
	// alert(agentid);
	// return;
	$.ajax({
		type: 'POST',
		url: '<?= BASE_URL ?>api/controllers/activate_agent.php',
		data: {
			agentid : agentid
		},
		cache: false,
		dataType: 'text',
		success: function (response) {
			// alert(response);
			// return;
			if(response == 'success'){
				document.getElementById('result').innerHTML = '<p class="alert alert-success">Agent Approved!</p>';
				setTimeout(function () {
					window.location.reload();
				}, 3000);
				return;
			}else{
				document.getElementById('result').innerHTML = '<p class="alert alert-warning">' + response + '</p>';
				setTimeout(function () {
					window.location.reload();
				}, 3000);
				return;
			}
			}
		});
	event.preventDefault();
	}
function replyreview(id){
  $('#reply_review'+id).modal('show');
}
<?php if (isset($_GET['disputeid'])) {?>

  setInterval(function() {
    // load_dispute(<?php echo '"'.$_GET['disputeid'].'"'; ?>);
  }, 5000);
<?php } ?>

    function load_dispute(id) {
      $.ajax({
        type: 'GET',
        url: '<?= BASE_URL ?>api/controllers/get_dispute.php',
        data: {
          id : id,
        },
        cache: false,
        dataType: 'text',
        success: function (response) {// //console.log(response);
           $('#chat-box').html(response)

        },
        error: function (response) {

        }
      });
    }
    function getview(view) {
      $.ajax({
        type: 'GET',
        url: '<?= BASE_URL ?>api/controllers/get_admin_message_view.php',
        data: {
          view : view
        },
        cache: false,
        dataType: 'text',
        success: function (response) {
         $('#view').html(response)

        },
        error: function (response) {

        }
      });
    }
    function getMessage(id=0) {
      $.ajax({
        type: 'GET',
        url: '<?= BASE_URL ?>api/controllers/get_admin_message_view.php',
        data: {
          messageid : id,
          view : "seen"
        },
        cache: false,
        dataType: 'text',
        success: function (response) {
         $('#view').html(response)

        },
        error: function (response) {

        }
      });
    }

function reply_dispute_chat(receiverid) {
  var msg = $('#b_message').val()
  var time = "<?php echo date("Y-m-d H:i:s");?>";
  var img = "<?php echo $userClass->profilepic_link($userid);?>";

  // console.log($('#chat-box'+receiverid));

  $.ajax({
    type: 'POST',
    url: '<?= BASE_URL ?>api/controllers/dispute_response.php',

    data: {
      receiverid : $('#receiverid').val(),
      senderusername : $('#senderusername').val(),
      againstusername : $('#againstusername').val(),
      dispute_message : $('#b_message').val(),
      disputeid : $('#disputeid').val(),
      senderid : $('#senderid').val(),
      againstid : $('#againstid').val()

    },
    cache: false,
    dataType: 'text',
    success: function (response) {
      $('#chat-box'+receiverid).append(

         "   <div class='chat-box-wrapper chat-box-wrapper-right float-right' style=' width: 52%;'>"+
           "     <div>"+
           "         <div class='chat-box bg-secondary text-white'>"+msg+
           "         </div>"+
           "         <small class='opacity-6'>"+
           "             <i class='fa fa-calendar-alt mr-1'></i>"+
           "            "+time+" "+
           "         </small>"+
           "     </div>"+
           "     <div>"+
           "         <div class='avatar-icon-wrapper ml-1'>"+
           "             <div class='badge badge-bottom btn-shine badge-success badge-dot badge-dot-lg'></div>"+
           "             <div class='avatar-icon avatar-icon-lg rounded'><img src='"+img+"'"+
           "                     alt=''></div>"+
           "         </div>"+
           "     </div>"+
       " </div>")
       $('#b_message').val('')
       $(".chatbox").stop().animate({ scrollTop: $(".chatbox")[0].scrollHeight}, 1000);

    },
    error: function (response) {
//console.log(response);
    }
  });
}
function SendReply(id) {
            document.getElementById("reply"+id).innerHTML = "Please wait...";
            document.getElementById("replyBtn"+id).disabled = true;
            var data = {
				reviewid : id,
				product_id  : $("#p"+id).val(),
				user_id     : $("#u"+id).val(),
				rating     : $("#rt"+id).val(),
				r_name      : $("#n"+id).val(),
				r_email     : $("#e"+id).val(),
				r_title       : $("#t"+id).val(),
				r_body      : $("#reply"+id).val()
            }
            $.ajax({
                    type: 'POST',
                    url: '<?= BASE_URL ?>api/controllers/reply_review.php',
                    data: data,
                    cache: false,
                    dataType: 'text',
                    success: function (response) {
                        //console.log(response);
                        if(response){
                          document.getElementById("replyBtn"+id).innerHTML = "Reply Sent";
                          document.getElementById("replyBtn"+id).disabled = false;
                          document.getElementById('result'+id).innerHTML = '<p class="alert alert-success">Reply Sent!</p>';
                          window.location.reload();
                            return true;
                        }
                    }
                });
                event.preventDefault();

}
function deactivateAgent(agentid){
  // alert(agentid);
  // return;
  $.ajax({
  	type: 'POST',
  	url: '<?= BASE_URL ?>api/controllers/deactivate_agent.php',
  	data: {
  		agentid : agentid
  	},
  	cache: false,
  	dataType: 'text',
  	success: function (response) {
          // alert(response);
          // return;
          if(response == 'success'){
          	document.getElementById('result').innerHTML = '<p class="alert alert-danger">Agent Disapproved!</p>';
          	setTimeout(function () {
          		window.location.reload();
          	}, 3000);
          	return;
          }else{
          	document.getElementById('result').innerHTML = '<p class="alert alert-warning">' + response + '</p>';
          	setTimeout(function () {
          		window.location.reload();
          	}, 3000);
          	return;
          }
        }
      });
  event.preventDefault();
}

function activateVerify(verifyid, userid){
  // alert(userid);
  // return;
  $.ajax({
  	type: 'POST',
  	url: '<?= BASE_URL ?>api/controllers/activate_verify.php',
  	data: {
  		verifyid : verifyid,
  		userid : userid
  	},
  	cache: false,
  	dataType: 'text',
  	success: function (response) {
          // alert(response);
          // return;
          if(response == 'success'){
          	document.getElementById('result').innerHTML = '<p class="alert alert-success">Seller has been verified!</p>';
          	setTimeout(function () {
          		window.location.reload();
          	}, 3000);
          	return;
          }else{
          	document.getElementById('result').innerHTML = '<p class="alert alert-warning">' + response + '</p>';
          	setTimeout(function () {
          		window.location.reload();
          	}, 3000);
          	return;
          }
        }
      });
  event.preventDefault();
}

function deactivateVerify(verifyid, userid){
  // alert(userid);
  // return;
  $.ajax({
  	type: 'POST',
  	url: '<?= BASE_URL ?>api/controllers/deactivate_verify.php',
  	data: {
  		verifyid : verifyid,
  		userid : userid
  	},
  	cache: false,
  	dataType: 'text',
  	success: function (response) {
          // alert(response);
          // return;
          if(response == 'success'){
          	document.getElementById('result').innerHTML = '<p class="alert alert-danger">Seller could not be verified!</p>';
          	setTimeout(function () {
          		window.location.reload();
          	}, 3000);
          	return;
          }else{
          	document.getElementById('result').innerHTML = '<p class="alert alert-warning">' + response + '</p>';
          	setTimeout(function () {
          		window.location.reload();
          	}, 3000);
          	return;
          }
        }
      });
  event.preventDefault();
}

function edit_category(catid){
	$.ajax({
		type: 'POST',
		url: '<?= BASE_URL ?>api/controllers/category_admin_action.php',
		data: {
			catid : catid,
			action : edit_category
		},
		cache: false,
		dataType: 'text',
		success: function (response) {
			$('.subInfo').html('<span class="alert alert-danger>'+response+'</span>');
			setTimeout(function () {
				$('.popup-close').click();
				alert("You have successfully subscribe to our newsletter, enjoy your stay on OJARH.com!")
			}, 3000);
		}
	});
	event.preventDefault();
}
</script>
</body>

</html>
