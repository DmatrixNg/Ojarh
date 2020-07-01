<?php include 'inc/header.php'; ?>
                <div class="app-inner-layout app-inner-layout-page">
                    <div class="app-inner-layout__wrapper">
                        <div class="app-inner-layout__content">
                                    <div class="container-fluid">
                                        <?php
                                            if($acctType->account_type == 'Starter'){
                                                echo '<div class="card-body row">
                                                     <div class="alert alert-danger show col-md-12" role="alert">
                                                        You can do more when you upgrade your account to BASIC &amp; PREMIUM!
                                                        <a href="#"><button class="btn btn-warning btn-sm"  data-toggle="modal" data-target="#exampleModal">Upgrade Now!</button></a>
                                                     </div>
                                                 </div>';
                                            }elseif($acctType->account_type == 'Basic'){
                                                echo '<div class="card-body row">
                                                     <div class="alert alert-danger show col-md-12" role="alert">
                                                        You can do more when you upgrade your account to PREMIUM!
                                                        <a href="#"><button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#exampleModal">Upgrade Now!</button></a>
                                                     </div>
                                                 </div>';
                                            }
                                         ?>
                                         
                                        <div class="row">
                                                <div class="mb-3 card">
                                                    <?php
                                                        $noo = $userClass->accountdetails($userid);
                                                        if($noo == 1){
                                                    ?>
                                                    <div class="card-body row">
                                                        <div class="col-md-3">
                                                            <h3 class="text-danger">Account Verification</h3>
                                                            <div class="divider"></div>
                                                            <span class="text-success">Fill out the form carefully by uploading the data page of any means of identification</span>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="card-body">
                                                                    <div class="card">
                                                                        <?php if(isset($_GET['result'])){ ?>
                                                                        <div class="b-radius-0 card-header">
                                                                            <button type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" class="text-left m-0 p-0 btn btn-link btn-block">
                                                                                <span class="form-heading"><?php echo $_GET['result']; ?></span>
                                                                            </button>
                                                                        </div>
                                                                        <?php } ?>
                                                                            <div class="card-body"><h5 class="card-title">Choose Document Type</h5>
                                                                                <form action="../api/controllers/verify_seller.php" method="POST" enctype="multipart/form-data">
                                                                                    <fieldset class="position-relative form-group">
                                                                                        <div class="position-relative form-check row">
                                                                                            <label class="form-check-label col-md-3">
                                                                                                <input name="verificationtype" type="radio" value="International Passport" class="form-check-input">International Passport
                                                                                            </label>
                                                                                            <label class="form-check-label col-md-2">
                                                                                                <input name="verificationtype" type="radio" value="National ID" class="form-check-input">National ID
                                                                                            </label>
                                                                                            <label class="form-check-label col-md-3">
                                                                                                <input name="verificationtype" type="radio" value="Drivers License" class="form-check-input">Drivers License
                                                                                            </label>
                                                                                            <label class="form-check-label col-md-3">
                                                                                                <input name="verificationtype" type="radio" value="Voters Card" class="form-check-input">Voters Card
                                                                                            </label>
                                                                                        </div>
                                                                                    </fieldset>
                                                                                    <div class="divider"></div>
                                                                                    <div class="position-relative form-group ml-3 mr-3">
                                                                                        <div class="row">
                                                                                            <label for="exampleEmail4">Upload image here</label>
                                                                                            <input type="file" name="verifyimage" id="verifyimage" class="form-control col-md-11" required>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="text-right">
                                                                                        <input type="submit" name="submit" value="Submit" class="btn-shadow btn-sm btn btn-danger btn-lg">
                                                                                    </div>
                                                                                </form>
                                                                            </div>
                                                                    </div>
                                                            </div>
                                                            <div class="no-results" style="display: none;">
                                                                <div class="swal2-icon swal2-success swal2-animate-success-icon">
                                                                    <div class="swal2-success-circular-line-left"
                                                                         style="background-color: rgb(255, 255, 255);"></div>
                                                                    <span class="swal2-success-line-tip"></span>
                                                                    <span class="swal2-success-line-long"></span>
                                                                    <div class="swal2-success-ring"></div>
                                                                    <div class="swal2-success-fix"
                                                                         style="background-color: rgb(255, 255, 255);"></div>
                                                                    <div class="swal2-success-circular-line-right"
                                                                         style="background-color: rgb(255, 255, 255);"></div>
                                                                </div>
                                                                <div class="results-subtitle mt-4">Finished!
                                                                </div>
                                                                <div class="results-title">You arrived at the
                                                                    last form
                                                                    wizard step!
                                                                </div>
                                                                <div class="mt-3 mb-3"></div>
                                                                <div class="text-center">
                                                                    <button class="btn-shadow btn-wide btn btn-success btn-lg">
                                                                        Finish
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php } else{ ?>
                                                    <div class="card-body row">
                                                        <div class="col-md-12 text-center">
                                                            <div class="divider"></div>
                                                            <div class="alert alert-warning">NB: You have to update your account details to be able to add product.</div>
                                                            <a href="account_details.php" class="btn btn-danger">Update Account Details</a>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                                </div>
                                        </div>
                                    </div>
                        </div>
                    </div>
                </div>
<?php include 'inc/footer.php'; ?>
<!--
market
product_category
-->

<script type="text/javascript">
    $(document).ready(function() {
        $("#market").change(function(){
            var selectedloc = $("#market option:selected").val();
            $("#product_category").html("<option value=''>Select Product Category</option>");
            $.ajax({
                type: 'POST',
                url: '../api/controllers/process-loc.php',
                data: {
                    loc : selectedloc
                },
                cache: false,
                dataType: 'text',
                success: function (response) {
                    var obj = JSON.parse(response);
                    var areaOption = "<option value=''>Select Product Category</option>";
                    for (var i = 0; i < obj.length; i++) {
                        areaOption += '<option value="' + obj[i] + '">' + obj[i] + '</option>'
                    }
                    $("#product_category").html(areaOption);
                }
            });
            event.preventDefault();
        });
    });
</script>
