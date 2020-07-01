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
                                                                                            <label class="form-check-label col-md-3">
                                                                                                <input name="verificationtype" type="radio" value="National ID" class="form-check-input">National ID
                                                                                            </label>
                                                                                            <label class="form-check-label col-md-3">
                                                                                                <input name="verificationtype" type="radio" value="Drivers License" class="form-check-input">Drivers License
                                                                                            </label>
                                                                                            <label class="form-check-label col-md-3">
                                                                                                <input name="verificationtype" type="radio" value="Voters Card" class="form-check-input">Voters Card
                                                                                            </label>
                                                                                            <label class="form-check-label col-md-3">
                                                                                                <input name="verificationtype" type="radio" value="CAC" class="form-check-input">CAC
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
