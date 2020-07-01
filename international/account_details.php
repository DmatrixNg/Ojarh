<?php
include('../api/config/Database.php');
include('../api/models/session.php');
if(!isset($_SESSION['role']) || empty($_SESSION['role'])  || $_SESSION['role']!='International')
    {
        session_destroy();
        session_unset();
        header("Location: " . BASE_URL);
    }
?>
<?php include 'inc/header.php'; ?>
                <div class="app-inner-layout app-inner-layout-page">
                    <div class="app-inner-layout__wrapper">
                        <div class="app-inner-layout__content pt-1">
                            <div class="tab-content">
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
                                     <?php
                                        if($acctType->account_type == 'Premium' && $userClass->bizDetails($userid) == 'empty'){
                                            echo '<div class="card-body row">
                                                        <div class="alert alert-danger show col-md-12" role="alert">
                                                        You have to update your business information <a href="business_setting.php"><button class="btn btn-info btn-sm">Update business profile</button></a>
                                                        </div>
                                                    </div>';
                                        }else{

                                        }
                                    ?>
                                    <div class="row">
                                        <div class="col-md-12 col-lg-6 col-xl-4">
                                            <div class="main-card mb-3 card">
                                                <?php if($userClass->acctdetails($userid) == 'empty'){ ?>
                                                    <div class="card-body">
                                                        <h3>Bank Account Information</h3>
                                                        <ul class="list-group">
                                                            <li class="list-group-item">
                                                                <h5 class="list-group-item-heading">Bank Name</h5>
                                                                <p class="list-group-item-text">bank name here</p>
                                                            </li>
                                                            <li class="list-group-item">
                                                                <h5 class="list-group-item-heading">Account Number</h5>
                                                                <p class="list-group-item-text">account number here</p>
                                                            </li>
                                                            <li class="list-group-item">
                                                                <h5 class="list-group-item-heading">Account Name</h5>
                                                                <p class="list-group-item-text">account name here</p>
                                                            </li>
                                                            <li class="list-group-item">
                                                                <h5 class="list-group-item-heading">Account Type</h5>
                                                                <p class="list-group-item-text">account type here</p>
                                                            </li>
                                                            <li class="list-group-item">
                                                                <button class="btn btn-secondary">Update Details</button>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                <?php }else{ ?>
                                                    <div class="card-body">
                                                        <h3>Bank Account Information</h3>
                                                        <ul class="list-group">
                                                            <li class="list-group-item">
                                                                <h5 class="list-group-item-heading">Bank Name</h5>
                                                                <p class="list-group-item-text"><?php echo $acctdetails->bankname; ?></p>
                                                            </li>
                                                            <li class="list-group-item">
                                                                <h5 class="list-group-item-heading">Account Number</h5>
                                                                <p class="list-group-item-text"><?php echo $acctdetails->accountnumber; ?></p>
                                                            </li>
                                                            <li class="list-group-item">
                                                                <h5 class="list-group-item-heading">Account Name</h5>
                                                                <p class="list-group-item-text"><?php echo $acctdetails->accountname; ?></p>
                                                            </li>
                                                            <li class="list-group-item">
                                                                <h5 class="list-group-item-heading">Account Type</h5>
                                                                <p class="list-group-item-text"><?php echo $acctdetails->accounttype; ?></p>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-lg-6 col-xl-8">
                                            <div class="main-card mb-3 card">

                                                <?php if($userClass->acctdetails($userid) == 'empty'){ ?>
                                                    <div id="pfBody" class="card-body">
                                                        <div class="forms-wizard-vertical">
                                                            <div class="card-body">
                                                                <h3>Account Information</h3>
                                                                <div class="divider"></div>
                                                                <div class="form-group row">
                                                                     <div class="col-md-6">
                                                                        <label for="exampleEmail5">Bank Name</label>
                                                                        <select type="text" class="form-control" name="bankname" id="bankname">
                                                                            <option selected>Choose</option>
                                                                            <option value="access">Access Bank</option>
                                                                            <option value="citibank">Citibank</option>
                                                                            <option value="diamond">Diamond Bank</option>
                                                                            <option value="ecobank">Ecobank</option>
                                                                            <option value="fidelity">Fidelity Bank</option>
                                                                            <option value="fcmb">First City Monument Bank (FCMB)</option>
                                                                            <option value="fsdh">FSDH Merchant Bank</option>
                                                                            <option value="gtb">Guarantee Trust Bank (GTB)</option>
                                                                            <option value="heritage">Heritage Bank</option>
                                                                            <option value="Keystone">Keystone Bank</option>
                                                                            <option value="rand">Rand Merchant Bank</option>
                                                                            <option value="skye">Skye Bank</option>
                                                                            <option value="stanbic">Stanbic IBTC Bank</option>
                                                                            <option value="standard">Standard Chartered Bank</option>
                                                                            <option value="sterling">Sterling Bank</option>
                                                                            <option value="suntrust">Suntrust Bank</option>
                                                                            <option value="union">Union Bank</option>
                                                                            <option value="uba">United Bank for Africa (UBA)</option>
                                                                            <option value="unity">Unity Bank</option>
                                                                            <option value="wema">Wema Bank</option>
                                                                            <option value="zenith">Zenith Bank</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label for="exampleEmail5">Account Number</label>
                                                                        <input type="text" id="accountnumber" name="accountnumber" class="form-control">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <div class="col-md-12">
                                                                        <label for="exampleEmail5">Account Name</label>
                                                                        <input type="text" id="accountname" name="accountname" class="form-control">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <div class="col-md-12">
                                                                        <label for="exampleEmail5">Account Type</label>
                                                                        <select class="form-control" id="accounttype" name="accounttype">
                                                                            <option value="">Choose...</option>
                                                                            <option value="Current">Current Account</option>
                                                                            <option value="Savings">Savings Account</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div id="result"></div>
                                                        <div class="divider"></div>
                                                        <div class="clearfix">
                                                            <button type="button" id="updateAcct"
                                                                    class="btn-shadow btn-wide float-right btn-pill btn-hover-shine btn btn-primary">
                                                                Update Account
                                                            </button>
                                                        </div>
                                                    </div>
                                                <?php }else{ ?>
                                                    <div id="pfBody" class="card-body">
                                                        <div class="forms-wizard-vertical">
                                                            <div class="card-body">
                                                                <h3>Account Information</h3>
                                                                <div class="divider"></div>
                                                                <div class="form-group row">
                                                                     <div class="col-md-6">
                                                                        <label for="exampleEmail5">Bank Name</label>
                                                                        <input type="text" value="<?php echo $acctdetails->bankname; ?>" class="form-control" disabled>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label for="exampleEmail5">Account Number</label>
                                                                        <input type="text" value="<?php echo $acctdetails->accountnumber; ?>" class="form-control" disabled>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <div class="col-md-12">
                                                                        <label for="exampleEmail5">Account Name</label>
                                                                        <input type="text" value="<?php echo $acctdetails->accountname; ?>" class="form-control" disabled>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <div class="col-md-12">
                                                                        <label for="exampleEmail5">Account Type</label>
                                                                        <input type="text" value="<?php echo $acctdetails->accounttype; ?>" class="form-control" disabled>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div id="result"></div>
                                                        <div class="divider"></div>
                                                        <div class="clearfix">
                                                            <button type="button" class="btn-shadow btn-wide float-right btn-pill btn-hover-shine btn btn-primary"> Request changes </button>
                                                        </div>
                                                    </div>
                                                <?php } ?>



                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
<?php include 'inc/footer.php'; ?>
    <script type="text/javascript">
        $(document).ready(function (e) {
            $("#updateAcct").on('click', function () {
                document.getElementById('updateAcct').innerHTML = "Updating...";
                document.getElementById('updateAcct').disabled = true;
                // alert('yes');
                // return;
                if ($("#bankname").val() !== "" && $("#accountnumber").val() !== "" && $("#accountname").val() !== "" && $("#accounttype").val() !== "") {
                    $.ajax({
                        type: 'POST',
                        url: '../api/controllers/add_accountdetails.php',
                        data: {
                            bankname : $("#bankname").val(),
                            accountnumber : $("#accountnumber").val(),
                            accountname : $("#accountname").val(),
                            accounttype : $("#accounttype").val()
                        },
                        cache: false,
                        dataType: 'text',
                        success: function (response) {
                            // alert(response);
                            // return;
                            if(response == 'success'){
                                document.getElementById('updateAcct').innerHTML = 'Update Account';
                                document.getElementById('updateAcct').disabled = false;
                                 document.getElementById('result').innerHTML = '<p class="alert alert-success">Update successful!</p>';
                                setTimeout(function () {
                                    window.location.reload();
                                }, 3000);
                                return false;
                            }else if(response == 'exist'){
                                document.getElementById('updateAcct').innerHTML = 'Update Account';
                                document.getElementById('updateAcct').disabled = false;
                                 document.getElementById('result').innerHTML = '<p class="alert alert-warning">You already updated your account details!</p>';
                                setTimeout(function () {
                                    window.location.reload();
                                }, 3000);
                                return false;
                            }else{
                                 document.getElementById('updateAcct').innerHTML = 'Update Account';
                                 document.getElementById('result').innerHTML = '<p class="alert alert-danger">Error trying to update your profile, contact our customer care representative!</p>';
                                document.getElementById('updateAcct').disabled = false;
                                setTimeout(function () {
                                    window.location.reload();
                                }, 3000);
                                return false;
                            }
                        }
                    });
                    event.preventDefault();
                } else {
                    document.getElementById('result').innerHTML = '<p class="alert alert-danger">Please fill in your information.</p>';
                    document.getElementById('updateAcct').innerHTML = "Retry";
                    document.getElementById('updateAcct').disabled = false;
                }
            });
        });
    </script>
